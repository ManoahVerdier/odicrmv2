@extends('layouts.app')

@section('extra-meta')
    <meta name="detail_url" content="{{route('clients.show',['client'=>'?'])}}"/>
    <meta name="massedit_url" content="{{route('clients.massEdit')}}"/>
    <meta name="loadinput_url" content="{{route('clients.loadInput')}}"/>
    <meta name="store_segment_url" content="{{route('segments.store')}}"/>
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
    <nav id="sidebar" class="bg-dark navbar-dark">
        <div class="sidebar-header">
            <h3>OdiCRM</h3>
            <strong>v2</strong>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="{{route('home')}}">
                    <span class="icon"><i class="fas fa-home"></i></span>
                    <span class="text">{{__('navigation.home')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('deals.index')}}">
                    <span class="icon"><i class="fas fa-briefcase"></i></span>
                    <span class="text">{{__('navigation.deals')}}</span>
                </a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="icon"><i class="fas fa-copy"></i></span>
                    <span class="text">Pages</span>
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="{{route('clients.index')}}">{{__('navigation.clients')}}</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>
<button type="button" id="sidebarCollapse" class="btn btn-info">
    <i class="fas fa-align-left"></i>
    <span>Toggle Sidebar</span>
</button>
@endsection
