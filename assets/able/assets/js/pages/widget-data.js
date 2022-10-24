'use strict';
$(document).ready(function() {
    var map;
    map = new GMaps({
        el: '#markers-map',
        lat: 21.2334329,
        lng: 72.866472,
        scrollwheel: false
    });
    map.addMarker({
        lat: 21.2334329,
        lng: 72.866472,
        title: 'Marker with InfoWindow',
        infoWindow: {
            content: '<p><Phoenicoded></Phoenicoded> <br/> Buy Now at <a href="">Themeforest</a></p>'
        }
    });
    // ====================================================================
    // ====================================================================
    // ====================================================================
    // [ customer-scroll ] start
    var px = new PerfectScrollbar('.customer-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ customer-scroll ] end

    // [ incomeing-scroll ] start
    var px = new PerfectScrollbar('.incomeing-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ incomeing-scroll ] end

    // [ product-scroll ] start
    var px = new PerfectScrollbar('.product-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ product-scroll ] end

    // [ sale-scroll ] start
    var px = new PerfectScrollbar('.sale-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ sale-scroll ] end

    // [ revenue-scroll ] start
    var px = new PerfectScrollbar('.revenue-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ revenue-scroll ] end

    // [ stock-scroll ] start
    var px = new PerfectScrollbar('.stock-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ stock-scroll ] end

    // [ subject-scroll ] start
    var px = new PerfectScrollbar('.subject-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ subject-scroll ] end

    // [ app-scroll ] start
    var px = new PerfectScrollbar('.app-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ app-scroll ] end

    // [ user-scroll ] start
    var px = new PerfectScrollbar('.user-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ user-scroll ] end

    // [ full-scroll ] start
    var px = new PerfectScrollbar('.full-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ full-scroll ] end

    // [ recent-scroll ] start
    var px = new PerfectScrollbar('.recent-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ recent-scroll ] end

    // [ cust-scroll ] start
    var px = new PerfectScrollbar('.cust-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ cust-scroll ] end

    // [ pro-scroll ] start
    var px = new PerfectScrollbar('.pro-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ pro-scroll ] end

    // [ contact-scroll ] start
    var px = new PerfectScrollbar('.contact-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ contact-scroll ] end

    // [ performance-scroll ] start
    var px = new PerfectScrollbar('.performance-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ performance-scroll ] end

    // [ test-scroll ] start
    var px = new PerfectScrollbar('.test-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ text-scroll ] end

    // [ activity-scroll ] start
    var px = new PerfectScrollbar('.activity-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ activity-scroll ] end

    // [ campaign-scroll ] start
    var px = new PerfectScrollbar('.campaign-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ campaign-scroll ] end

    // [ feed-scroll ] start
    var px = new PerfectScrollbar('.feed-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ feed-scroll ] end

    // [ new-scroll ] start
    var px = new PerfectScrollbar('.new-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ new-scroll ] end

    // [ latest-scroll ] start
    var px = new PerfectScrollbar('.latest-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ lastest-scroll ] end
});
