import {Deal} from './deal';
export class Client {
    constructor(){
        if($('.deal').length>0) {
            window.deal=new Deal();
        }
    }
    
}