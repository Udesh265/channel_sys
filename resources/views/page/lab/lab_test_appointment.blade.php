@extends('layouts.admin')

@section('content')

<lab-test-appointment-component :user_id = "{{ Auth::user()->id }}" />

@endsection
