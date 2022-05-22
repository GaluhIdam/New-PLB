window._ = require('lodash');
import Popper from 'popper.js/dist/umd/popper.js';
try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = Popper;
    require('bootstrap');
    require('admin-lte');
    require('datatables.net');

} catch (e) {}


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';