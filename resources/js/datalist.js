import { eq } from 'lodash';

require('datatables.net-bs4');
require('datatables.net-buttons-bs4');
require('datatables.net-buttons/js/buttons.colVis.js');
require('datatables.net-buttons/js/buttons.print.js');
require('datatables.net-buttons/js/buttons.html5.js' );
require('datatables.net-responsive' );

require('datatables.net-select' );

import jsZip from 'jszip';
import { MassEdit } from './massedit';
import { SavedQueries } from './savedqueries';
window.JSZip = jsZip;



export class Datalist {
    constructor(){       
        /*Pour chaque tableau concerné chaque tableau*/
        $('.datalist').each((index, el) => {
            if($(el).attr('saved_queries') == '1') {
                require('datatables.net-searchbuilder-bs4'); 
            }

            if($(el).attr('pdf_export') == '1' && window.pdfMake ==undefined) {
                window.pdfMake = require('pdfmake/build/pdfmake.js');
                var vfs = require('pdfmake/build/vfs_fonts.js');
                window.pdfMake.vfs = vfs.pdfMake.vfs;
            }

            /* Affichage du spinner */
            this.showLoading();
            this.name=$(el).attr('name');
            /* Récupération des noms et labels des colonnes*/
            let cols = [];
            $(el).find('thead th[real-column=1]').each((index,el)=>{
                console.log($(el).attr('column-name'));
                if($(el).attr('column-name').indexOf('amount')>0) {
                    cols[index]=
                        {
                            name: $(el).attr('column-name'),
                            title: $(el).text(),
                            render: $.fn.dataTable.render.number(' ', ',', 2, '', ' €' )
                        };
                } else {
                    cols[index]=
                        {
                            name: $(el).attr('column-name'),
                            title: $(el).text()
                        };
                }
                
            });
            //Création des filtres par colonnes
            if($(el).attr('column_filtering')=='1') {
                this.addColFiltering(el);
            }

            //Colonnes visibles
            let visibleCols = [];
            if(window.mobileCheck()){
                visibleCols = "_all";
            } else {
                let colIndex=0;
                let max = $(el).find('tr.header-first th').length<6?$(el).find('tr.header-first th').length:6;
                for(colIndex=0;colIndex<max-1;colIndex++){
                    visibleCols.push(colIndex+1);
                }
            }

            if($(el).attr('advanced_filters') == '1') {
                require('datatables.net-searchpanes-dt'); 
            }

            //Instanciation de l'objet Datatables
            window.datatable = $(el).DataTable(
                {
                    ajax: 
                    {
                        url: $(el).attr('datasource'), 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "post",
                        type:'POST'
                    },
                    columns:
                        cols,
                    dom: 
                        '<"float-left mb-2"B><"search-builder-modal modal"Q><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4 text-center"i><"col-sm-4"p>>',
                    language: 
                        this.getLanguage(),
                    buttons:
                    {
                        dom: 
                        {
                            button: 
                            {
                                className: 'btn'
                            }
                        },
                        buttons: 
                            this.getButtons(el)
                    },
                    columnDefs: 
                    [
                        { 
                            targets: 
                                visibleCols, 
                            visible: 
                                true,
                        },
                        { 
                            targets: 
                                '_all', 
                            visible: 
                                false,
                            /*searchPanes:
                            {
                                threshold: 0.5
                            }*/
                        },
                        {
                            className: 'control',
                            orderable: false,
                            render: function(){
                                return ''
                            },
                            targets:   0
                        }
                    ],
                    retrieve:
                        true,
                    bSortCellsTop: 
                        true,
                    responsive:
                    {
                        details: {
                            type: 'column',
                            target:0
                        }
                    },
                    /*searchPanes: {
                        cascadePanes: true,
                        viewTotal: true
                    },*/
                    deferRender: true,
                    processing: true,
                    paging:true,
                    stateSave:true,
                    scrollX:true,
                    initComplete:function(){
                        window.datalist.hideLoading();
                    }
                }
            );
            if(window.mobileCheck()){
                $(el).find('tbody').on('click', 'tr td:not(:first)', function(event) {
                    let table = window.datatable;
                    var row = table.row(this).data();
                    let base_url=$('meta[name="detail_url"]').attr("content");
                    window.location = base_url.replace('?',row[0]);
                });

                $(el).find('tr td:first').html('');
            } else {
                $(el).find('tbody').on('click','tr', function(event) {
                    let table = window.datatable;
                    var row = table.row(this).data();
                    let base_url=$('meta[name="detail_url"]').attr("content");
                    window.location = base_url.replace('?',row[0]);
                });
            }
            if($(el).attr('mass_edit') == '1') {
                window.massedit = new MassEdit($(el).attr('name'));
            }

            if($(el).attr('saved_queries') == '1') {
                window.savedQueries = new SavedQueries($(el).attr('name'));   
            }
        });
        $('.datalist').show();
    }

    //Création des filtres par colonnes
    addColFiltering(el){
        //Boucle sur chaque th de la 2e ligne
        $('thead tr:eq(1) th').each( function (i) {

            //Ajout de l'élément input
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Filtrer par '+title+'" />' );
    
            //Ajout de l'évènement
            $( 'input', this ).on( 'keyup change', function () {
                //Récupération et actualisation de l'objet dataTable
                let table = window.datatable;
                table
                    .column(i)
                    .search( this.value )
                    .draw(true);
            } );
        } );
    }

