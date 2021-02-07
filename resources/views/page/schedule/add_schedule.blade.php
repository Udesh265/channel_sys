@extends('layouts.admin')

@section('content')
<add-schedule-component :user_id = "{{ Auth::user()->id }}" />
@endsection
