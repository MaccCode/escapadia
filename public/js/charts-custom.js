$(document).ready(function () {

    'use strict';

    Chart.defaults.global.defaultFontColor = '#75787c';
//line chart for Monthly Sales
var LINECHARTEXMPLE = $('#lineChartCustom1');
var lineChartExample = new Chart(LINECHARTEXMPLE, {
    type: 'bar',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Monthly Sales",
            data: monthlySales,
            backgroundColor: "#1E90FF",
            borderColor: "#1E90FF",
            fill: true,
            tension: 0.1
        }]
        
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
//Bar chart for Weekly Sales
var BARCHARTWEEKLY = $('#barChartWeeklySales');
var barChartWeekly = new Chart(BARCHARTWEEKLY, {
    type: 'bar',
    data: {
        labels: Object.keys(weeklySales), // Week numbers
        datasets: [{
            label: 'Weekly Sales',
            data: Object.values(weeklySales),
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            },
            x: {
                title: {
                    display: true,
                    text: 'Week Number'
                }
            }
        }
    }
});
//Pie Chart for Bookings
    var PIECHARTEXMPLE = document.getElementById('pieChartCustom1').getContext('2d');
    var pieChartExample = new Chart(PIECHARTEXMPLE, {
        type: 'pie',
        data: {
            labels: Object.keys(bookingsData), // property names
            datasets: [{
                data: Object.values(bookingsData),
                backgroundColor: [
                    '#1E90FF', '#864DD9', '#9762e6', '#a678eb', '#c9a0ff'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'left'
                }
            }
        }
    });  
});
