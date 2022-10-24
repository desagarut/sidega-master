'use strict';
$(document).ready(function() {
    setTimeout(function() {
        floatchart()
    }, 100);
});

function floatchart() {
    // [ tot-lead ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 150,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#4680ff"],
            fill: {
                type: 'solid',
                opacity: 0.3,
            },
            stroke: {
                curve: 'straight',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [25, 66, 41, 89, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89]
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
                            return 'Total Leads :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#tot-lead"), options);
        chart.render();
    });
    // [ tot-lead ] end
    // [ tot-vendor ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 150,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#9ccc65"],
            fill: {
                type: 'solid',
                opacity: 0.3,
            },
            stroke: {
                curve: 'straight',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 25, 66, 41, 50]
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
                            return 'Total Vendors :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#tot-vendor"), options);
        chart.render();
    });
    // [ tot-vendor ] end
    // [ invoice-gen ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 150,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#ff5252"],
            fill: {
                type: 'solid',
                opacity: 0.3,
            },
            stroke: {
                curve: 'straight',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [25, 66, 41, 89, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89]
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
                            return 'Invoice Generate :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#invoice-gen"), options);
        chart.render();
    });
    // [ invoice-gen ] end
    // [ monthlyprofit-3 ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 30,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#ff5252"],
            fill: {
                type: 'solid',
                opacity: 0.3,
            },
            markers: {
                size: 2,
                opacity: 0.9,
                colors: "#ff5252",
                strokeColor: "#ff5252",
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
                data: [9, 66, 41, 89, 63, 25, 44, 12, 36, 20, 54, 25, 66, 41, 89, 63, 54, 25, 66, 41, 9]
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
                            return 'Unique Visitors :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#monthlyprofit-3"), options);
        chart.render();
    });
    // [ monthlyprofit-3 ] end
    // [ client-map-1 ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 90,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#4680ff"],
            fill: {
                type: 'solid',
                opacity: 0.4,
            },
            stroke: {
                curve: 'smooth',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [20, 10, 18, 12, 25, 10, 20]
            }],
            yaxis: {
                min: 0,
                max: 30,
            },
            tooltip: {
                theme: 'dark',
                fixed: {
                    enabled: false
                },
                x: {
                    show: false,
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Activity'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#client-map-1"), options);
        chart.render();
    });
    // [ client-map-1 ] end
    // [ client-map-3 ] start
    $(function() {
        var options = {
            chart: {
                type: 'bar',
                height: 90,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#9ccc65"],
            plotOptions: {
                bar: {
                    columnWidth: '60%'
                }
            },
            series: [{
                data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 63]
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
                            return 'Activity :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#client-map-3"), options);
        chart.render();
    });
    // [ client-map-3 ] end
}
