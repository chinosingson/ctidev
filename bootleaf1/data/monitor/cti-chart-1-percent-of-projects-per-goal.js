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
            text: 'Percent of Projects Per Goal'
        },
        /*subtitle: {
            text: 'Source: Coral Triangle Initiative'
        },*/
        xAxis: {
            categories: [
                'Goal 1',
                'Goal 2',
                'Goal 3',
                'Goal 4',
                'Goal 5',
                'No Data']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Projects'
            }
        },
        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
        },
        plotOptions: {
            column: {
                stacking: 'percent',
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ongoing',
            data: [10, 16, 16, 13, 6, 2],
            stack: 'goals'
        }, {
            name: 'Completed',
            data: [16, 27, 30, 33, 15, 4],
            stack: 'goals'
        }, {
            name: 'Incomplete Information',
            data: [6, 3, 0, 1, 1, 3],
            stack: 'goals'
        }]
    });
});