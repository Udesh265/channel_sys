@extends('layouts.app')

@section('content')
<mark-attendance-component :user_id = "{{ Auth::user()->id }}" />
@endsection
