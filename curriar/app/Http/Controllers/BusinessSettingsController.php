<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use App\BusinessSetting;
use Artisan;
use SpotlayerCheck;

class BusinessSettingsController extends Controller
{
    public function general_setting(Request $request)
    {
        SpotlayerCheck::instantiateShopRepository();
    	return view('backend.setup_configurations.general_settings');
    }

    public function activation(Request $request)
    {
        SpotlayerCheck::instantiateShopRepository();
    	return view('backend.setup_configurations.activation');
    }

    public function social_login(Request $request)
    {
        SpotlayerCheck::instantiateShopRepository();
        return view('backend.setup_configurations.social_login');
    }

    public function notifications(Request $request)
    {
        SpotlayerCheck::instantiateShopRepository();
        return view('backend.setup_configurations.notifications');
    }

    public function sms_gateways(Request $request)
    {
        SpotlayerCheck::instantiateShopRepository();
        return view('backend.setup_configurations.sms_gateways');
    }

    public function smtp_settings(Request $request)
    {
        SpotlayerCheck::instantiateShopRepository();
        return view('backend.setup_configurations.smtp_settings');
    }

    public function google_analytics(Request $request)
    {
        SpotlayerCheck::instantiateShopRepository();
        return view('backend.setup_configurations.google_analytics');
    }

    public function google_recaptcha(Request $request)
    {
        SpotlayerCheck::instantiateShopRepository();
        return view('backend.setup_configurations.google_recaptcha');
    }

    public function facebook_chat(Request $request)
    {
        SpotlayerCheck::instantiateShopRepository();
        return view('backend.setup_configurations.facebook_chat');
    }

    public function payment_method(Request $request)
    {
        SpotlayerCheck::instantiateShopRepository();
        return view('backend.setup_configurations.payment_method');
    }

    public function file_system(Request $request)
    {
        SpotlayerCheck::instantiateShopRepository();
        return view('backend.setup_configurations.file_system');
    }

