// Typeahead configuration
$(document).ready(function() {
    //var url = base_url + '/find?q=%QUERY%';
    //alert(url);
    var engine = new Bloodhound({
        remote: {
            url: base_url + '/find?q=%QUERY%&current_person_id=' + $('#currentPersonId').val(),
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    $("#manager-search-input").typeahead({
        hint: true,
        hightlight: false,
        minLength: 3
    }, {
        source: engine.ttAdapter(),

        templates: {
            empty: ['<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'],
            header: ['<div class="list-group search-results-dropdown">'],
            suggestion: function (data) {
                return '<a href="/memp/' + data.person_id + '" class="list-group-item">' + data.name + '<br>' + data.position_name + '</a>'
            }
        }
    });

});

const checkManagerSelection = function(formElement) {
    if ($("input[name='manager']:checked").val() ) {
        formElement.submit();
    } else {
        $("#managerSelectionError").text('Please use the search form or make a selection to continue.');
        return false;
    }
}
