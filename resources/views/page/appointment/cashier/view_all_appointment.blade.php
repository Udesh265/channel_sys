@extends('layouts.admin')

@section('content')

<view-all-appointment-component :user_id = "{{ Auth::user()->id }}" />

@endsection
