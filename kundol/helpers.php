<?php
use App\Models\Admin\Setting;
use App\Models\Admin\CurrentTheme;
use App\Models\Admin\Currency;

if(!function_exists("getSetting")){

    function getSetting(){
        $settings = Setting::whereNotIn('type',['app_general','app_display_in_setting','app_notification_setting','app_login_signup'])->get();
        $normalizdSetting = [];
        foreach($settings as $setting){
            $normalizdSetting[$setting->key] = $setting->value; 
        }
        // dd($normalizdSetting);
        return $normalizdSetting;
   }
}   


if(!function_exists("homePageBuilderJson")){

    function homePageBuilderJson(){
        $currentThemeSetting = [];
        if(CurrentTheme::first()){
            $currentThemeSetting = CurrentTheme::first()->home_setting;
            $currentThemeSetting =  json_decode($currentThemeSetting,true);
        }
        // dd($currentThemeSetting);
        return $currentThemeSetting;
    }
}


if(!function_exists("currencyConvertor")){

    function currencyConvertor($value){
        dd($value);
        $currency = Currency::where('id',1)->first();
        if($currency){
            $calculatedValue = $value*$currency->exchange_rate;

            if($currency == 'left'){
                $currency->code.' '.$calculatedValue;
            }else{
                $calculatedValue.' '.$currency->code;
            }
        }
    }
}
