import {Deal} from './deal';
export class Client {
    constructor(){
        if($('.deal').length>0) {
            window.deal=new Deal();
        }

        if($('meta[name="initial_deal"]').length>0) {
            let id=$('meta[name="initial_deal"]').attr('content');
            let deal=$('.deal[deal_id='+id+']');
            if(deal.length>0) {
                $('.deal[deal_id='+id+']').trigger('click');
            }
        }
    }
    
}