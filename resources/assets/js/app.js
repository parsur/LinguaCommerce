// bootstrap
require('./bootstrap');
// Jquery
window.$ = window.jQuery = require('jquery');

// Admin
require('./admin');

// DataTables
window.datatables = require('datatables.net-bs4');
window.dt = require('datatables.net/js/jquery.dataTables');
require('datatables.net-responsive');
require( 'datatables.net-buttons-bs4');
require( 'datatables.net-buttons/js/buttons.html5.js' );
require( 'datatables.net-buttons/js/buttons.print.js' );
require( 'datatables.net-buttons/js/buttons.colVis.js' );

// Select 2
require('select2/dist/js/select2');