    /**
     * Update the API key's for payment methods.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payment_method_update(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', $request->payment_method.'_sandbox')->first();
        // dd($business_settings->type);
        if($business_settings != null){
            if ($request->has($request->payment_method.'_sandbox')) {
                $business_settings->value = 1;
                $business_settings->save();
            }
            else{
                $business_settings->value = 0;
                $business_settings->save();
            }
        }

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    /**
     * Update the API key's for GOOGLE analytics.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function google_analytics_update(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', 'google_analytics')->first();

        if ($request->has('google_analytics')) {
            $business_settings->value = 1;
            $business_settings->save();
        }
        else{
            $business_settings->value = 0;
            $business_settings->save();
        }

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    public function google_recaptcha_update(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', 'google_recaptcha')->first();

        if ($request->has('google_recaptcha')) {
            $business_settings->value = 1;
            $business_settings->save();
        }
        else{
            $business_settings->value = 0;
            $business_settings->save();
        }

        flash(translate("Settings updated successfully"))->success();
        return back();
    }
    public function google_map_update(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $business_settings = BusinessSetting::where('type', 'google_map')->first();
        if ($request->has('google_map')) {
            $business_settings->value = 1;
            $business_settings->key   = $request->MAP_KEY;
            $business_settings->save();
        }
        else{
            $business_settings->value = 0;
            $business_settings->key   = " ";
            $business_settings->save();
        }

        flash(translate("Google Map Settings updated successfully"))->success();
        return back();
    }


    /**
     * Update the API key's for GOOGLE analytics.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function facebook_chat_update(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', 'facebook_chat')->first();

        if ($request->has('facebook_chat')) {
            $business_settings->value = 1;
            $business_settings->save();
        }
        else{
            $business_settings->value = 0;
            $business_settings->save();
        }

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    public function facebook_pixel_update(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }

        $business_settings = BusinessSetting::where('type', 'facebook_pixel')->first();

        if ($request->has('facebook_pixel')) {
            $business_settings->value = 1;
            $business_settings->save();
        }
        else{
            $business_settings->value = 0;
            $business_settings->save();
        }

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    /**
     * Update the API key's for other methods.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function env_key_update(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    /**
     * overWrite the Env File values.
     * @param  String type
     * @param  String value
     * @return \Illuminate\Http\Response
     */
    public function overWriteEnvFile($type, $val)
    {
        if(env('DEMO_MODE') != 'On'){
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"'.trim($val).'"';
                if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                    file_put_contents($path, str_replace(
                        $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                    ));
                }
                else{
                    file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
                }
            }
        }
    }

    public function seller_verification_form(Request $request)
    {
    	return view('backend.sellers.seller_verification_form.index');
    }

    /**
     * Update sell verification form.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function seller_verification_form_update(Request $request)
    {
        $form = array();
        $select_types = ['select', 'multi_select', 'radio'];
        $j = 0;
        for ($i=0; $i < count($request->type); $i++) {
            $item['type'] = $request->type[$i];
            $item['label'] = $request->label[$i];
            if(in_array($request->type[$i], $select_types)){
                $item['options'] = json_encode($request['options_'.$request->option[$j]]);
                $j++;
            }
            array_push($form, $item);
        }
        $business_settings = BusinessSetting::where('type', 'verification_form')->first();
        $business_settings->value = json_encode($form);
        if($business_settings->save()){
            flash(translate("Verification form updated successfully"))->success();
            return back();
        }
    }

    public function update(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        if(isset($request->image_required) && $request->image_required == 1){
            $this->validate($request,[
                '*_images.*'=>'required',
            ]);
        }
        
        // return $request;
        if($request->types){

            foreach ($request->types as $key => $type) {
                if($type == 'site_name'){
                    $this->overWriteEnvFile('APP_NAME', $request[$type]);
                }
                if($type == 'timezone'){
                    $this->overWriteEnvFile('APP_TIMEZONE', $request[$type]);
                }
                else {
                    if($request->lang){
                        $business_settings = BusinessSetting::where('type', $type)->where('lang', $request->lang)->first();
                    }else{
                        $business_settings = BusinessSetting::where('type', $type)->first();
                    }
                    if($business_settings!=null){
                        if(gettype($request[$type]) == 'array'){
                            $business_settings->value = json_encode($request[$type]);
                        }
                        else {
                            $business_settings->value = $request[$type];
                        }
                        $business_settings->save();
                    }
                    else{
                        $business_settings = new BusinessSetting;
                        $business_settings->type = $type;
                        if(gettype($request[$type]) == 'array'){
                            $business_settings->value = json_encode($request[$type]);
                        }
                        else {
                            $business_settings->value = $request[$type];
                        }
                        $business_settings->lang = $request->lang ?? null;
                        $business_settings->save();
                    }
                }
            }
            flash(translate("Settings updated successfully"))->success();
        }else{
            flash(translate("Nothing To Update"))->error();
        }

        return back();
    }

    public function updateNotificationsSettings(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $business_settings = BusinessSetting::where('type', $request->type)->where('key', $request->key)->first();
        if($business_settings!=null){
            if($business_settings->value != null){
                if($request->value == 'false'){
                    $value = array_merge(json_decode($business_settings->value, true),array($request->role => $request->value));
                    unset($value[$request->role]);
                }else{
                    $value = array_merge(json_decode($business_settings->value, true),array($request->role => $request->value));
                }
            }else{
                if($request->value == false){
                    $value = NULL;
                }else{
                    $value = array($request->role => $request->value);
                }
            }
            $business_settings->value = $value;
            $business_settings->save();
        }
        else{
            $business_settings = new BusinessSetting;
            $business_settings->type = $request->type;
            $business_settings->key = $request->key;
            $business_settings->value = array($request->role => $request->value);
            $business_settings->save();
        }
        return '1';
    }

    public function updateActivationSettings(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $env_changes = ['FORCE_HTTPS', 'FILESYSTEM_DRIVER'];
        if (in_array($request->type, $env_changes)) {

            return $this->updateActivationSettingsInEnv($request);
        }


        if($request->lang){
            $business_settings = BusinessSetting::where('type', $request->type)->where('lang', $request->lang)->first();
        }else{
            $business_settings = BusinessSetting::where('type', $request->type)->first();
        }
        if($business_settings!=null){
            if ($request->type == 'maintenance_mode' && $request->value == '1') {
                if(env('DEMO_MODE') != 'On'){
                    Artisan::call('down');
                }
            }
            elseif ($request->type == 'maintenance_mode' && $request->value == '0') {
                if(env('DEMO_MODE') != 'On') {
                    Artisan::call('up');
                }
            }
            $business_settings->value = $request->value;
            $business_settings->lang = $request->lang ?? null;
            $business_settings->save();
        }
        else{
            $business_settings = new BusinessSetting;
            $business_settings->type = $request->type;
            $business_settings->value = $request->value;
            $business_settings->lang = $request->lang ?? null;
            $business_settings->save();
        }
        return '1';
    }

    public function updateActivationSettingsInEnv($request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        if ($request->type == 'FORCE_HTTPS' && $request->value == '1') {
            $this->overWriteEnvFile($request->type, 'On');

            if(strpos(env('APP_URL'), 'http:') !== FALSE) {
                $this->overWriteEnvFile('APP_URL', str_replace("http:", "https:", env('APP_URL')));
            }

        }
        elseif ($request->type == 'FORCE_HTTPS' && $request->value == '0') {
            $this->overWriteEnvFile($request->type, 'Off');
            if(strpos(env('APP_URL'), 'https:') !== FALSE) {
                $this->overWriteEnvFile('APP_URL', str_replace("https:", "http:", env('APP_URL')));
            }

        }
        elseif ($request->type == 'FILESYSTEM_DRIVER' && $request->value == '1') {
            $this->overWriteEnvFile($request->type, 's3');
        }
        elseif ($request->type == 'FILESYSTEM_DRIVER' && $request->value == '0') {
            $this->overWriteEnvFile($request->type, 'local');
        }

        return '1';
    }

    public function vendor_commission(Request $request)
    {
        $business_settings = BusinessSetting::where('type', 'vendor_commission')->first();
        return view('backend.sellers.seller_commission.index', compact('business_settings'));
    }

    public function vendor_commission_update(Request $request){
        $business_settings = BusinessSetting::where('type', $request->type)->first();
        $business_settings->type = $request->type;
        $business_settings->value = $request->value;
        $business_settings->save();

        flash(translate('Seller Commission updated successfully'))->success();
        return back();
    }

    public function shipping_configuration(Request $request){
        return view('backend.setup_configurations.shipping_configuration.index');
    }

    public function shipping_configuration_update(Request $request){
        $business_settings = BusinessSetting::where('type', $request->type)->first();
        $business_settings->value = $request[$request->type];
        $business_settings->save();
        return back();
    }
}
