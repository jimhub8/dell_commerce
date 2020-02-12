<?php

namespace App\Http\Controllers;

use App\models\Safmpesa;
use App\models\Transaction;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SafmpesaController extends Controller
{
    public function register_url()
    {
        $shortcode = '743418';
        $confirmation_url = 'https://dellmat.com/confirmation';
        $validate = 'https://dellmat.com/validate';
        $token = $this->token();

        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        $data = array(
            'ShortCode' => $shortcode,
            'ResponseType' => 'Completed',
            'ConfirmationURL' => $confirmation_url,
            'ValidationURL' => $validate,
        );
        // try {
        //     $client = new Client();
        //     $request = $client->request('POST', $url, [
        //         'headers' => [
        //             'Host' => 'sandbox.safaricom.co.ke',
        //             'Authorization' => 'Bearer ' . $token,
        //             'accept' => 'application/json',
        //             'Content-Type' => 'application/json',
        //         ], 'json' => json_encode([
        //             'data' => $data
        //         ])
        //     ]);
        //     // $response = $http->get(env('API_URL').'/api/getUsers');
        //     return $response = $request->getBody()->getContents();
        //     // dd($response);
        // } catch (\Exception $e) {

        //     \Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
        //     return $e->getMessage();
        // }
        // return;
        // $consumerKey = 'nOI0bNv9sGjtCJaRBWmCcAWJTIsUweg9';
        // $consumerSecret = 'osewV588G2lV1IFW';

        $headers = ['Content-Type: application/json; charset=utf8'];

        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        curl_setopt($curl, CURLOPT_HEADER, FALSE);

        // curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
        // curl_setopt($curl, CURLOPT_USERPWD, $token);

        // $result = curl_exec($curl);
        // $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // $result = json_decode($result);

        // $access_token = $result->access_token;

        // echo $access_token;

        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token)); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => '743418',
            'ResponseType' => 'Completed',
            'ConfirmationURL' => 'https://dellmat.com/confirmation',
            'ValidationURL' => 'https://dellmat.com/validate'
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
    }


    public function base_64()
    {
        $key = 'JZUG1CY6ebrZWvVRlepAT7dWKGFtpQc2';
        $secret = 'gCUybB1B3vxlwh18';
        $base64 = base64_encode($key . ':' . $secret);
        return $base64;
    }

    public function token()
    {
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $base64 = $this->base_64();

        $request_headers = array();
        $request_headers[] = 'Authorization: Basic ' . $base64;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);

        if (curl_errno($ch)) {
            $token = '';
        } else {
            $transaction = json_decode($data, TRUE);
            $token = $transaction['access_token'];
        }

        return $token;
    }

    public function validate_url()
    {
        // echo { "ResultCode": 0, "ResultDesc": "Accepted"};
        $token = $this->token();

        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('HOST:sandbox.safaricom.co.ke', 'Content-Type:application/json', 'Authorization:Bearer ' . $token)); //setting custom header


        $curl_post_data = array(
            "ResultCode" => 0,
            "ResultDesc" => "Accepted"
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
    }

    public function confirmation()
    {
        $transaction = new \Safaricom\Mpesa\Mpesa();

        $callbackData = $transaction->getDataFromCallback();
        $callbackData = json_decode($callbackData);
        // return $callbackData->TransactionType;
        // $array = json_decode($request, true);
        // return $array;
        // $transactiontype = $array['TransactionType'];
        // $transid = $array['TransID'];
        // $transtime = $array['TransTime'];
        // $transamount = $array['TransAmount'];
        // $businessshortcode = $array['BusinessShortCode'];
        // $billrefno = $array['BillRefNumber'];
        // $invoiceno = $array['InvoiceNumber'];
        // $orgaccountbalance = $array['OrgAccountBalance'];
        // $msisdn = $array['MSISDN'];
        // $firstname = $array['FirstName'];
        // $middlename = $array['MiddleName'];
        // $lastname = $array['LastName'];
        // return ($request);
        // abort(200, $request->all());
        $transaction = new Transaction();
        $transaction->TransactionType = $callbackData->TransactionType;
        $transaction->TransID = $callbackData->TransID;
        $transaction->TransTime = $callbackData->TransTime;
        $transaction->TransAmount = $callbackData->TransAmount;
        $transaction->BusinessShortCode = $callbackData->BusinessShortCode;
        $transaction->BillRefNumber = $callbackData->BillRefNumber;
        $transaction->InvoiceNumber = $callbackData->InvoiceNumber;
        $transaction->OrgAccountBalance = $callbackData->OrgAccountBalance;
        $transaction->ThirdPartyTransID = $callbackData->ThirdPartyTransID;
        $transaction->MSISDN = $callbackData->MSISDN;
        $transaction->FirstName = $callbackData->FirstName;
        $transaction->MiddleName = $callbackData->MiddleName;
        $transaction->LastName = $callbackData->LastName;
        $transaction->save();

        $transaction = new Transaction();
        $transaction->TransactionType = null;
        $transaction->TransID = null;
        $transaction->TransTime = null;
        $transaction->TransAmount = null;
        $transaction->BusinessShortCode = null;
        $transaction->BillRefNumber = null;
        $transaction->InvoiceNumber = null;
        $transaction->OrgAccountBalance = null;
        $transaction->ThirdPartyTransID = null;
        $transaction->MSISDN = null;
        $transaction->FirstName = null;
        $transaction->MiddleName = null;
        $transaction->LastName = null;
        $transaction->save();
        return $transaction;
    }

    public function payment_()
    {


        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';
        $shortcode = '720514';
        $token = $this->token();
        // $transaction = new \Safaricom\Mpesa\Mpesa();

        // Test
        // $shortcode = '602996';
        $MSISDN = '254708374149';
        $amount = '10';

        // $b2bTransaction = $transaction->c2b($shortcode, 'CustomerPayBillOnline', $amount, $MSISDN, 'account');

        // Log::useDailyFiles(storage_path() . '/logs/saf_logs.log');
        // $trans_ = new \Safaricom\Mpesa\TransactionCallbacks();
        // $trans_->processC2BRequestValidation();
        // return $b2bTransaction;



        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$token));

        $curl_post_data = array(
            'ShortCode' => $shortcode,
            'CommandID' => 'CustomerBuyGoodsOnline',
            'Amount' => 1000,
            'Msisdn' => $MSISDN,
            // 'BillRefNumber' => $BillRefNumber
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $curl_response = curl_exec($curl);
        return $curl_response;

        // echo $curl_response['ConversationID'];
    }

    public function stk_push()
    {
        $shortcode = '174379';
        $confirmation_url = 'https://dellmat.com/confirmation';

        $transaction = new \Safaricom\Mpesa\Mpesa();
        $stkPushSimulation = $transaction->STKPushSimulation('743418', $this->password(), 'CustomerPayBillOnline', '1', 254743895505, $shortcode, 254743895505, $confirmation_url, '', 'payment', 'Test');
        return $stkPushSimulation;
        /*
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $token = $this->token();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token)); //setting custom header


        $current_timestamp = Carbon::now()->timestamp; // Produces something like 1552296328
        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => '602996',
            'Password' => $this->password(),
            'Timestamp' => $current_timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount"' => '1',
            'PartyA' => '254708374149',
            'PartyB' => $shortcode,
            'PhoneNumber' => '254708374149',
            'CallBackURL' => $confirmation_url,
            'AccountReference' => ' ',
            'TransactionDesc' => 'payment'
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
        */
    }

    public function password()
    {
        $current_timestamp = Carbon::now()->timestamp; // Produces something like 1552296328
        $pass = '743418' . 'nOI0bNv9sGjtCJaRBWmCcAWJTIsUweg9' . $current_timestamp;
        $password = base64_encode($pass);
        return $password;
    }
}
