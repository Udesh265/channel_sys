@extends('layouts.admin')

@section('content')

<manage-emp-component :user_id = "{{ Auth::user()->id }}"/>
@endsection
