export class Create {
    constructor(){
        let createObject = this;
        $('select.has-model').each(function(index){
            if(! $(this).hasClass('depends')){
                let url=$('meta[name="'+$(this).attr('model')+'-list-url"]').attr('content');
                createObject.updateList($(this).attr('name'), url,$(this).attr('value')) ;
            } else {
                let dependsOnField = $('select[name="'+$(this).attr('depends_on')+'"] option.default').text();
                $(this)
                    .attr('disabled','disabled')
                    .attr('title','Merci de renseigner le champ '+dependsOnField)
                    .attr('data-toggle',"tooltip");
            }
            
            if($(this).hasClass('required')){
                $(this).on('change', function(){
                    $(this).find('option.default').attr('disabled',true);
                    let forList=$('select[name="'+$(this).attr('required_for')+'"]');
                    forList.attr('title','').attr('disabled',false);
                    let url=$('meta[name="'+forList.attr('model')+'-list-url"]').attr('content');
                    createObject.updateList(forList.attr('name'), url, forList.attr('value'), $(this).attr('name'), $(this).val()) ;
                });
            }

            $('#name').on('keyup', function(){
                createObject.checkExists($(this).val());
            })
        })
    }

    checkExists(value){
        let url=$('meta[name="client-exists-url"]').attr('content');
        $.ajax({
            type: 'POST',
            url: url,
            data:{
                value:value
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                //Décodage
                data=JSON.parse(data);
                console.log(data);
                if(data){
                    $('#name').addClass('is-invalid');
                    $("#save").attr('disabled',true);
                } else {
                    $('#name').removeClass('is-invalid');
                    $("#save").attr('disabled',false);
                }
            }
        });
    }

    updateList(name, url, selected, valName, val){
        $.ajax({
            type: 'POST',
            url: url,
            data:{
                valName:valName,
                val:val
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                //Décodage
                data=JSON.parse(data);
                $("select[name='"+name+"']").find('li:not(.default)').remove();
                for (let i = 0; i < data.length; i++) {
                    if(data[i].id == selected){
                        $("select[name='"+name+"']").append('<option selected value="'+data[i].id+'">'+data[i].name+'</option>');
                    } else {
                        $("select[name='"+name+"']").append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                    }
                }
                if(selected!=""){
                    $("select[name='"+name+"']").trigger('change');
                }
            }
        });
    }
    
}