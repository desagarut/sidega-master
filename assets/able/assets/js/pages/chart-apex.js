'use strict';
$(document).ready(function() {
    setTimeout(function() {
        $(function() {
            var options = {
                chart: {
                    height: 300,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false,
                    width: 2,
                },
                stroke: {
                    curve: 'straight',
                },
                colors: ["#4680ff"],
                series: [{
                    name: "Desktops",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                }],
                title: {
                    text: 'Product Trends by Month',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f6ff', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#line-chart-1"),
                options
            );
            chart.render();
        });
        $(function() {
            var lastDate = 0;
            var data = []

            function getDayWiseTimeSeries(baseval, count, yrange) {
                var i = 0;
                while (i < count) {
                    var x = baseval;
                    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

                    data.push({
                        x,
                        y
                    });
                    lastDate = baseval
                    baseval += 86400000;
                    i++;
                }
            }

            getDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 10, {
                min: 10,
                max: 90
            })

            function getNewSeries(baseval, yrange) {
                var newDate = baseval + 86400000;
                lastDate = newDate
                data.push({
                    x: newDate,
                    y: Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min
                })
            }

            function resetData() {
                data = data.slice(data.length - 10, data.length);
            }

            var options = {
                chart: {
                    height: 300,
                    type: 'line',
                    animations: {
                        enabled: true,
                        easing: 'linear',
                        dynamicAnimation: {
                            speed: 2000
                        }
                    },
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                series: [{
                    data: data
                }],
                colors: ["#4680ff"],
                title: {
                    text: 'Dynamic Updating Chart',
                    align: 'left'
                },
                markers: {
                    size: 0
                },
                xaxis: {
                    type: 'datetime',
                    range: 777600000,
                },
                yaxis: {
                    max: 100
                },
                legend: {
                    show: false
                },
            }

            var chart = new ApexCharts(
                document.querySelector("#line-chart-2"),
                options
            );

            chart.render();

            var dataPointsLength = 10;

            window.setInterval(function() {
                getNewSeries(lastDate, {
                    min: 10,
                    max: 90
                })

                chart.updateSeries([{
                    data: data
                }])
            }, 2000)

            // every 60 seconds, we reset the data
            window.setInterval(function() {
                resetData()
                chart.updateSeries([{
                    data
                }], false, true)
            }, 60000)
        });
        $(function() {
            var options = {
                chart: {
                    height: 300,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [5, 7, 5],
                    curve: 'straight',
                    dashArray: [0, 8, 5]
                },
                colors: ["#0e9e4a", "#ffba57", "#ff5252"],
                series: [{
                        name: "Session Duration",
                        data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
                    },
                    {
                        name: "Page Views",
                        data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
                    },
                    {
                        name: 'Total Visits',
                        data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
                    }
                ],
                title: {
                    text: 'Page Statistics',
                    align: 'left'
                },
                markers: {
                    size: 0,

                    hover: {
                        sizeOffset: 6
                    }
                },
                xaxis: {
                    categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
                        '10 Jan', '11 Jan', '12 Jan'
                    ],
                },
                tooltip: {
                    y: [{
                        title: {
                            formatter: function(val) {
                                return val + " (mins)"
                            }
                        }
                    }, {
                        title: {
                            formatter: function(val) {
                                return val + " per session"
                            }
                        }
                    }, {
                        title: {
                            formatter: function(val) {
                                return val;
                            }
                        }
                    }]
                },
                grid: {
                    borderColor: '#f1f1f1',
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#line-chart-3"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'area',
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                colors: ["#ffba57", "#ff5252"],
                series: [{
                    name: 'series1',
                    data: [31, 40, 28, 51, 42, 109, 100]
                }, {
                    name: 'series2',
                    data: [11, 32, 45, 32, 34, 52, 41]
                }],

                xaxis: {
                    type: 'datetime',
                    categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"],
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#area-chart-1"),
                options
            );

            chart.render();
        });
        $(function() {
            var options = {
                annotations: {
                    yaxis: [{
                        y: 30,
                        borderColor: '#999',
                        label: {
                            show: true,
                            text: 'Support',
                            style: {
                                color: "#fff",
                                background: '#00E396'
                            }
                        }
                    }],
                    xaxis: [{
                        x: new Date('14 Nov 2012').getTime(),
                        borderColor: '#999',
                        yAxisIndex: 0,
                        label: {
                            show: true,
                            text: 'Rally',
                            style: {
                                color: "#fff",
                                background: '#775DD0'
                            }
                        }
                    }]
                },
                chart: {
                    type: 'area',
                    height: 320,
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                        data: [
                            [1327359600000, 30.95],
                            [1327446000000, 31.34],
                            [1327532400000, 31.18],
                            [1327618800000, 31.05],
                            [1327878000000, 31.00],
                            [1327964400000, 30.95],
                            [1328050800000, 31.24],
                            [1328137200000, 31.29],
                            [1328223600000, 31.85],
                            [1328482800000, 31.86],
                            [1328569200000, 32.28],
                            [1328655600000, 32.10],
                            [1328742000000, 32.65],
                            [1328828400000, 32.21],
                            [1329087600000, 32.35],
                            [1329174000000, 32.44],
                            [1329260400000, 32.46],
                            [1329346800000, 32.86],
                            [1329433200000, 32.75],
                            [1329778800000, 32.54],
                            [1329865200000, 32.33],
                            [1329951600000, 32.97],
                            [1330038000000, 33.41],
                            [1330297200000, 33.27],
                            [1330383600000, 33.27],
                            [1330470000000, 32.89],
                            [1330556400000, 33.10],
                            [1330642800000, 33.73],
                            [1330902000000, 33.22],
                            [1330988400000, 31.99],
                            [1331074800000, 32.41],
                            [1331161200000, 33.05],
                            [1331247600000, 33.64],
                            [1331506800000, 33.56],
                            [1331593200000, 34.22],
                            [1331679600000, 33.77],
                            [1331766000000, 34.17],
                            [1331852400000, 33.82],
                            [1332111600000, 34.51],
                            [1332198000000, 33.16],
                            [1332284400000, 33.56],
                            [1332370800000, 33.71],
                            [1332457200000, 33.81],
                            [1332712800000, 34.40],
                            [1332799200000, 34.63],
                            [1332885600000, 34.46],
                            [1332972000000, 34.48],
                            [1333058400000, 34.31],
                            [1333317600000, 34.70],
                            [1333404000000, 34.31],
                            [1333490400000, 33.46],
                            [1333576800000, 33.59],
                            [1333922400000, 33.22],
                            [1334008800000, 32.61],
                            [1334095200000, 33.01],
                            [1334181600000, 33.55],
                            [1334268000000, 33.18],
                            [1334527200000, 32.84],
                            [1334613600000, 33.84],
                            [1334700000000, 33.39],
                            [1334786400000, 32.91],
                            [1334872800000, 33.06],
                            [1335132000000, 32.62],
                            [1335218400000, 32.40],
                            [1335304800000, 33.13],
                            [1335391200000, 33.26],
                            [1335477600000, 33.58],
                            [1335736800000, 33.55],
                            [1335823200000, 33.77],
                            [1335909600000, 33.76],
                            [1335996000000, 33.32],
                            [1336082400000, 32.61],
                            [1336341600000, 32.52],
                            [1336428000000, 32.67],
                            [1336514400000, 32.52],
                            [1336600800000, 31.92],
                            [1336687200000, 32.20],
                            [1336946400000, 32.23],
                            [1337032800000, 32.33],
                            [1337119200000, 32.36],
                            [1337205600000, 32.01],
                            [1337292000000, 31.31],
                            [1337551200000, 32.01],
                            [1337637600000, 32.01],
                            [1337724000000, 32.18],
                            [1337810400000, 31.54],
                            [1337896800000, 31.60],
                            [1338242400000, 32.05],
                            [1338328800000, 31.29],
                            [1338415200000, 31.05],
                            [1338501600000, 29.82],
                            [1338760800000, 30.31],
                            [1338847200000, 30.70],
                            [1338933600000, 31.69],
                            [1339020000000, 31.32],
                            [1339106400000, 31.65],
                            [1339365600000, 31.13],
                            [1339452000000, 31.77],
                            [1339538400000, 31.79],
                            [1339624800000, 31.67],
                            [1339711200000, 32.39],
                            [1339970400000, 32.63],
                            [1340056800000, 32.89],
                            [1340143200000, 31.99],
                            [1340229600000, 31.23],
                            [1340316000000, 31.57],
                            [1340575200000, 30.84],
                            [1340661600000, 31.07],
                            [1340748000000, 31.41],
                            [1340834400000, 31.17],
                            [1340920800000, 32.37],
                            [1341180000000, 32.19],
                            [1341266400000, 32.51],
                            [1341439200000, 32.53],
                            [1341525600000, 31.37],
                            [1341784800000, 30.43],
                            [1341871200000, 30.44],
                            [1341957600000, 30.20],
                            [1342044000000, 30.14],
                            [1342130400000, 30.65],
                            [1342389600000, 30.40],
                            [1342476000000, 30.65],
                            [1342562400000, 31.43],
                            [1342648800000, 31.89],
                            [1342735200000, 31.38],
                            [1342994400000, 30.64],
                            [1343080800000, 30.02],
                            [1343167200000, 30.33],
                            [1343253600000, 30.95],
                            [1343340000000, 31.89],
                            [1343599200000, 31.01],
                            [1343685600000, 30.88],
                            [1343772000000, 30.69],
                            [1343858400000, 30.58],
                            [1343944800000, 32.02],
                            [1344204000000, 32.14],
                            [1344290400000, 32.37],
                            [1344376800000, 32.51],
                            [1344463200000, 32.65],
                            [1344549600000, 32.64],
                            [1344808800000, 32.27],
                            [1344895200000, 32.10],
                            [1344981600000, 32.91],
                            [1345068000000, 33.65],
                            [1345154400000, 33.80],
                            [1345413600000, 33.92],
                            [1345500000000, 33.75],
                            [1345586400000, 33.84],
                            [1345672800000, 33.50],
                            [1345759200000, 32.26],
                            [1346018400000, 32.32],
                            [1346104800000, 32.06],
                            [1346191200000, 31.96],
                            [1346277600000, 31.46],
                            [1346364000000, 31.27],
                            [1346709600000, 31.43],
                            [1346796000000, 32.26],
                            [1346882400000, 32.79],
                            [1346968800000, 32.46],
                            [1347228000000, 32.13],
                            [1347314400000, 32.43],
                            [1347400800000, 32.42],
                            [1347487200000, 32.81],
                            [1347573600000, 33.34],
                            [1347832800000, 33.41],
                            [1347919200000, 32.57],
                            [1348005600000, 33.12],
                            [1348092000000, 34.53],
                            [1348178400000, 33.83],
                            [1348437600000, 33.41],
                            [1348524000000, 32.90],
                            [1348610400000, 32.53],
                            [1348696800000, 32.80],
                            [1348783200000, 32.44],
                            [1349042400000, 32.62],
                            [1349128800000, 32.57],
                            [1349215200000, 32.60],
                            [1349301600000, 32.68],
                            [1349388000000, 32.47],
                            [1349647200000, 32.23],
                            [1349733600000, 31.68],
                            [1349820000000, 31.51],
                            [1349906400000, 31.78],
                            [1349992800000, 31.94],
                            [1350252000000, 32.33],
                            [1350338400000, 33.24],
                            [1350424800000, 33.44],
                            [1350511200000, 33.48],
                            [1350597600000, 33.24],
                            [1350856800000, 33.49],
                            [1350943200000, 33.31],
                            [1351029600000, 33.36],
                            [1351116000000, 33.40],
                            [1351202400000, 34.01],
                            [1351638000000, 34.02],
                            [1351724400000, 34.36],
                            [1351810800000, 34.39],
                            [1352070000000, 34.24],
                            [1352156400000, 34.39],
                            [1352242800000, 33.47],
                            [1352329200000, 32.98],
                            [1352415600000, 32.90],
                            [1352674800000, 32.70],
                            [1352761200000, 32.54],
                            [1352847600000, 32.23],
                            [1352934000000, 32.64],
                            [1353020400000, 32.65],
                            [1353279600000, 32.92],
                            [1353366000000, 32.64],
                            [1353452400000, 32.84],
                            [1353625200000, 33.40],
                            [1353884400000, 33.30],
                            [1353970800000, 33.18],
                            [1354057200000, 33.88],
                            [1354143600000, 34.09],
                            [1354230000000, 34.61],
                            [1354489200000, 34.70],
                            [1354575600000, 35.30],
                            [1354662000000, 35.40],
                            [1354748400000, 35.14],
                            [1354834800000, 35.48],
                            [1355094000000, 35.75],
                            [1355180400000, 35.54],
                            [1355266800000, 35.96],
                            [1355353200000, 35.53],
                            [1355439600000, 37.56],
                            [1355698800000, 37.42],
                            [1355785200000, 37.49],
                            [1355871600000, 38.09],
                            [1355958000000, 37.87],
                            [1356044400000, 37.71],
                            [1356303600000, 37.53],
                            [1356476400000, 37.55],
                            [1356562800000, 37.30],
                            [1356649200000, 36.90],
                            [1356908400000, 37.68],
                            [1357081200000, 38.34],
                            [1357167600000, 37.75],
                            [1357254000000, 38.13],
                            [1357513200000, 37.94],
                            [1357599600000, 38.14],
                            [1357686000000, 38.66],
                            [1357772400000, 38.62],
                            [1357858800000, 38.09],
                            [1358118000000, 38.16],
                            [1358204400000, 38.15],
                            [1358290800000, 37.88],
                            [1358377200000, 37.73],
                            [1358463600000, 37.98],
                            [1358809200000, 37.95],
                            [1358895600000, 38.25],
                            [1358982000000, 38.10],
                            [1359068400000, 38.32],
                            [1359327600000, 38.24],
                            [1359414000000, 38.52],
                            [1359500400000, 37.94],
                            [1359586800000, 37.83],
                            [1359673200000, 38.34],
                            [1359932400000, 38.10],
                            [1360018800000, 38.51],
                            [1360105200000, 38.40],
                            [1360191600000, 38.07],
                            [1360278000000, 39.12],
                            [1360537200000, 38.64],
                            [1360623600000, 38.89],
                            [1360710000000, 38.81],
                            [1360796400000, 38.61],
                            [1360882800000, 38.63],
                            [1361228400000, 38.99],
                            [1361314800000, 38.77],
                            [1361401200000, 38.34],
                            [1361487600000, 38.55],
                            [1361746800000, 38.11],
                            [1361833200000, 38.59],
                            [1361919600000, 39.60],
                        ]
                    },

                ],
                markers: {
                    size: 0,
                    style: 'hollow',
                },
                colors: ["#4680ff"],
                xaxis: {
                    type: 'datetime',
                    min: new Date('01 Mar 2012').getTime(),
                    tickAmount: 6,
                },
                tooltip: {
                    x: {
                        format: 'dd MMM yyyy'
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 100]
                    }
                },

            }
            var chart = new ApexCharts(
                document.querySelector("#area-chart-2"),
                options
            );
            chart.render();
            var resetCssClasses = function(activeEl) {
                var els = document.querySelectorAll("button");
                Array.prototype.forEach.call(els, function(el) {
                    el.classList.remove('active');
                });

                activeEl.target.classList.add('active')
            }
            document.querySelector("#one_month").addEventListener('click', function(e) {
                resetCssClasses(e)
                chart.updateOptions({
                    xaxis: {
                        min: new Date('28 Jan 2013').getTime(),
                        max: new Date('27 Feb 2013').getTime(),
                    }
                })
            })
            document.querySelector("#six_months").addEventListener('click', function(e) {
                resetCssClasses(e)
                chart.updateOptions({
                    xaxis: {
                        min: new Date('27 Sep 2012').getTime(),
                        max: new Date('27 Feb 2013').getTime(),
                    }
                })
            })
            document.querySelector("#one_year").addEventListener('click', function(e) {
                resetCssClasses(e)
                chart.updateOptions({
                    xaxis: {
                        min: new Date('27 Feb 2012').getTime(),
                        max: new Date('27 Feb 2013').getTime(),
                    }
                })
            })
            document.querySelector("#ytd").addEventListener('click', function(e) {
                resetCssClasses(e)
                chart.updateOptions({
                    xaxis: {
                        min: new Date('01 Jan 2013').getTime(),
                        max: new Date('27 Feb 2013').getTime(),
                    }
                })
            })
            document.querySelector("#all").addEventListener('click', function(e) {
                resetCssClasses(e)
                chart.updateOptions({
                    xaxis: {
                        min: undefined,
                        max: undefined,
                    }
                })
            })
            document.querySelector("#ytd").addEventListener('click', function() {

            })
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                colors: ["#0e9e4a", "#4680ff", "#ff5252"],
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: 'Net Profit',
                    data: [44, 55, 57, 56, 61, 58, 63]
                }, {
                    name: 'Revenue',
                    data: [76, 85, 101, 98, 87, 105, 91]
                }, {
                    name: 'Free Cash Flow',
                    data: [35, 41, 36, 26, 45, 48, 52]
                }],
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                },
                yaxis: {
                    title: {
                        text: '$ (thousands)'
                    }
                },
                fill: {
                    opacity: 1

                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$ " + val + " thousands"
                        }
                    }
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#bar-chart-1"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                    stacked: true,
                    toolbar: {
                        show: true
                    },
                    zoom: {
                        enabled: true
                    }
                },
                colors: ["#4680ff", "#0e9e4a", "#ffba57", "#ff5252"],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }],
                plotOptions: {
                    bar: {
                        horizontal: false,
                    },
                },
                series: [{
                    name: 'PRODUCT A',
                    data: [44, 55, 41, 67, 22, 43]
                }, {
                    name: 'PRODUCT B',
                    data: [13, 23, 20, 8, 13, 27]
                }, {
                    name: 'PRODUCT C',
                    data: [11, 17, 15, 15, 21, 14]
                }, {
                    name: 'PRODUCT D',
                    data: [21, 7, 25, 13, 22, 8]
                }],
                xaxis: {
                    type: 'datetime',
                    categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT', '01/05/2011 GMT', '01/06/2011 GMT'],
                },
                legend: {
                    position: 'right',
                    offsetY: 40
                },
                fill: {
                    opacity: 1
                },
            }
            var chart = new ApexCharts(
                document.querySelector("#bar-chart-2"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                colors: ["#4680ff", "#0e9e4a"],
                dataLabels: {
                    enabled: true,
                    offsetX: -6,
                    style: {
                        fontSize: '12px',
                        colors: ['#fff']
                    }
                },
                stroke: {
                    show: true,
                    width: 1,
                    colors: ['#fff']
                },
                series: [{
                    data: [44, 55, 41, 64, 22, 43, 21]
                }, {
                    data: [53, 32, 33, 52, 13, 44, 32]
                }],
                xaxis: {
                    categories: [2001, 2002, 2003, 2004, 2005, 2006, 2007],
                },

            }
            var chart = new ApexCharts(
                document.querySelector("#bar-chart-3"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                    stacked: true,
                    stackType: '100%'
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    },

                },
                colors: ["#4680ff", "#00acc1", "#0e9e4a", "#ffba57", "#ff5252"],
                stroke: {
                    width: 1,
                    colors: ['#fff']
                },
                series: [{
                    name: 'Marine Sprite',
                    data: [44, 55, 41, 37, 22, 43, 21]
                }, {
                    name: 'Striking Calf',
                    data: [53, 32, 33, 52, 13, 43, 32]
                }, {
                    name: 'Tank Picture',
                    data: [12, 17, 11, 9, 15, 11, 20]
                }, {
                    name: 'Bucket Slope',
                    data: [9, 7, 5, 8, 6, 9, 4]
                }, {
                    name: 'Reborn Kid',
                    data: [25, 12, 19, 32, 25, 24, 10]
                }],
                title: {
                    text: '100% Stacked Bar'
                },
                xaxis: {
                    categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + "K"
                        }
                    }
                },
                fill: {
                    opacity: 1

                },

                legend: {
                    position: 'top',
                    horizontalAlign: 'left',
                    offsetX: 40
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#bar-chart-4"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'line',
                },
                series: [{
                    name: 'Website Blog',
                    type: 'column',
                    data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
                }, {
                    name: 'Social Media',
                    type: 'line',
                    data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
                }],
                stroke: {
                    width: [0, 4]
                },
                colors: ["#4680ff", "#ff5252"],
                title: {
                    text: 'Traffic Sources'
                },
                labels: ['01 Jan 2001', '02 Jan 2001', '03 Jan 2001', '04 Jan 2001', '05 Jan 2001', '06 Jan 2001', '07 Jan 2001', '08 Jan 2001', '09 Jan 2001', '10 Jan 2001', '11 Jan 2001', '12 Jan 2001'],
                xaxis: {
                    type: 'datetime'
                },
                yaxis: [{
                    title: {
                        text: 'Website Blog',
                    },

                }, {
                    opposite: true,
                    title: {
                        text: 'Social Media'
                    }
                }]

            }
            var chart = new ApexCharts(
                document.querySelector("#mixed-chart-1"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'line',
                    stacked: false,
                },
                stroke: {
                    width: [0, 2, 5],
                    curve: 'smooth'
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%'
                    }
                },
                colors: ['#ff5252', '#4680ff', '#ffba57'],
                series: [{
                    name: 'Facebook',
                    type: 'column',
                    data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
                }, {
                    name: 'Vine',
                    type: 'area',
                    data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
                }, {
                    name: 'Dribbble',
                    type: 'line',
                    data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
                }],
                fill: {
                    opacity: [0.85, 0.25, 1],
                    gradient: {
                        inverseColors: false,
                        shade: 'light',
                        type: "vertical",
                        opacityFrom: 0.85,
                        opacityTo: 0.55,
                        stops: [0, 100, 100, 100]
                    }
                },
                labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003', '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'],
                markers: {
                    size: 0
                },
                xaxis: {
                    type: 'datetime'
                },
                yaxis: {
                    min: 0
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0) + " views";
                            }
                            return y;

                        }
                    }
                },
                legend: {
                    labels: {
                        useSeriesColors: true
                    },
                    markers: {
                        customHTML: [
                            function() {
                                return ''
                            },
                            function() {
                                return ''
                            },
                            function() {
                                return ''
                            }
                        ]
                    }
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#mixed-chart-2"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'candlestick',
                },
                series: [{
                    data: [{
                            x: new Date(1538778600000),
                            y: [6629.81, 6650.5, 6623.04, 6633.33]
                        },
                        {
                            x: new Date(1538780400000),
                            y: [6632.01, 6643.59, 6620, 6630.11]
                        },
                        {
                            x: new Date(1538782200000),
                            y: [6630.71, 6648.95, 6623.34, 6635.65]
                        },
                        {
                            x: new Date(1538784000000),
                            y: [6635.65, 6651, 6629.67, 6638.24]
                        },
                        {
                            x: new Date(1538785800000),
                            y: [6638.24, 6640, 6620, 6624.47]
                        },
                        {
                            x: new Date(1538787600000),
                            y: [6624.53, 6636.03, 6621.68, 6624.31]
                        },
                        {
                            x: new Date(1538789400000),
                            y: [6624.61, 6632.2, 6617, 6626.02]
                        },
                        {
                            x: new Date(1538791200000),
                            y: [6627, 6627.62, 6584.22, 6603.02]
                        },
                        {
                            x: new Date(1538793000000),
                            y: [6605, 6608.03, 6598.95, 6604.01]
                        },
                        {
                            x: new Date(1538794800000),
                            y: [6604.5, 6614.4, 6602.26, 6608.02]
                        },
                        {
                            x: new Date(1538796600000),
                            y: [6608.02, 6610.68, 6601.99, 6608.91]
                        },
                        {
                            x: new Date(1538798400000),
                            y: [6608.91, 6618.99, 6608.01, 6612]
                        },
                        {
                            x: new Date(1538800200000),
                            y: [6612, 6615.13, 6605.09, 6612]
                        },
                        {
                            x: new Date(1538802000000),
                            y: [6612, 6624.12, 6608.43, 6622.95]
                        },
                        {
                            x: new Date(1538803800000),
                            y: [6623.91, 6623.91, 6615, 6615.67]
                        },
                        {
                            x: new Date(1538805600000),
                            y: [6618.69, 6618.74, 6610, 6610.4]
                        },
                        {
                            x: new Date(1538807400000),
                            y: [6611, 6622.78, 6610.4, 6614.9]
                        },
                        {
                            x: new Date(1538809200000),
                            y: [6614.9, 6626.2, 6613.33, 6623.45]
                        },
                        {
                            x: new Date(1538811000000),
                            y: [6623.48, 6627, 6618.38, 6620.35]
                        },
                        {
                            x: new Date(1538812800000),
                            y: [6619.43, 6620.35, 6610.05, 6615.53]
                        },
                        {
                            x: new Date(1538814600000),
                            y: [6615.53, 6617.93, 6610, 6615.19]
                        },
                        {
                            x: new Date(1538816400000),
                            y: [6615.19, 6621.6, 6608.2, 6620]
                        },
                        {
                            x: new Date(1538818200000),
                            y: [6619.54, 6625.17, 6614.15, 6620]
                        },
                        {
                            x: new Date(1538820000000),
                            y: [6620.33, 6634.15, 6617.24, 6624.61]
                        },
                        {
                            x: new Date(1538821800000),
                            y: [6625.95, 6626, 6611.66, 6617.58]
                        },
                        {
                            x: new Date(1538823600000),
                            y: [6619, 6625.97, 6595.27, 6598.86]
                        },
                        {
                            x: new Date(1538825400000),
                            y: [6598.86, 6598.88, 6570, 6587.16]
                        },
                        {
                            x: new Date(1538827200000),
                            y: [6588.86, 6600, 6580, 6593.4]
                        },
                        {
                            x: new Date(1538829000000),
                            y: [6593.99, 6598.89, 6585, 6587.81]
                        },
                        {
                            x: new Date(1538830800000),
                            y: [6587.81, 6592.73, 6567.14, 6578]
                        },
                        {
                            x: new Date(1538832600000),
                            y: [6578.35, 6581.72, 6567.39, 6579]
                        },
                        {
                            x: new Date(1538834400000),
                            y: [6579.38, 6580.92, 6566.77, 6575.96]
                        },
                        {
                            x: new Date(1538836200000),
                            y: [6575.96, 6589, 6571.77, 6588.92]
                        },
                        {
                            x: new Date(1538838000000),
                            y: [6588.92, 6594, 6577.55, 6589.22]
                        },
                        {
                            x: new Date(1538839800000),
                            y: [6589.3, 6598.89, 6589.1, 6596.08]
                        },
                        {
                            x: new Date(1538841600000),
                            y: [6597.5, 6600, 6588.39, 6596.25]
                        },
                        {
                            x: new Date(1538843400000),
                            y: [6598.03, 6600, 6588.73, 6595.97]
                        },
                        {
                            x: new Date(1538845200000),
                            y: [6595.97, 6602.01, 6588.17, 6602]
                        },
                        {
                            x: new Date(1538847000000),
                            y: [6602, 6607, 6596.51, 6599.95]
                        },
                        {
                            x: new Date(1538848800000),
                            y: [6600.63, 6601.21, 6590.39, 6591.02]
                        },
                        {
                            x: new Date(1538850600000),
                            y: [6591.02, 6603.08, 6591, 6591]
                        },
                        {
                            x: new Date(1538852400000),
                            y: [6591, 6601.32, 6585, 6592]
                        },
                        {
                            x: new Date(1538854200000),
                            y: [6593.13, 6596.01, 6590, 6593.34]
                        },
                        {
                            x: new Date(1538856000000),
                            y: [6593.34, 6604.76, 6582.63, 6593.86]
                        },
                        {
                            x: new Date(1538857800000),
                            y: [6593.86, 6604.28, 6586.57, 6600.01]
                        },
                        {
                            x: new Date(1538859600000),
                            y: [6601.81, 6603.21, 6592.78, 6596.25]
                        },
                        {
                            x: new Date(1538861400000),
                            y: [6596.25, 6604.2, 6590, 6602.99]
                        },
                        {
                            x: new Date(1538863200000),
                            y: [6602.99, 6606, 6584.99, 6587.81]
                        },
                        {
                            x: new Date(1538865000000),
                            y: [6587.81, 6595, 6583.27, 6591.96]
                        },
                        {
                            x: new Date(1538866800000),
                            y: [6591.97, 6596.07, 6585, 6588.39]
                        },
                        {
                            x: new Date(1538868600000),
                            y: [6587.6, 6598.21, 6587.6, 6594.27]
                        },
                        {
                            x: new Date(1538870400000),
                            y: [6596.44, 6601, 6590, 6596.55]
                        },
                        {
                            x: new Date(1538872200000),
                            y: [6598.91, 6605, 6596.61, 6600.02]
                        },
                        {
                            x: new Date(1538874000000),
                            y: [6600.55, 6605, 6589.14, 6593.01]
                        },
                        {
                            x: new Date(1538875800000),
                            y: [6593.15, 6605, 6592, 6603.06]
                        },
                        {
                            x: new Date(1538877600000),
                            y: [6603.07, 6604.5, 6599.09, 6603.89]
                        },
                        {
                            x: new Date(1538879400000),
                            y: [6604.44, 6604.44, 6600, 6603.5]
                        },
                        {
                            x: new Date(1538881200000),
                            y: [6603.5, 6603.99, 6597.5, 6603.86]
                        },
                        {
                            x: new Date(1538883000000),
                            y: [6603.85, 6605, 6600, 6604.07]
                        },
                        {
                            x: new Date(1538884800000),
                            y: [6604.98, 6606, 6604.07, 6606]
                        },
                    ]
                }],
                title: {
                    text: 'CandleStick Chart',
                    align: 'left'
                },
                colors: ["#0e9e4a", "#ff5252"],
                xaxis: {
                    type: 'datetime'
                },
                yaxis: {
                    tooltip: {
                        enabled: true
                    }
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#candlestick-chart-1"),
                options
            );
            chart.render();
        });
        $(function() {
            function generateBubbleData(baseval, count, yrange) {
                var i = 0;
                var series = [];
                while (i < count) {
                    var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
                    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
                    var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

                    series.push([x, y, z]);
                    baseval += 86400000;
                    i++;
                }
                return series;
            }
            var options = {
                chart: {
                    height: 350,
                    type: 'bubble',
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                        name: 'Bubble1',
                        data: generateBubbleData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                            min: 10,
                            max: 60
                        })
                    },
                    {
                        name: 'Bubble2',
                        data: generateBubbleData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                            min: 10,
                            max: 60
                        })
                    },
                    {
                        name: 'Bubble3',
                        data: generateBubbleData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                            min: 10,
                            max: 60
                        })
                    },
                    {
                        name: 'Bubble4',
                        data: generateBubbleData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                            min: 10,
                            max: 60
                        })
                    }
                ],
                colors: ["#4680ff", "#0e9e4a", "#ffba57", "#ff5252"],
                fill: {
                    opacity: 0.8
                },
                title: {
                    text: 'Simple Bubble Chart'
                },
                xaxis: {
                    tickAmount: 12,
                    type: 'category',
                },
                yaxis: {
                    max: 70
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#bubble-chart-1"),
                options
            );
            chart.render();
        });
        $(function() {
            function generateDatasehratheatbubble3d(baseval, count, yrange) {
                var i = 0;
                var series = [];
                while (i < count) {
                    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
                    var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

                    series.push([baseval, y, z]);
                    baseval += 86400000;
                    i++;
                }
                return series;
            }
            var options = {
                chart: {
                    height: 350,
                    type: 'bubble',
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                        name: 'Product1',
                        data: generateDatasehratheatbubble3d(new Date('11 Feb 2017 GMT').getTime(), 20, {
                            min: 10,
                            max: 60
                        })
                    },
                    {
                        name: 'Product2',
                        data: generateDatasehratheatbubble3d(new Date('11 Feb 2017 GMT').getTime(), 20, {
                            min: 10,
                            max: 60
                        })
                    },
                    {
                        name: 'Product3',
                        data: generateDatasehratheatbubble3d(new Date('11 Feb 2017 GMT').getTime(), 20, {
                            min: 10,
                            max: 60
                        })
                    },
                    {
                        name: 'Product4',
                        data: generateDatasehratheatbubble3d(new Date('11 Feb 2017 GMT').getTime(), 20, {
                            min: 10,
                            max: 60
                        })
                    }
                ],
                fill: {
                    type: 'gradient',
                },
                colors: ["#4680ff", "#0e9e4a", "#ffba57", "#ff5252"],
                title: {
                    text: '3D Bubble Chart'
                },
                xaxis: {
                    tickAmount: 12,
                    type: 'datetime',

                    labels: {
                        rotate: 0,
                    }
                },
                yaxis: {
                    max: 70
                },
                theme: {
                    palette: 'palette2'
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#bubble-chart-2"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'scatter',
                    zoom: {
                        enabled: true,
                        type: 'xy'
                    }
                },
                colors: ["#4680ff", "#0e9e4a", "#ff5252", "#ffba57", "#00acc1"],
                series: [{
                    name: "SAMPLE A",
                    data: [
                        [16.4, 5.4],
                        [21.7, 2],
                        [25.4, 3],
                        [19, 2],
                        [10.9, 1],
                        [13.6, 3.2],
                        [10.9, 7.4],
                        [10.9, 0],
                        [10.9, 8.2],
                        [16.4, 0],
                        [16.4, 1.8],
                        [13.6, 0.3],
                        [13.6, 0],
                        [29.9, 0],
                        [27.1, 2.3],
                        [16.4, 0],
                        [13.6, 3.7],
                        [10.9, 5.2],
                        [16.4, 6.5],
                        [10.9, 0],
                        [24.5, 7.1],
                        [10.9, 0],
                        [8.1, 4.7],
                        [19, 0],
                        [21.7, 1.8],
                        [27.1, 0],
                        [24.5, 0],
                        [27.1, 0],
                        [29.9, 1.5],
                        [27.1, 0.8],
                        [22.1, 2]
                    ]
                }, {
                    name: "SAMPLE B",
                    data: [
                        [36.4, 13.4],
                        [1.7, 11],
                        [5.4, 8],
                        [9, 17],
                        [1.9, 4],
                        [3.6, 12.2],
                        [1.9, 14.4],
                        [1.9, 9],
                        [1.9, 13.2],
                        [1.4, 7],
                        [6.4, 8.8],
                        [3.6, 4.3],
                        [1.6, 10],
                        [9.9, 2],
                        [7.1, 15],
                        [1.4, 0],
                        [3.6, 13.7],
                        [1.9, 15.2],
                        [6.4, 16.5],
                        [0.9, 10],
                        [4.5, 17.1],
                        [10.9, 10],
                        [0.1, 14.7],
                        [9, 10],
                        [12.7, 11.8],
                        [2.1, 10],
                        [2.5, 10],
                        [27.1, 10],
                        [2.9, 11.5],
                        [7.1, 10.8],
                        [2.1, 12]
                    ]
                }, {
                    name: "SAMPLE C",
                    data: [
                        [21.7, 3],
                        [23.6, 3.5],
                        [24.6, 3],
                        [29.9, 3],
                        [21.7, 20],
                        [23, 2],
                        [10.9, 3],
                        [28, 4],
                        [27.1, 0.3],
                        [16.4, 4],
                        [13.6, 0],
                        [19, 5],
                        [22.4, 3],
                        [24.5, 3],
                        [32.6, 3],
                        [27.1, 4],
                        [29.6, 6],
                        [31.6, 8],
                        [21.6, 5],
                        [20.9, 4],
                        [22.4, 0],
                        [32.6, 10.3],
                        [29.7, 20.8],
                        [24.5, 0.8],
                        [21.4, 0],
                        [21.7, 6.9],
                        [28.6, 7.7],
                        [15.4, 0],
                        [18.1, 0],
                        [33.4, 0],
                        [16.4, 0]
                    ]
                }],
                xaxis: {
                    tickAmount: 10,
                    labels: {
                        formatter: function(val) {
                            return parseFloat(val).toFixed(1)
                        }
                    }
                },
                yaxis: {
                    tickAmount: 7
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#scatter-chart-1"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'scatter',
                    zoom: {
                        type: 'xy'
                    }
                },
                series: [{
                        name: 'TEAM 1',
                        data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
                            min: 10,
                            max: 60
                        })
                    },
                    {
                        name: 'TEAM 2',
                        data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
                            min: 10,
                            max: 60
                        })
                    },
                    {
                        name: 'TEAM 3',
                        data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 30, {
                            min: 10,
                            max: 60
                        })
                    },
                    {
                        name: 'TEAM 4',
                        data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 10, {
                            min: 10,
                            max: 60
                        })
                    },
                    {
                        name: 'TEAM 5',
                        data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 30, {
                            min: 10,
                            max: 60
                        })
                    },
                ],
                dataLabels: {
                    enabled: false
                },
                colors: ["#4680ff", "#0e9e4a", "#ff5252", "#ffba57", "#00acc1"],
                grid: {
                    xaxis: {
                        showLines: true
                    },
                    yaxis: {
                        showLines: true
                    },
                },
                xaxis: {
                    type: 'datetime',

                },
                yaxis: {
                    max: 70
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#scatter-chart-2"),
                options
            );
            chart.render();

            function generateDayWiseTimeSeries(baseval, count, yrange) {
                var i = 0;
                var series = [];
                while (i < count) {
                    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

                    series.push([baseval, y]);
                    baseval += 86400000;
                    i++;
                }
                return series;
            }
        });
        $(function() {
            function generateDatasehratheat(count, yrange) {
                var i = 0;
                var series = [];
                while (i < count) {
                    var x = 'w' + (i + 1).toString();
                    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

                    series.push({
                        x: x,
                        y: y
                    });
                    i++;
                }
                return series;
            }
            var options = {
                chart: {
                    height: 350,
                    type: 'heatmap',
                },
                dataLabels: {
                    enabled: false
                },
                colors: ["#4680ff"],
                series: [{
                        name: 'Metric1',
                        data: generateDatasehratheat(12, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric2',
                        data: generateDatasehratheat(12, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric3',
                        data: generateDatasehratheat(12, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric4',
                        data: generateDatasehratheat(12, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric5',
                        data: generateDatasehratheat(12, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric6',
                        data: generateDatasehratheat(12, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric7',
                        data: generateDatasehratheat(12, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric8',
                        data: generateDatasehratheat(12, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric9',
                        data: generateDatasehratheat(12, {
                            min: 0,
                            max: 90
                        })
                    }
                ],
                title: {
                    text: 'HeatMap Chart (Single color)'
                },
            }
            var chart = new ApexCharts(
                document.querySelector("#heatmap-chart-1"),
                options
            );
            chart.render();
        });
        $(function() {
            function generateDatasehrat(count, yrange) {
                var i = 0;
                var series = [];
                while (i < count) {
                    var x = (i + 1).toString();
                    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

                    series.push({
                        x: x,
                        y: y
                    });
                    i++;
                }
                return series;
            }
            var options = {
                chart: {
                    height: 350,
                    type: 'heatmap',
                },
                stroke: {
                    width: 0
                },
                plotOptions: {
                    heatmap: {
                        radius: 30,
                        enableShades: false,
                        colorScale: {
                            ranges: [{
                                    from: 0,
                                    to: 50,
                                    color: '#ffba57'
                                },
                                {
                                    from: 51,
                                    to: 100,
                                    color: '#ff5252'
                                },
                            ],
                        },

                    }
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#fff']
                    }
                },
                series: [{
                        name: 'Metric1',
                        data: generateDatasehrat(15, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric2',
                        data: generateDatasehrat(15, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric3',
                        data: generateDatasehrat(15, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric4',
                        data: generateDatasehrat(15, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric5',
                        data: generateDatasehrat(15, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric6',
                        data: generateDatasehrat(15, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric7',
                        data: generateDatasehrat(15, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric8',
                        data: generateDatasehrat(15, {
                            min: 0,
                            max: 90
                        })
                    },
                    {
                        name: 'Metric8',
                        data: generateDatasehrat(15, {
                            min: 0,
                            max: 90
                        })
                    }
                ],
                colors: ["#4680ff", "#00acc1", "#0e9e4a", "#ffba57", "#ff5252"],
                xaxis: {
                    type: 'category',
                },
                title: {
                    text: 'Rounded (Range without Shades)'
                },
            }
            var chart = new ApexCharts(
                document.querySelector("#heatmap-chart-2"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 320,
                    type: 'pie',
                },
                labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                series: [44, 55, 13, 43, 22],
                colors: ["#4680ff", "#0e9e4a", "#00acc1", "#ffba57", "#ff5252"],
                legend: {
                    show: true,
                    position: 'bottom',
                },
                dataLabels: {
                    enabled: true,
                    dropShadow: {
                        enabled: false,
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            }
            var chart = new ApexCharts(
                document.querySelector("#pie-chart-1"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 320,
                    type: 'donut',
                },
                series: [44, 55, 41, 17, 15],
                colors: ["#4680ff", "#0e9e4a", "#00acc1", "#ffba57", "#ff5252"],
                legend: {
                    show: true,
                    position: 'bottom',
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true
                                },
                                value: {
                                    show: true
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    dropShadow: {
                        enabled: false,
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {          
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            }
            var chart = new ApexCharts(
                document.querySelector("#pie-chart-2"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'radialBar',
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: '70%',
                        }
                    },
                },
                colors: ["#4680ff"],
                series: [70],
                labels: ['Cricket'],
            }
            var chart = new ApexCharts(
                document.querySelector("#radialBar-chart-1"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'radialBar',
                },
                plotOptions: {
                    radialBar: {
                        offsetY: -30,
                        startAngle: 0,
                        endAngle: 270,
                        hollow: {
                            margin: 5,
                            size: '30%',
                            background: 'transparent',
                            image: undefined,
                        },
                        dataLabels: {
                            name: {
                                show: false,

                            },
                            value: {
                                show: false,
                            }
                        }
                    }
                },
                colors: ["#4680ff", "#0e9e4a", "#ffba57", "#ff5252"],
                series: [76, 67, 61, 90],
                labels: ['Vimeo', 'Messenger', 'Facebook', 'LinkedIn'],
                legend: {
                    show: true,
                    floating: true,
                    fontSize: '16px',
                    position: 'left',
                    offsetX: 0,
                    offsetY: 0,
                    labels: {
                        useSeriesColors: true,
                    },
                    markers: {
                        size: 0
                    },
                    formatter: function(seriesName, opts) {
                        return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                    },
                    itemMargin: {
                        horizontal: 1,
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            show: false
                        }
                    }
                }]
            }

            var chart = new ApexCharts(
                document.querySelector("#radialBar-chart-2"),
                options
            );

            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'radar',
                },
                series: [{
                    name: 'Series 1',
                    data: [20, 100, 40, 30, 50, 80, 33],
                }],
                labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                plotOptions: {
                    radar: {
                        size: 140,
                        polygons: {
                            strokeColor: '#f3f6ff',
                            fill: {
                                colors: ['#f3f6ff', '#fff']
                            }
                        }
                    }
                },
                title: {
                    text: 'Radar with Polygon Fill'
                },
                colors: ['#ff5252'],
                markers: {
                    size: 4,
                    colors: ['#fff'],
                    strokeColor: '#ff5252',
                    strokeWidth: 2,
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val
                        }
                    }
                },
                yaxis: {
                    tickAmount: 7,
                    labels: {
                        formatter: function(val, i) {
                            if (i % 2 === 0) {
                                return val
                            } else {
                                return ''
                            }
                        }
                    }
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#radar-chart-1"),
                options
            );
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'radar',
                    dropShadow: {
                        enabled: true,
                        blur: 1,
                        left: 1,
                        top: 1
                    }
                },
                series: [{
                    name: 'Series 1',
                    data: [80, 50, 30, 40, 100, 20],
                }, {
                    name: 'Series 2',
                    data: [20, 30, 40, 80, 20, 80],
                }, {
                    name: 'Series 3',
                    data: [44, 76, 78, 13, 43, 10],
                }],
                title: {
                    text: 'Radar Chart - Multi Series'
                },
                colors: ["#4680ff", "#0e9e4a", "#ff5252"],
                stroke: {
                    width: 0
                },
                fill: {
                    opacity: 0.7
                },
                markers: {
                    size: 0
                },
                labels: ['2011', '2012', '2013', '2014', '2015', '2016']
            }
            var chart = new ApexCharts(
                document.querySelector("#radar-chart-2"),
                options
            );
            chart.render();

            function update() {
                function randomSeries() {
                    var arr = []
                    for (var i = 0; i < 6; i++) {
                        arr.push(Math.floor(Math.random() * 100))
                    }
                    return arr
                }
                chart.updateSeries([{
                    name: 'Series 1',
                    data: randomSeries(),
                }, {
                    name: 'Series 2',
                    data: randomSeries(),
                }, {
                    name: 'Series 3',
                    data: randomSeries(),
                }])
            }
        });
    }, 700);
});
