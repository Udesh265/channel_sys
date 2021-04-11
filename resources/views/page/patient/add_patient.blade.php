@extends('layouts.admin')

@section('content')

<add-patient-component :user_id = "{{ Auth::user()->id }}" />

@endsection
