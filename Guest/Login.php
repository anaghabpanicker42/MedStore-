<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include('Header.php');
if(isset($_POST['btn_submit']))
{
    $email=$_POST['txt_email'];
    $pass=$_POST['txt_pass'];
    
    $SelAdmin="select * from tbl_admin where admin_email='".$email."' and admin_password='".$pass."'";
    $rowAdmin=$Con->query($SelAdmin);
    
    $SelUser="select * from tbl_user where user_email='".$email."' and user_password='".$pass."'";
    $rowUser=$Con->query($SelUser);
    
     $SelPharmacy="select * from tbl_pharmacy where pharmacy_email='".$email."' and pharmacy_password='".$pass."'";
    $rowPharmacy=$Con->query($SelPharmacy);
    
    $SelDeliveryboy="select * from tbl_deliveryboy where deliveryboy_email='".$email."' and deliveryboy_password='".$pass."'";
    $rowDeliveryboy=$Con->query($SelDeliveryboy);
    
    if($dataAdmin=$rowAdmin->fetch_assoc())
    {
        $_SESSION["aid"]=$dataAdmin['admin_id'];
        $_SESSION["aname"]=$dataAdmin['admin_name'];
        header("location:../Admin/HomePage.php");
    }
    else if($dataUser=$rowUser->fetch_assoc())
    {
        $_SESSION["uid"]=$dataUser['user_id'];
        $_SESSION["uname"]=$dataUser['user_name'];
        header("location:../User/HomePage.php");
    }
    else if($dataPharmacy=$rowPharmacy->fetch_assoc())
    {
        $_SESSION["pid"]=$dataPharmacy['pharmacy_id'];
        $_SESSION["pname"]=$dataPharmacy['pharmacy_name'];
        header("location:../Pharmacy/HomePage.php");
    }
    else if($dataDeliveryboy=$rowDeliveryboy->fetch_assoc())
    {
        $_SESSION["dbid"]=$dataDeliveryboy['deliveryboy_id'];
        $_SESSION["dbname"]=$dataDeliveryboy['deliveryboy_name'];
        header("location:../Deliveryboy/HomePage.php");
    }
    else
    {
        ?>
        <script>
            alert("Account not found");
        </script>
        <?php
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    
    .login-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 350px;
        max-width: 90%;
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }
    
    .login-header h2 {
        margin: 0;
        font-size: 24px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
    }
    
    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s;
    }
    
    .form-group input:focus {
        border-color: #4a90e2;
        outline: none;
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
    }
    
    .btn-submit {
        width: 100%;
        padding: 12px;
        background-color: #4a90e2;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .btn-submit:hover {
        background-color: #3a7bc8;
    }
    
    .forgot-password {
        text-align: center;
        margin-top: 15px;
    }
    
    .forgot-password a {
        color: #4a90e2;
        text-decoration: none;
        font-size: 14px;
    }
    
    .forgot-password a:hover {
        text-decoration: underline;
    }
    
    .error-message {
        color: #e74c3c;
        text-align: center;
        margin-bottom: 15px;
        font-size: 14px;
    }
</style>
</head>

<body>
<div class="login-container">
    <div class="login-header">
        <h2>Login to Your Account</h2>
    </div>
    
    <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
            <label for="txt_email">Email</label>
            <input type="email" name="txt_email" id="txt_email" placeholder="Enter your email" required />
        </div>
        
        <div class="form-group">
            <label for="txt_pass">Password</label>
            <input type="password" name="txt_pass" id="txt_pass" placeholder="Enter your password" required />
        </div>
        
        <div class="form-group">
            <input type="submit" name="btn_submit" id="btn_submit" class="btn-submit" value="Login" />
        </div>
        
        <!-- <div class="forgot-password">
            <a href="#">Forgot password?</a>
        </div> -->
    </form>
</div>
</body>
</html>
<?php
ob_flush();
include('Footer.php');
?>