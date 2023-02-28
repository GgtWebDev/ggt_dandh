<?php

namespace App\Http\Controllers;

use App\Http\Classes\DandH;
use App\Traits\HttpResponses;

class DandhApi extends Controller
{
    use HttpResponses;

    public function getToken()
    {
        $token = DandH::apiToken();

        return $this->success($token, "This is your access token :");
    }

    public function getPriceAndAvail()
    {
        // $data = DandH::product('687P0UT');
        $data = DandH::CreateOrder();

        return $this->success($data, 'Item Info :');
    }
}
