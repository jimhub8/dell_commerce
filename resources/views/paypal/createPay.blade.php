@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="/createpayment" method="post">
                        @csrf {{-- <input type="submit" value="paypal"> --}}
                        <v-btn color='primary' raised type="submit">Paypal</v-btn>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection