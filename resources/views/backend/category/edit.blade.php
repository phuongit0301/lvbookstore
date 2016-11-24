@extends('backend.layouts.index')

@section('content')

    <h1>Edit Category</h1>

    {!! Form::model($category, ['route' => ['admin.management.category.update', $category->id], 'method' => 'PATCH']) !!}
        @include('backend.category._form', [$label='Update'])
    {!! Form::close() !!}

@endsection