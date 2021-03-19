 // Tinymce(read only) implementation
 tinymce.init({
    selector: 'textarea#description',
    plugins: 'autoresize',
    readonly: 1,
    menubar: false,
    toolbar: false,
    directionality : "rtl" 
});