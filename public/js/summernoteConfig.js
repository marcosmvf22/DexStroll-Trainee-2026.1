$(document).ready(function() {
            $('#summernoteCriar').summernote({
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

            $('.summernoteEditar').summernote({
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
                    ['height', ['height']]
                    ['insert', ['picture']],
                ]
            });

            $('.summernoteVisualizar').summernote({
                height: 200,
                toolbar: []
            });
            $('.summernoteVisualizar').summernote('disable');
        });