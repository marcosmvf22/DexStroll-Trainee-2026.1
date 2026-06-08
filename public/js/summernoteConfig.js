$(document).ready(function () {
    $('#summernoteCriar').summernote({
        dialogsInBody: true,
        height: 200,
        width: '100%',
        maxHeight: 500,
        minHeight: 150,
        callbacks: {
            onImageUpload: function (files) {
                uploadImagem(files[0]);
            }
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['picture']],
        ]
    });

    $('.summernoteEditar').summernote({
        dialogsInBody: true,
        height: 200,
        width: '100%',
        maxHeight: 500,
        minHeight: 150,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['picture']],
        ]
    });

    $('.summernoteVisualizar').summernote({
        dialogsInBody: true,
        height: 200,
        toolbar: []
    });
    $('.summernoteVisualizar').summernote('disable');
});


function uploadImagem(file) {
    let data = new FormData();
    data.append("imagem", file); 

    $.ajax({
        url: '/publicacoes/upload-imagem',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            console.log("URL retornada pelo PHP:", url);
            $('#summernoteCriar').summernote('insertImage', url, function ($image) {
                $image.css('width', '100%'); 
            });
        },
        error: function(data) {
            console.error("Erro no Ajax:", data.responseText); 
            alert("Erro ao enviar a imagem.");
        }
    });
}