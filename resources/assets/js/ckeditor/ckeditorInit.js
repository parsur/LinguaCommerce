ClassicEditor
  .create(document.querySelector('#description'), {
    toolbar: {
      items: [
        'heading',
        'alignment',
        '|',
        'bold',
        'italic',
        'link',
        'bulletedList',
        'numberedList',
        '|',
        'outdent',
        'indent',
        '|',
        'imageUpload',
        'blockQuote',
        'insertTable',
        'mediaEmbed',
        'htmlEmbed',
        'exportPdf',
        'imageInsert',
        'redo',
        'undo',
        '-',
        'highlight',
        'fontColor',
        'fontSize',
        'fontFamily',
        'fontBackgroundColor',
        '-',
        'previousPage',
        'nextPage',
        'pageNavigation'
      ],
      shouldNotGroupWhenFull: true
    },
    language: 'fa',
    image: {
      toolbar: [
        'imageTextAlternative',
        'imageStyle:full',
        'imageStyle:side',
        'linkImage'
      ]
    },
    table: {
      contentToolbar: [
        'tableColumn',
        'tableRow',
        'mergeTableCells'
      ]
    },
    licenseKey: '',


  })
  .then(editor => {
    window.editor = editor;
  })
  .catch(error => {
    console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
    console.error(error);
  });