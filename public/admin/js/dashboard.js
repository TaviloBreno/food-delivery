/**
 * Dashboard Module - Charts and DataTables
 * 
 * @description Gerencia gráficos e tabelas do dashboard
 * @author B-Web
 * @version 1.0.0
 */

(function($) {
    'use strict';

    // 🔥 CONFIGURAÇÕES
    const DEFAULTS = {
        chartColors: {
            returns: '#ff4747',
            sales: '#4d83ff',
            loss: '#ffc100',
            primary: '#4d83ff',
            primaryLight: 'rgba(77,131,255,0.77)',
            primaryLighter: 'rgba(77,131,255,0.43)',
        },
        chartFont: {
            color: '#6c7383',
            size: 16,
            style: 300,
        },
        gridLines: {
            color: '#e9e9e9',
            width: 1,
        }
    };

    // 🔥 UTILITÁRIOS
    const Utils = {
        getContext: function(selector) {
            const canvas = document.querySelector(selector);
            return canvas ? canvas.getContext('2d') : null;
        },

        getElement: function(selector) {
            return document.querySelector(selector);
        },

        generateLegend: function(chart, containerId) {
            const container = document.getElementById(containerId);
            if (container) {
                container.innerHTML = chart.generateLegend();
            }
        },

        formatCurrency: function(value) {
            return 'R$ ' + value.toFixed(2).replace('.', ',');
        }
    };

    // 🔥 MÓDULO: Gráfico de Depósitos
    const CashDepositsChart = {
        selector: '#cash-deposits-chart',
        legendContainer: 'cash-deposits-chart-legend',

        getData: function() {
            return {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8'],
                datasets: [
                    {
                        label: 'Returns',
                        data: [27, 35, 30, 40, 52, 48, 54, 46, 70],
                        borderColor: [DEFAULTS.chartColors.returns],
                        borderWidth: 2,
                        fill: false,
                        pointBackgroundColor: '#fff',
                    },
                    {
                        label: 'Sales',
                        data: [29, 40, 37, 48, 64, 58, 70, 57, 80],
                        borderColor: [DEFAULTS.chartColors.sales],
                        borderWidth: 2,
                        fill: false,
                        pointBackgroundColor: '#fff',
                    },
                    {
                        label: 'Loss',
                        data: [90, 62, 80, 63, 72, 62, 40, 50, 38],
                        borderColor: [DEFAULTS.chartColors.loss],
                        borderWidth: 2,
                        fill: false,
                        pointBackgroundColor: '#fff',
                    },
                ],
            };
        },

        getOptions: function() {
            return {
                scales: {
                    yAxes: [{
                        display: true,
                        gridLines: {
                            drawBorder: false,
                            lineWidth: DEFAULTS.gridLines.width,
                            color: DEFAULTS.gridLines.color,
                            zeroLineColor: DEFAULTS.gridLines.color,
                        },
                        ticks: {
                            min: 0,
                            max: 100,
                            stepSize: 20,
                            fontColor: DEFAULTS.chartFont.color,
                            fontSize: DEFAULTS.chartFont.size,
                            fontStyle: DEFAULTS.chartFont.style,
                            padding: 15,
                        }
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            drawBorder: false,
                            lineWidth: DEFAULTS.gridLines.width,
                            color: DEFAULTS.gridLines.color,
                        },
                        ticks: {
                            fontColor: DEFAULTS.chartFont.color,
                            fontSize: DEFAULTS.chartFont.size,
                            fontStyle: DEFAULTS.chartFont.style,
                            padding: 15,
                        }
                    }],
                },
                legend: {
                    display: false,
                },
                elements: {
                    point: { radius: 3 },
                    line: { tension: 0 },
                },
                layout: {
                    padding: {
                        top: 0,
                        bottom: -10,
                        left: -10,
                        right: 0,
                    }
                }
            };
        },

        init: function() {
            const canvas = Utils.getContext(this.selector);
            if (!canvas) return;

            const chart = new Chart(canvas, {
                type: 'line',
                data: this.getData(),
                options: this.getOptions(),
            });

            Utils.generateLegend(chart, this.legendContainer);
        }
    };

    // 🔥 MÓDULO: Gráfico de Vendas Totais
    const TotalSalesChart = {
        selector: '#total-sales-chart',
        legendContainer: 'total-sales-chart-legend',

        getData: function() {
            return {
                labels: [
                    '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
                    '10', '11', '12', '13', '14', '15', '16', '17', '18', '19',
                    '20', '21', '22', '23', '24', '25', '26', '27', '28', '29',
                    '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40'
                ],
                datasets: [
                    {
                        label: '2019',
                        data: [42, 42, 30, 30, 18, 22, 16, 21, 22, 22, 22, 20, 24, 20, 18, 22, 30, 34, 32, 33, 33, 24, 32, 34, 30, 34, 19, 34, 18, 10, 22, 24, 20, 22, 20, 21, 10, 10, 5, 9, 14],
                        borderColor: ['transparent'],
                        borderWidth: 2,
                        fill: true,
                        backgroundColor: DEFAULTS.chartColors.primaryLight,
                    },
                    {
                        label: '2018',
                        data: [35, 28, 32, 42, 44, 46, 42, 50, 48, 30, 35, 48, 42, 40, 54, 58, 56, 55, 59, 58, 57, 60, 66, 54, 38, 40, 42, 44, 42, 43, 42, 38, 43, 41, 43, 50, 58, 58, 68, 72, 72],
                        borderColor: ['transparent'],
                        borderWidth: 2,
                        fill: true,
                        backgroundColor: DEFAULTS.chartColors.sales,
                    },
                    {
                        label: 'Past years',
                        data: [98, 88, 92, 90, 98, 98, 90, 92, 78, 88, 84, 76, 80, 72, 74, 74, 88, 80, 72, 62, 62, 72, 72, 78, 78, 72, 75, 78, 68, 68, 60, 68, 70, 75, 70, 80, 82, 78, 78, 84, 82],
                        borderColor: ['transparent'],
                        borderWidth: 2,
                        fill: true,
                        backgroundColor: DEFAULTS.chartColors.primaryLighter,
                    },
                ],
            };
        },

        getOptions: function() {
            return {
                scales: {
                    yAxes: [{
                        display: false,
                        gridLines: {
                            drawBorder: false,
                            lineWidth: DEFAULTS.gridLines.width,
                            color: DEFAULTS.gridLines.color,
                            zeroLineColor: DEFAULTS.gridLines.color,
                        },
                        ticks: {
                            display: true,
                            min: 0,
                            max: 100,
                            stepSize: 10,
                            fontColor: DEFAULTS.chartFont.color,
                            fontSize: DEFAULTS.chartFont.size,
                            fontStyle: DEFAULTS.chartFont.style,
                            padding: 15,
                        }
                    }],
                    xAxes: [{
                        display: false,
                        gridLines: {
                            drawBorder: false,
                            lineWidth: DEFAULTS.gridLines.width,
                            color: DEFAULTS.gridLines.color,
                        },
                        ticks: {
                            display: true,
                            fontColor: DEFAULTS.chartFont.color,
                            fontSize: DEFAULTS.chartFont.size,
                            fontStyle: DEFAULTS.chartFont.style,
                            padding: 15,
                        }
                    }],
                },
                legend: {
                    display: false,
                },
                elements: {
                    point: { radius: 0 },
                    line: { tension: 0 },
                },
                layout: {
                    padding: {
                        top: 0,
                        bottom: 0,
                        left: 0,
                        right: 0,
                    }
                }
            };
        },

        init: function() {
            const canvas = Utils.getContext(this.selector);
            if (!canvas) return;

            const chart = new Chart(canvas, {
                type: 'line',
                data: this.getData(),
                options: this.getOptions(),
            });

            Utils.generateLegend(chart, this.legendContainer);
        }
    };

    // 🔥 MÓDULO: DataTable
    const RecentPurchasesTable = {
        selector: '#recent-purchases-listing',

        init: function() {
            const table = document.querySelector(this.selector);
            if (!table) return;

            $(this.selector).DataTable({
                aLengthMenu: [
                    [5, 10, 15, -1],
                    [5, 10, 15, 'All']
                ],
                iDisplayLength: 10,
                language: {
                    search: '',
                    searchPlaceholder: 'Pesquisar...',
                },
                searching: false,
                paging: false,
                info: false,
                ordering: true,
                responsive: true,
            });
        }
    };

    // 🔥 INICIALIZAÇÃO
    function init() {
        CashDepositsChart.init();
        TotalSalesChart.init();
        RecentPurchasesTable.init();
    }

    // 🔥 Iniciar quando o DOM estiver pronto
    $(document).ready(init);

})(jQuery);