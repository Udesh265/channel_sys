@extends('layouts.admin')

@section('content')

<rep-doctor-appointment-component :user_id = "{{ Auth::user()->id }}" />

@endsection
