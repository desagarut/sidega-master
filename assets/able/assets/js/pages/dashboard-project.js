'use strict';
$(document).ready(function() {
    setTimeout(function() {
        floatchart()
    }, 100);
});

function floatchart() {
    // [ sec-ecommerce-chart-line ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#fff"],
            fill: {
                type: 'solid',
                opacity: 0,
            },
            markers: {
                size: 3,
                opacity: 0.9,
                colors: "#fff",
                strokeColor: "#fff",
                strokeWidth: 2,
                hover: {
                    size: 4,
                }
            },
            stroke: {
                curve: 'straight',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 25, 66, 41, 89, 63, 54, 25, 66, 41, 89, 63]
            }],
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Referral :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#sec-ecommerce-chart-line"), options);
        chart.render();
    });
    // [ sec-ecommerce-chart-line ] end
    // [ sec-ecommerce-chart-bar ] start
    $(function() {
        var options = {
            chart: {
                type: 'bar',
                height: 80,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#548b2e"],
            plotOptions: {
                bar: {
                    columnWidth: '60%'
                }
            },
            series: [{
                data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 63, 54, 25, 66, 41, 89]
            }],
            xaxis: {
                crosshairs: {
                    width: 1
                },
            },
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Affiliate :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#sec-ecommerce-chart-bar"), options);
        chart.render();
    });
    // [ sec-ecommerce-chart-bar ] end
    // [ sec-ecommerce-chart-line1 ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#fff"],
            fill: {
                type: 'solid',
                opacity: 0,
            },
            markers: {
                size: 3,
                opacity: 0.9,
                colors: "#fff",
                strokeColor: "#fff",
                strokeWidth: 2,
                hover: {
                    size: 4,
                }
            },
            stroke: {
                curve: 'straight',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 25, 66, 41, 89, 63, 54, 25, 66, 41, 89, 63]
            }],
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Referral :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#sec-ecommerce-chart-line1"), options);
        chart.render();
    });
    // [ sec-ecommerce-chart-line1 ] end
    // [ sec-ecommerce-chart-bar1 ] start
    $(function() {
        var options = {
            chart: {
                type: 'bar',
                height: 80,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#0491a2"],
            plotOptions: {
                bar: {
                    columnWidth: '60%'
                }
            },
            series: [{
                data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 63, 54, 25, 66, 41, 89]
            }],
            xaxis: {
                crosshairs: {
                    width: 1
                },
            },
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Affiliate :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#sec-ecommerce-chart-bar1"), options);
        chart.render();
    });
    // [ sec-ecommerce-chart-bar1 ] end
}
