$(document).ready(function() {
    var tempoExibicao = 20000;

    $('.alert').each(function() {
        var $alert = $(this);

        $alert.addClass('fade show');

        var progressBar = $('<div class="progress" style="height: 3px; margin-top: 8px;">' +
            '<div class="progress-bar bg-' + getAlertColor($alert) + '" ' +
            'role="progressbar" style="width: 100%; transition: width 20s linear;"></div>' +
            '</div>');
        $alert.append(progressBar);

        setTimeout(function() {
            progressBar.find('.progress-bar').css('width', '0%');
        }, 100);

        var timer = setTimeout(function() {
            $alert.alert('close');
        }, tempoExibicao);

        $alert.on('close.bs.alert', function() {
            clearTimeout(timer);
        });
    });

    function getAlertColor($alert) {
        if ($alert.hasClass('alert-success')) return 'success';
        if ($alert.hasClass('alert-danger')) return 'danger';
        if ($alert.hasClass('alert-warning')) return 'warning';
        if ($alert.hasClass('alert-info')) return 'info';
        return 'primary';
    }
});