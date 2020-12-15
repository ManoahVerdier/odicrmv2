@extends('layouts.app')

@section('extra-meta')
    <!--<meta name="detail_url" content="{{route('clients.show',['client'=>'?'])}}"/>
    <meta name="massedit_url" content="{{route('clients.massEdit')}}"/>
    <meta name="loadinput_url" content="{{route('clients.loadInput')}}"/>-->
@endsection

@section('title', env('APP_NAME')." - ".$client->name)

@section('body-attr')
id="clients-show-page"
content="show"
@endsection

{{-- Header --}}
{{--@section('header')
    @include('layouts.partials.header.main')
@endsection
--}}

{{-- Content --}}
@section('content')
<div class="container-fluid">
    <h1 class="text-center display-4 text-dark">{{$client->name}}</h1>
    <div class="row">
        <div class="col-12 col-md-4">
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
        <div class="col-12 col-md-4">
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
        <div class="col-12 col-md-4">
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
    <div class="row mt-3">
        @include(
            'layouts.partials.deals'
        )
    </div>
</div>
<div id="modals">
    @include(
        'layouts.partials.modals.show_all_infos',
        [
            'title'=>"Infos client",
            "modalId"=>'allFieldsClient',
            'infos'=>collect($client->toArray())->except(array_merge($client->getGuarded(), ['infos', 'remarks'])),
            'target'=>'clients'
        ]
    )
</div>
@endsection
