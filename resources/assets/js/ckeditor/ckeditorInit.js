ClassicEditor
  .create(document.querySelector('#description'), {
    fontFamily: {
      options: [
        'Arial, Helvetica, sans-serif',
        'Courier New, Courier, monospace',
        'Georgia, serif',
        'Lucida Sans Unicode, Lucida Grande, sans-serif',
        'Tahoma, Geneva, sans-serif',
        'Times New Roman, Times, serif',
        'Trebuchet MS, Helvetica, sans-serif',
        'Verdana, Geneva, sans-serif'
      ]
    },
    toolbar: {
      items: [
        'heading',
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
        'blockQuote',
        'insertTable',
        'htmlEmbed',
        'mediaEmbed',
        'imageUpload',
        'imageInsert',
        'exportPdf',
        'CKFinder',
        'fontSize',
        'fontColor',
        'fontBackgroundColor',
        'fontFamily',
        'pageBreak',
        'horizontalLine',
        'codeBlock',
        'alignment',
        'undo',
        'redo'
      ]
    },
    mediaEmbed: {
      providers: 
      [
        {
          name: 'aparat',
          url: /^aparat\.com/,
          html: match => {
            const url = getAttribute( 'url' );

            return (
              '<div style="position: relative; padding-bottom: 100%; height: 0; ">' +
                `<iframe src="${ url }" ` +
                  'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" ' +
                  'frameborder="0" width="480" height="270" allowfullscreen allow="autoplay">' +
                '</iframe>' +
              '</div>'
            );
          }
        },
      ],
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
    editor.execute( 'fontFamily', 'shabnam' );
    /**
		 * The media registry managing the media providers in the editor.
		 *
		 * @member {module:media-embed/mediaregistry~MediaRegistry} #registry
		 */
		this.registry = new MediaRegistry( editor.locale, editor.config.get( 'mediaEmbed' ) );
  })
  .catch(error => {
    console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
    console.error(error);
  });

  