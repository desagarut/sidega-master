'use strict';
$(document).ready(function() {
    // [ Typeahead ]
    var citynames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
            url: 'assets/json/citynames.json',
            filter: function(list) {
                return $.map(list, function(cityname) {
                    return {
                        name: cityname
                    };
                });
            }
        }
    });
    citynames.initialize();
    $('.typeahead').tagsinput({
        typeaheadjs: {
            name: 'citynames',
            displayKey: 'name',
            valueKey: 'name',
            source: citynames.ttAdapter()
        }
    });

    // [ Categorizing tag ]
    var cities = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: 'assets/json/cities.json'
    });
    cities.initialize();

    var elt = $('.category-tag');
    elt.tagsinput({
        tagClass: function(item) {
            switch (item.continent) {
                case 'Europe':
                    return 'label label-primary';
                case 'America':
                    return 'label label-danger label-important';
                case 'Australia':
                    return 'label label-success';
                case 'Africa':
                    return 'label label-default';
                case 'Asia':
                    return 'label label-warning';
            }
        },
        itemValue: 'value',
        itemText: 'text',
        typeaheadjs: {
            name: 'cities',
            displayKey: 'text',
            source: cities.ttAdapter()
        }
    });
    elt.tagsinput('add', {
        "value": 1,
        "text": "Amsterdam",
        "continent": "Europe"
    });
    elt.tagsinput('add', {
        "value": 4,
        "text": "Washington",
        "continent": "America"
    });
    elt.tagsinput('add', {
        "value": 7,
        "text": "Sydney",
        "continent": "Australia"
    });
    elt.tagsinput('add', {
        "value": 10,
        "text": "Beijing",
        "continent": "Asia"
    });
    elt.tagsinput('add', {
        "value": 13,
        "text": "Cairo",
        "continent": "Africa"
    });

    // [ object tag ]
    var cities = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: 'assets/json/cities.json'
    });
    cities.initialize();

    var elt = $('.objects-tag');
    elt.tagsinput({
        itemValue: 'value',
        itemText: 'text',
        typeaheadjs: {
            name: 'cities',
            displayKey: 'text',
            source: cities.ttAdapter()
        }
    });
    elt.tagsinput('add', {
        "value": 1,
        "text": "Amsterdam",
        "continent": "Europe"
    });
    elt.tagsinput('add', {
        "value": 4,
        "text": "Washington",
        "continent": "America"
    });
    elt.tagsinput('add', {
        "value": 7,
        "text": "Sydney",
        "continent": "Australia"
    });
    elt.tagsinput('add', {
        "value": 10,
        "text": "Beijing",
        "continent": "Asia"
    });
    elt.tagsinput('add', {
        "value": 13,
        "text": "Cairo",
        "continent": "Africa"
    });

    // [ defult length ]
    $('input[maxlength]').maxlength();

    // [ Threshold ]
    $('input.thresold-i').maxlength({
        threshold: 20
    });

    // [ Color-lables ]
    $('input.color-class').maxlength({
        alwaysShow: true,
        threshold: 10,
        warningClass: "label label-success",
        limitReachedClass: "label label-danger"
    });

    // [ Play With Positions ]
    $('input.position-class').maxlength({
        alwaysShow: true,
        placement: 'top-right'
    });

    // [ Working With Textarea ]
    $('textarea.max-textarea').maxlength({
        alwaysShow: true
    });
});
