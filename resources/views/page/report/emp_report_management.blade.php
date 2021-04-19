@extends('layouts.admin')

@section('content')
<employee-report-component :user_id = "{{ Auth::user()->id }}" />
@endsection



