
    <script src="../Assets/Templates/Admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/libs/iconify-icon/dist/iconify-icon.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/libs/@preline/dropdown/index.js"></script>
    <script src="../Assets/Templates/Admin/assets/libs/@preline/overlay/index.js"></script>
    <script src="../Assets/Templates/Admin/assets/js/sidebarmenu.js"></script>
    <script src="../Assets/Templates/Admin/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Profit & Expenses Chart
            var profitOptions = {
                series: [{
                    name: 'Profit',
                    data: [30, 40, 35, 50, 49, 60, 70, 91, 125, 100, 97, 120]
                }, {
                    name: 'Expenses',
                    data: [20, 25, 30, 35, 40, 35, 45, 50, 60, 70, 65, 75]
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#4f46e5', '#ef4444'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                }
            };

            var profitChart = new ApexCharts(document.querySelector("#profit"), profitOptions);
            profitChart.render();

            // Sales Chart (Pie)
            var salesOptions = {
                series: [75, 25],
                chart: {
                    width: 100,
                    type: 'donut',
                },
                colors: ['#4f46e5', '#e5e7eb'],
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '80%'
                        }
                    }
                },
                stroke: {
                    width: 0
                },
                states: {
                    hover: {
                        filter: {
                            type: 'none'
                        }
                    }
                }
            };

            var salesChart = new ApexCharts(document.querySelector("#sales-chart"), salesOptions);
            salesChart.render();

            // Revenue Chart (Mini)
            var revenueOptions = {
                series: [{
                    data: [30, 40, 35, 50, 49, 60, 70, 91]
                }],
                chart: {
                    type: 'bar',
                    height: 80,
                    sparkline: {
                        enabled: true
                    }
                },
                colors: ['#4f46e5'],
                plotOptions: {
                    bar: {
                        columnWidth: '60%'
                    }
                },
                xaxis: {
                    crosshairs: {
                        width: 1
                    },
                },
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function (seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            };

            var revenueChart = new ApexCharts(document.querySelector("#revenue-chart"), revenueOptions);
            revenueChart.render();
        });
    </script>
</body>
</html>