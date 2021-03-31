@extends('layouts.admin')

@section('content')
<dashboard-component :user_id="{{Auth::user()->id}}"/>
@endsection
