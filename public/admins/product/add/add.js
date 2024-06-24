$(function () {
    $('.tags_select_choose').select2({
        placeholder: "Product Tags",
        tags: true,
        tokenSeparators: [',']
    })

    $('.select2_init').select2({
        placeholder: "Category",
        allowClear: true
    })

    $('.select2_init_size').select2({
        placeholder: "Choose size",
    })

    $('#description').summernote({
        placeholder: 'Product contents',
        tabsize: 3,
        height: 150,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
})




