@extends('layouts.admin')

@section('content')
<add-workplacetime-component :user_id = "{{ Auth::user()->id }}" />
@endsection
