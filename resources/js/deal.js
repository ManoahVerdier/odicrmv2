require('jquery-ui/ui/widgets/progressbar');
import AutoNumeric from 'autonumeric';

export class Deal {
    constructor(){
        //Barre de phase/probabilité
        this.stepBar = $( "#step-bar" );
        this.stepBar.progressbar({
            value: 1
        });
        //Barre de valeur
        this.stepBarValue = this.stepBar.find( ".ui-progressbar-value" );
        this.stepBarValue.css({
            "background": '#17a2b8',
            "height": 'calc(100% + 2px)',
            "margin": '0px',
            "border": "0px"
          });
        //Label sur la barre
        this.stepBarLabel = this.stepBar.find(".progress-label" );
        $('.deal').on('click', function(){
            window.deal.load($(this).attr('deal_id'));
            $('#dealInfo').modal();
        })
        //Icone de phase
        this.stepIcon = $('#dealInfo #step-icon');

        //Réinitialisation de la barre à fermeture de la modal
        $('#dealInfo').on('hidden.bs.modal', function(){
            //Valeur
            window.deal.stepBar.progressbar('option', {
                value: 1
            });
            //Couleur
            window.deal.stepBarValue.css({
                "background": '#17a2b8'
            });
            //Icone
            window.deal.stepIcon.html('<i class="fa fa-4x fa-question-circle"></i>');
            $('.icon-circle').removeClass(["border-secondary", "border-success", "border-danger"]);
            $('#amount').next().removeClass(["text-secondary", "text-success", "text-danger"]) .addClass('text-info');
        });

        //Valeurs mises en avant
        this.amount = new AutoNumeric('#amount', {decimalPlaces:0, digitGroupSeparator:' '});
        this.estimDate = new Date();
        this.step = 0;
    }

    load(id){
        //Appel AJAX pour récupération Deal
        let url=$('meta[name="deal_get_url"]').attr('content').replace('?',id);
        $.ajax({
            type: 'GET',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                //Décodage
                data=JSON.parse(data);
                //Gestion des phases/proba
                window.deal.setStep(data);
                //Parcours et affichage des attributs du deal
                $.each(data, function(index, value){
                    //Cas particuliers : titre, proba, montant, dates, note
                    //Soit emplacement particulier, soit formattage particulier
                    if(index=="title"){
                        $('#dealInfoTitle').text(value);
                    } else if(index=="probability") {
                        $('#dealInfo [name="'+index+'"]').text(value + "%");
                    } else if(index.indexOf("amount")>=0){
                        $('#dealInfo [name="'+index+'"]').text(value);
                        if (AutoNumeric.getAutoNumericElement('#dealInfo [name="'+index+'"]') === null) {
                            new AutoNumeric('#dealInfo [name="'+index+'"]', {decimalPlaces:0, digitGroupSeparator:' ', currencySymbol:' €', currencySymbolPlacement:'s'});
                        }
                    } else if(index.indexOf("date")>=0){
                        $('#dealInfo [name="'+index+'"]').text(convertDate(value));
                    } else if(index=='more'){
                        $('#dealInfo #more').text(value);
                    } else{
                        $('#dealInfo [name="'+index+'"]').text(value);
                    }
                });

                //Valeurs mises en avant
                window.deal.amount.set(data.amount);
                window.deal.estimDate = new Date(data.estim_date);
                $('#estim_date').text(convertDate(window.deal.estimDate));

                //Animation montant
                $('#dealInfo .counter').each(function () {
                    $(this).prop('Counter',0).animate({
                        Counter: window.deal.amount.get()
                    }, {
                        duration: 500,
                        easing: 'swing',
                        step: function (now) {
                            window.deal.amount.set(Math.ceil(now));
                        }
                    });
                });
            }
        });
    }

    setStep(data){
        let percent;

        //Pour les phases >= 6, il faut afficher la barre complète
        if(data.step.id<6){
            percent = data.probability;
        } else {
            percent = 100;
        }

        //Gestion de l'icone de phase
        this.stepIcon.html('<i class="fa fa-4x '+data.step.icon+'"></i>');

        //Animation barre de phase/proba
        this.stepBarValue.animate(
            {
                width: percent+"%"
            }, 
            {queue: false}
        );

        //Affichage rayures barre de phase/proba
        this.stepBar.progressbar('option', {
            value: false
        });

        //Couleurs : rouge pour perte, gris pour variante, vert pour gagné
        if(data.step.id==6){
            this.stepBarValue.css('background-color', '#dc3545');
            $('.icon-circle').addClass('border-danger');
            $('#amount').next().removeClass('text-info').addClass('text-danger');
        }
        if(data.step.id==7){
            this.stepBarValue.css('background-color', '#3CC275');
            $('.icon-circle').addClass('border-success');
            $('#amount').next().removeClass('text-info').addClass('text-success');
        }
        if(data.step.id==8){
            this.stepBarValue.css('background-color', '#cecece');
            $('.icon-circle').addClass('border-secondary');
            $('#amount').next().removeClass('text-info').addClass('text-secondary');
        }

        //Couleur du label fonction du remplissage de la barre
        if(data.probability>50) {
            this.stepBarLabel.css('color','white');
        }
        else {
            this.stepBarLabel.css('color','#212529');
        }

        //Mise à jour du label
        this.stepBarLabel.text("Probabilité : "+data.probability+"%");

        //Mise à jour nom de la phase
        $('#dealInfo #step-text').text(data.step.name);
     
        //Stockage phase
        this.step = data.step.id;
    }
    
}

function convertDate(inputFormat) {
    function pad(s) { return (s < 10) ? '0' + s : s; }
    var d = new Date(inputFormat)
    return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/')
}