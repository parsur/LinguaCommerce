// ClassicEditor
//   .create(document.querySelector('#description'), {
//     // Font family
//     fontFamily: {
//       options: [
//         'Arial, Helvetica, sans-serif',
//         'Courier New, Courier, monospace',
//         'Georgia, serif',
//         'Lucida Sans Unicode, Lucida Grande, sans-serif',
//         'Tahoma, Geneva, sans-serif',
//         'Times New Roman, Times, serif',
//         'Trebuchet MS, Helvetica, sans-serif',
//         'Verdana, Geneva, sans-serif'
//       ]
//     },
//     // Toolbar
//     toolbar: {
//       items: [
//         'heading',
//         'alignment',
//         '|',
//         'bold',
//         'italic',
//         'link',
//         'bulletedList',
//         'numberedList',
//         '|',
//         'outdent',
//         'indent',
//         '|',
//         'imageUpload',
//         'imageInsert',
//         'blockQuote',
//         'insertTable',
//         'mediaEmbed',
//         'htmlEmbed',
//         'exportPdf',
//         'redo',
//         'undo',
//         '-',
//         'highlight',
//         'fontColor',
//         'fontSize',
//         'fontFamily',
//         'fontBackgroundColor',
//         '-',
//       ],
//       shouldNotGroupWhenFull: true,
//     },
//     // Media embed aparat
//     mediaEmbed: {
//       extraProviders: [
//         {
//           // Aparat
//           name: 'aparat',
//           url: "<style>.h_iframe-aparat_embed_frame",

//           html: match => {
//             return (
//               `${match.input}`
//             );
//           }
//         },
//       ]
//     },
//     // Remove plugin
//     // removePlugins: ['MediaEmbedToolbar'],
//     language: 'fa',
//     // Image
//     image: {
//       toolbar: [
//         'imageTextAlternative',
//         'imageStyle:full',
//         'imageStyle:side',
//         'linkImage'
//       ]
//     },
//     // Table
//     table: {
//       contentToolbar: [
//         'tableColumn',
//         'tableRow',
//         'mergeTableCells'
//       ]
//     },
//     licenseKey: '',
//   })
//   .then(editor => {
//     window.editor = editor
//   })
//   .catch(error => {
//     console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
//     console.error(error);
//   });


ClassicEditor
    .create(document.querySelector('#description'), {

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
                'alignment',
                '|',
                'imageUpload',
                'blockQuote',
                'insertTable',
                'imageInsert',
                'mediaEmbed',
                'pageBreak',
                'horizontalLine',
                'undo',
                'redo',
                '-',
                'fontBackgroundColor',
                'fontColor',
                'fontSize',
                'fontFamily',
                'highlight',
                '-',
                'htmlEmbed',
                'codeBlock',
                'restrictedEditingException'
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
        // Media embed aparat
        mediaEmbed: {
            extraProviders: [
                {
                    // Aparat
                    name: 'aparat',
                    url: "<style>.h_iframe-aparat_embed_frame",

                    html: match => {
                        return (
                            `${match.input}`
                        );
                    }
                },
            ]
        },
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells',
                'tableCellProperties',
                'tableProperties'
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