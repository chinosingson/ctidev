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
            text: 'Percent of Projects per Goal - Indonesia'
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