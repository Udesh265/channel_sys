@extends('layouts.admin')

@section('content')
<service-list-component :user_id = "{{ Auth::user()->id }}" />
@endsection
