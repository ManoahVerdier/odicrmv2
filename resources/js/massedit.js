export class MassEdit {
    constructor(name){
        $("#"+name+"-mass-edit select").on('change', function(event) {
            window.massedit.loadInput(this);
        });

        $("#"+name+"-massedit-valid").on('click', function(event){
            window.massedit.run();
        });

        this.name = name;
    }
    loadInput(select){
        let url=$('meta[name="loadinput_url"]').attr('content');
        let id_group = $(select).parent().attr('group');
        let column = $(select).val();
        $('div[group='+id_group+'] input').remove();
        $('div[group='+id_group+'] select.value').remove();
        $.ajax({
            type: 'POST',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {column: column},
            success: function (data) {
                var field;
                if(data.element=="input") {
                    field = "<input pattern='"+data.pattern+"' type='"+data.type+"' name='"+data.name+"' class='form-control col-12 offset-md-1 col-md-6 value' placeholder='Valeur souhaitée...'/>";
                }
                else {
                    field = "<select name='"+data.name+"' class='form-control col-12 offset-md-1 col-md-6 value'>";
                    for(let key in data.values) {
                        if(data.values[key].label!="" && data.values[key].label!=undefined){
                            field+="<option value='"+key+"'>"+data.values[key].label+"</option>";
                        } else {
                            field+="<option value='"+key+"'>"+data.values[key]+"</option>";
                        }
                    }
                    field+="</select>";
                }
                $('div[group='+id_group+']').append(field);
            }
        });
    }

    run(){
        if($('.value')[0].reportValidity()) {
            let field = $('.field').val();
            let value = $('.value').val();

            let table= window.datatable;
            let selected = table.rows({ search: 'applied' }).select().data().toArray();
            let url = $('meta[name="massedit_url"]').attr('content');
            $.ajax({
                type: 'POST',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    json: JSON.stringify(selected),
                    field:field,
                    value:value
                },
                success: function (data) {
                    window.datatable.ajax.reload();
                    $('#'+window.massedit.name+'-mass-edit').modal('hide');
                    $('#'+window.massedit.name+'-mass-edit .value').remove();
                    $('#'+window.massedit.name+'-mass-edit .field').val("");
                }
            });
        }
    }
}