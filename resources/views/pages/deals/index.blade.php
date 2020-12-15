@extends('layouts.app')

@section('extra-meta')
    <meta name="detail_url" content="{{route('deals.show',['deal'=>'?'])}}"/>
    <meta name="massedit_url" content="{{route('deals.massEdit')}}"/>
    <meta name="loadinput_url" content="{{route('deals.loadInput')}}"/>
@endsection

@section('title', env('APP_NAME')." - Deals")

@section('body-attr')
id="deals-index-page"
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
    <h1 class="text-center display-4 text-dark">Devis</h1>
    @include(
        "layouts.partials.datalist",
        [
            "columnsNames"=>$columnsNames,
            "name"=>"deals",
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
