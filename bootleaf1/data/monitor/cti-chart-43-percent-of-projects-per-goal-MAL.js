$(function () {
    $('#chartContainer').highcharts({

        chart: {
            type: 'column',
						backgroundColor: null,
						style: {
								fontFamily: 'OpenSans'
						}
        },

        title: {
            text: 'Malaysia'
        },

        xAxis: {
            categories: ['Goal 1', 'Goal 2', 'Goal 3', 'Goal 4', 'Goal 5', 'No Data']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Number of Projects'
            }
        },

        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
        },

        plotOptions: {
            column: {
                stacking: 'percent'
            }
        },

        series: [{
            name: 'Ongoing',
            data: [5, 6, 2, 5, 2, 1],
            stack: 'MAL'
        }, {
            name: 'Completed',
            data: [5, 1, 4, 3, 1, 4],
            stack: 'MAL'
        }, {
            name: 'Incomplete Information',
            data: [2, 0, 0, 0, 1, 2],
            stack: 'MAL'
        }]
    });
});