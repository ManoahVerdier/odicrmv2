import 'jquery-ui/ui/widgets/sortable.js';

export class FieldEdit {
    constructor(){
        
        this.target=$('#targetsFieldValues .nav-link.active').attr('aria-controls');
        this.field=$('#'+this.target+' .nav-link.active').attr('field_name');
        this.field_id=$('#'+this.target+' .nav-link.active').attr('field_id');
        this.base_url=$('#'+this.target+' .nav-link.active').attr('url_base');
        this.container=$('#'+this.target+'-field-sortable');
        this.target_class=$('#'+this.target+' .nav-link.active').attr('target_class');
        this.editing=-1;
        this.modalAdd = $('#add-field-value').modal('hide');
        this.modalEdit = $('#edit-field-value').modal('hide');
        console.log(this);
        this.loadList();
        this.addGlobalEvents();
    }

    sortAsc() {
        var sortableList = $(this.container);
        var listitems = $('li', sortableList);
    
        listitems.sort(function (a, b) {
            return ($(a).text().toUpperCase() > $(b).text().toUpperCase())  ? 1 : -1;
        });
        sortableList.append(listitems);
    
    }

    sortDesc() {
        var sortableList = $(this.container);
        var listitems = $('li', sortableList);
    
        listitems.sort(function (a, b) {
            return ($(a).text().toUpperCase() < $(b).text().toUpperCase())  ? 1 : -1;
        });
        sortableList.append(listitems);
    
    }

    loadList(){
        this.container.find('li').remove();
        $.ajax({
            type: 'POST',
            url: $('meta[name="values_url"]').attr("content"),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                target: this.target,
                field:this.field
            },
            success: function (data) {
                let values=JSON.parse(data);
                let index=0;
                for(index=0;index<values.length;index++)
                {
                    let line = $('<li></li>');
                    line.html(
                        '<span class="ui-icon ui-icon-arrowthick-2-n-s float-left position-absolute move"></span>'+
                        values[index].label+
                        '<span class="position-absolute del text-danger"><i class="fas fa-trash"></i></span>'+
                        '<span class="position-absolute edit text-primary"><i class="fas fa-pen"></i></span>'
                    );
                    line.addClass("ui-state-default");
                    line.addClass("py-2 px-5 bg-light");
                    line.addClass("text-center");
                    line.addClass("list-group-item");
                    line.attr('value_id',values[index].id);
                    line.appendTo(window.fieldEdit.container);
                }
                window.fieldEdit.container.sortable();
                window.fieldEdit.addListEvents();
            }
        });
    }

    addGlobalEvents(){
        $('#add-field-value-valid').off('click');
        $('#add-field-value-valid').on('click',function(){
            if($('#label').get(0).reportValidity()){
                $.ajax({
                    type: 'POST',
                    url: $('meta[name="fieldvalue_url"]').attr("content"),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        target_name: window.fieldEdit.target,
                        field_name:window.fieldEdit.field,
                        label:$('#label').val(),
                        value:$('#label').val(),
                        order:window.fieldEdit.container.find('li').length,
                        target_class:window.fieldEdit.target_class,
                    },
                    success: function (data) {
                        window.fieldEdit.modalAdd.modal('hide');
                        $('#label').val('');
                        window.fieldEdit.loadList();
                    }
                });
            }
        });
        $('#edit-field-value-valid').off('click');
        $('#edit-field-value-valid').on('click',function(){
            if($('#new_label').get(0).reportValidity()){
                console.log($('meta[name="fieldvalue_url"]').attr("content")+"/"+window.fieldEdit.editing);
                $.ajax({
                    type: 'POST',
                    url: $('meta[name="fieldvalue_url"]').attr("content")+"/"+window.fieldEdit.editing,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _method:'PUT',
                        label:$('#new_label').val()
                    },
                    success: function (data) {
                        window.fieldEdit.modalEdit.modal('hide');
                        $('#new_label').val('');
                        window.fieldEdit.editing=-1;
                        window.fieldEdit.loadList();
                    }
                });
            }
        });

        $('#'+this.target+'-alpha-sort').on('click',function(){
            window.fieldEdit.sortAsc();
            window.fieldEdit.container.trigger('sortupdate');
        })

        $('#'+this.target+'-anti-alpha-sort').on('click',function(){
            window.fieldEdit.sortDesc();
            window.fieldEdit.container.trigger('sortupdate');
        })

        $('#'+this.target+'-add-field-value-button').on('click',function(){
            window.fieldEdit.modalAdd.modal('show');
        });

        $('#'+this.target+' .nav-item').on('click',function(){
            $('#'+window.fieldEdit.target+' .nav-item a.active').removeClass('active');
            $('#'+window.fieldEdit.target+' .nav-item.active').removeClass('active');
            $(this).addClass('active');
            $(this).find('a').addClass('active');
            window.fieldEdit.field=$(this).find('a').attr('field_name');
            window.fieldEdit.loadList();
        })
        $('#targetsFieldValues li a').off('shown.bs.tab');
        $('#targetsFieldValues li a').on('shown.bs.tab', function(){
            window.fieldEdit.container.find('li').remove();
            window.fieldEdit = new FieldEdit();
        })
    }

    addListEvents(){
        window.fieldEdit.container.on('sortupdate',function(){
            let values = $(window.fieldEdit.container).find('li');
            let index;
            for(index=0;index<values.length;index++){
                let id = $(values[index]).attr('value_id');
                $.ajax({
                    type: 'POST',
                    url: $('meta[name="fieldvalue_url"]').attr("content")+"/"+id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _method:'PUT',
                        order:index
                    },
                    success: function (data) {
                        window.fieldEdit.modalEdit.modal('hide');
                        window.fieldEdit.editing=-1;
                    }
                });
            }
        });
        $('.del').on('click',function(){
            let id = $(this).parent().attr('value_id');
            $(this).parent().remove();
            $.ajax({
                type: 'POST',
                url: $('meta[name="fieldvalue_url"]').attr("content")+"/"+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method:'DELETE',
                },
                success: function (data) {
                    
                }
            });
        });
        $('.edit').on('click',function(){
            window.fieldEdit.editing=$(this).parent().attr('value_id');
            window.fieldEdit.modalEdit.modal('show');
        });
    }
}