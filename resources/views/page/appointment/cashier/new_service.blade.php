@extends('layouts.admin')

@section('content')

<new-service-component :user_id = "{{ Auth::user()->id }}" />

@endsection
