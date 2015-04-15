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
            text: 'Number of Projects per Goal - Indonesia'
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
            data: [3, 5, 6, 4, 2, 1],
            stack: 'IND'
        }, {
            name: 'Completed',
            data: [1, 2, 2, 3, 0, 6],
            stack: 'IND'
        }, {
            name: 'Incomplete Information',
            data: [3, 1, 0, 0, 0, 1],
            stack: 'IND'
        }]
    });
});