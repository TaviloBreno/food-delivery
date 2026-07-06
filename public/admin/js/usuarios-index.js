$(function() {
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
                            label: 'Usuário não encontrado',
                            value: -1
                        }];
                    }
                    response(data);
                },
                error: function() {
                    response([{
                        label: 'Erro ao buscar usuários',
                        value: -1
                    }]);
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
});