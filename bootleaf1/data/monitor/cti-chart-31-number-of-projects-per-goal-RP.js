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
            text: 'Number of Projects per Goal - Philippines'
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
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            }
        },

        series: [{
            name: 'Ongoing',
            data: [6, 13, 12, 11, 6, 1],
            stack: 'RP'
        }, {
            name: 'Completed',
            data: [13, 26, 26, 33, 14, 5],
            stack: 'RP'
        }, {
            name: 'Incomplete Information',
            data: [1, 2, 0, 0, 0, 0],
            stack: 'RP'
        }]
    });
});