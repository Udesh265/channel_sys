@extends('layouts.admin')

@section('content')

<new-appointment-component :user_id = "{{ Auth::user()->id }}" />

@endsection
