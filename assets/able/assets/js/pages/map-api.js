'use strict';
jQuery(document).ready(function($) {
    var map;
    var geocoder = new google.maps.Geocoder();
    var markers = [];
    var iterator = 0;
    var berlin = new google.maps.LatLng(52.520816, 13.410186),
        stockholm = new google.maps.LatLng(59.32522, 18.07002);
    var neighborhoods = [new google.maps.LatLng(52.511467, 13.447179), new google.maps.LatLng(52.549061, 13.422975), new google.maps.LatLng(52.497622, 13.396110), new google.maps.LatLng(52.517683, 13.394393), new google.maps.LatLng(52.530843, 13.382721), new google.maps.LatLng(52.514549, 13.350105), new google.maps.LatLng(52.534394, 13.340492), ];

    function initialize() {
        var mapOptions = {
            zoom: 12,
            center: berlin
        };
        var el = document.getElementById('map-1'),
            doc_height = $(document).height() - 10 -
            $(".main-content > .user-info-navbar").outerHeight() -
            $(".main-content > .page-title").outerHeight() -
            $(".google-map-env .map-toolbar").outerHeight();
        el.style.height = doc_height + 'px';
        map = new google.maps.Map(el, mapOptions);
        for (var i = 0; i < neighborhoods.length; i++) {
            setTimeout(function() {
                addMarker();
            }, i * 200 + 200);
        }
        new google.maps.Marker({
            map: map,
            position: stockholm,
            draggable: true
        });
    }

    function addMarker() {
        markers.push(new google.maps.Marker({
            position: neighborhoods[iterator],
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP
        }));
        iterator++;
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    // [ go-sthlm ]
    $("#go-sthlm").on('click', function(ev) {
        ev.preventDefault();
        map.panTo(stockholm);
    });
    // [ go-bln ]
    $("#go-bln").on('click', function(ev) {
        ev.preventDefault();
        map.panTo(berlin);
    });
    // [ map-unzoom ]
    $("#map-unzoom").on('click', function(ev) {
        ev.preventDefault();
        map.setZoom(map.getZoom() - 1);
    });
    // [ map-resetzoom ]
    $("#map-resetzoom").on('click', function(ev) {
        ev.preventDefault();
        map.setZoom(12);
    });
    // [ map-zoom ]
    $("#map-zoom").on('click', function(ev) {
        ev.preventDefault();
        map.setZoom(map.getZoom() + 1);
    });
    // [ address-search ]
    $("#address-search").submit(function(ev) {
        ev.preventDefault();
        var $inp = $(this).find('.form-control'),
            address = $inp.val().trim();
        if (address.length != 0) {
            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        draggable: true
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    });
});
