// Ckeditor(read only) implementation
ClassicEditor
.create( document.querySelector('#description'), {
    language: 'fa',
})
.then( editor => {
    window.editor = editor;
    editor.isReadOnly = true;
    editor.contentsLangDirection= 'rtl';
})
.catch( error => {
    console.error( error );
});