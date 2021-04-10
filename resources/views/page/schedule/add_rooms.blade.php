@extends('layouts.admin')

@section('content')
<add-room-component :user_id = "{{ Auth::user()->id }}" />
@endsection
