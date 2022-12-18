<?php

#-----------------------------------------------------------------------
#   Custom non-Laravel helpers
#-----------------------------------------------------------------------

use App\Models\Settings;

if (!function_exists('settings')) {
    /**
     * Return a complete objects of the website settings.
     *
     * @param  \App\Models\Settings $code
     * @param  null
     * @return $settings objects
     *
     */
    function settings()
    {
        //
    }
}

if (!function_exists('settings')) {
    /**
     * Return a complete objects of the website settings.
     *
     * @param  \App\Models\Settings $code
     * @param  null
     * @return $settings objects
     *
     */
    function settings($key)
    {
        $value = Settings::where('key', $key)->pluck('value');
    }
}

if (!function_exists('get_error_response')) {
    /**
     * @param int $code : Error Code
     * @param string $msg  : Error Message
     * @param array $data : Error Message
     */
    function get_error_response(int $code, string $msg, array $data)
    {
        return [
            "status"    =>  $code,
            "message"   =>  $msg,
            "error"     =>  $data
        ];
    }
}

if (!function_exists('get_success_response')) {
    /**
     * @param int $code : Error Code
     * @param string $msg  : Error Message
     * @param array $data : Error Message
     */
    function get_success_response(array $data, int $code = 200)
    {
        return [
            "status"    =>  $code,
            "message"   =>  "success",
            "data"      =>  $data
        ];
    }
}

if (!function_exists('save_image')) {
    function save_image($path, $image): string
    {
        $image_path = '/storage/' . $path;
        $path = public_path($image_path);
        $filename = sha1(time()) . '.jpg';
        $image->move($path, $filename);
        $img_url = asset($image_path . '/' . $filename);
        return $img_url;
    }
}

if (!function_exists('get_greetings')) {
    /**
     */
    function get_greetings()
    {
        $hour = date('G');

        if ((int) $hour == 0 || (int) $hour <= 9) {
            $greet = 'Good Morning,';
        } elseif ((int) $hour >= 10 && (int) $hour <= 11) {
            $greet = 'Good Day,';
        } elseif ((int) $hour >= 12 || (int) $hour <= 15) {
            $greet = 'Good Afternoon,';
        } elseif ((int) $hour >= 16 || (int) $hour <= 23) {
            $greet = 'Good Evening,';
        } else {
            $greet = 'Welcome,';
        }

        return $greet . " \t";
    }
}

#-----------------------------------------------------------------------
#
#-----------------------------------------------------------------------
