var Index = {
    init: function() {
        $(document.generate).on("submit", function(e) {
            e.preventDefault();

            Index.generateReport(
                document.generate.start.value,
                document.generate.stop.value
            );
        });
    },
    generateReport: function(start, stop) {
        $.get(
            "/api/report",
            {
                start,
                stop
            },
            function(response) {
                Index.populateChart(response);
            }
        );
    },
    populateChart: function(data) {
        Highcharts.chart("chart", {
            title: {
                text: "Retention curve chart"
            },

            subtitle: {
                text:
                    "How far weekly cohorts progress through the Onboarding Flow"
            },

            yAxis: {
                title: {
                    text: "Percentage of users per stage"
                }
            },

            legend: {
                layout: "vertical",
                align: "right",
                verticalAlign: "middle"
            },

            xAxis: {
                categories: [0, 20, 40, 50, 70, 90, 99, 100],
                title: {
                    text: "Onboarding steps"
                }
            },

            series: data,

            responsive: {
                rules: [
                    {
                        condition: {
                            maxWidth: 1000
                        },
                        chartOptions: {
                            legend: {
                                layout: "horizontal",
                                align: "center",
                                verticalAlign: "bottom"
                            }
                        }
                    }
                ]
            }
        });
    }
};

$(document).ready(Index.init);
