<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");

$SelQry="select * from tbl_pharmacy ph INNER JOIN tbl_place p on ph.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id  where pharmacy_id='".$_SESSION['pid']."'";
$res=$Con->query($SelQry);
$data=$res->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pharmacy Profile</title>
<style>
    :root {
        --primary-blue: #1976D2;
        --dark-blue: #0D47A1;
        --light-blue: #E3F2FD;
        --white: #FFFFFF;
        --light-gray: #F5F5F5;
        --text-dark: #212121;
        --text-light: #757575;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--light-gray);
        margin: 0;
        padding: 20px;
        color: var(--text-dark);
    }
    
    .profile-container {
        max-width: 600px;
        margin: 30px auto;
        background-color: var(--white);
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .profile-header {
        background-color: var(--primary-blue);
        color: var(--white);
        padding: 20px;
        text-align: center;
        font-size: 24px;
        font-weight: 500;
    }
    
    .profile-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid var(--white);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        margin: 20px auto;
        display: block;
    }
    
    .profile-details {
        padding: 20px;
    }
    
    .detail-row {
        display: flex;
        border-bottom: 1px solid #E0E0E0;
        padding: 15px 0;
    }
    
    .detail-label {
        width: 150px;
        font-weight: 600;
        color: var(--primary-blue);
    }
    
    .detail-value {
        flex: 1;
        color: var(--text-dark);
    }
    
    .action-buttons {
        display: flex;
        justify-content: center;
        padding: 20px;
        gap: 15px;
    }
    
    .action-btn {
        padding: 10px 20px;
        background-color: var(--primary-blue);
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .action-btn:hover {
        background-color: var(--dark-blue);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
</head>

<body>
    <div class="profile-container">
        <div class="profile-header">Pharmacy Profile</div>
        
        <img src="../Assets/Files/Pharmacy/<?php echo $data['pharmacy_photo'] ?>" class="profile-photo" alt="Pharmacy Photo" />
        
        <div class="profile-details">
            <div class="detail-row">
                <div class="detail-label">Name</div>
                <div class="detail-value"><?php echo $data['pharmacy_name']?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Email</div>
                <div class="detail-value"><?php echo $data['pharmacy_email']?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Contact</div>
                <div class="detail-value"><?php echo $data['pharmacy_contact']?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Address</div>
                <div class="detail-value"><?php echo $data['pharmacy_address']?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">District</div>
                <div class="detail-value"><?php echo $data['district_name']?></div>
            </div>
            
            <div class="detail-row" style="border-bottom: none;">
                <div class="detail-label">Place</div>
                <div class="detail-value"><?php echo $data['place_name']?></div>
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="EditProfile.php" class="action-btn">Edit Profile</a>
            <a href="ChangePassword.php" class="action-btn">Change Password</a>
        </div>
    </div>
</body>
</html>
<?php
include("Footer.php");
?>