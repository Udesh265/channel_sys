@extends('layouts.admin')

@section('content')

<add-employee-component :user_id = "{{ Auth::user()->id }}"/>
@endsection
