<?php

namespace App\Http\Controllers;

use App\models\Carousel;
use Illuminate\Http\Request;

// use GuzzleHttp\Client;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiGet()
    {
        // $http = new Client;
        $client = new \GuzzleHttp\Client();
        $request = $client->request('GET', 'http://speedball.test/api/shipment', [
            'headers' => [
                'Content-type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBhMmE5ZTIzNDU3ZmQ1OWM2MWJlNTAzMzZhN2QyNWJiNDNlZmFhMjA0Yjg3MTQ4N2E3N2M1NDhjOTc0M2JiZGQzZGUyMTM3NWJkNWFkMDJjIn0.eyJhdWQiOiIxIiwianRpIjoiMGEyYTllMjM0NTdmZDU5YzYxYmU1MDMzNmE3ZDI1YmI0M2VmYWEyMDRiODcxNDg3YTc3YzU0OGM5NzQzYmJkZDNkZTIxMzc1YmQ1YWQwMmMiLCJpYXQiOjE1NTU2NjYwODIsIm5iZiI6MTU1NTY2NjA4MiwiZXhwIjoxNTg3Mjg4NDgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iU-BAzEWAZ_dcBHNDcO1udLVUNJmhdlYxuJ3J8efiocIii16pomu8MoiNWS5Y02UBTl-XN3IpcV-KeecRX15mhsXZ3O6j1CXGaHwzkW9Jf7esTcRDJmLifGZ2m6l0mNtgYhMJ7mVcHWyI2MYiluMGszePgb3QE5613uRzDbRsaaZn4dm1Wl6hi6Yx0RbVQbqxH5GwUWVviUKnCf6GSTyf7nPTSeOOp6zOeUrxoCgg8JEty1ldjHR6qExeB1sm8yKAfhHT_X5qpGlzBrLkC0TZZN-3zENj63X6n1kLChg490NfZVjvhts7ZZNkElwgvzaCVuRR8M9DKZFOu6rkxtQoyinwMkNfq4G4ZVvIBUh6o2tnayChuWkulKHw8n6VOWQhXFC2RGRO1mKLTK8bITD8sdX5i2c8r0MlQuQKk5BroKpm_3CyTGveAUrgqhDY1l-ClBAZm4t0Hu7ZmSgkvr_AATnnxzUFyf54oqEOhDOzRZIvYSk-_mvgJspNPZWYcOYkUNFNUWcKZfYaDcOmct9snWB1_EEeBkd3lJfEs84PY1UtUWFsjZjAE5MD8usv0y_xi9khf-qE6ycqn8DGv_qStJ4REeebGs_umvd0u7rZEz9h2cRetQWXojMeYQLpXwDinJzyLUaC9gnBS1mketKVut33Y9O8Dybam53u7Ko6MQ',
            ],
        ]);
        // $response = $http->get('http://courierapp.test/api/getUsers');
        return $response = $request->getBody()->getContents();
        // echo '<pre>';
        // dd($response);
        // exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function show(Carousel $carousel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function edit(Carousel $carousel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carousel $carousel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carousel $carousel)
    {
        //
    }
}
