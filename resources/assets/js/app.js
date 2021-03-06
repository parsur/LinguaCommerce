// Axios
require('./bootstrap');

// Bootstrap
require('./admin');

// DataTables
window.datatables = require('datatables.net-bs4');
window.dt = require('datatables.net');
require('datatables.net-responsive');

// Select 2
require('select2/dist/js/select2');

// Tinymce
window.tinymce = require('tinymce/tinymce');
require('tinymce/icons/default');
require('tinymce/themes/silver');
require('tinymce/plugins/paste');
require('tinymce/plugins/link');
require('tinymce/plugins/autolink');
require('tinymce/plugins/link');
require('tinymce/plugins/image');
require('tinymce/plugins/lists');
require('tinymce/plugins/charmap');
require('tinymce/plugins/preview');
require('tinymce/plugins/hr');
require('tinymce/plugins/anchor');
require('tinymce/plugins/pagebreak');
require('tinymce/plugins/table');
require('tinymce/plugins/emoticons');
require('tinymce/plugins/template');
require('tinymce/plugins/paste');

// particles
require('particles.js')