@extends('layouts.app')

@section('title', env('APP_NAME')." - Sociétés")

@section('body-attr')
id="branches-create-page"
content="create"
@endsection

{{-- Header --}}
{{--@section('header')
    @include('layouts.partials.header.main')
@endsection
--}}

{{-- Content --}}
@section('content')
<div class="container">
    <h1 class="text-center display-4 text-dark">Sociétés</h1>

    {{ Form::model($branch, ['url' => route('branches.store')]) }}
        {{ Form::token() }}
        <div class="form-group">
            {!! Form::text('name', '', ['class' => 'form-control', 'placeholder'=>__('branches.attributes.name')]) !!}
        </div>
    
        <div class="form-group">
            {!! Form::text('code', '', ['class' => 'form-control', 'placeholder'=>__('branches.attributes.code')]) !!}
        </div>
    
        <button class="btn btn-success float-right" type="submit">Ajouter</button>
    {{ Form::close() }}
</div>
@endsection