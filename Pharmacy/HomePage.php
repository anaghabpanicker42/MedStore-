<?php
include("SessionValidation.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pharmacy Dashboard</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background: linear-gradient(135deg, #f8f9ff 0%, #e6f0ff 100%);
        color: #2c3e50;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    
    .header {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        padding: 15px 0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    
    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .logo {
        font-size: 24px;
        font-weight: bold;
        display: flex;
        align-items: center;
    }
    
    .logo-icon {
        margin-right: 10px;
        font-size: 28px;
    }
    
    .nav-links {
        display: flex;
        gap: 10px;
    }
    
    .nav-link {
        color: white;
        text-decoration: none;
        padding: 10px 15px;
        border-radius: 6px;
        transition: all 0.3s;
        font-weight: 500;
        display: flex;
        align-items: center;
        font-size: 14px;
    }
    
    .nav-link i {
        margin-right: 6px;
    }
    
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
    }
    
    .main-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
    }
    
    .welcome-container {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(52, 152, 219, 0.1);
        text-align: center;
        width: 100%;
        max-width: 700px;
        margin-bottom: 40px;
    }
    
    .welcome-icon {
        font-size: 60px;
        margin-bottom: 20px;
        color: #3498db;
    }
    
    .welcome-title {
        font-size: 28px;
        color: #2c3e50;
        margin-bottom: 10px;
        font-weight: 600;
    }
    
    .username {
        color: #3498db;
        font-size: 32px;
        font-weight: bold;
        text-transform: capitalize;
        padding: 10px 20px;
        border-bottom: 3px solid #b3dcff;
        display: inline-block;
        margin-bottom: 20px;
    }
    
    .welcome-subtitle {
        color: #7f8c8d;
        font-size: 16px;
        margin-bottom: 10px;
    }
    
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        width: 100%;
        max-width: 1000px;
    }
    
    .dashboard-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        border: 1px solid #e8f4ff;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(52, 152, 219, 0.15);
        border-color: #3498db;
    }
    
    .card-icon {
        font-size: 45px;
        margin-bottom: 15px;
        color: #3498db;
    }
    
    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
    }
    
    .card-description {
        color: #7f8c8d;
        font-size: 14px;
        line-height: 1.5;
    }
    
    .footer {
        background: #2c3e50;
        color: white;
        text-align: center;
        padding: 20px;
        margin-top: auto;
    }
    
    .footer p {
        font-size: 14px;
    }
    
    @media (max-width: 900px) {
        .dashboard-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .nav-container {
            flex-direction: column;
            gap: 15px;
        }
        
        .nav-links {
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
        
        .welcome-container {
            padding: 25px;
        }
        
        .welcome-title {
            font-size: 24px;
        }
        
        .username {
            font-size: 26px;
        }
    }
    
    @media (max-width: 480px) {
        .nav-links {
            flex-direction: column;
            width: 100%;
        }
        
        .nav-link {
            text-align: center;
            justify-content: center;
        }
    }
</style>
</head>

<body>
    <div class="header">
        <div class="nav-container">
            <div class="logo">
                <span class="logo-icon">💊</span>
                <span>Pharmacy Dashboard</span>
            </div>
            <div class="nav-links">
                <a href="MyProfile.php" class="nav-link">👤 Profile</a>
                <a href="../Logout.php" class="nav-link">🚪 Logout</a>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        <div class="welcome-container">
            <div class="welcome-icon">👋</div>
            <h1 class="welcome-title">Welcome to Your Pharmacy Dashboard</h1>
            <div class="username"><?php echo $_SESSION['pname'] ?></div>
            <p class="welcome-subtitle">Manage your pharmacy operations efficiently</p>
        </div>
        
        <div class="dashboard-grid">
            
            
            <a href="MyCart.php" class="dashboard-card">
                <div class="card-icon">🛒</div>
                <div class="card-title">Cart Management</div>
                <div class="card-description">View and manage customer shopping carts</div>
            </a>
            
            <a href="Product.php" class="dashboard-card">
                <div class="card-icon">📦</div>
                <div class="card-title">Product Management</div>
                <div class="card-description">Add, edit, and manage your product inventory</div>
            </a>
            
            <a href="ViewBooking.php" class="dashboard-card">
                <div class="card-icon">📋</div>
                <div class="card-title">View Bookings</div>
                <div class="card-description">Check and manage customer bookings and orders</div>
            </a>
            
            <a href="ViewRequest.php" class="dashboard-card">
                <div class="card-icon">📝</div>
                <div class="card-title">View Requests</div>
                <div class="card-description">Review and process customer requests</div>
            </a>
        </div>
    </div>
    
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> Pharmacy Management System. All rights reserved.</p>
    </div>
</body>
</html>