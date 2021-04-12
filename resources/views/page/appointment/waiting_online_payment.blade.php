
@extends('layouts.admin')

@section('content')

<wait-online-payment-component :user_id = "{{ Auth::user()->id }}" />

@endsection


