<?php
$url = "/api/v2/tbtc/wallet/6228b5861bfa60000725b4340bcdf0fc/addresses";

$url = "https://app.bitgo-test.com/".$url;
$fields = [
    'chain' => 1,
    'label' => 'Bob\'s Hot Wallet Address',
    'lowPriority' => false,
    'gasPrice' => 0,
    'eip1559' => [
        'maxPriorityFeePerGas' => 'string',
        'maxFeePerGas' => 'string',
    ],
    'forwarderVersion' => 0,
    'onToken' => 'ofcbtc',
    'format' => 'cashaddr',
];
$fields_string = http_build_query($fields);
//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer v2xcc2b8e207cb4d3c8c8246a711620cc21d620da5001e3890966e9f12e45bc6c99",
    "Cache-Control: no-cache",
));

//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

//execute post
$result = curl_exec($ch);
echo $result;