<?php

namespace App\Http\Controllers;

use App\models\Safmpesa;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SafmpesaController1 extends Controller
{
    public function register_url()
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        $shortcode = '743418';
        $confirmation_url = 'https://dellmat.com/confirmation';
        $validation_url = 'https://dellmat.com/validation_url';

        // $token = $this->token();

        // $data = array(
        //     'ShortCode' => $shortcode,
        //     'ResponseType' => 'Completed',
        //     'ConfirmationURL' => $confirmation_url,
        //     'ValidationURL' => $validation_url,
        // );
        $token = 'DG4VgxLN4G4Iu1Uvp6DNaKO015er';
        // $base64 = $this->base_64();
        // dd($base64);
        // $base64 = 'bFVpQTJIeGpVcXk1MWZ2SmZtR3lwVUxlSU5ISnJTSGw6SmVMT05QQWV1R3htamVUMw==';
        // $base64 = '8MrLceMNwRrhfEAyzpHo3EsJsbxf';


        // $url = 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('HOST:sandbox.safaricom.co.ke', 'Content-Type:application/json', 'Authorization:Bearer ' . $token)); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => $shortcode,
            'ResponseType' => 'Completed',
            'ConfirmationURL' => $confirmation_url,
            'ValidationURL' => $validation_url
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;



        //    try {
        //         $client = new Client();
        //         $request = $client->request('POST', $url, [
        //             'headers' => [
        //                 'Host' => 'sandbox.safaricom.co.ke',
        //                 'Authorization' => 'Bearer ' . $base64,
        //                 'accept' => 'application/json',
        //                 'Content-Type' => 'application/json',
        //             ], 'json' => json_encode([
        //                 'data' => $data
        //             ])
        //         ]);
        //         // $response = $http->get(env('API_URL').'/api/getUsers');
        //         return $response = $request->getBody()->getContents();
        //         // dd($response);
        //     } catch (\Exception $e) {

        //         \Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
        //         return $e->getMessage();
        //     }
        //     return;

        // $token = $this->token();

        // $data = array(
        //     'ShortCode' => $shortcode,
        //     'ResponseType' => 'Completed',
        //     'ConfirmationURL' => $confirmation_url,
        //     'ValidationURL' => $validation_url,
        // );

        // $data_string = json_encode($data);
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Host: sandbox.safaricom.co.ke','Content-Type:application/json','Authorization:Bearer '.$token));
        //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_POST, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        // $curl_response = curl_exec($curl);

        // return $curl_response;
    }


    // public function base_64()
    // {
    //     $key = 'lUiA2HxjUqy51fvJfmGypULeINHJrSHl';
    //     $secret = 'JeLONPAeuGxmjeT3';
    //     $base64 = base64_encode($key . ':' . $secret);
    //     return $base64;
    // }

    // public function token()
    // {
    //     $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

    //     $base64 = $this->base_64();

    //     $request_headers = array();
    //     $request_headers[] = 'Authorization: Basic ' . $base64;
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     $data = curl_exec($ch);

    //     if (curl_errno($ch)) {
    //         $token = '';
    //     } else {
    //         $transaction = json_decode($data, TRUE);
    //         $token = $transaction['access_token'];
    //     }

    //     return $token;
    // }

    public function validation_url()
    {

    }
}
