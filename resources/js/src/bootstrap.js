window._ = require('lodash');
try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js').default;
    require('admin-lte');
    require('bootstrap');
    require('datatables.net');

} catch (e) {}