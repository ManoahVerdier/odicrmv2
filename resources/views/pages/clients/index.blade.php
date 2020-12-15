@extends('layouts.app')

@section('extra-meta')
    <meta name="detail_url" content="{{route('clients.show',['client'=>'?'])}}"/>
    <meta name="massedit_url" content="{{route('clients.massEdit')}}"/>
    <meta name="loadinput_url" content="{{route('clients.loadInput')}}"/>
@endsection

@section('title', env('APP_NAME')." - Clients")

@section('body-attr')
id="clients-index-page"
content="list"
@endsection

{{-- Header --}}
{{--@section('header')
    @include('layouts.partials.header.main')
@endsection
--}}

{{-- Content --}}
@section('content')
<div class="container-fluid">
    <h1 class="text-center display-4 text-dark">Clients</h1>
    @include(
        "layouts.partials.datalist",
        [
            "columnsNames"=>$columnsNames,
            "name"=>"clients",
            "column_filtering"=>true,
            "mass_edit"=>true,
            "excel_export"=>true,
            "pdf_export"=>true,
            "saved_queries"=>true,
            "advanced_filters"=>true,
        ]
    )
</div>

@endsection
