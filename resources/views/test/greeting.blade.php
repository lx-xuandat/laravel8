@extends('layouts.myapp')

@section('title', 'Nguyen Van Giang')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>Hello {{ $name }}</p>
@endsection
