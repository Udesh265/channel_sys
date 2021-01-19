@extends('layouts.admin')

@section('content')

<manage-patient-component :user_id = "{{ Auth::user()->id }}"/>
@endsection
