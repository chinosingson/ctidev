﻿$(function () {
    $('#chartContainer').highcharts({

        chart: {
            type: 'column',
						backgroundColor: null,
						style: {
								fontFamily: 'OpenSans'
						}
        },

        title: {
            text: 'Number of Projects per Goal - Malaysia'
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
        },]
    });
});