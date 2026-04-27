<?php 
include('SessionValidation.php');
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
                    <a href="HomePage.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Home
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
                                <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full active" href="#">
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
                                <!-- <ul class="icon-nav flex items-center gap-6">
                                    <li class="relative notification-badge">
                                        <a class="text-xl icon-hover cursor-pointer text-heading" href="#">
                                            <i class="ti ti-bell-ringing relative z-[1]"></i>
                                            <span class="notification-count">3</span>
                                        </a>
                                    </li> -->
                                    <!-- <li class="hs-dropdown relative inline-flex [--placement:bottom-right] sm:[--trigger:hover]">
                                        <a class="relative hs-dropdown-toggle cursor-pointer align-middle rounded-full">
                                            <img class="object-cover w-9 h-9 rounded-full" src="../Assets/Templates/Admin/assets/images/profile/user-1.jpg" alt="Admin" aria-hidden="true">
                                        </a> -->
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
                                    </li>
                                </ul>
                            </nav>
                        </header>