@extends('layouts.app') 
@section('content')
    <my-header :company="{{ json_encode($company) }}" :user="{{ json_encode($auth_user) }}"></my-header>
    <router-view :user="{{ json_encode($auth_user) }}"></router-view>
{{--
<router-view></router-view> --}}
@endsection