<div class="modal fade" id="{{$name}}-saved-queries" tabindex="-1" role="dialog" aria-labelledby="{{$name}}SavedQueries" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" id="{{$name}}SavedQueriesTitle">Segments</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
 
                <div class="form-horizontal py-3 px-4">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class='form-group row' group="1">
                        <div class="col-md-6 col-12 px-2">
                            <input required type="text" class="form-control" name="name" id="saved-queries-name" placeholder="Nom"/>
                        </div>
                        <div class="col-md-6 col-12 px-2">
                            <select required name="visibility" id="saved-queries-visibility" class="form-control">
                                <option value="">Visibilité</option>
                                <option value="private">Privé</option>
                                <option value="public">Public</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div id="{{$name}}-savedqueries-conditions" class="col-12 px-2">

                        </div>
                    </div>
                </div>                       
 
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button id="{{$name}}-savedqueries-valid" class="btn btn-success float-right">
                        Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>