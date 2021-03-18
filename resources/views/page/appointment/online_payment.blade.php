@extends('layouts.admin')

@section('content')

<online-payment-component :p_id="{{$payment_id}}" :user_id = "{{ Auth::user()->id }}" />

@endsection
