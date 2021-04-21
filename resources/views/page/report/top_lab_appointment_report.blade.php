@extends('layouts.admin')

@section('content')
<top-lab-appointment-report-component :user_id = "{{ Auth::user()->id }}" />
@endsection
