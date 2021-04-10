@extends('layouts.admin')

@section('content')

<lab-report-component :user_id = "{{ Auth::user()->id }}" />

@endsection
