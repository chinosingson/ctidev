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
            text: 'Number of Projects Per Country'
        },
        /*subtitle: {
            text: 'Source: Coral Triangle Initiative'
        },*/
        xAxis: {
            categories: [
                'Philippines',
                'Indonesia',
                'Malaysia']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Projects'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ongoing',
            data: [23, 14, 13],
            stack: 'countries'
        }, {
            name: 'Completed',
            data: [83, 10, 14],
            stack: 'countries'
        }, {
            name: 'Incomplete Information',
            data: [5, 7, 18],
            stack: 'countries'
        }]
    });
});