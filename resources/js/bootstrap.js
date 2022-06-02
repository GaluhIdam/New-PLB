window._ = require('lodash');
try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js').default;
    require('admin-lte');
    require('bootstrap');
    require('datatables.net');

} catch (e) {}


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';