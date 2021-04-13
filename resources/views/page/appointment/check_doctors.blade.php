
@extends('layouts.admin')

@section('content')

<check-doctors-component :user_id = "{{ Auth::user()->id }}" />

@endsection
