
// *************************************************
(function (namespace, $) {
    "use strict";

    var DemoCharts = function () {
        // Create reference to this instance
        var o = this;
        // Initialize app when document is ready
        $(document).ready(function () {
            o.initialize();
        });

    };
    var p = DemoCharts.prototype;

    // =========================================================================
    // INIT
    // =========================================================================

    p.initialize = function () {
        // Morris
        this._initMorris();
    };


    // =========================================================================
    // MORRIS
    // =========================================================================

    p._initMorris = function () {
        var chart_print = $('#chart_print').html();
        var chart_print1 = $.parseJSON(chart_print);
        // console.log(chart_print1);
        if (typeof Morris !== 'object') {
            return;
        }
        // Morris stacked bar demo
        if ($('#morris-stacked-bar-graph').length > 0) {
            Morris.Bar({
                element: 'morris-stacked-bar-graph',
                data: chart_print1,
                xkey: 'x',
                ykeys: ['y','z'],
                labels: ['Count','Amount'],
                stacked: true,
                barColors: $('#morris-stacked-bar-graph').data('colors').split(',')
            });
        }
    };

// =========================================================================
    namespace.DemoCharts = new DemoCharts;
}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):

// app-wise orders chart


(function (namespace, $) {


    var dates1 = '';
    var app_select = $('#app_select').val();
    $(document).on('change', '#app_select', function (e) {
        app_select = $('#app_select').val();
        filter();
    });
    function filter(){

        $('#loadingmessage').show();
        $.post("dashboard.php",
            {
                app_wise_chart: dates1,
                app_select: app_select
            },
            function (data, status) {
                if(data) {
                    $('#loadingmessage').hide();
                    var result = JSON.parse(data);
                    // console.log(result);
                    if (typeof Morris !== 'object') {
                        return;
                    }
                    if ($('#date_wise_chart').length > 0) {
                        window.m = Morris.Line({
                            element: 'date_wise_chart',
                            data: result,
                            xkey: 'x',
                            ykeys: ['y'],
                            labels: ['User Count'],
                            parseTime: false,
                            resize: true,
                            // barColors: $('#morris-stacked-bar-graph').data('colors').split(','),
                            lineColors: ['green'],
                            // lineColors: $('#dispatch_chart').data('colors').split(','),
                            // hoverCallback: function (index, options, default_content) {
                            //     var row = options.data[index];
                            //     return default_content.replace(row.x + ")");
                            // },
                            xLabelMargin: 10,
                            integerYLabels: true,
                        });
                    }
                }else {
                    $('#date_wise_chart').html('<p style="text-align: center;font-size: 20px;">No data</p>');
                }
                // alert("Data: " + data + "\nStatus: " + status);
            });
    }


    "use strict";
    var DemoCharts = function () {
        // Create reference to this instance
        var o = this;
        // Initialize app when document is ready
        $(document).ready(function () {
            o.initialize();
        });

    };
    var p = DemoCharts.prototype;
    p.initialize = function () {
        this._initMorris();
    };
    p._initMorris = function () {
        if (typeof Morris !== 'object') {
            return;
        }

        var start = moment().subtract(50, 'days');
        var end = moment();


        function cb5(start, end) {
            var dates = $('#start_chart').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            dates1 = start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY');
            // alert(dates1);
            var app_select = $("#app_select").val();
            $(document).ajaxStart(function () {
                $("#loadingmessage").css("display", "block");
            });
            $(document).ajaxComplete(function () {
                $("#loadingmessage").css("display", "none");
            });
            $("#date_wise_chart").empty();
            // alert('next' + dates1 + 'next1=' + bid);

            $.post("dashboard.php",
                {
                    app_wise_chart: dates1,
                    app_select: app_select
                },
                function (data, status) {
                    if (data) {
                        var result = JSON.parse(data);
                        // console.log(result);
                        if (typeof Morris !== 'object') {
                            return;
                        }
                        if ($('#date_wise_chart').length > 0) {
                            window.m = Morris.Line({
                                element: 'date_wise_chart',
                                data: result,
                                xkey: 'x',
                                ykeys: ['y'],
                                labels: ['User Count'],
                                parseTime: false,
                                resize: true,
                                // barColors: $('#morris-stacked-bar-graph').data('colors').split(','),
                                lineColors: ['green'],
                                // lineColors: $('#dispatch_chart').data('colors').split(','),
                                // hoverCallback: function (index, options, default_content) {
                                //     var row = options.data[index];
                                //     return default_content.replace(row.x + ")");
                                // },
                                xLabelMargin: 10,
                                integerYLabels: true,
                            });
                        }
                    }else {
                        $('#date_wise_chart').html('<p style="text-align: center;font-size: 20px;">No data</p>');
                    }
                    // alert("Data: " + data + "\nStatus: " + status);
                });
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb5);

        cb5(start, end);


    };
    // =========================================================================
    namespace.DemoCharts = new DemoCharts;
}(this.materialadmin, jQuery));