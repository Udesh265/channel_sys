@extends('layouts.admin')

@section('content')
<top-service-report-component :user_id = "{{ Auth::user()->id }}" />
@endsection
