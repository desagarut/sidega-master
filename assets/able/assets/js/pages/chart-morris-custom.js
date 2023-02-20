'use strict';
$(document).ready(function() {
    setTimeout(function() {
        // [ bar-simple ] chart start
        Morris.Bar({
            element: 'morris-bar-chart',
            data: [{
                    y: '2008',
                    a: 50,
                    b: 40,
                    c: 35,
                },
                {
                    y: '2009',
                    a: 75,
                    b: 65,
                    c: 60,
                },
                {
                    y: '2010',
                    a: 50,
                    b: 40,
                    c: 55,
                },
                {
                    y: '2011',
                    a: 75,
                    b: 65,
                    c: 85,
                },
                {
                    y: '2012',
                    a: 100,
                    b: 90,
                    c: 40,
                }
            ],
            xkey: 'y',
            barSizeRatio: 0.70,
            barGap: 3,
            resize: true,
            responsive: true,
            ykeys: ['a', 'b', 'c'],
            labels: ['Bar 1', 'Bar 2', 'Bar 3'],
            barColors: ["#4680ff", "#536dfe", "#9ccc65"]
        });
        // [ bar-simple ] chart end

        // [ bar-stacked ] chart start
        Morris.Bar({
            element: 'morris-bar-stacked-chart',
            data: [{
                    y: '2008',
                    a: 50,
                    b: 40,
                    c: 35,
                },
                {
                    y: '2009',
                    a: 75,
                    b: 65,
                    c: 60,
                },
                {
                    y: '2010',
                    a: 50,
                    b: 40,
                    c: 55,
                },
                {
                    y: '2011',
                    a: 75,
                    b: 65,
                    c: 85,
                },
                {
                    y: '2012',
                    a: 100,
                    b: 90,
                    c: 40,
                }
            ],
            xkey: 'y',
            stacked: true,
            barSizeRatio: 0.50,
            barGap: 3,
            resize: true,
            responsive: true,
            ykeys: ['a', 'b', 'c'],
            labels: ['Bar 1', 'Bar 2', 'Bar 3'],
            barColors: ["#ffba57", "#ff5252", "#4680ff"]
        });
        // [ bar-stacked ] chart end

        // [ area-angle-chart ] start
        Morris.Area({
            element: 'morris-area-chart',
            data: [{
                    y: '2006',
                    a: 0,
                    b: 0
                },
                {
                    y: '2007',
                    a: 130,
                    b: 100
                },
                {
                    y: '2008',
                    a: 80,
                    b: 60
                },
                {
                    y: '2009',
                    a: 70,
                    b: 200
                },
                {
                    y: '2010',
                    a: 220,
                    b: 150
                },
                {
                    y: '2011',
                    a: 105,
                    b: 90
                },
                {
                    y: '2012',
                    a: 250,
                    b: 150
                }
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            pointSize: 0,
            fillOpacity: 0.8,
            pointStrokeColors: ['#b4becb', '#536dfe'],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 0,
            smooth: false,
            hideHover: 'auto',
            responsive: true,
            lineColors: ['#b4becb', '#536dfe'],
            resize: true
        });
        // [ area-angle-chart ] end

        // [ area-smooth-chart ] start
        Morris.Area({
            element: 'morris-area-curved-chart',
            data: [{
                period: '2010',
                iphone: 0,
                ipad: 0,
                itouch: 0
            }, {
                period: '2011',
                iphone: 50,
                ipad: 15,
                itouch: 5
            }, {
                period: '2012',
                iphone: 20,
                ipad: 50,
                itouch: 65
            }, {
                period: '2013',
                iphone: 60,
                ipad: 12,
                itouch: 7
            }, {
                period: '2014',
                iphone: 30,
                ipad: 20,
                itouch: 120
            }, {
                period: '2015',
                iphone: 25,
                ipad: 80,
                itouch: 40
            }, {
                period: '2016',
                iphone: 10,
                ipad: 10,
                itouch: 10
            }],
            lineColors: ['#9ccc65', '#536dfe', '#4680ff'],
            xkey: 'period',
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['Site A', 'Site B', 'Site C'],
            pointSize: 0,
            lineWidth: 0,
            resize: true,
            fillOpacity: 0.9,
            responsive: true,
            behaveLikeLine: true,
            gridLineColor: '#d2d2d2',
            hideHover: 'auto'
        });
        // [ area-smooth-chart ] end

        // [ line-angle-chart ] Start
        Morris.Line({
            element: 'morris-line-chart',
            data: [{
                    y: '2006',
                    a: 20,
                    b: 10
                },
                {
                    y: '2007',
                    a: 55,
                    b: 45
                },
                {
                    y: '2008',
                    a: 45,
                    b: 35
                },
                {
                    y: '2009',
                    a: 75,
                    b: 65
                },
                {
                    y: '2010',
                    a: 50,
                    b: 40
                },
                {
                    y: '2011',
                    a: 75,
                    b: 65
                },
                {
                    y: '2012',
                    a: 100,
                    b: 90
                }
            ],
            xkey: 'y',
            redraw: true,
            resize: true,
            smooth: false,
            ykeys: ['a', 'b'],
            hideHover: 'auto',
            responsive: true,
            labels: ['Series A', 'Series B'],
            lineColors: ['#536dfe', '#4680ff']
        });
        // [ line-angle-chart ] end

        // [ line-smooth-chart ] start
        Morris.Line({
            element: 'morris-line-smooth-chart',
            data: [{
                    y: '2006',
                    a: 100,
                    b: 90
                },
                {
                    y: '2007',
                    a: 75,
                    b: 65
                },
                {
                    y: '2008',
                    a: 50,
                    b: 40
                },
                {
                    y: '2009',
                    a: 75,
                    b: 65
                },
                {
                    y: '2010',
                    a: 50,
                    b: 40
                },
                {
                    y: '2011',
                    a: 75,
                    b: 65
                },
                {
                    y: '2012',
                    a: 100,
                    b: 90
                }
            ],
            xkey: 'y',
            redraw: true,
            resize: true,
            ykeys: ['a', 'b'],
            hideHover: 'auto',
            responsive: true,
            labels: ['Series A', 'Series B'],
            lineColors: ['#9ccc65', '#ff5252']
        });
        // [ line-smooth-chart ] end

        // [ line-real-chart ] start
        var nReloads = 0;

        function data(offset) {
            var ret = [];
            for (var x = 0; x <= 360; x += 10) {
                var v = (offset + x) % 360;
                ret.push({
                    x: x,
                    y: Math.cos(Math.PI * v / 90).toFixed(4),
                    z: Math.cos(Math.PI * v / 180).toFixed(4),
                    a: Math.sin(Math.PI * v / 90).toFixed(4)
                });
            }
            return ret;
        }
        var graph_real = Morris.Line({
            element: 'morris-line-realtime-chart',
            data: data(0),
            resize: true,
            xkey: 'x',
            ykeys: ['y', 'z', 'a'],
            labels: ['line 1', 'line 2', 'line 3'],
            parseTime: false,
            ymin: -1.0,
            ymax: 1.0,
            lineColors: ['#ffba57', '#ff5252', '#4680ff'],
            pointSize: 4,
            responsive: true,
            pointFillColors: ['#fff', '#fff', '#fff'],
            pointStrokeColors: ['#ffba57', '#ff5252', '#4680ff'],
            lineWidth: 2,
            hideHover: true
        });

        function update() {
            nReloads++;
            graph_real.setData(data(5 * nReloads));
        }
        setInterval(update, 100);
        // [ line-real-chart ] end

        // [ Donut-chart ] Start
        var graph = Morris.Donut({
            element: 'morris-donut-chart',
            data: [{
                    value: 60,
                    label: 'Data 1'
                },
                {
                    value: 20,
                    label: 'Data 1'
                },
                {
                    value: 10,
                    label: 'Data 1'
                },
                {
                    value: 5,
                    label: 'Data 1'
                }
            ],
            colors: [
                '#4680ff',
                '#536dfe',
                '#ff5252',
                '#ffba57',
            ],
            resize: true,
            formatter: function(x) {
                return "val : " + x
            }
        });
    }, 700);
    // [ Donut-chart ] end
});
