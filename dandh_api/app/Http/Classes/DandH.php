<?php

namespace App\Http\Classes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DandH
{


    private static $dandhAuthurl;
    private static $dandhMainurl;
    private static $dandhClient;
    private static $dandhSecret;

    protected static $accountNumber = 3056100000;

    public static $token = null;

    public function __construct()
    {
    }

    private static function initializeEnv()
    {
        self::$dandhAuthurl = env("DANDH_AUTH_ENDPOINT");
        self::$dandhMainurl = env("DANDH_MAIN_ENDPOINT");
        self::$dandhClient = env("DANDH_CLIENT_ID");
        self::$dandhSecret = env("DANDH_CLIENT_SECRET");
    }

    public static function apiToken()
    {

        if (self::$token === null) {

            if (Session::has('api_token')) {

                self::$token = Session::get('api_token');
            } else {
                self::initializeEnv();

                $data = [
                    "grant_type" => ("client_credentials"),
                    "client_id" => self::$dandhClient,
                    "client_secret" => self::$dandhSecret,
                    // "scope" => "resource.Read"
                ];

                // dd(self::$dandhAuthurl);

                $response = Http::asForm()->post(self::$dandhAuthurl, $data);

                $token = json_decode($response->body());

                self::$token = $token->access_token;

                Session::put('api_token', self::$token);
            }
        }

        return self::$token;
    }

    public static function product($itemId)
    {
        self::$token = self::apiToken();

        if (self::$token !== null) {

            self::initializeEnv();

            $header = [
                'Authorization' => 'Bearer ' . self::$token,
                'dandh-tenant' => 'dhus'
            ];

            $url = self::$dandhMainurl . '/' . 'customers' . '/' . self::$accountNumber . '/' . 'items/' . $itemId;

            // dd($url, $header);

            $response = Http::withHeaders($header)->get($url);

            $data = $response->body();

            return json_decode($data);
        } else return 'Unauthorized !';
    }

    public static function CreateOrder($data)
    {
        self::$token = self::apiToken();

        if (self::$token !== null) {

            self::initializeEnv();

            $header = [
                'Authorization' => 'Bearer ' . self::$token,
                'dandh-tenant' => 'dhus'
            ];

            $url = self::$dandhMainurl . '/' . 'customers' . '/' . self::$accountNumber . '/' . 'salesOrders';

            // dd($url, $header);

            $response = Http::withHeaders($header)->post($url,);

            $data = $response->body();

            return json_decode($data);
        } else return 'Unauthorized !';
    }

    public static function trackOrder()
    {
    }
}
