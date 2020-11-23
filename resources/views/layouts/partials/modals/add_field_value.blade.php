<div class="modal fade" id="add-field-value" tabindex="-1" role="dialog" aria-labelledby="AddFieldValue" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" id="AddFieldValueTitle">Ajouter une valeur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
 
                <div class="form-horizontal py-3 px-4">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
 
                    <input required class="form-control mb-2" name="label" id="label" placeholder="Valeur affichée"/>
                </div>                       
 
            </div>
            <div class="modal-footer">
                <button id="add-field-value-valid" class="btn btn-success float-right">
                    Ajouter
                </button>
            </div>
        </div>
    </div>
</div>