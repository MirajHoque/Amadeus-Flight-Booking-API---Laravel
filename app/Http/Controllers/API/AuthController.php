<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function auth(){
        dd('hello');
        $res = Http::post('https://test.api.amadeus.com/v1/security/oauth2/token', [
             'client_id' => '0tIJxgUPkvR74W8KPcfu7mtLpaR93ZS9',
             'client_secret' => 'wXZZZahYxZs8nhSY',
             'grant_type' => 'client_credentials'
         ]);

         return $res;
    }
}
