/**
 * Módulo Compartilhado - Paginação
 */
(function() {
    'use strict';

    function init() {
        setupPerPageChange();
    }

    function setupPerPageChange() {
        $(document).on('change', '#perPage', function() {
            const perPage = $(this).val();
            const url = new URL(window.location.href);
            url.searchParams.set('perPage', perPage);
            url.searchParams.delete('page');
            window.location.href = url.toString();
        });
    }

    $(document).ready(init);

})();