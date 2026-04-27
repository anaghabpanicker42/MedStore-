<?php
include("../Assets/Connection/Connection.php");
//session_start();
include("Header.php");

// Check if delivery boy is logged in
if(!isset($_SESSION['dbid'])) {
    header("Location: login.php");
    exit();
}

$SelQry = "select * from tbl_deliveryboy db INNER JOIN tbl_place p on db.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id where deliveryboy_id='".$_SESSION['dbid']."'";
$res = $Con->query($SelQry);
$data = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delivery Boy Profile | Medstore</title>
<style>
    :root {
        --primary-blue: #1a73e8;
        --primary-dark-blue: #0d47a1;
        --primary-light-blue: #e8f0fe;
        --secondary-blue: #4285f4;
        --accent-blue: #2962ff;
        --text-dark: #202124;
        --text-gray: #5f6368;
        --border-light: #dadce0;
        --background-light: #f8f9fa;
        --white: #ffffff;
        --shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Google Sans', 'Segoe UI', Roboto, Arial, sans-serif;
    }
    
    body {
        background-color: var(--background-light);
        color: var(--text-dark);
        line-height: 1.6;
        padding: 0;
    }
    
    .profile-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .profile-header h1 {
        color: var(--primary-dark-blue);
        font-size: 32px;
        font-weight: 500;
        margin-bottom: 10px;
    }
    
    .profile-header p {
        color: var(--text-gray);
        font-size: 16px;
    }
    
    .profile-card {
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .profile-content {
        display: flex;
        flex-wrap: wrap;
        padding: 30px;
    }
    
    .profile-image-section {
        flex: 1;
        min-width: 280px;
        text-align: center;
        padding: 20px;
        border-right: 1px solid var(--border-light);
    }
    
    .profile-image {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--primary-light-blue);
        box-shadow: var(--shadow);
        margin-bottom: 20px;
    }
    
    .profile-name {
        font-size: 22px;
        font-weight: 500;
        color: var(--primary-dark-blue);
        margin-bottom: 5px;
    }
    
    .profile-role {
        color: var(--text-gray);
        font-size: 14px;
        background: var(--primary-light-blue);
        padding: 4px 12px;
        border-radius: 16px;
        display: inline-block;
        margin-bottom: 20px;
    }
    
    .profile-details {
        flex: 2;
        min-width: 320px;
        padding: 20px 30px;
    }
    
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }
    
    .detail-item {
        margin-bottom: 20px;
    }
    
    .detail-label {
        font-size: 13px;
        font-weight: 500;
        color: var(--text-gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
    }
    
    .detail-label i {
        margin-right: 8px;
        color: var(--primary-blue);
    }
    
    .detail-value {
        font-size: 16px;
        color: var(--text-dark);
        font-weight: 400;
        padding: 8px 12px;
        background: var(--primary-light-blue);
        border-radius: 8px;
        border-left: 3px solid var(--primary-blue);
    }
    
    .action-section {
        background: var(--primary-light-blue);
        padding: 25px 30px;
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .action-btn {
        padding: 12px 24px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .btn-primary {
        background: var(--primary-blue);
        color: var(--white);
        box-shadow: var(--shadow);
    }
    
    .btn-primary:hover {
        background: var(--primary-dark-blue);
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }
    
    .btn-secondary {
        background: var(--white);
        color: var(--primary-blue);
        border: 1px solid var(--primary-blue);
    }
    
    .btn-secondary:hover {
        background: var(--primary-light-blue);
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }
    
    .action-btn i {
        margin-right: 8px;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-content {
            flex-direction: column;
            padding: 20px;
        }
        
        .profile-image-section {
            border-right: none;
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 30px;
        }
        
        .profile-details {
            padding: 20px 0;
        }
        
        .action-section {
            flex-direction: column;
            align-items: center;
        }
        
        .action-btn {
            width: 100%;
            justify-content: center;
        }
        
        .profile-container {
            margin: 20px auto;
            padding: 0 15px;
        }
    }
</style>
</head>

<body>
<div class="profile-container">
    <div class="profile-header">
        <h1>My Profile</h1>
        <p>Manage your delivery account information</p>
    </div>
    
    <div class="profile-card">
        <div class="profile-content">
            <div class="profile-image-section">
                <img src="../Assets/Files/Delivery/<?php echo htmlspecialchars($data['deliveryboy_photo']); ?>" 
                     alt="Profile Photo" class="profile-image" />
                <h2 class="profile-name"><?php echo htmlspecialchars($data['deliveryboy_name']); ?></h2>
                <div class="profile-role">Delivery Partner</div>
            </div>
            
            <div class="profile-details">
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fa fa-envelope"></i> Email Address
                        </div>
                        <div class="detail-value"><?php echo htmlspecialchars($data['deliveryboy_email']); ?></div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fa fa-phone"></i> Contact Number
                        </div>
                        <div class="detail-value"><?php echo htmlspecialchars($data['deliveryboy_contactno']); ?></div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fa fa-map-marker"></i> Address
                        </div>
                        <div class="detail-value"><?php echo htmlspecialchars($data['deliveryboy_address']); ?></div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fa fa-map"></i> District
                        </div>
                        <div class="detail-value"><?php echo htmlspecialchars($data['district_name']); ?></div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fa fa-location-arrow"></i> Place
                        </div>
                        <div class="detail-value"><?php echo htmlspecialchars($data['place_name']); ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="action-section">
            <a href="EditProfile.php" class="action-btn btn-primary">
                <i class="fa fa-edit"></i> Edit Profile
            </a>
            <a href="ChangePassword.php" class="action-btn btn-secondary">
                <i class="fa fa-lock"></i> Change Password
            </a>
        </div>
    </div>
</div>
</body>
</html>
<?php
include('Footer.php');
?>