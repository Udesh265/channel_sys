@extends('layouts.admin')

@section('content')

<lab-report-type-component :user_id = "{{ Auth::user()->id }}" />

@endsection
