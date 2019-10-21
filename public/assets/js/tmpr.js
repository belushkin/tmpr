console.log(d);
Highcharts.chart('container', {

    title: {
        text: 'How users are performing in the Onboarding Flow'
    },

    subtitle: {
        text: 'Source: Tmpr'
    },

    yAxis: {
        title: {
            text: 'Percentage of Users'
        },
        type: 'linear'
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
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            }
        }
    },

    series: d,

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});