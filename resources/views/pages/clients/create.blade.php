@extends('layouts.app')

@section('extra-meta')
    @foreach($fields->where('has_model', true) as $field)
        <meta name="{{$field->model}}-list-url" content="{{route($field->model."-list")}}"/>
    @endforeach
    <meta name="client-exists-url" content="{{route("clients.exists")}}"/>
@endsection

@section('title', env('APP_NAME')." - ".__('clients.create.title'))

@section('body-attr')
id="clients-create-page"
content="create-client"
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
    <h1 class="text-center display-4 text-dark">{{__('clients.create.title')}}</h1>

    <div class="row">
        @php 
            $client=App\Models\Client::first() ?? (new App\Models\Client());
            $model = new App\Models\Client();
        @endphp

        <form class='col-8 offset-2 py-4' method="POST" action="{{route('clients.store')}}">
            @csrf
            <div class='row'>
                @foreach($fields as $field)
                    @if(in_array($field->name, ["type","branch_id","name", "address", "agent_id"]))
                        <div class="col-12 py-1">
                    @else
                        <div class="col-6 py-1">
                    @endif
                        
                        @if($field->is_select)
                            @if($field->is_boolean)
                                <select 
                                    id="{{$field->name}}" 
                                    name="{{$field->name}}" 
                                    type="{{$field->name}}" 
                                    class="form-control {{ $errors->has($field->name) ? ' is-invalid' : '' }}"
                                    required
                                >
                                    <option value="" {{ old($field->name) == "" ? "selected" : ""}}  class="default">{{__('clients.attributes.'.$field->name)}}</option>
                                    <option value="1" {{ old($field->name) == 1 ? "selected" : ""}} >Oui</option>
                                    <option value="0" {{ old($field->name) == 0 ? "selected" : ""}} >Non</option>
                                </select>
                            @elseif($field->has_model)
                                <select 
                                    id="{{$field->name}}" 
                                    name="{{$field->name}}" 
                                    type="{{$field->name}}" 
                                    model="{{$field->model}}"
                                    class="
                                        form-control {{ $errors->has($field->name) ? ' is-invalid' : '' }} 
                                        has-model 
                                        @if($field->required_for ?? false) required @endif
                                        @if($field->depends_on ?? false) depends @endif
                                    "
                                    @if($field->required_for ?? false)
                                        required_for={{$field->required_for}}
                                    @endif

                                    @if($field->depends_on ?? false)
                                        depends_on={{$field->depends_on}}
                                    @endif
                                    required
                                    value="{{ old($field->name) }}"
                                >
                                    <option value="" selected class="default">{{__('clients.attributes.'.$field->name)}}</option>
                                </select>
                            @else
                                <select 
                                    id="{{$field->name}}" 
                                    name="{{$field->name}}" 
                                    type="{{$field->name}}" 
                                    class="form-control {{ $errors->has($field->name) ? ' is-invalid' : '' }}"
                                    required
                                >
                                    <option value="" {{ old($field->name) == "" ? "selected" : ""}}  class="default">{{__('clients.attributes.'.$field->name)}}</option>
                                    @foreach($field->values as $value)
                                        <option 
                                            {{ old($field->name) == $value->value ? "selected" : ""}} 
                                            value="{{$value->value}}"
                                        >
                                            {{$value->label}}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        @else 
                            <input 
                                id="{{$field->name}}" 
                                name="{{$field->name}}" 
                                type="{{$field->name}}" 
                                placeholder="{{__('clients.attributes.'.$field->name)}}"
                                class="form-control {{ $errors->has($field->name) ? ' is-invalid' : '' }}"
                                @if($field->pattern ?? false)
                                    pattern="{{$field->pattern}}"
                                @endif
                                required
                                value="{{ old($field->name) }}"
                            />
                        @endif
                        @if($field->name=="name" && ! $errors->has("name"))
                            <div class="invalid-feedback">{{__('clients.create.exists')}}</div>
                        @endif
                        @if ($errors->has($field->name))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first($field->name) }}</strong>
                            </span>
                        @endif
                    </div>
                @endforeach
                <div class="col-12">
                    <input id="save" type="submit" class='form-control btn btn-primary btn block mt-1' value='Enregistrer'>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
