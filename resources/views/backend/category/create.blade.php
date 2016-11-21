@extends('backend.layouts.index')

@section('content')

    <h1>Create Category</h1>

    {!! Form::open(['route' => 'admin.management.category.store', 'method' => 'POST']) !!}
        @include('backend.category._form', [$label='Create'])
    {!! Form::close() !!}

@endsection