@extends('layouts.admin')

@section('content')

<laboraty-overview-component :user_id = "{{ Auth::user()->id }}" />

@endsection
