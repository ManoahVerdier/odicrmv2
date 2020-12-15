export class SavedQueries {
    constructor(name){
        this.name = name;
        this.selected=-1;
        this.select = this.initSelect();
        this.updateSelect();
        this.initButtons();
        
        
        new $.fn.dataTable.SearchBuilder(window.datatable, {});
        this.searchBuilder = window.datatable.searchBuilder;
        window.datatable.searchBuilder.container().appendTo("#clients-savedqueries-conditions");
        
        this.addControl();
        this.initEvents();

        $('.dataTables_filter').css('display','none');
        
        $('#'+this.name+'-saved-queries').modal("hide");
        
    }

    changeSavedQuery(){
        let oldSelected = this.selected;
        this.selected=$('#selectSavedQueries').val();
        if(this.selected!=-1) {
            
            window.savedQueries.loadSavedQuery();
        } else {
            window.savedQueries.resetSavedQueries(oldSelected);
        }
    }

    initEvents(){
        $('#'+this.name+'-savedqueries-valid').on('click',function(){
            if(window.savedQueries.selected==-1) {
                window.savedQueries.saveCurrentQuery();
            } else {
                window.savedQueries.updateCurrentQuery();
            }
        });
        $('#selectSavedQueries').on('change',function(){
            window.savedQueries.changeSavedQuery();    
        });
    }

    saveCurrentQuery() {
        if($('#saved-queries-name').get(0).reportValidity() && $('#saved-queries-visibility').get(0).reportValidity()) {
            $.ajax({
                url: "/segments",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    
                    type: this.name,
                    name: $('#saved-queries-name').val(),
                    data: JSON.stringify(this.searchBuilder.getDetails()),
                    visibility:$('#saved-queries-visibility').val(),
                    owner_id: 1
                },
                cache: false,
                success: function(dataResult){
                    dataResult=JSON.parse(dataResult);
                    window.savedQueries.selected=dataResult.id;
                    $('#'+window.savedQueries.name+'-saved-queries').modal("hide");
                    window.savedQueries.updateSelect();
                    $('.add').hide();
                    $('.edit').show();
                }
            });
        }
    }

    deleteCurrentQuery() {
        $.ajax({
            url: "/segments/"+this.selected,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                _method:'DELETE',
                id: this.selected
            },
            cache: false,
            success: function(dataResult){
                window.savedQueries.resetSavedQueries();
                window.savedQueries.updateSelect();
            }
        });
    }

    updateCurrentQuery() {
        if($('#saved-queries-name').get(0).reportValidity() && $('#saved-queries-visibility').get(0).reportValidity()) {
            $.ajax({
                url: "/segments/"+this.selected,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method:'PUT',
                    type: this.name,
                    name: $('#saved-queries-name').val(),
                    data: JSON.stringify(this.searchBuilder.getDetails()),
                    visibility:$('#saved-queries-visibility').val(),
                    owner_id: 1
                },
                cache: false,
                success: function(dataResult){
                    $('#'+window.savedQueries.name+'-saved-queries').modal("hide");
                }
            });
        }
    }

    resetSavedQueries(oldSelected){
        $('.edit').hide();
        $('.add').show();
        $('#saved-queries-visibility').val('');
        $('#saved-queries-name').val('');
        window.savedQueries.searchBuilder.rebuild();
        $.ajax({
            url: "/segments/forget/"+oldSelected,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
        });
    }

    showSpinner(){
        var spinner=$('<div id="savedQueriesSpinner" class="rounded border border-secondary position-absolute p-5"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
        spinner.css('left','calc(50% - 3rem - 1.5rem)');
        spinner.css('top','50%');
        spinner.css('z-index','9999999');
        spinner.css('background','rgba(255,255,255,1)');
        spinner.css('text-align','center');
        spinner.insertAfter('#'+this.name+'-table_wrapper');
    }

    removeSpinner(){
        $('#savedQueriesSpinner').remove();
    }

    loadSavedQuery() {
        $('.add').hide();
        $('.edit').show();
        let id=this.selected;
        this.showSpinner();
        $.ajax({
            url: "/segments/"+id,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(dataResult){
                dataResult=JSON.parse(dataResult);
                console.log(dataResult.data);
                window.savedQueries.searchBuilder.rebuild(JSON.parse(dataResult.data));
                $('#saved-queries-name').val(dataResult.name);
                $('#saved-queries-visibility').val(dataResult.visibility);
                window.savedQueries.removeSpinner();
            }
        });
    }

    initSelect(){
        var label = $("<label class=''>Segments : </label>");
        label.insertBefore('.dataTables_filter');
        var select = $("<select style='width:auto' class=' mx-2 btn-group dt-buttons form-control flex-wrap' id='selectSavedQueries'></select>"); 
        
        var opt = $("<option class='all'></option"); 
        opt.val("-1"); 
        opt.html("Voir tout"); 
        select.append(opt);
        return select;
    }

    updateSelect(){
        this.select.find('option:not(.all)').remove();
        $.ajax({
            url: "/segments/typeList/"+this.name,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(dataResult){
                let select=window.savedQueries.select;
                dataResult=JSON.parse(dataResult);
                console.log(dataResult);
                if(dataResult.selected != ""){
                    window.savedQueries.selected=dataResult.selected;
                }
                for(let index=0;index<dataResult.list.length;index++){
                    let data = dataResult.list[index];
                    console.log(data);
                    var opt = $("<option></option"); 
                    opt.val(data.id); 
                    opt.html(data.name); 
                    if(data.id==window.savedQueries.selected){
                        opt.attr('selected','selected');
                    }
                    select.append(opt);
                }
            }
        });
    }

    initButtons(){
        let table = window.datatable;
        new $.fn.dataTable.Buttons(table, {
            name: 'saved_queries_edit',
            buttons: [
                {
                    text:'<i class="fas fa-edit"></i>',
                    action:function(){
                        window.savedQueries.showSpinner();
                        $('.dtsb-logicContainer').css('visibility','hidden');
                        $('#'+window.savedQueries.name+'-saved-queries').modal("show");
                        $('#'+window.savedQueries.name+'-saved-queries').on('shown.bs.modal', function (e) {
                            $('.dtsb-logic').trigger('click').trigger('click');
                            $('.dtsb-logicContainer').css('visibility','visible');
                            window.savedQueries.removeSpinner();
                        });
                    },
                    className:"edit"
                },  
                {
                    text:'<i class="fas fa-trash"></i>',
                    action:function(){
                        window.savedQueries.deleteCurrentQuery();
                    },
                    className:"edit"
                }
            ]
        });

        new $.fn.dataTable.Buttons(table, {
            name: 'saved_queries_add',
            buttons: [
                {
                    text:'<i class="fas fa-plus-circle"></i>',
                    action:function(){
                        $('#'+window.savedQueries.name+'-saved-queries').modal("show");
                    },
                    className:"add"
                }
            ]
        });
    }

    addControl(){
        let table = window.datatable;
        this.select.insertBefore('.dataTables_filter');
        table
            .buttons('saved_queries_edit', null)
            .containers()
            .addClass('groupright')
            .insertBefore('.dataTables_filter');
        table
            .buttons('saved_queries_add', null)
            .containers()
            .addClass('groupright')
            .insertBefore('.dataTables_filter');
            $('.edit').hide();
    }
}