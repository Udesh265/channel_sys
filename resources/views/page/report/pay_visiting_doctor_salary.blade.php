@extends('layouts.admin')

@section('content')
<visiting-doc-salary-component :user_id = "{{ Auth::user()->id }}" />
@endsection
