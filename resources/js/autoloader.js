import {Datalist} from './datalist';
import {FieldEdit} from './fieldedit';

export class Autoloader {
    constructor() {
        this.lazyLoad()
    }

    lazyLoad() {
        let page = $('body').attr('content');

        switch (page) {
            case 'list':
                    new Datalist();
                break;
            case 'fieldEdit':
                    window.fieldEdit = new FieldEdit();
                break;
            default:
                // new Global
        }
    }
}