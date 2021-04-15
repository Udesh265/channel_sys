@extends('layouts.admin')

@section('content')

<view-all-lab-app-component :user_id = "{{ Auth::user()->id }}" />

@endsection
