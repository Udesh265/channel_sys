@extends('layouts.admin')

@section('content')

<online-payment-component :user_id = "{{ Auth::user()->id }}" />

@endsection
