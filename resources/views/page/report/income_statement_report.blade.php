@extends('layouts.admin')

@section('content')
<income-statement-report-component :user_id = "{{ Auth::user()->id }}" />
@endsection
