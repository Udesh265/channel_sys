@extends('layouts.admin')

@section('content')
<service-component :user_id = "{{ Auth::user()->id }}" />
@endsection
