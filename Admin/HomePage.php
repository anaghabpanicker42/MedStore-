<?php 
include("../Assets/Connection/Connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../Assets/Templates/Admin/assets/images/logos/favicon.png" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <!-- Core CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/theme.css" />
    <style>
        .custom-header {
            background: linear-gradient(90deg, #0f0533 0%, #1b0a5c 100%);
            padding: 15px 20px;
            color: white;
        }
        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .notification-badge {
            position: relative;
            cursor: pointer;
        }
        .notification-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
        }
        .sidebar-link.active {
            background-color: #eef2ff;
            color: #4f46e5;
        }
        .sidebar-link.active i {
            color: #4f46e5;
        }
        .chart-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-surface">
    <main>
        <!-- Header with Admin Registration -->
        <div class="custom-header">
            <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
                <div class="flex items-center gap-5">
                    <a href="../">
                        <img src="../Assets/Templates/Admin/assets/images/logos/logo-light.svg" width="147" alt="logo" />
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <h4 class="text-sm font-normal text-white uppercase font-semibold">Admin Dashboard</h4>
                    <a href="AdminRegistration.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Admin Registration
                    </a>
                </div>
            </div>
        </div>

        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            <!-- Sidebar -->
            <aside class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-[90px] xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0 w-[270px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar transition-all duration-300">
                <div class="p-4">
                    <a href="../" class="text-nowrap">
                        <img src="../Assets/Templates/Admin/assets/images/logos/logo-light.svg" alt="Logo" width="120" />
                    </a>
                </div>
                <div class="scroll-sidebar" data-simplebar="">
                    <nav class="w-full flex flex-col sidebar-nav px-4 mt-5">
                        <ul id="sidebarnav" class="text-gray-600 text-sm">
                            <li class="text-xs font-bold pb-[5px]">
                                <span class="text-xs text-gray-400 font-semibold">MAIN NAVIGATION</span>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full active" href="Homepage.php">
                                    <i class="ti ti-layout-dashboard ps-2 text-2xl"></i> 
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li class="text-xs font-bold mb-4 mt-6">
                                <span class="text-xs text-gray-400 font-semibold">MANAGEMENT</span>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full" href="DeliveryVerification.php">
                                    <i class="ti ti-user-check ps-2 text-2xl"></i> 
                                    <span>Delivery Boy Verification</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full" href="PharmacyVerification.php">
                                    <i class="ti ti-building-store ps-2 text-2xl"></i> 
                                    <span>Pharmacy Verification</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full" href="District.php">
                                    <i class="ti ti-map-pin ps-2 text-2xl"></i> 
                                    <span>District Management</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full" href="Place.php">
                                    <i class="ti ti-location ps-2 text-2xl"></i> 
                                    <span>Place Management</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full" href="Brand.php">
                                    <i class="ti ti-location ps-2 text-2xl"></i> 
                                    <span>Brand</span>
                                </a>
                            </li>

                            <li class="text-xs font-bold mb-4 mt-6">
                                <span class="text-xs text-gray-400 font-semibold">SUPPORT</span>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full" href="ViewComplaint.php">
                                    <i class="ti ti-alert-circle ps-2 text-2xl"></i> 
                                    <span>View Complaints</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                               
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full" href="../Logout.php">
                                    <i class="ti ti-message-circle ps-2 text-2xl"></i> 
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="w-full page-wrapper xl:px-6 px-0">
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        <!-- Header with admin info and notifications -->
                        <header class="bg-white shadow-md rounded-md w-full text-sm py-4 px-6">
                            <nav class="w-full flex items-center justify-between" aria-label="Global">
                                <div class="flex items-center gap-4">
                                    <h2 class="text-xl font-semibold text-gray-700">Welcome, <?php echo $_SESSION['aname'] ?? 'Admin'; ?></h2>
                                </div>
                                <ul class="icon-nav flex items-center gap-6">
                                    <!-- <li class="relative notification-badge">
                                        <a class="text-xl icon-hover cursor-pointer text-heading" href="#">
                                            <i class="ti ti-bell-ringing relative z-[1]"></i>
                                            <span class="notification-count">3</span>
                                        </a>
                                    </li> -->
                                    <!-- <li class="hs-dropdown relative inline-flex [--placement:bottom-right] sm:[--trigger:hover]">
                                        <a class="relative hs-dropdown-toggle cursor-pointer align-middle rounded-full">
                                            <img class="object-cover w-9 h-9 rounded-full" src="../Assets/Templates/Admin/assets/images/profile/user-1.jpg" alt="Admin" aria-hidden="true">
                                        </a>
                                        <div class="card hs-dropdown-menu transition-[opacity,margin] rounded-md duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max w-[200px] hidden z-[12]" aria-labelledby="hs-dropdown-custom-icon-trigger">
                                            <div class="card-body p-0 py-2">
                                                <a href="javscript:void(0)" class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                                                    <i class="ti ti-user text-xl"></i>
                                                    <p class="text-sm">My Profile</p>
                                                </a>
                                                <a href="javscript:void(0)" class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                                                    <i class="ti ti-settings text-xl"></i>
                                                    <p class="text-sm">Settings</p>
                                                </a>
                                                <div class="px-4 mt-[7px] grid">
                                                    <a href="../Assets/Templates/Admin/pages/authentication-login.html" class="btn-outline-primary font-medium text-[15px] w-full hover:bg-blue-600 hover:text-white">Logout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li> -->
                                </ul>
                            </nav>
                        </header>

                        <!-- Dashboard Content -->
                        <div class="">
                            <!-- Profit & Expenses Chart -->
                            <!-- <div class="col-span-2">
                                <div class="chart-container">
                                    <div class="flex justify-between mb-5">
                                        <h4 class="text-gray-500 text-lg font-semibold">Profit & Expenses</h4>
                                        <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                                            <a class="relative hs-dropdown-toggle cursor-pointer align-middle rounded-full">
                                                <i class="ti ti-dots-vertical text-2xl text-gray-400"></i>
                                            </a>
                                            <div class="card hs-dropdown-menu transition-[opacity,margin] rounded-md duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max w-[150px] hidden z-[12]" aria-labelledby="hs-dropdown-custom-icon-trigger">
                                                <div class="card-body p-0 py-2">
                                                    <a href="javscript:void(0)" class="flex gap-2 items-center font-medium px-4 py-2.5 hover:bg-gray-200 text-gray-400">
                                                        <p class="text-sm">View Report</p>
                                                    </a>
                                                    <a href="javscript:void(0)" class="flex gap-2 items-center font-medium px-4 py-2.5 hover:bg-gray-200 text-gray-400">
                                                        <p class="text-sm">Export</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="profit" style="min-height: 300px;"></div>
                                </div>
                            </div> -->
                            
                            <!-- Product Sales & Stats -->
                            <!-- <div class="flex flex-col gap-6">
                                <div class="chart-container">
                                    <h4 class="text-gray-500 text-lg font-semibold mb-4">Product Sales</h4>
                                    <div class="flex items-center justify-between gap-4">
                                        <div>
                                            <h3 class="text-[22px] font-semibold text-gray-500 mb-4">$36,358</h3>
                                            <div class="flex items-center gap-1 mb-3">
                                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-teal-400">
                                                    <i class="ti ti-arrow-up-left text-teal-500 text-xs"></i>
                                                </span>
                                                <p class="text-gray-500 text-sm font-normal">+9%</p>
                                                <p class="text-gray-400 text-sm font-normal text-nowrap">last year</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <div id="sales-chart" style="width: 100px; height: 100px;"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="chart-container">
                                    <div class="flex gap-6 items-center justify-between">
                                        <div class="flex flex-col gap-4">
                                            <h4 class="text-gray-500 text-lg font-semibold">Monthly Revenue</h4>
                                            <div class="flex flex-col gap-4">
                                                <h3 class="text-[22px] font-semibold text-gray-500">$6,820</h3>
                                                <div class="flex items-center gap-1">
                                                    <span class="flex items-center justify-center w-5 h-5 rounded-full bg-red-400">
                                                        <i class="ti ti-arrow-down-right text-red-500 text-xs"></i>
                                                    </span>
                                                    <p class="text-gray-500 text-sm font-normal">-3%</p>
                                                    <p class="text-gray-400 text-sm font-normal text-nowrap">last month</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-11 h-11 flex justify-center items-center rounded-full bg-blue-500 text-white self-start">
                                            <i class="ti ti-currency-dollar text-xl"></i>
                                        </div>
                                    </div>
                                    <div id="revenue-chart" style="min-height: 80px; margin-top: 15px;"></div>
                                </div>
                            </div>
                        </div> -->

                        <!-- Quick Stats -->
                        <div style="width: 100%;display: flex;flex-wrap: wrap;gap: 4rem;justify-content: center;">
                            <div class="chart-container flex items-center gap-4" style="width: 390px;">
                                <div class="w-12 h-12 flex justify-center items-center rounded-full bg-blue-100 text-blue-600">
                                    <i class="ti ti-users text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">Total Users</p>
                                    <?php
                                    $selQry="select count(*) as totaluser from tbl_user";
                                    $data=$Con->query($selQry);
                                    $res=$data->fetch_assoc();
                                    ?>
                                    <h3 class="text-xl font-semibold text-gray-700"><?php echo $res['totaluser'];?></h3>
                                </div>
                            </div>
                            
                            <div class="chart-container flex items-center gap-4" style="width: 390px;">
                                <div class="w-12 h-12 flex justify-center items-center rounded-full bg-green-100 text-green-600">
                                    <i class="ti ti-building-store text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">Pharmacies</p>
                                    <?php
                                    $selQry="select count(*) as totalpharmacy from tbl_pharmacy where pharmacy_status=1";
                                    $data=$Con->query($selQry);
                                    $res=$data->fetch_assoc();
                                    ?>
                                    <h3 class="text-xl font-semibold text-gray-700"><?php echo $res['totalpharmacy'];?></h3>
                                </div>
                            </div>
                            
                            <div class="chart-container flex items-center gap-4" style="width: 390px;">
                                <div class="w-12 h-12 flex justify-center items-center rounded-full bg-purple-100 text-purple-600">
                                    <i class="ti ti-truck-delivery text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">Delivery Boys</p>
                                    <?php
                                    $selQry="select count(*) as totaldboy from tbl_deliveryboy where deliveryboy_status=1";
                                    $data=$Con->query($selQry);
                                    $res=$data->fetch_assoc();
                                    ?>

                                    <h3 class="text-xl font-semibold text-gray-700"><?php echo $res['totaldboy'];?></h3>
                                </div>
                            </div>
                            
                            <div class="chart-container flex items-center gap-4" style="width: 390px;">
                                <div class="w-12 h-12 flex justify-center items-center rounded-full bg-orange-100 text-orange-600">
                                    <i class="ti ti-message-circle text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">Pending Complaints</p>
                                    <?php
                                    $selQry="select count(*) as complaints from tbl_complaint where complaint_status=0";
                                    $data=$Con->query($selQry);
                                    $res=$data->fetch_assoc();
                                    ?>
                                    <h3 class="text-xl font-semibold text-gray-700"><?php echo $res['complaints'];?></h3>
                                </div>
                            </div>
                        </div>

                        <!-- <footer>
                            <p class="text-base text-gray-400 font-normal p-3 text-center">
                                Admin Dashboard &copy; <?php echo date('Y'); ?>
                            </p>
                        </footer> -->
                    </div>
                </main>
            </div>
        </div>
    </main>

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