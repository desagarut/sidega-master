'use strict';
$(document).ready(function() {
    // [ Single Select ]
    $(".js-example-basic-single").select2();

    // [ Multi Select ]
    $(".js-example-basic-multiple").select2();

    // [ With Placeholder ]
    $(".js-example-placeholder-multiple").select2({
        placeholder: "Select Your Name"
    });

    // [ Tagging Support ]
    $(".js-example-tags").select2({
        tags: true
    });

    // [ Automatic Select ]
    $(".js-example-tokenizer").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });

    // [ RTL Support ]
    $(".js-example-rtl").select2({
        dir: "rtl"
    });

    // [ limiting selection ]
    $(".js-example-basic-multiple-limit").select2({
        maximumSelectionLength: 2
    });

    // [ diacritics select ]
    $(".js-example-diacritics").select2();

    // [ Responsive select ]
    $(".js-example-responsive").select2();

    // [ loading array ]
    var data = [{
        id: 0,
        text: 'enhancement'
    }, {
        id: 1,
        text: 'bug'
    }, {
        id: 2,
        text: 'duplicate'
    }, {
        id: 3,
        text: 'invalid'
    }, {
        id: 4,
        text: 'wontfix'
    }];
    $(".js-example-data-array").select2({
        data: data
    });

    // [ loading data ]
    function formatRepo(repo) {
        if (repo.loading) return repo.text;

        var markup = "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

        if (repo.description) {
            markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
        }

        markup += "<div class='select2-result-repository__statistics'>" +
            "<div class='select2-result-repository__forks'><i class='icofont icofont-flash'></i> " + repo.forks_count + " Forks</div>" +
            "<div class='select2-result-repository__stargazers'><i class='icofont icofont-star'></i> " + repo.stargazers_count + " Stars</div>" +
            "<div class='select2-result-repository__watchers'><i class='icofont icofont-eye-alt'></i> " + repo.watchers_count + " Watchers</div>" +
            "</div>" +
            "</div></div>";

        return markup;
    }

    function formatRepoSelection(repo) {
        return repo.full_name || repo.text;
    }
    $(".js-data-example-ajax").select2({
        ajax: {
            url: "https://api.github.com/search/repositories",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatRepo, // omitted for brevity, see the source of this page
        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    });

    // [ disable result ]
    $(".js-example-disabled-results").select2();

    // [ hide search ]
    $(".js-example-basic-hide-search").select2({
        minimumResultsForSearch: Infinity
    });

    // [ enable disable ]
    $(".js-example-disabled").select2({
        disabled: false
    });
    $(".js-programmatic-enable").on("click", function() {
        $(".js-example-disabled").prop("disabled", false);
    });
    $(".js-programmatic-disable").on("click", function() {
        $(".js-example-disabled").prop("disabled", true);
    });
});
