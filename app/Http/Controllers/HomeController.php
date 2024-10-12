<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


use function PHPSTORM_META\type;

class HomeController extends Controller
{    
    public function search(){
        return view('pages.search');
    }
   
    public function home(Request $req)
    {
        $fields = $req->validate([
            'originLocationCode' => 'required|string',
            'destinationLocationCode' => 'required|string',

            'departureDate' => 'required|string',
            // 'returnDate' => 'string|nullable',

            'adults' => 'required|numeric',
            'children' => 'numeric|nullable',

            'travelClass' => 'string|nullable',
            'max' => 'numeric|nullable',
        ]);

        $noOfTraveller = $fields['adults'] + $fields['children'];
        $req->session()->flash('noOfTraveller', $noOfTraveller);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer cll7zwWC8oOV1J1JKJ8aZhhqKsvr',
        ])->get('https://test.api.amadeus.com/v2/shopping/flight-offers', [
            'originLocationCode' => $fields['originLocationCode'],
            'destinationLocationCode' => $fields['destinationLocationCode'],
            'departureDate' => $fields['departureDate'],
            // 'returnDate' => $fields['returnDate'],
            'adults' => $fields['adults'],
            'children' => $fields['children'],
            'travelClass' => $fields['travelClass'],
            'max' => $fields['max']
        ]);

        $res = json_decode($response->body())->data;
        return view('pages.search-results', compact('res'));
    }

    //validate offer price
    public function validateFlightPrice(Request $req){
        $data = json_decode($req->data, true);
        $req->session()->put('flightOffers', $data);
        $priceFlightOffersBody = [
            'data'=> [
                'type' => 'flight-offers-pricing',
                'flightOffers' =>
                    [$data]
            ],
        ];

        $price = json_encode($priceFlightOffersBody);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer cll7zwWC8oOV1J1JKJ8aZhhqKsvr',
        ])->withBody($price, 'application/json')
        ->post('https://test.api.amadeus.com/v1/shopping/flight-offers/pricing');

         $res = json_decode($response->body())->data;
        return view('pages.book-flight')->with(['noOfTraveller' => $req->noOfTraveller]);
    }

    //Book Flight
    public function flightBooking(Request $req){
        //  $req->session()->forget('travellersArray');
        // $req->session()->flush();
        // $info = $req->session()->pull('travellersArray', 'default');
        //   dd($info);

        $fields = $req->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'dob' => 'required|string',
            'gender' => 'required|string',

            'email' => 'required|email',
            'country_code' => 'required|numeric',
            'phone' => 'required|numeric',
        ]);

        $travellerInfo = [
            'id' => $req->id,
            'dateOfBirth' => $fields['dob'],
            'name' => [
                'firstName' => $fields['first_name'],
                'lastName' => $fields['last_name'],
            ],
            'gender' => $fields['gender'],
            'contact' => [
                'emailAddress' => $fields['email']
            ],
            'phones' => [[
                'deviceType' => 'MOBILE',
                'countryCallingCode' => $fields['country_code'],
                'number' => $fields['phone']
            ]],
            'documents' => [[
            'documentType' => 'PASSPORT',
            'birthPlace' => 'Madrid',
            'issuanceLocation' => 'Madrid',
            'issuanceDate' => '2015-04-14',
            'number' => '00000000',
            'expiryDate' => '2025-04-14',
            'issuanceCountry' => 'ES',
            'validityCountry' => 'ES',
            'nationality' => 'ES',
            'holder' => true
        ]]

            ];

        if ($req->session()->has('travellersArray')) {
            $req->session()->push('travellersArray', $travellerInfo);
        }
        else{
            $req->session()->push('travellersArray', $travellerInfo);
        }

        if($req->id > 1){
            $req->id = $req->id -1;
            return view('pages.book-flight')->with(['noOfTraveller' => $req->id]);
        }
        else{
            $flightOffers = $req->session()->pull('flightOffers', 'default');

            $body  = [
                'data' => [
                    'type' => 'flight-order',
                    'flightOffers' =>
                    [$flightOffers],
                    'travelers' =>
                    $req->session()->pull('travellersArray', $travellerInfo),
                ],
            ];

            $apiData = json_encode($body, JSON_UNESCAPED_SLASHES);

            // dd($apiData);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer cll7zwWC8oOV1J1JKJ8aZhhqKsvr',
            ])->withBody($apiData, 'application/json')
            ->post('https://test.api.amadeus.com/v1/booking/flight-orders');

            $res = json_decode($response->body())->data;

            dd($res);
        }
    
    }
}
