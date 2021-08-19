<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use DB;
use Artisan;
use Schema;
use App\BusinessSetting;
use App\Language;
use App\Upload;
use App\Banner;
use App\User;
use App\Slider;
use App\HomeCategory;
use Storage;
use ZipArchive;
use SpotlayerCheck;
use App\Http\Helpers\SpotConfigHelper;

class UpdateController extends Controller
{
    public function step0(Request $request) {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        if ($request->hasFile('update_zip')) {
            if (class_exists('ZipArchive')) {
                // Create update directory.
                $dir = 'updates';
                if (!is_dir($dir))
                    mkdir($dir, 0777, true);

                $path = Storage::disk('local')->put('updates', $request->update_zip);

                $zipped_file_name = $request->update_zip->getClientOriginalName();

                //Unzip uploaded update file and remove zip file.
                $zip = new ZipArchive;
                $res = $zip->open(base_path('public/' . $path));

                if ($res === true) {
                    $res = $zip->extractTo(base_path());
                    $zip->close();
                } else {
                    flash(translate('Could not open the updates zip file.'))->error();
                    return back();
                }

                return redirect()->route('update.step1');
            }
            else {
                flash(translate('Please enable ZipArchive extension.'))->error();
            }
        }
        else {
            return view('update.step0');
        }
    }

    public function step1() {
        if(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '5.1'){
            $sql_path = base_path('sqlupdates/v52.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        elseif(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '5.0'){
            $sql_path = base_path('sqlupdates/v52.sql');
            $sql_path = base_path('sqlupdates/v51.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        elseif(BusinessSetting::where('type', 'current_version')->first() != null && BusinessSetting::where('type', 'current_version')->first()->value == '3.8'){
            $sql_path = base_path('sqlupdates/v52.sql');
            $sql_path = base_path('sqlupdates/v51.sql');
            $sql_path = base_path('sqlupdates/v50.sql');
            $sql_path = base_path('sqlupdates/v38.sql');
            DB::unprepared(file_get_contents($sql_path));

            return redirect()->route('update.step2');
        }
        else {
            Artisan::call('view:clear');
            Artisan::call('cache:clear');

            SpotConfigHelper::setValue("updatable","false");

            return view('update.done');
        }
    }

    public function step2() {
        if(count(Upload::all()) == 0){
            $this->convertAssetsToUploader();
        }

        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        SpotConfigHelper::setValue("updatable","false");
        
        return view('update.done');
    }

    public function convertAssetsToUploader(){
        $type = array(
            "jpg"=>"image",
            "jpeg"=>"image",
            "png"=>"image",
            "svg"=>"image",
            "webp"=>"image",
            "gif"=>"image",
            "mp4"=>"video",
            "mpg"=>"video",
            "mpeg"=>"video",
            "webm"=>"video",
            "ogg"=>"video",
            "avi"=>"video",
            "mov"=>"video",
            "flv"=>"video",
            "swf"=>"video",
            "mkv"=>"video",
            "wmv"=>"video",
            "wma"=>"audio",
            "aac"=>"audio",
            "wav"=>"audio",
            "mp3"=>"audio",
            "zip"=>"archive",
            "rar"=>"archive",
            "7z"=>"archive",
            "doc"=>"document",
            "txt"=>"document",
            "docx"=>"document",
            "pdf"=>"document",
            "csv"=>"document",
            "xml"=>"document",
            "ods"=>"document",
            "xlr"=>"document",
            "xls"=>"document",
            "xlsx"=>"document"
        );

        foreach (Banner::all() as $key => $banner) {
            if ($banner->photo != null) {
                $arr = explode('.', $banner->photo);
                $upload = Upload::create([
                    'file_original_name' => null, 'file_name' => $banner->photo, 'user_id' => User::where('user_type', 'admin')->first()->id, 'extension' => $arr[1],
                    'type' => isset($type[$arr[1]]) ?  $type[$arr[1]] : "others", 'file_size' => 0
                ]);

                $banner->photo = $upload->id;
                $banner->save();
            }
        }

        foreach (Slider::all() as $key => $slider) {
            if ($slider->photo != null) {
                $arr = explode('.', $slider->photo);
                $upload = Upload::create([
                    'file_original_name' => null, 'file_name' => $slider->photo, 'user_id' => User::where('user_type', 'admin')->first()->id, 'extension' => $arr[1],
                    'type' => isset($type[$arr[1]]) ?  $type[$arr[1]] : "others", 'file_size' => 0
                ]);

                $slider->photo = $upload->id;
                $slider->save();
            }
        }

        foreach (User::all() as $key => $user) {
            if ($user->avatar_original != null) {
                $arr = explode('.', $user->avatar_original);
                $upload = Upload::create([
                    'file_original_name' => null, 'file_name' => $user->avatar_original, 'user_id' => $user->id, 'extension' => $arr[1],
                    'type' => isset($type[$arr[1]]) ?  $type[$arr[1]] : "others", 'file_size' => 0
                ]);

                $user->avatar_original = $upload->id;
                $user->save();
            }
        }

        $business_setting = BusinessSetting::where('type', 'home_slider_images')->first();
        $business_setting->value = json_encode(Slider::pluck('photo')->toArray());
        $business_setting->save();

        $business_setting = BusinessSetting::where('type', 'home_slider_links')->first();
        $business_setting->value = json_encode(Slider::pluck('link')->toArray());
        $business_setting->save();

        $business_setting = BusinessSetting::where('type', 'home_banner1_images')->first();
        $business_setting->value = json_encode(Banner::where('position', 1)->pluck('photo')->toArray());
        $business_setting->save();

        $business_setting = BusinessSetting::where('type', 'home_banner1_links')->first();
        $business_setting->value = json_encode(Banner::where('position', 1)->pluck('url')->toArray());
        $business_setting->save();

        $business_setting = BusinessSetting::where('type', 'home_banner2_images')->first();
        $business_setting->value = json_encode(Banner::where('position', 2)->pluck('photo')->toArray());
        $business_setting->save();

        $business_setting = BusinessSetting::where('type', 'home_banner2_links')->first();
        $business_setting->value = json_encode(Banner::where('position', 2)->pluck('url')->toArray());
        $business_setting->save();
    }
}
