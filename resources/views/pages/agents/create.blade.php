@extends('layouts.app')

@section('title', env('APP_NAME')." - Commerciaux")

@section('body-attr')
id="agents-create-page"
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
    <h1 class="text-center display-4 text-dark">Commerciaux</h1>

    {{ Form::model($agent, ['url' => route('agents.store')]) }}
        {{ Form::token() }}
        <div class="form-group">
            {!! Form::text(
                'name', 
                '', 
                [
                    'class' => 'form-control', 
                    'placeholder'=>__('agents.attributes.name'),
                    'required' => 'required'
                ]
            ) !!}
        </div>
    
        <div class="form-group">
            {!!Form::select(
                'branch_id', 
                [null=>'Société'] + App\Models\Branch::all()->pluck('name','id')->toArray(),
                '',
                [
                    'class'=>'form-control',
                    'required' => 'required'
                ]
            )!!}
        </div>
    
        <button class="btn btn-success float-right" type="submit">Ajouter</button>
    {{ Form::close() }}
</div>
@endsection