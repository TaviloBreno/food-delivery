/**
 * Produtos - JavaScript Functions
 */

$(document).ready(function() {
    // 🔥 MÁSCARA DE PREÇO
    function initMascaraPreco() {
        if ($('#preco').length) {
            $('#preco, #preco_promocional').mask('000.000.000.000.000,00', {
                reverse: true
            });
        }
    }

    // 🔥 UPLOAD DE IMAGEM
    function initUploadImagem() {
        const uploadArea = document.getElementById('uploadArea');
        const inputFile = document.getElementById('imagem');
        const previewContainer = document.getElementById('preview-container');
        const preview = document.getElementById('preview');

        if (!uploadArea) return;

        uploadArea.addEventListener('click', function() {
            inputFile.click();
        });

        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#4d83ff';
            this.style.background = '#f8f9fa';
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#dee2e6';
            this.style.background = 'transparent';
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#dee2e6';
            this.style.background = 'transparent';

            if (e.dataTransfer.files.length > 0) {
                inputFile.files = e.dataTransfer.files;
                previewFile(e.dataTransfer.files[0]);
            }
        });

        if (inputFile) {
            inputFile.addEventListener('change', function() {
                if (this.files.length > 0) {
                    previewFile(this.files[0]);
                }
            });
        }

        function previewFile(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
                uploadArea.querySelector('p').textContent = 'Arquivo selecionado: ' + file.name;
            };
            reader.readAsDataURL(file);
        }
    }

    // 🔥 PAGINAÇÃO
    function initPaginacao() {
        $('#perPage').on('change', function() {
            var perPage = $(this).val();
            var url = new URL(window.location.href);
            url.searchParams.set('perPage', perPage);
            url.searchParams.delete('page');
            window.location.href = url.toString();
        });
    }

    // 🔥 AUTOCOMPLETE
    function initAutocomplete() {
        if ($('#query').length) {
            $("#query").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: window.autocompleteUrl,
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            if (data.length < 1) {
                                data = [{
                                    label: 'Produto não encontrado',
                                    value: -1
                                }];
                            }
                            response(data);
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    if (ui.item.value == -1) {
                        $(this).val("");
                        return false;
                    } else {
                        window.location.href = window.showUrl + '/' + ui.item.id;
                    }
                }
            });
        }
    }

    // 🔥 INICIALIZAR
    initMascaraPreco();
    initUploadImagem();
    initPaginacao();
    initAutocomplete();
});