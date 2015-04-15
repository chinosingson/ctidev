{
        chart: {
            type: 'column',
						backgroundColor: null
        },
        title: {
            text: 'Number of Projects Per Goal'
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
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y + '<br/>' + 'Total: ' + this.point.stackTotal;
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
            name: 'Current',
            data: [10, 16, 16, 13, 6, 2],
            stack: 'goals'
        }, {
            name: 'Ended',
            data: [16, 27, 30, 33, 15, 4],
            stack: 'goals'
        }, {
            name: 'Unclear',
            data: [6, 3, 0, 1, 1, 3],
            stack: 'goals'
        }]
    }