@extends('layouts.admin')

@section('content')
<patient-report-component :user_id = "{{ Auth::user()->id }}" />
@endsection
