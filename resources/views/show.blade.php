@extends('layouts.app')

@section('content')
    <todo-page :todo="{{ $todo }}"></todo-page>
@endsection
