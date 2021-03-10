tinymce.init({
    selector: 'textarea#description',
    height: 700,
    plugins: [
        'autolink link image lists charmap preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'table emoticons template paste directionality'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | link image | preview media fullpage | ' +
        'forecolor backcolor emoticons | ltr rtl',
    menu: {
        favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
    },
    menubar: 'favs file edit view insert format tools table help',
    content_style:"@import url('/fonts/Shabnam-Bold.ttf')",
  
});