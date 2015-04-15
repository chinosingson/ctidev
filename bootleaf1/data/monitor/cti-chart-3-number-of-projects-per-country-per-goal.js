$(function () {
    $('#container').highcharts({

        chart: {
            type: 'column'
        },

        title: {
            text: 'Number of Projects per Country per Goal'
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
        },
            {
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
        },
            {
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