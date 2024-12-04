import './bootstrap';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const dataContainer = document.getElementById('data-container');
    const categories = JSON.parse(dataContainer.getAttribute('data-categories'));
    const totals = JSON.parse(dataContainer.getAttribute('data-totals'));

    const options = {
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Total Produk',
            data: totals // Data total produk per kategori
        }],
        xaxis: {
            categories: categories // Nama kategori sebagai sumbu x
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Produk"; // Menampilkan jumlah produk
                }
            }
        }
    };

    const chart = new ApexCharts(document.querySelector("#column-chart"), options);
    chart.render();
});


    // Area Chart
    const areaChartElement = document.getElementById('area-chart');
    const visitorData = JSON.parse(areaChartElement.getAttribute('data-visitor-data'));

    const areaChartOptions = {
        chart: {
            height: '100%',
            maxWidth: '100%',
            type: 'area',
        },
        series: [{
            name: 'Visitors',
            data: visitorData.map(item => item.total_visits) // Total pengunjung per bulan
        }],
        xaxis: {
            categories: visitorData.map(item => item.month) // Nama bulan
        },
        yaxis: {
            show: true,
        },
        stroke: {
            curve: 'smooth',
        },
        fill: {
            type: 'gradient',
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
            },
        },
        dataLabels: {
            enabled: false
        },
        tooltip: {
            enabled: true,
            y: {
                formatter: function (val) {
                    return val + " Visitors";
                }
            }
        }
    };

    if (areaChartElement && typeof ApexCharts !== 'undefined') {
        const areaChart = new ApexCharts(areaChartElement, areaChartOptions);
        areaChart.render();
    }
