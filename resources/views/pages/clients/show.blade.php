@extends('layouts.app')

@section('extra-meta')
    <meta name="deal_get_url" content="{{route('deals.ajaxGet',['deal'=>'?'])}}"/>
    <!--<meta name="massedit_url" content="{{route('clients.massEdit')}}"/>
    <meta name="loadinput_url" content="{{route('clients.loadInput')}}"/>-->
@endsection

@section('title', env('APP_NAME')." - ".$client->name)

@section('body-attr')
id="clients-show-page"
content="show-client"
@endsection

{{-- Header --}}
{{--@section('header')
    @include('layouts.partials.header.main')
@endsection
--}}

{{-- Content --}}
@section('content')
<div class="container-fluid">

    {{-- Name --}}
    <h1 class="text-center display-4 text-dark">{{$client->name}}</h1>

    {{-- First line --}}
    <div class="row" id="first-line">

        {{-- Infos --}}
        <div class="col-12 col-md-4" id="infos">
            @include(
                'layouts.partials.info_box',
                [
                    'icon'=>'fa-user-tie',
                    'title'=>'Infos client',
                    'main_infos'=>collect($client->toArray())->only('name', 'address', 'city','postal_code'),
                    'infos'=>collect($client->toArray())->only('phone', 'fax', 'email', 'website'),
                    'target'=>'clients',
                    'showMore'=>true,
                    'idModal'=>'allFieldsClient'
                ]
            )
        </div>

        {{-- Commercial --}}
        <div class="col-12 col-md-4" id="commercial">
            @include(
                'layouts.partials.info_box',
                [
                    'icon'=>'fa-briefcase',
                    'title'=>'Infos commerciales',
                    'infos'=>collect($client->commercial->toArray())->except($client->commercial->getGuarded()),
                    'target'=>'clients',
                    'showMore'=>false
                ]
            )
        </div>

        {{-- Contract --}}
        <div class="col-12 col-md-4" id="contract">
            @include(
                'layouts.partials.info_box',
                [
                    'icon'=>'fa-tools',
                    'title'=>'Contrats entretien',
                    'infos'=>collect($client->contract->toArray())->except($client->contract->getGuarded()),
                    'target'=>'clients',
                    'showMore'=>false
                ]
            )
        </div>
    </div>

    {{-- Deals --}}
    <div class="row mt-3" id="deals">
        @include(
            'layouts.partials.deals'
        )
    </div>
</div>

{{-- Modals --}}
<div id="modals">

    {{-- More infos modal --}}
    @include(
        'layouts.partials.modals.show_all_infos',
        [
            'title'=>"Infos client",
            "modalId"=>'allFieldsClient',
            'infos'=>collect($client->toArray())->except(array_merge($client->getGuarded(), ['infos', 'remarks'])),
            'target'=>'clients'
        ]
    )

    {{-- Deal-modal --}}
    @if($client->deals->count()>0)
        @include(
            'layouts.partials.modals.deal_infos',
            [
                'title'=>"Infos client",
                "modalId"=>'allFieldsClient',
                'infos'=>array_diff($client->deals->first()->columns(), ['id', 'title', 'more']),
                'target'=>'deals'
            ]
        )
    @endif
</div>
@endsection
