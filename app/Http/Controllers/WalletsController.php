<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use neto737\BitGoSDK\BitGoSDK;
use neto737\BitGoSDK\Enum\CurrencyCode;

class WalletsController extends Controller
{
    protected $token = "v2xcc2b8e207cb4d3c8c8246a711620cc21d620da5001e3890966e9f12e45bc6c99";

    function index()
    {
        $coin = "tbtc";
        $wallet_id = "6228b5861bfa60000725b4340bcdf0fc";
        $url = "$coin/wallet/$wallet_id/addresses";
        $response = bitgo_curl_get($url);
        echo ($response);
    }
    
    /**
     * action Create a new wallet address
     * @param coin : must tally with the wallet ID from bitgo
     * @param wallet_id : admin wallet type ID gotten from BitGo
     * @param endpoint : {coin_type}/wallet/{wallet_id}/address
     * @return new wallet create ID, crypto address as address, wallet_id, coin 
     */
    function create()
    {
        $coin = "tbtc"; 
        $wallet_id = "6228b5861bfa60000725b4340bcdf0fc";
        $url = "$coin/wallet/$wallet_id/address";
        $fields = [
            'chain' => 10,
            'label' => 'Test Wallet Address',
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
        $response = bitgo_curl_post($url, $fields);
        echo ($response);
    }
    
    /**
     * action Create a new wallet address
     * @param coin : must tally with the wallet ID from bitgo
     * @param wallet_id : admin wallet type ID gotten from BitGo
     * @param endpoint : {coin_type}/wallet/{wallet_id}/address
     * @return new wallet create ID, crypto address as address, wallet_id, coin 
     */
    function listTransfers()
    {
        $coin = "tbtc"; 
        $wallet_id = "6228b5861bfa60000725b4340bcdf0fc";
        $url = "$coin/wallet/$wallet_id/transfer/62293fbb48aa2f0008e7be6961a9862e";
        $response = bitgo_curl_get($url);
        // echo ($response);
        $result = $this->search("62293fbb48aa2f0008e7be6961a9862e", $response);
        var_dump($result);
    }
    
    /**
     * action Create a new wallet address
     * @param coin : must tally with the wallet ID from bitgo
     * @param wallet_id : admin wallet type ID gotten from BitGo
     * @param endpoint : {coin_type}/wallet/{wallet_id}/address
     * @return new wallet create ID, crypto address as address, wallet_id, coin 
     */
    function search($resp, $v)
    {
        $arr = json_decode($v, true);
        return array_search($resp, $arr);
    }

    /**
     * Receive wallet object from create @method
     * Save the wallet address to the users wallet list in the database.
     */
    function getPayAddress()
    {
        //
    }

    /**
     * List of Crypto types enabled by the customer
     * Save the wallet address to the users wallet list in the database.
     */
    function usersAddress()
    {
        //
    }

    /**
     * save transaction in the database
     * @data: amount to be paid, wallet_address, wallet_id, coin_name, user_id
     */
    function recordTransaction()
    {
        //
    }

    function test()
    {
        $bitgo = new BitGoSDK($this->token, CurrencyCode::BITCOIN_TESTNET, TRUE);
        return $bitgo->createWalletAddress();
    }
}

// https://app.bitgo.com/api/v2/{coin}/wallet/{walletId}/webhooks/{webhookId}/simulate