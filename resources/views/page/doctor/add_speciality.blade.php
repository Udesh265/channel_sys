@extends('layouts.admin')

@section('content')

<add-doctor-speciality :user_id = "{{ Auth::user()->id }}" />

@endsection
