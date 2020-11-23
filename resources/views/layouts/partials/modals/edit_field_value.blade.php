<div class="modal fade" id="edit-field-value" tabindex="-1" role="dialog" aria-labelledby="EditFieldValue" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" id="EditFieldValueTitle">Modifier une valeur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
 
                <div class="form-horizontal py-3 px-4">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
 
                    <input required class="form-control mb-2" name="label" id="new_label" placeholder="Valeur affichée"/>
                </div>                       
 
            </div>
            <div class="modal-footer">
                <button id="edit-field-value-valid" class="btn btn-success float-right">
                    Enregistrer
                </button>
            </div>
        </div>
    </div>
</div>