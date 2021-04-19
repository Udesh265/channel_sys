@extends('layouts.admin')

@section('content')
<appointment-mgt-component :user_id = "{{ Auth::user()->id }}" />
@endsection
