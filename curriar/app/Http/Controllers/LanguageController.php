<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use File;
use App\Language;
use App\Translation;
use Config;
// use App\Http\Requests\CsvImportRequest;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
    	$request->session()->put('locale', $request->locale);
        $language = Language::where('code', $request->locale)->first();
    	flash(translate('Language changed to ').$language->name)->success();
    }

    public function index(Request $request)
    {
        $languages = Language::paginate(10);
        return view('backend.setup_configurations.languages.index', compact('languages'));
    }

    public function create(Request $request)
    {
        return view('backend.setup_configurations.languages.create');
    }

    public function store(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $language = new Language;
        $language->name = $request->name;
        $language->code = $request->code;
        if($language->save()){

            flash(translate('Language has been inserted successfully'))->success();
            return redirect()->route('languages.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function show(Request $request, $id)
    {
        $sort_search = null;
        $language = Language::findOrFail(decrypt($id));
        $lang_keys = Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'));
        if ($request->has('search')){
            $sort_search = $request->search;
            $lang_keys = $lang_keys->where('lang_key', 'like', '%'.$sort_search.'%');
        }
        $lang_keys = $lang_keys->paginate(50);
        return view('backend.setup_configurations.languages.language_view', compact('language','lang_keys','sort_search'));
    }

    public function edit($id)
    {
        $language = Language::findOrFail(decrypt($id));
        return view('backend.setup_configurations.languages.edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }

        $language = Language::findOrFail($id);
        if($language->code == Session::get('locale', Config::get('app.locale')) ){
            
            config(['app.locale' => $request->code]);
            Session::put('locale', Config::get('app.locale'));
        }
        $language = Language::findOrFail($id);
        $language->name = $request->name;
        $language->code = $request->code;
        $language->icon = $request->icon;
        if($language->save()){
            flash(translate('Language has been updated successfully'))->success();
            return redirect()->route('languages.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function key_value_store(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $language = Language::findOrFail($request->id);
        foreach ($request->values as $key => $value) {
            $translation_def = Translation::where('lang_key', $key)->where('lang', $language->code)->first();
            if($translation_def == null){
                $translation_def = new Translation;
                $translation_def->lang = $language->code;
                $translation_def->lang_key = $key;
                $translation_def->lang_value = $value;
                $translation_def->save();
            }
            else {
                $translation_def->lang_value = $value;
                $translation_def->save();
            }
        }
        flash(translate('Translations updated for ').$language->name)->success();
        return back();
    }

    public function update_rtl_status(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $language = Language::findOrFail($request->id);
        $language->rtl = $request->status;
        if($language->save()){
            flash(translate('RTL status updated successfully'))->success();
            return 1;
        }
        return 0;
    }

    public function destroy($id)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        Language::destroy($id);
        flash(translate('Language has been deleted successfully'))->success();
        return redirect()->route('languages.index');
    }

    public function export(Request $request)
    {
        $fileName = 'file.csv';
        $table = Translation::select('lang','lang_key','lang_value')->where('lang', env('DEFAULT_LANGUAGE'))->get();

        $columns = array('Lang', 'Lang_key', 'Lang_value');


        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=file.csv');
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($table as $row) {
            $row['Lang']  = $row->lang;
            $row['Lang_key']    = $row->lang_key;
            $row['Lang_value']    = $row->lang_value;

            fputcsv($file, array($row['Lang'], $row['Lang_key'], $row['Lang_value']));
        }

        fclose($file);
        exit;
    }

    public function import(Request $request)
    {
        return view('backend.setup_configurations.languages.import');
    }

    public function parseImport(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }

        $path = $request->file('csv_file')->getRealPath();
        
        $data = array_map('str_getcsv', file($path));
        $csv_header_fields  =   $data[0];
        
        if($csv_header_fields[0]  == 'Lang' && $csv_header_fields[1]  ==  'Lang_key' && $csv_header_fields[2]  ==  'Lang_value'){
            unset($data[0]);
            foreach ($data as $row) {
                if ( ! isset($row[1])) {
                    $row[1] = null;
                }
                if ( ! isset($row[2])) {
                    $row[2] = null;
                }
                $translation_def = new Translation;
                $translation_def->lang = $row[0];  
                $translation_def->lang_key = $row[1];
                $translation_def->lang_value = $row[2];
                $translation_def->save();
            }

            return view('backend.setup_configurations.languages.import_success');
        }else{
            flash(translate('This file you are trying to import is not the file that you should upload'))->error();
            return back();
        }
    }

}
