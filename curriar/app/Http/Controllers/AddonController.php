<?php

namespace App\Http\Controllers;

use App\Addon;
use App\Menu;
use Illuminate\Http\Request;
use ZipArchive;
use DB;
use Auth;
use App\BusinessSetting;
use App\Http\Helpers\SpotConfigHelper;
use SpotlayerCheck;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Storage;


use App\Client;
use App\Http\Helpers\UserRegistrationHelper;
use App\User;
use App\UserClient;
use App\Events\AddClient;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SpotlayerCheck::instantiateShopRepository();
        return view('backend.addons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.addons.create');
    }

    private function recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }

        if (class_exists('ZipArchive')) {
            if ($request->hasFile('addon_zip')) {

                if ($request->addon_zip->getClientOriginalExtension() != 'zip') {
                    flash(translate('Please upload correct addon zipped file!'))->error();
                    return back();
                }
                // Create update directory.
                $dir = 'addons';
                if (!is_dir($dir))
                    mkdir($dir, 0777, true);

                $path = Storage::disk('local')->put('addons', $request->addon_zip);

                $zipped_file_name = $request->addon_zip->getClientOriginalName();

                //Unzip uploaded update file and remove zip file.
                $zip = new ZipArchive;
                $res = $zip->open(base_path('public/' . $path));

                $random_dir = Str::random(10);

                $dir = trim($zip->getNameIndex(0), '/');

                if ($res === true) {
                    $res = $zip->extractTo(base_path('temp/' . $random_dir . '/addons'));
                    $zip->close();
                } else {
                    dd('could not open');
                }

                $str = file_get_contents(base_path('temp/' . $random_dir . '/addons/' . $dir . '/config.json'));

                $json = json_decode($str, true);



                $files = array();

                if (!empty($json['files'])) {
                    foreach ($json['files'] as $file) {
                        $files[] = $file['update_directory'];
                    }
                }

                // TODO: add any sql changes in database so it can be revert again when uninstall

                if (BusinessSetting::where('type', 'current_version')->first()->value >= $json['minimum_item_version']) {
                    if (count(Addon::where('unique_identifier', $json['unique_identifier'])->get()) == 0) {
                        if (isset($json['required_addons'])) {
                            $req_addons = explode(',', $json['required_addons']);
                            if (count(Addon::whereIn('unique_identifier', $req_addons)->get()) == 0) {
                                flash(translate('This addon is required another addons') . ' (' . $json['required_addons'] . ')')->error();
                                return back();
                            }
                        }
                        DB::beginTransaction();
                        try {
                            $this->recurse_copy(base_path('temp/' . $random_dir . '/addons/' . $dir), base_path('addons/' . $json['unique_identifier'] . '/'));
                            $addon = new Addon;
                            $addon->name = $json['name'];
                            $addon->unique_identifier = $json['unique_identifier'];
                            if (isset($json['required_addons'])) {
                                $addon->required_addons = $json['required_addons'];
                            }
                            $addon->version = $json['version'];
                            $addon->activated = 1;
                            $addon->image = $json['addon_banner'];
                            $addon->files = implode(',', $files);


                            // Create new directories.
                            if (!empty($json['directory'])) {
                                //dd($json['directory'][0]['name']);
                                foreach ($json['directory'][0]['name'] as $directory) {
                                    if (is_dir(base_path($directory)) == false) {
                                        mkdir(base_path($directory), 0777, true);
                                    } else {
                                        echo "error on creating directory";
                                    }
                                }
                            }

                            // Create/Replace new files.
                            if (!empty($json['files'])) {
                                foreach ($json['files'] as $key => $file) {
                                    try {
                                        copy(base_path('temp/' . $random_dir . '/' . $file['root_directory']), base_path($file['update_directory']));
                                    } catch (\Throwable $th) {
                                        $this->rollback($json, $addon ?? null);
                                        print_r($th->getMessage());
                                        exit;
                                    }
                                }
                            }
                            // Run sql modifications
                            $sql_path = base_path('temp/' . $random_dir . '/addons/' . $dir . '/sql/update.sql');
                            $migrations_temp_path = 'temp/' . $random_dir . '/addons/' . $dir . '/sql/migrations';
                            $migrations_path =  base_path($migrations_temp_path);
                            if (file_exists($sql_path)) {
                                DB::unprepared(file_get_contents($sql_path));
                            } elseif (file_exists($migrations_path)) {
                                //delte migration rollback files info from migrations table
                                $migrations_path_old = 'addons/' . $addon->unique_identifier . '/sql/migrations/rollbacks/';
                                if (file_exists($migrations_path_old)) {
                                    $files = \File::files($migrations_path_old);
                                    foreach ($files as $file) {
                                        $file_name_without_ext = explode('.', $file->getFilename())[0];
                                        DB::table('migrations')->where('migration', $file_name_without_ext)->delete();
                                    }
                                }
                                $files = \File::files($migrations_path);
                                foreach ($files as $file) {
                                    Artisan::call('migrate', array('--path' => $migrations_temp_path . '/' . $file->getFilename(), '--force' => true));
                                }
                            }
                            $addon->save();
                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollback();
                            $this->rollback($json, $addon ?? null);
                            print_r($e->getMessage());
                            exit;

                            flash(translate("Error"))->error();
                            return back();
                        }

                        flash(translate('Addon installed successfully'))->success();
                        return redirect()->route('addons.index');
                    } else {
                        DB::beginTransaction();
                        try {
                            // Create new directories.
                            if (!empty($json['directory'])) {
                                //dd($json['directory'][0]['name']);
                                foreach ($json['directory'][0]['name'] as $directory) {
                                    if (is_dir(base_path($directory)) == false) {
                                        mkdir(base_path($directory), 0777, true);
                                    }
                                }
                            }

                            // Create/Replace new files.
                            if (!empty($json['files'])) {
                                foreach ($json['files'] as $file) {
                                    copy(base_path('temp/' . $random_dir . '/' . $file['root_directory']), base_path($file['update_directory']));
                                }
                            }

                            $addon = Addon::where('unique_identifier', $json['unique_identifier'])->first();
                            $this->recurse_copy(base_path('temp/' . $random_dir . '/addons/' . $dir), base_path('addons/' . $json['unique_identifier'] . '/'));
                            for ($i = $addon->version + 0.1; $i <= $json['version']; $i = $i + 0.1) {
                                // Run sql modifications
                                $sql_path = base_path('temp/' . $random_dir . '/addons/' . $dir . '/sql/' . $i . '.sql');
                                $migrations_temp_path = 'temp/' . $random_dir . '/addons/' . $dir . '/sql/migrations/' . $i;
                                $migrations_path =  base_path($migrations_temp_path);
                                if (file_exists($sql_path)) {
                                    DB::unprepared(file_get_contents($sql_path));
                                } elseif (file_exists($migrations_path)) {
                                    $files = \File::files($migrations_path);
                                    foreach ($files as $file) {
                                        Artisan::call('migrate', array('--path' => $migrations_temp_path . '/' . $file->getFilename(), '--force' => true));
                                    }
                                }
                            }

                            $addon->files = implode(',', $files);
                            $addon->version = $json['version'];
                            $addon->save();
                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollback();
                            $this->rollback($json, $addon ?? null);
                            print_r($e->getMessage());
                            exit;

                            flash(translate("Error"))->error();
                            return back();
                        }

                        flash(translate('This addon is updated successfully'))->success();
                        return redirect()->route('addons.index');
                    }
                } else {
                    flash(translate('This version is not capable of installing Addons, Please update.'))->error();
                    return redirect()->route('addons.index');
                }
            }
        } else {
            flash(translate('Please enable ZipArchive extension.'))->error();
        }
    }

    public function forceDelete($id)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $addon = Addon::find($id);
        $addon_folder = base_path('addons/' . $addon->unique_identifier . '/');
    }

    private function rollback($json, $addon)
    {
        foreach ($json['files'] as $subkey => $temp_file) {
            if (file_exists($temp_file['update_directory'])) {
                unlink(base_path($temp_file['update_directory']));
            }
        }
        foreach ($json['directory'][0]['name'] as $directory) {
            if (is_dir(base_path($directory)) == true) {
                $this->delete_directory(base_path($directory));
            }
        }
        if ($addon) {
            $this->delete_directory(base_path('addons/' . $addon->unique_identifier . '/'));
        }
    }

    private function delete_directory($dirname)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        else
            return false;
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else
                    $this->delete_directory($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
    public function generate()
    {
        return view('backend.addons.generate');
    }
    private function create_addon_structure($unique_id, $views_folder_name, $config)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }

        $addons_path = base_path('addons/');
        mkdir($addons_path . $unique_id, 0777, true);
        mkdir($addons_path . $unique_id . '/controllers', 0777, true);
        mkdir($addons_path . $unique_id . '/assets', 0777, true);
        mkdir($addons_path . $unique_id . '/documentation', 0777, true);
        mkdir($addons_path . $unique_id . '/helpers', 0777, true);
        mkdir($addons_path . $unique_id . '/Resources', 0777, true);
        mkdir($addons_path . $unique_id . '/routes', 0777, true);
        mkdir($addons_path . $unique_id . '/sql', 0777, true);
        mkdir($addons_path . $unique_id . '/sql/migrations', 0777, true);
        mkdir($addons_path . $unique_id . '/sql/migrations/rollbacks', 0777, true);
        mkdir($addons_path . $unique_id . '/views', 0777, true);
        mkdir($addons_path . $unique_id . '/views/hooks', 0777, true);
        mkdir($addons_path . $unique_id . '/views/' . $views_folder_name, 0777, true);
        mkdir($addons_path . $unique_id . '/views/' . $views_folder_name . '/backend', 0777, true);
        mkdir($addons_path . $unique_id . '/views/' . $views_folder_name . '/frontend', 0777, true);
        mkdir($addons_path . $unique_id . '/views/' . $views_folder_name . '/inc', 0777, true);
        mkdir($addons_path . $unique_id . '/views/' . $views_folder_name . '/permissions', 0777, true);
        $config_file = $addons_path . $unique_id . '/config.json';
        fopen($config_file, "w");
        file_put_contents($config_file, $config);
    }
    private function reverseConfigExecution($config = array())
    {

        if (!empty($config['files'])) {
            foreach ($config['files'] as $file) {
                copy(base_path($file['update_directory']), base_path($file['root_directory']));
            }
        }
    }
    private function zipAddon($unique_id)
    {
        // // Enter the name of directory 
        // $pathdir =  base_path("addons/".$unique_id);

        // // Enter the name to creating zipped directory 
        // $zipcreated = "addons/".$unique_id.".zip";

        // // Create new zip class 
        // $zip = new ZipArchive;

        // if ($zip->open($zipcreated, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        //     // Store the path into the variable 
        //     $dir = opendir($pathdir);
        //     while ($file = readdir($dir)) {
        //         if (is_file($pathdir . $file)) {
        //             $zip->addFile($pathdir . $file, $file);
        //         }
        //     }
        //     $zip->close();
        // }
    }
    public function generator(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }

        try {
            DB::beginTransaction();
            $check = Addon::where('unique_identifier', $request->unique_identifier)->count();
            if ($check > 0) {
                flash(translate('This addon created before , please check "unique_identifier" '))->error();
                return back();
            }
            $addon = new Addon;
            $addon->name = $request->title;
            $addon->unique_identifier = $request->unique_identifier;
            if (isset($request->required_addons) && !empty($request->required_addons)) {
                $addon->required_addons = $request->required_addons;
            }
            $addon->version = $request->version;
            $addon->activated = 1;
            $addon->image = "test";
            if ($addon->save()) {
                $files_array = array();
                $folders = array();
                $controller_path = "";
                $models_path = "";
                $views_path = "";
                $addon_root_dir = 'addons/' . $request->unique_identifier . '/';


                $create_model = array('command' => 'make:model ' . $request->model_file_name, 'params' => array(), 'creation_path' => 'app/');
                $create_controller = array('command' => 'make:controller ' . $request->controller_file_name . ' --resource', 'params' => array(), 'creation_path' => 'app/Http/Controllers/');
                Artisan::call($create_controller['command']);
                array_push($files_array, ['root_directory' => $addon_root_dir . 'controllers/' . $request->controller_file_name . '.php', 'update_directory' => $create_controller['creation_path'] . $request->controller_file_name . '.php']);
                Artisan::call($create_model['command']);
                array_push($files_array, ['root_directory' => $addon_root_dir . $request->model_file_name . '.php', 'update_directory' => $create_model['creation_path'] . $request->model_file_name . '.php']);
                fopen(base_path('routes/addons/' . $request->route_file_name), "w");
                array_push($files_array, ['root_directory' => $addon_root_dir . 'routes/' . $request->route_file_name, 'update_directory' => 'routes/addons/' . $request->route_file_name]);
                $view_folder_full_path = 'resources/views/backend/' . $request->view_folder_name;
                if (is_dir(base_path($view_folder_full_path)) == false) {
                    mkdir(base_path($view_folder_full_path), 0777, true);
                }
                array_push($folders, $view_folder_full_path);
                $counter = count($files_array);
                foreach ($request->views as $view) {
                    fopen(base_path($view_folder_full_path . '/' . $view['view_file_name']), "w");
                    $files_array[$counter]['root_directory'] = $addon_root_dir . 'views/' . $request->view_folder_name . '/backend/' . $view['view_file_name'];
                    $files_array[$counter]['update_directory'] = $view_folder_full_path . '/' . $view['view_file_name'];
                    $counter++;
                }
                fopen(base_path('resources/views/backend/inc/addons/' . $addon->unique_identifier . '_sidenav.blade.php'), "w");
                array_push($files_array, ['root_directory' => $addon_root_dir . 'views/' . $request->view_folder_name . '/inc/' . $addon->unique_identifier . '_sidenav.blade.php', 'update_directory' => 'resources/views/backend/inc/addons/' . $addon->unique_identifier . '_sidenav.blade.php']);
                fopen(base_path('resources/views/backend/permissions/' . $addon->unique_identifier . '_permissions.blade.php'), "w");
                array_push($files_array, ['root_directory' => $addon_root_dir . 'views/' . $request->view_folder_name . '/permissions/' . $addon->unique_identifier . '_permissions.blade.php', 'update_directory' => 'resources/views/backend/permissions/' . $addon->unique_identifier . '_permissions.blade.php']);



                $config_array = [
                    'name' => $request->title,
                    'unique_identifier' => $addon->unique_identifier,
                    'version' => $request->version,
                    'minimum_item_version' => $request->minimum_item_version,
                    'addon_banner' => 'example.jpg',
                    'required_addons' => $request->required_addons,
                    'directory' => [
                        [
                            'name' => $folders,
                        ],
                    ],
                    'sql_file' => '',
                    'files' => $files_array

                ];
                $addon->files = json_encode($config_array);
                $addon->save();
                $fullConfigFileInJson = json_encode($config_array, JSON_PRETTY_PRINT);
                $this->create_addon_structure($addon->unique_identifier, $request->view_folder_name, $fullConfigFileInJson);
                $this->reverseConfigExecution($config_array);
                $this->zipAddon($addon->unique_identifier);
            }
            DB::commit();
            flash(translate("Addon generated successfully"))->success();
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;

            flash(translate("Error"))->error();
            return back();
        }
    }
    public function delete($id)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $addon = Addon::find($id);
        $addon_folder = base_path('addons/' . $addon->unique_identifier . '/');
        $str = file_get_contents($addon_folder . 'config.json');
        $json = json_decode($str, true);
        $addons = Addon::all();
        foreach ($addons as $s_addon) {
            $reqs = explode(',', $s_addon->required_addons);
            if (in_array($addon->unique_identifier, $reqs)) {
                flash(translate("You can't delete this addon , this addon required by another addons"))->error();
                return redirect()->route('addons.index');
            }
        }

        DB::beginTransaction();
        try {
            //delte migration files info from migrations table
            $migrations_path_old = 'addons/' . $addon->unique_identifier . '/sql/migrations/';
            if (file_exists($migrations_path_old)) {
                $files = \File::files($migrations_path_old);
                foreach ($files as $file) {
                    $file_name_without_ext = explode('.', $file->getFilename())[0];
                    DB::table('migrations')->where('migration', $file_name_without_ext)->delete();
                }
            }

            //Rollback database
            $migrations_temp_path = 'addons/' . $addon->unique_identifier . '/sql/migrations/rollbacks/';
            $migrations_path =  base_path($migrations_temp_path);
            if (file_exists($migrations_path)) {
                $files = \File::files($migrations_path);
                foreach ($files as $file) {
                    //rollback migration
                    Artisan::call('migrate', array('--path' => $migrations_temp_path . $file->getFilename(), '--force' => true));
                }
            }
            //Delete files
            if (!empty($json['files'])) {
                foreach ($json['files'] as $file) {
                    if (file_exists($file['update_directory'])) {
                        unlink(base_path($file['update_directory']));
                    }
                }
            }
            //Delete folders 
            if (!empty($json['directory'])) {
                //dd($json['directory'][0]['name']);
                foreach ($json['directory'][0]['name'] as $directory) {
                    if (is_dir(base_path($directory)) == true) {
                        $this->delete_directory(base_path($directory));
                    }
                }
            }

            $addon->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;

            flash(translate("Error"))->error();
            return back();
        }

        flash(translate('This addon is deleted successfully'))->success();
        return redirect()->route('addons.index');
    }

    public function resetSystem()
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $all_addons = Addon::all();
        foreach ($all_addons as $addon) {
            DB::beginTransaction();
            try {
                $addon_folder = base_path('addons/' . $addon->unique_identifier . '/');
                $str = file_get_contents($addon_folder . 'config.json');
                $json = json_decode($str, true);
                $addons = Addon::all();
                foreach ($addons as $s_addon) {
                    $reqs = explode(',', $s_addon->required_addons);
                    if (in_array($addon->unique_identifier, $reqs)) {
                        flash(translate("You can't delete this addon , this addon required by another addons"))->error();
                        return redirect()->route('addons.index');
                    }
                }

                //delte migration files info from migrations table
                $migrations_path_old = 'addons/' . $addon->unique_identifier . '/sql/migrations/';
                if (file_exists($migrations_path_old)) {
                    $files = \File::files($migrations_path_old);
                    foreach ($files as $file) {
                        $file_name_without_ext = explode('.', $file->getFilename())[0];
                        DB::table('migrations')->where('migration', $file_name_without_ext)->delete();
                    }
                }

                //Rollback database
                $migrations_temp_path = 'addons/' . $addon->unique_identifier . '/sql/migrations/rollbacks/';
                $migrations_path =  base_path($migrations_temp_path);
                if (file_exists($migrations_path)) {
                    $files = \File::files($migrations_path);
                    foreach ($files as $file) {
                        //rollback migration
                        Artisan::call('migrate', array('--path' => $migrations_temp_path . $file->getFilename(), '--force' => true));
                    }
                }
                //Delete files
                if (!empty($json['files'])) {
                    foreach ($json['files'] as $file) {
                        if (file_exists($file['update_directory'])) {
                            unlink(base_path($file['update_directory']));
                        }
                    }
                }
                //Delete folders 
                if (!empty($json['directory'])) {
                    //dd($json['directory'][0]['name']);
                    foreach ($json['directory'][0]['name'] as $directory) {
                        if (is_dir(base_path($directory)) == true) {
                            $this->delete_directory(base_path($directory));
                        }
                    }
                }
                $this->delete_directory(base_path('addons/' . $addon->unique_identifier . '/'));
                $addon->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                print_r($e->getMessage());
                exit;

                flash(translate("Error"))->error();
                return back();
            }
        }

        SpotConfigHelper::setValue("installable", "true");
        return redirect('/');
    }

    private function deleteDirectory($dir)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }
    
    public function exportCurrentDatabase()
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        Artisan::call('backup:mysql-dump db');
        copy(base_path('public/backups/db.sql'),base_path('/db.sql'));
        unlink(base_path('public/backups/db.sql'));
    }
  


    public function generateInstallabeFile()
    {
       
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }


        Artisan::call('backup:mysql-dump current');

        $all_addons = Addon::all()->pluck('unique_identifier');
        $oldAddons = $all_addons;
        //Drop all tables 
        $colname = 'Tables_in_' . env('DB_DATABASE');
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $droplist[] = $table->$colname;
        }
        $droplist = implode(',', $droplist);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement("DROP TABLE $droplist");
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        //Re-import 
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $sql_path = base_path('db.sql');
        DB::unprepared(file_get_contents($sql_path));
        Artisan::call('migrate');
        Artisan::call('db:seed');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        foreach ($oldAddons as $addon_id) {
            DB::beginTransaction();
            try {

                //Re-migrate addons tables 
                $addon_folder = base_path('addons/' . $addon_id . '/');
                $str = file_get_contents($addon_folder . 'config.json');
                $json = json_decode($str, true);
                $sql_path = base_path('addons/' . $addon_id . '/sql/update.sql');
                $migrations_temp_path = 'addons/' . $addon_id . '/sql/migrations';
                $migrations_path =  base_path($migrations_temp_path);
                if (file_exists($sql_path)) {
                    DB::unprepared(file_get_contents($sql_path));
                } elseif (file_exists($migrations_path)) {
                    //delte migration rollback files info from migrations table
                    $files = \File::files($migrations_path);
                    foreach ($files as $file) {
                        Artisan::call('migrate', array('--path' => $migrations_temp_path . '/' . $file->getFilename(), '--force' => true));
                    }
                }
                $addon = new Addon;
                $addon->name = $json['name'];
                $addon->unique_identifier = $json['unique_identifier'];
                if (isset($json['required_addons'])) {
                    $addon->required_addons = $json['required_addons'];
                }
                $addon->version = $json['version'];
                $addon->activated = 1;
                $addon->image = $json['addon_banner'];
                $addon->files = ' ';
                $addon->save();
                //Empty Temp folder
                $this->deleteDirectory(base_path('temp/'));
                mkdir(base_path() . '/temp', 0777, true);

                //Stop debug mode and reset .env
                $installabe_env = file_get_contents(base_path('installable.env'));
                $copy_to_current_env = file_put_contents(base_path('.env'), $installabe_env);
                // unlink($installabe_env);
                
                SpotConfigHelper::setValue("installable", "true");
                $this->exportCurrentDatabase();
                //remove addon manager link from side menu 
                SpotConfigHelper::setValue("is_dev", "false");

                //Compress to zip file
                // Get real path for our folder
                $rootPath = realpath('./');

                ini_set('max_execution_time', 0);

                // Initialize archive object
                $zip = new ZipArchive();
                $zip->open('installable.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

                // Create recursive directory iterator
                /** @var SplFileInfo[] $files */
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($rootPath),
                    \RecursiveIteratorIterator::LEAVES_ONLY
                );

                foreach ($files as $name => $file) {
                    // Skip directories (they would be added automatically)
                    if (!$file->isDir()) {
                        // Get real and relative path for current file
                        $filePath = $file->getRealPath();

                        $relativePath = substr($filePath, strlen($rootPath));
                        // Add current file to archive
                        $zip->addFile($filePath, $relativePath);
                    }
                }

                // Zip archive will be created only after closing object
                $zip->close();


                //Drop all tables and install the current database
                $colname = 'Tables_in_' . env('DB_DATABASE');
                $tables = DB::select('SHOW TABLES');
                foreach ($tables as $table) {
                    $droplist[] = $table->$colname;
                }
                $droplist = implode(',', $droplist);
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::statement("DROP TABLE $droplist");
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                $sql_path = base_path('public/backups/current.sql');
                DB::unprepared(file_get_contents($sql_path));
                unlink(base_path('public/backups/current.sql'));

                ini_set('max_execution_time', 60);
                SpotConfigHelper::setValue("installable","false");

                return redirect('/');

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                print_r($e->getMessage());
                exit;

                flash(translate("Error"))->error();
                return back();
            }
        }


    }

    public function writeEnvironmentFile($type, $val)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $path = base_path('.env');

        if (file_exists($path)) {

            $val = '"' . trim($val) . '"';

            file_put_contents($path, str_replace(
                $type . '="' . env($type) . '"',
                $type . '=' . $val,
                file_get_contents($path)
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function show(Addon $addon)
    {
        //
    }

    public function list()
    {
        //return view('backend.'.Auth::user()->role.'.addon.list')->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function edit(Addon $addon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function activation(Request $request)
    {
        $addon = Addon::find($request->id);
        //$menu  = Menu::where('displayed_name', $addon->unique_identifier)->first();
        $addon->activated = $request->status;

        $addon->save();
        //$menu->save();

        // $data = array(
        //     'status' => true,
        //     'notification' => translate('addon_status_updated_successfully')
        // );
        // return $data;

        return 1;
    }
}
