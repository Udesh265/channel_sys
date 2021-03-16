
@extends('layouts.admin')

@section('content')

<view-appointment-component :user_id = "{{ Auth::user()->id }}" />

@endsection


