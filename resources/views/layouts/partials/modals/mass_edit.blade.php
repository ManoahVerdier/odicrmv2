<div class="modal fade" id="{{$name}}-mass-edit" tabindex="-1" role="dialog" aria-labelledby="{{$name}}MassEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" id="{{$name}}MassEditTitle">Modification en masse</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
 
                <div class="form-horizontal py-3 px-4">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
 
                    <div class='form-group row' group="1">
                        <select class="form-control field col-12 col-md-5 ">
                            <option value="">Choisir un attribut</option>
                            @foreach($columnsNames as $column)
                                <option value="{{$column}}">{{__("$name.attributes.$column")}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button id="{{$name}}-massedit-valid" class="btn btn-success float-right">
                            Modifier
                        </button>
                    </div>
                </div>                       
 
            </div>
        </div>
    </div>
</div>