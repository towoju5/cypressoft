<?php

#-----------------------------------------------------------------------
#   Custom non-Laravel helpers
#-----------------------------------------------------------------------

if (! function_exists('to_usd')) {
    /**
     * Send cURL get request get USD equvalient of incoming fee
     *
     * @param  array data
     * @param  base_url url: https://test.bitgo.com/;
     * @return json
     * 
     */
    function to_usd($amount)
    {
        try{
            $url = "https://test.bitgo.com/api/v2/";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //remove in production
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "accept: application/json",
                "Authorization: Bearer " . bitgo_token(),
                "Cache-Control: no-cache"
            ));
            $sResult = curl_exec($ch);
            if (curl_errno($ch)) {
                return json_encode('Error: ' . curl_error($ch));
            } else {
                return $sResult;
            }
        } catch (Exception $e) {
            return $amount;
        }
    }
}


if (! function_exists('bitgo_curl_get')) {
    /**
     * Send cURL get request to bitgo server
     *
     * @param  array data
     * @param  base_url url: https://test.bitgo.com/;
     * @return json
     * 
     */
    function bitgo_curl_get($url, array $data = null)
    {
        $url = "https://test.bitgo.com/api/v2/" . $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //remove in production
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "accept: application/json",
            "Authorization: Bearer " . bitgo_token(),
            "Cache-Control: no-cache"
        ));
        $sResult = curl_exec($ch);
        if (curl_errno($ch)) {
            return json_encode('Error: ' . curl_error($ch));
        } else {
            return $sResult;
        }
    }
}


if (! function_exists('bitgo_curl_post')) {
    /**
     * Send cURL POST request to bitgo server
     *
     * @param  array data
     * @param  base_url url: https://test.bitgo.com/api/v2/;
     * @return json
     * 
     */
    function bitgo_curl_post($url, array $data = [])
    {
        try {
            $ch = curl_init();

            // Check if initialization had gone wrong*    
            if ($ch === false) {
                throw new Exception('failed to initialize');
            }

            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . bitgo_token(),
                "Cache-Control: no-cache",
            ));

            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //execute post
            $result = curl_exec($ch);
            // echo $result;
            return json_encode($result);
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }
}


if (! function_exists('bitgo_token')) {
    /**
     * Return a complete objects of the website settings.
     *
     * @param  \App\Models\Settings $code
     * @param  null
     * @return $settings objects
     * 
     */
    function bitgo_token()
    {
        return getenv('BITGO_TOKEN');
    }
}


if (! function_exists('settings')) {
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

if (! function_exists('get_greetings')) {
    /**
     */
    function get_greetings()
    {
        $hour = date("G"); 
        $minute = date("i"); 
        $second = date("s"); 
        $msg = " Today is " . date("l, M. d, Y.") . " And the time is " . date("g:i a"); 

        if ( (int)$hour == 0 || (int)$hour <= 9 ) { 
            $greet = "Good Morning,"; 
        } else if ( (int)$hour >= 10 && (int)$hour <= 11 ) { 
            $greet = "Good Day,"; 
        } else if ( (int)$hour >= 12 || (int)$hour <= 15 ) { 
            $greet = "Good Afternoon,"; 
        } else if ( (int)$hour >= 16 || (int)$hour <= 23 ) { 
            $greet = "Good Evening,"; 
        } else { 
            $greet = "Welcome,"; 
        }

        return $greet." \t" ;
    }
}

#-----------------------------------------------------------------------
#
#-----------------------------------------------------------------------
