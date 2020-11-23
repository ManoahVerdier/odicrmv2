@extends('layouts.app')

@section('extra-meta')
    <meta name="values_url" content="{{route('fieldvalue.values')}}"/>
    <meta name="fieldvalue_url" content="{{route('fieldvalues.index')}}"/>
    {{--<meta name="loadinput_url" content="{{route('clients.loadInput')}}"/>--}}
@endsection

@section('title', env('APP_NAME')." - Clients")

@section('body-attr')
id="field-values-edit-page"
content="fieldEdit"
@endsection

{{-- Header --}}
{{--@section('header')
    @include('layouts.partials.header.main')
@endsection
--}}

{{-- Content --}}
@section('content')
<div class="container-fluid">
    <h1 class="text-center display-4 text-dark">Gestion des listes déroulantes</h1>

    <ul class="nav nav-tabs" id="targetsFieldValues" role="tablist">
        @foreach ($targets as $target=>$fields)
            <li class="nav-item">
                <a 
                    class="nav-link @if($loop->first) active @endif" 
                    id="{{$target}}-tab" 
                    data-toggle="tab" 
                    href="#{{$target}}" 
                    role="tab" 
                    aria-controls="{{$target}}" 
                    @if($loop->first) aria-selected=true @endif
                >
                    {{__($target.".name")}}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="targetsFieldContent">
        @foreach ($targets as $target=>$fields)
            <div class="tab-pane fade @if($loop->first) show active @endif" id="{{$target}}" role="tabpanel" aria-labelledby="{{$target}}-tab">
                @include(
                    'layouts.partials.settings.fieldvalues_edit',
                    [
                        "list" => $fields,
                        "name" => $target
                    ]    
                )
            </div>
        @endforeach
    </div>    
</div>

@include('layouts.partials.modals.add_field_value')
@include('layouts.partials.modals.edit_field_value')

@endsection
