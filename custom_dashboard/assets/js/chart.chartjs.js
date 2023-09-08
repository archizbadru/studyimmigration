$(function () {
    'use strict'
    var BASEURL = $('body').attr('data-baseUrl');
    $.ajax({
        url: BASEURL + 'Report/all_source',
        type: 'POST',
        success: function (data) {
            var obj = JSON.parse(data);
            var ctxLabelb = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var ctxData1b = [43, 60, 50, 45, 50, 60, 70, 40, 45, 35, 25, 30];
            var ctxData2b = [10, 40, 30, 40, 60, 55, 45, 35, 30, 20, 15, 20];
            var ctxColor1b = '#E5343D';
            var ctxColor2b = '#00cccc';
            for (var i = 0; i < (obj['source'].length); i++) {
            }
            var ctx5b = document.getElementById('chartArea1');
            new Chart(ctx5b, {
                type: 'line',
                data: {
                    labels: ctxLabelb,
                    datasets: [{
                            data: ctxData1b,
                            borderColor: ctxColor1b,
                            borderWidth: 1,
                            backgroundColor: 'rgba(0,23,55, .5)'
                        }, {
                            data: ctxData2b,
                            borderColor: ctxColor2b,
                            borderWidth: 1,
                            backgroundColor: 'rgba(28,225,172, .5)'
                        }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                        labels: {
                            display: false
                        }
                    },
                    scales: {
                        yAxes: [{
                                stacked: true,
                                gridLines: {
                                    color: '#e5e9f2'
                                },
                                ticks: {
                                    beginAtZero: true,
                                    fontSize: 10
                                }
                            }],
                        xAxes: [{
                                stacked: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: {
                                    beginAtZero: true,
                                    fontSize: 11
                                }
                            }]
                    }
                }
            });
        }
    });
})
