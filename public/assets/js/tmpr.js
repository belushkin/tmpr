document.addEventListener('DOMContentLoaded', function () {
    let options = {
        title: {
            text: 'How users are performing in the Onboarding Flow'
        },

        subtitle: {
            text: 'Source: Tmpr'
        },

        chart: {
            type: 'spline',
            pointStart: 0
        },

        yAxis: {
            title: {
                text: 'Percentage of Users'
            },
            type: 'linear',
            offset:0
        },

        xAxis: {
            title: {
                text: 'Percentage of Users'
            },
            categories:[
                'Create account - 0%',
                'Activate account - 20%',
                'Provide profile information - 40%',
                'What jobs are you interested in? - 50%',
                'Do you have relevant experience in these jobs? - 70%',
                'Are you a freelancer? - 90%',
                'Waiting for approval - 99%',
                'Approval - 100%'
            ]
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointPlacement: 'on'
            }
        },

        series: [{}]
    };

    Highcharts.ajax({
        url: '/api/v1/data',
        success: function(data) {
            options.series = data;
            Highcharts.chart('container', options);
        }
    });

});
