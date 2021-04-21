@extends('layouts.admin')

@section('content')
<lab-appointment-list-report-component :user_id = "{{ Auth::user()->id }}" />
@endsection
