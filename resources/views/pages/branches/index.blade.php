@extends('layouts.app')

@section('extra-meta')
    <meta name="detail_url" content="{{route('branches.show',['branch'=>'?'])}}"/>
@endsection

@section('title', env('APP_NAME')." - Sociétés")

@section('body-attr')
id="branches-index-page"
content="list"
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

    @include(
        "layouts.partials.datalist",
        [
            "columnsNames"=>$columnsNames,
            "name"=>"branches",
            "column_filtering"=>true,
            "mass_edit"=>false,
            "excel_export"=>false,
            "pdf_export"=>false,
            "saved_queries"=>false,
            "advanced_filters"=>false,
        ]
    )
</div>

@endsection
