$(document).ready(function() {
    $("#clear_button").bind("click", clear_click);
    //$("#screenings_check").bind("change", screenings_check_change);
    $("#search_button").bind("click", function () {
        search_click();
    });

    //// DATERANGE PICKER CONFIG
    $('#screening_daterange').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            alwaysShowCalendars: true,
            startDate: moment().subtract(14, 'days'),
            endDate: moment()
        },
        function (start, end, label) {
            $('#screening_daterange').data('drp_empty', false); // means value was SET
        });

    ////// allow blank date range input
    // https://github.com/dangrossman/daterangepicker/issues/771

    $('#screening_daterange').on('change input keyup', function () {
        if (!$('#screening_daterange').val()) { // only if empty. Means value ERASED. If there is any value - we ignore it
            $('#screening_daterange').data('drp_empty', true); // remember our empty state (until reset again in cb)
        }
    });

    $('#screening_daterange').on('blur', function () {
        if ($('#screening_daterange').data('drp_empty')) { // means we were erasing it
            $('#screening_daterange').val(''); // so we force erasing it
        }
    });

    //run this just in case we are refreshing -- the switch can be sticky
    screenings_check_change();

    load_table();
});

var load_table = function()
{
    $("#results-card").show();
    $("#admin_table_container").hide();
    $("#loading_panel").show();

    setTimeout(function() {
        $.ajax({
            url: base_url + "/getsupervisortable",
            type: "POST",
            data: get_filters(),
            dataType: 'html',
            async: false,
            cache: false,
            success: function (data) {
                //$("#loading_panel").hide();
                $("#loading_panel").hide();
                $("#admin_table_container").html(data).show();

                $("#admin_table").DataTable({
                    "responsive": true,
                    //dom: 'Bfrtip',
                    //buttons: [
                    //    'copy', 'csv', 'excel', 'pdf'
                    //]
                });

            },
            error: function (xhr, status, err) {
                alert('error');
                //console.error(this.props.url, status. err.toString());
                var retstr = 'js error initializing...<br />';
                retstr += 'status: ' + status + ' error: ' + err.toString();
                retstr += '<br />' + xhr.responseText;
                $("#debug").html(retstr);
            }
        })
    }, 100);
};

var get_filters = function()
{
    //var only_failed_screenings = 0;
    //if($("#screenings_check").is(":checked"))
        only_failed_screenings = 1;

    var filters = {
        _token: csrftoken,
        daterange: $("#screening_daterange").val(),
        only_failed_screenings: only_failed_screenings,
        search_term: $("#search_string").val()
    };

    return filters;
};

var search_click = function()
{
    load_table();
};

var screenings_check_change = function()
{
    $(".screening_switch_label").removeClass("screen_switch_label_selected");
    if($("#screenings_check").is(":checked"))
    {
        //alert('checked');
        $("#failed_screenings_label").addClass("screen_switch_label_selected");
    }
    else
    {
        $("#all_screenings_label").addClass("screen_switch_label_selected");
    }

    load_table();
};

var clear_click = function()
{
    $('#department_search').val("");
    $('#department_id').val("");

    $("#screening_daterange").data('daterangepicker').setStartDate(moment().subtract(14, 'days'));
    $("#screening_daterange").data('daterangepicker').setEndDate(moment());

    $("#search_string").val("");

    //$("#screenings_check").prop('checked', true);
    //$(".screening_switch_label").removeClass("screen_switch_label_selected");
    //$("#failed_screenings_label").addClass("screen_switch_label_selected");

    ////$("#loading_panel").show();
    ////$("#report_results").hide();
    ////$("#results-card").hide();

    load_table();
};