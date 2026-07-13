/**
 * Módulo de Produtos - Listagem
 */
(function() {
    'use strict';

    const CONFIG = {
        autocompleteUrl: window.autocompleteUrl || '',
        showUrl: window.showUrl || '',
        querySelector: '#query',
        perPageSelector: '#perPage',
    };

    function init() {
        setupAutocomplete();
        setupPerPageChange();
    }

    function setupAutocomplete() {
        const $input = $(CONFIG.querySelector);
        
        if ($input.length === 0 || !CONFIG.autocompleteUrl) {
            return;
        }

        $input.autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: CONFIG.autocompleteUrl,
                    dataType: 'json',
                    data: { term: request.term },
                    success: function(data) {
                        if (data.length < 1) {
                            data = [{
                                label: 'Nenhum produto encontrado',
                                value: -1
                            }];
                        }
                        response(data);
                    },
                    error: function() {
                        response([{
                            label: 'Erro na busca',
                            value: -1
                        }]);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                if (ui.item.value === -1) {
                    $(this).val('');
                    return false;
                }
                window.location.href = CONFIG.showUrl + '/' + ui.item.id;
                return false;
            }
        });
    }

    function setupPerPageChange() {
        $(document).on('change', CONFIG.perPageSelector, function() {
            const perPage = $(this).val();
            const url = new URL(window.location.href);
            url.searchParams.set('perPage', perPage);
            url.searchParams.delete('page');
            window.location.href = url.toString();
        });
    }

    $(document).ready(init);

})();