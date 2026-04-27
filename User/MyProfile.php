<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");


$SelQry="select * from tbl_user u INNER JOIN tbl_place p on u.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id  where user_id='".$_SESSION['uid']."'";
$res=$Con->query($SelQry);
$data=$res->fetch_assoc();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Profile</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #e6f2ff; /* Light blue background */
        margin: 0;
        padding: 20px;
        color: #2c3e50;
    }
    
    .profile-container {
        max-width: 600px;
        margin: 30px auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 102, 204, 0.1); /* Blue tinted shadow */
        border: 1px solid #cce0ff; /* Light blue border */
        overflow: hidden;
    }
    
    .profile-header {
        background-color: #0066cc; /* Dark blue header */
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    .profile-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 600;
    }
    
    .profile-image {
        text-align: center;
        padding: 20px;
        background-color: #f5f9ff; /* Very light blue background */
    }
    
    .profile-image img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .profile-details {
        padding: 0 20px;
    }
    
    .profile-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .profile-table tr {
        border-bottom: 1px solid #e6f0ff; /* Very light blue border */
    }
    
    .profile-table tr:last-child {
        border-bottom: none;
    }
    
    .profile-table td {
        padding: 15px 10px;
    }
    
    .profile-label {
        font-weight: 500;
        color: #0066cc; /* Blue label color */
        width: 30%;
    }
    
    .profile-value {
        color: #333;
    }
    
    .profile-actions {
        padding: 20px;
        text-align: center;
        background-color: #f5f9ff; /* Very light blue background */
    }
    
    .profile-btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 0 10px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-edit {
        background-color: #0066cc; /* Blue button */
        color: white;
    }
    
    .btn-edit:hover {
        background-color: #0052a3; /* Darker blue on hover */
    }
    
    .btn-password {
        background-color: #4CAF50; /* Green button */
        color: white;
    }
    
    .btn-password:hover {
        background-color: #3e8e41; /* Darker green on hover */
    }
    
    @media (max-width: 600px) {
        .profile-container {
            margin: 15px;
        }
        
        .profile-table td {
            display: block;
            width: 100%;
            padding: 10px 0;
        }
        
        .profile-label {
            width: 100%;
            margin-bottom: 5px;
        }
        
        .profile-actions {
            padding: 15px;
        }
        
        .profile-btn {
            display: block;
            margin: 10px auto;
            width: 80%;
        }
    }
</style>
</head>

<body>
<div class="profile-container">
    <div class="profile-header">
        <h2>My Profile</h2>
    </div>
    
    <div class="profile-image">
        <img src="../Assets/Files/User/<?php echo $data['user_proof'] ?>" alt="Profile Picture" />
    </div>
    
    <div class="profile-details">
        <table class="profile-table">
            <tr>
                <td class="profile-label">Name</td>
                <td class="profile-value"><?php echo $data['user_name'] ?></td>
            </tr>
            <tr>
                <td class="profile-label">Email</td>
                <td class="profile-value"><?php echo $data['user_email']?></td>
            </tr>
            <tr>
                <td class="profile-label">Contact</td>
                <td class="profile-value"><?php echo $data['user_phone']?></td>
            </tr>
            <tr>
                <td class="profile-label">Address</td>
                <td class="profile-value"><?php echo $data['user_address']?></td>
            </tr>
            <tr>
                <td class="profile-label">District</td>
                <td class="profile-value"><?php echo $data['district_name']?></td>
            </tr>
            <tr>
                <td class="profile-label">Place</td>
                <td class="profile-value"><?php echo $data['place_name']?></td>
            </tr>
        </table>
    </div>
    
    <div class="profile-actions">
        <a href="EditProfile.php" class="profile-btn btn-edit">Edit Profile</a>
        <a href="ChangePassword.php" class="profile-btn btn-password">Change Password</a>
    </div>
</div>
</body>
</html>
<?php
include('Footer.php');
?>