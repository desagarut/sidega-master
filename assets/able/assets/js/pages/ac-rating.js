'use strict';
$(window).ready(function() {
    function ratingEnable() {
        // [ rating-1to10 ]
        $('#example-1to10').barrating('show', {
            theme: 'bars-1to10',
        });
        // [ rating-movie ]
        $('#example-movie').barrating('show', {
            theme: 'bars-movie'
        });
        // [ rating-movie1 ]
        $('#example-movie').barrating('set', 'Mediocre');
        // [ rating-square ]
        $('#example-square').barrating('show', {
            theme: 'bars-square',
            showValues: true,
            showSelectedRating: false
        });
        // [ rating-pill ]
        $('#example-pill').barrating('show', {
            theme: 'bars-pill',
            initialRating: 'A',
            showValues: true,
            showSelectedRating: false,
            allowEmpty: true,
            emptyValue: '-- no rating selected --',
            onSelect: function(value, text) {
                alert('Selected rating: ' + value);
            }
        });
        // [ rating-reverse ]
        $('#example-reversed').barrating('show', {
            theme: 'bars-reversed',
            showSelectedRating: true,
            reverse: true
        });
        // [ rating-horizontal ]
        $('#example-horizontal').barrating('show', {
            theme: 'bars-horizontal',
            reverse: true,
            hoverState: false
        });
        // [ rating-fontawesome ]
        $('#example-fontawesome').barrating({
            theme: 'fontawesome-stars',
            showSelectedRating: false
        });
        // [ rating-star ]
        $('.rating-star').barrating({
            theme: 'css-stars',
            showSelectedRating: false
        });
        // [ rating-bootstrap ]
        $('#example-bootstrap').barrating({
            theme: 'bootstrap-stars',
            showSelectedRating: false
        });
        // [ rating-fontawesome-o ]
        var currentRating = $('#example-fontawesome-o').data('current-rating');
        $('.stars-example-fontawesome-o .current-rating')
            .find('span')
            .html(currentRating);
        $('.stars-example-fontawesome-o .clear-rating').on('click', function(event) {
            event.preventDefault();
            $('#example-fontawesome-o')
                .barrating('clear');
        });

        $('#example-fontawesome-o').barrating({
            theme: 'fontawesome-stars-o',
            showSelectedRating: false,
            initialRating: currentRating,
            onSelect: function(value, text) {
                if (!value) {
                    $('#example-fontawesome-o')
                        .barrating('clear');
                } else {
                    $('.stars-example-fontawesome-o .current-rating')
                        .addClass('hidden');

                    $('.stars-example-fontawesome-o .your-rating')
                        .removeClass('hidden')
                        .find('span')
                        .html(value);
                }
            },
            onClear: function(value, text) {
                $('.stars-example-fontawesome-o')
                    .find('.current-rating')
                    .removeClass('hidden')
                    .end()
                    .find('.your-rating')
                    .addClass('hidden');
            }
        });
    }
    // [ rating-destroy ]
    function ratingDisable() {
        $('select').barrating('destroy');
    }
    // [ rating-enable ]
    $('.rating-enable').on('click', function(event) {
        event.preventDefault();
        ratingEnable();
        $(this).addClass('deactivated');
        $('.rating-disable').removeClass('deactivated');
    });
    // [ rating-disable ]
    $('.rating-disable').on('click', function(event) {
        event.preventDefault();
        ratingDisable();
        $(this).addClass('deactivated');
        $('.rating-enable').removeClass('deactivated');
    });
    ratingEnable();
});
