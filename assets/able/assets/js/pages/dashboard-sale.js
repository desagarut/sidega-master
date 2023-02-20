'use strict';
$(document).ready(function() {
    setTimeout(function() {
        floatchart()
    }, 700);
});

function floatchart() {
    // [ seo-anlytics1 ] start
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
            colors: ["#4680ff"],
            fill: {
                type: 'solid',
                opacity: 0,
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                }
            },
            markers: {
                size: 3,
                opacity: 0.9,
                colors: "#4680ff",
                strokeColor: "#4680ff",
                strokeWidth: 1,
                hover: {
                    size: 4,
                }
            },
            stroke: {
                curve: 'straight',
                width: 2,
            },
            series: [{
                name: 'series1',
                data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89]
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
                            return 'Site Analysis :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#seo-anlytics1"), options);
        chart.render();
    });
    // [ seo-anlytics1 ] end
    // [ seo-anlytics2 ] start
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
            colors: ["#9ccc65"],
            fill: {
                type: 'solid',
                opacity: 0,
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                }
            },
            markers: {
                size: 3,
                opacity: 0.9,
                colors: "#9ccc65",
                strokeColor: "#9ccc65",
                strokeWidth: 1,
                hover: {
                    size: 4,
                }
            },
            stroke: {
                curve: 'straight',
                width: 2,
            },
            series: [{
                name: 'series1',
                data: [12, 25, 36, 9, 54, 25, 66, 66, 41, 89, 63, 25, 44, 89, 41]
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
                            return 'Total Sales :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#seo-anlytics2"), options);
        chart.render();
    });
    // [ seo-anlytics2 ] end
    // [ seo-anlytics3 ] start
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
            colors: ["#ff5252"],
            fill: {
                type: 'solid',
                opacity: 0,
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                }
            },
            markers: {
                size: 3,
                opacity: 0.9,
                colors: "#ff5252",
                strokeColor: "#ff5252",
                strokeWidth: 1,
                hover: {
                    size: 4,
                }
            },
            stroke: {
                curve: 'straight',
                width: 2,
            },
            series: [{
                name: 'series1',
                data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89]
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
                            return 'Total Visits :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#seo-anlytics3"), options);
        chart.render();
    });
    // [ seo-anlytics3 ] end
    // [ seo-anlytics4 ] start
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
            colors: ["#ffba57"],
            fill: {
                type: 'solid',
                opacity: 0,
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                }
            },
            markers: {
                size: 3,
                opacity: 0.9,
                colors: "#ffba57",
                strokeColor: "#ffba57",
                strokeWidth: 1,
                hover: {
                    size: 4,
                }
            },
            stroke: {
                curve: 'straight',
                width: 2,
            },
            series: [{
                name: 'series1',
                data: [12, 25, 36, 9, 54, 25, 66, 66, 41, 89, 63, 25, 44, 89, 41]
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
                            return 'Total Usage :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#seo-anlytics4"), options);
        chart.render();
    });
    // [ seo-anlytics4 ] end
    // [ sec-ecommerce-chart-line ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 40,
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
                height: 75,
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
    // [ monthlyprofit-1 ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 70,
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
            markers: {
                size: 2,
                opacity: 0.9,
                colors: "#4680ff",
                strokeColor: "#4680ff",
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
                            return 'Monthly Profit :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#monthlyprofit-1"), options);
        chart.render();
    });
    // [ monthlyprofit-1 ] end
    // [ monthlyprofit-2 ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 70,
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
            markers: {
                size: 2,
                opacity: 0.9,
                colors: "#9ccc65",
                strokeColor: "#9ccc65",
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
                data: [9, 66, 41, 36, 20, 54, 25, 66, 41, 89, 63, 89, 63, 25, 44, 12, 54, 25, 66, 41, 9]
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
                            return 'Total Sales :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#monthlyprofit-2"), options);
        chart.render();
    });
    // [ monthlyprofit-2 ] end
}
