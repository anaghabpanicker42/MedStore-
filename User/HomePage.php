<?php
include('SessionValidation.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Dashboard</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e5e6 100%);
        color: #333;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    
    .header {
        background: linear-gradient(135deg, #1e88e5 0%, #0d47a1 100%);
        color: white;
        padding: 20px 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
        gap: 15px;
    }
    
    .nav-link {
        color: white;
        text-decoration: none;
        padding: 10px 15px;
        border-radius: 5px;
        transition: all 0.3s;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    
    .nav-link i {
        margin-right: 8px;
    }
    
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
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
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 100%;
        max-width: 700px;
        margin-bottom: 40px;
    }
    
    .welcome-icon {
        font-size: 60px;
        margin-bottom: 20px;
        color: #1e88e5;
    }
    
    .welcome-message {
        font-size: 28px;
        color: #0d47a1;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .username {
        color: #1e88e5;
        font-size: 32px;
        font-weight: bold;
        text-transform: capitalize;
        padding: 10px 20px;
        border-bottom: 3px solid #bbdefb;
        display: inline-block;
        margin-bottom: 20px;
    }
    
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        width: 100%;
        max-width: 1000px;
    }
    
    .dashboard-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(30, 136, 229, 0.15);
    }
    
    .card-icon {
        font-size: 40px;
        margin-bottom: 15px;
        color: #1e88e5;
    }
    
    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: #0d47a1;
        margin-bottom: 10px;
    }
    
    .card-description {
        color: #666;
        font-size: 14px;
    }
    
    .footer {
        background: #1e88e5;
        color: white;
        text-align: center;
        padding: 20px;
        margin-top: auto;
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
        
        .welcome-message {
            font-size: 24px;
        }
        
        .username {
            font-size: 26px;
        }
    }
</style>
</head>

<body>
    <div class="header">
        <div class="nav-container">
            <div class="logo">
                <span class="logo-icon">💊</span>
                <span>MedStore</span>
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
            <div class="welcome-message">Welcome Back</div>
            <div class="username"><?php echo $_SESSION['uname'] ?></div>
            <p>We're glad to see you again. What would you like to do today?</p>
        </div>
        
        <div class="dashboard-grid">
            <a href="ViewPharmacy.php" class="dashboard-card">
                <div class="card-icon">🏥</div>
                <div class="card-title">Pharmacy</div>
                <div class="card-description">Browse and order from our pharmacy</div>
            </a>
            
            <a href="Request.php" class="dashboard-card">
                <div class="card-icon">📋</div>
                <div class="card-title">Request</div>
                <div class="card-description">Submit prescription requests</div>
            </a>
            
            <a href="MyCart.php" class="dashboard-card">
                <div class="card-icon">🛒</div>
                <div class="card-title">My Cart</div>
                <div class="card-description">View your shopping cart</div>
            </a>
            
            <a href="MyBooking.php" class="dashboard-card">
                <div class="card-icon">📅</div>
                <div class="card-title">My Bookings</div>
                <div class="card-description">Manage your appointments</div>
            </a>
            
            <a href="Feedback.php" class="dashboard-card">
                <div class="card-icon">💬</div>
                <div class="card-title">Feedback</div>
                <div class="card-description">Share your experience with us</div>
            </a>
            
            <a href="Complaint.php" class="dashboard-card">
                <div class="card-icon">⚠️</div>
                <div class="card-title">Complaints</div>
                <div class="card-description">Report any issues or concerns</div>
            </a>
        </div>
    </div>
    
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> MediCare. All rights reserved.</p>
    </div>
</body>
</html>

<?php
include('Footer.php');
?>