@extends('layouts.admin')

@section('content')

<add-patient-component textz="Hello Udesh" :user_id = "{{ Auth::user()->id }}" />

@endsection
