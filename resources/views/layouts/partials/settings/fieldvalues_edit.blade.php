<div class="row py-4">
    <div class="col-md-2 border-right">
        <ul class="nav nav-pills flex-column">
            @foreach($list as $field) 
                <li class="nav-item">
                    <a 
                        target_name={{$field->target}} 
                        name={{$field->name}} 
                        field_id={{$field->id}} 
                        class="nav-link @if($loop->first) active @endif"
                        href="#"
                    >
                        {{__($field->target.".attributes.".$field->name)}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col align-self-center text-right">
                <div class="mb-2"><button id="{{$name}}-alpha-sort" class="btn btn-dark"><i class="fas fa-sort-alpha-down"></i></button></div>
                <div><button id="{{$name}}-anti-alpha-sort" class="btn btn-dark"><i class="fas fa-sort-alpha-up-alt"></i></button></div>
            </div>
            <div class="col-auto">
                <h2 class="mb-4">Valeurs possibles</h2>
                <ul id="{{$name}}-field-sortable" class="list-group mb-3">

                </ul>
            <button class="btn btn-block btn-primary" id="{{$target}}-add-field-value-button">Ajouter une valeur</button>
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>