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

    public static function CreateOrder()
    {
        self::$token = self::apiToken();

        if (self::$token !== null) {

            self::initializeEnv();

            $header = [
                'Authorization' => 'Bearer ' . self::$token,
                'dandh-tenant' => 'dhus'
            ];

            $data =
                [
                    "customerPurchaseOrder" => "123456",
                    "deliveryAddress" => [
                        "address" => [
                            "city" => "california",
                            "country" => "US",
                            "postalCode" => "123456",
                            "region" => "CA",
                            "street" => "120th ne street,california"
                        ],
                        "attention" => "string",
                        "deliveryName" => "Nihal"
                    ],

                    // "freightBillingAccount" => "string",
                    // "notes" => "string",
                    "shipments" => [
                        [
                            // "branch" => "string",
                            "lines" => [
                                [
                                    "item" => "687P0UT",
                                    "orderQuantity" => 1,
                                    "unitPrice" => "1100.00"

                                ]
                            ],
                            "shipping" => [
                                "allowBackOrder" => true,
                                // "allowPartialShipment" => true,
                                "carrier" => "pickup",
                                // "dropShipPassword" => "string",
                                // "onlyBranch" => "string",
                                "serviceType" => "pickup"
                            ]
                        ]
                    ]
                ];

            // dd(json_encode($data));

            $url = self::$dandhMainurl . '/' . 'customers' . '/' . self::$accountNumber . '/' . 'salesOrders';

            // dd($url, $header);

            $data1 = json_encode($data);

            dd($data1);

            $response = Http::withHeaders($header)->post($url, $data1);

            $data = $response->body();

            return json_decode($data);
        } else return 'Unauthorized !';
    }

    public static function trackOrder()
    {
    }
}


// "endUserData" => [
//     "address" => [
//         "city" => "string",
//         "country" => "str",
//         "postalCode" => "string",
//         "region" => "string",
//         "street" => "string"
//     ],
//     "attention" => "string",
//     "authorizationQuoteNumber" => "string",
//     "ccoId" => "string",
//     "customerAccountNumber" => "string",
//     "dateOfSale" => "2023-02-09T21:45:41.083Z",
//     "department" => "string",
//     "domain" => "string",
//     "domainAdministratorEmailAddress" => "string",
//     "email" => "string",
//     "endUserEmailAddress" => "string",
//     "fax" => "string",
//     "masterContactNumber" => "string",
//     "modelNumber" => "string",
//     "organization" => "string",
//     "phone" => "string",
//     "purchaseOrderNumber" => "string",
//     "resellerEmailAddress" => "string",
//     "resellerPhone" => "string",
//     "serialNumbers" => "string",
//     "supportStartDate" => "2023-02-09T21:45:41.083Z",
//     "updateType" => "New",
//     "warrantySku" => "string"
// ],