    getLanguage(){
        return {
            "lengthMenu": "Afficher _MENU_ lignes par page",
            "zeroRecords": "Aucun résultat",
            "info": "Page _PAGE_ sur _PAGES_",
            "infoEmpty": "Aucun résultat",
            "infoFiltered": "(filtré sur _MAX_ lignes au total)",
            "paginate": {
                "first":      "Début",
                "last":       "Fin",
                "next":       window.mobileCheck()?">":"Suivant",
                "previous":   window.mobileCheck()?"<":"Précédent"
            },
            "loadingRecords": '&nbsp;',
            "processing":     '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
            "search":         "Recherche : ",
            "decimal":        ",",
            "emptyTable":     "Aucun résultat",
            "infoPostFix":    "",
            "thousands":      " ",
            "aria": {
                "sortAscending":  ": cliquez pour trier dans l'ordre croissant",
                "sortDescending": ": cliquez pour trier dans l'ordre décroissant"
            },
            buttons: {
                copyTitle: 'Ajouté au presse-papiers',
                copyKeys: 'Appuyez sur <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> pour copier les données du tableau à votre presse-papiers. <br><br>Pour annuler, cliquez sur ce message ou appuyez sur Echap.',
                copySuccess: {
                    _: '%d lignes copiées',
                    1: '1 ligne copiée'
                }
            },
            searchPanes: {
                title: {
                    _: 'Filtres actifs - %d',
                    0: 'Aucun filtre actif',
                    1: 'Un filtre actif'
                },
                count: '{total} résultats',
                countFiltered: '{shown} ({total})',
                clearMessage:'Réinitialiser',
                collapse: {0: 'Filtres avancés', _: 'Filtres avancés (%d)'}
            },
            searchBuilder: {
                conditions : {
                    string: {
                        contains: 'Contient',
                        empty: 'Vide',
                        endsWith: 'Se termine par',
                        equals: '=',
                        not: "N'est pas",
                        notEmpty: 'Non vide',
                        startsWith: 'Commence par',
                    },
                    number: {
                        between: 'Entre',
                        empty: 'Vide',
                        equals: '=',
                        gt: '>',
                        gte: '>=',
                        lt: '<',
                        lte: '<=',
                        not: "N'est pas",
                        notBetween: 'Pas entre',
                        notEmpty: 'Non vide',
                    },
                },
                title: {
                    _: ' ',
                    0: ' ',
                    1: ' '
                },
                add: "Ajouter une condition",
                clearAll: "Réinitialiser",
                data:'Colonne',
                condition:'Opérateur',
                value:'Valeur',
                logicAnd:'ET',
                logicOr:'OU',
            },
            
        }
    }

    getButtons(el){
        let buttons = [];
        let exportBtn = [];
        buttons.push(
            {
                "text": 'Ajouter',
                "action": function ( e, dt, node, config ) {
                    window.location = $(el).attr('createUrl');
                },
                "className":"btn-primary"
            }
        );
        if(!window.mobileCheck()) {
            if(window.mobileCheck()){
                buttons.push(
                    {
                        extend: 'colvis',
                        columns: ':gt(0)',
                        text:'Afficher/masquer des colonnes',
                        "className":"btn-dark"
                    }
                );
            } else {
                buttons.push(
                    {
                        extend: 'colvis',
                        columns: ':gt(0)',
                        text:'Afficher/masquer des colonnes',
                        collectionLayout: 'two-column',
                        "className":"btn-dark"
                    }
                );
            }
            
            if($(el).attr('excel_export') == '1') {
                exportBtn.push(
                    {
                        extend:'excelHtml5',
                        exportOptions: {
                            columns: ':visible',
                            modifier: {
                                selected: null,
                            },
                        },
                        "className":"btn-success"
                    }
                );
            }
            if($(el).attr('pdf_export') == '1') {
                exportBtn.push(
                    {
                        extend:'pdfHtml5',
                        orientation:"landscape",
                        exportOptions: {
                            columns: ':visible',
                            modifier: {
                                selected: null,
                            },
                        },
                        "className":"btn-danger"
                    }
                );
            }
            exportBtn.push(
                {
                    extend:'csv',
                    className:"btn-dark"
                }
            );
            exportBtn.push(
                {
                    extend:'copy',
                    text:"Copier",
                    "className":"btn-dark"
                }
            );
            exportBtn.push(
                {
                    extend:'print',
                    text:'Imprimer',
                    "className":"btn-dark"
                }
            );
            buttons.push(
                {
                    extend : 'collection',
                    text : 'Exporter',
                    buttons : exportBtn,
                    "className":"btn-dark"
                }
            );
            if($(el).attr('advanced_filters') == '1') {
                buttons.push(
                    {
                        extend:"searchPanes",
                        "className":"btn-dark",
                        config: {
                            threshold:0.8
                        }

                    }
                );
            }
            if($(el).attr('mass_edit') == '1') {
                buttons.push(
                    {
                        "text": 'Editer en masse',
                        "action": function ( e, dt, node, config ) {
                            $('#'+$(el).attr('name')+'-mass-edit').modal();
                        },
                        "className":"btn-primary"
                    }
                );
            }
            
        }
        return buttons;
    }
    showLoading(name){
        $("#overlay").show();
        $('.datalist-wrapper').addClass('hidden');
        $('#loadingSpinner').show();
    }

    hideLoading(){
        $("#overlay").hide();
        $('.datalist-wrapper').removeClass('hidden');
        $('#loadingSpinner').hide();
    }
}