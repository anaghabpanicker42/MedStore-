<?php
include("../Assets/Connection/Connection.php");
session_start();
include('Header.php');

$selQry="select * from tbl_user where user_id='".$_SESSION['uid']."'";
$res=$Con->query($selQry);
$data=$res->fetch_assoc();
$uspassword=$data['user_password'];
if(isset($_POST['btn_submit']))
{
    $oldpass=$_POST['txt_oldpass'];
    $newpass=$_POST['txt_newpass'];
    $repass=$_POST['txt_retype'];
    if($uspassword==$oldpass)
    {
        if($newpass==$repass)
        {
            $upQry="update tbl_user set user_password='".$newpass."' where user_id='".$_SESSION['uid']."'";
            if($Con->query($upQry))
            {
                ?>
                <script>
                alert("Password Changed Successfully");
                window.location="MyProfile.php";
                </script>
                <?php
            }
        }
        else
        {
            ?>
            <script>
            alert("Passwords do not match");
            window.location="ChangePassword.php";
            </script>
            <?php
        }
    }
    else
    {
        ?>
        <script>
        alert("Incorrect current password");
        window.location="ChangePassword.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8fafc; /* Very light blue background */
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    
    .password-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 82, 163, 0.1);
        padding: 30px;
        width: 400px;
        max-width: 90%;
    }
    
    .password-header {
        text-align: center;
        margin-bottom: 25px;
    }
    
    .password-header h2 {
        margin: 0;
        font-size: 24px;
        color: #0052a3; /* Dark blue */
        font-weight: 600;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table td {
        padding: 12px 0;
    }
    
    .form-label {
        font-weight: 500;
        color: #0052a3; /* Dark blue */
        padding-right: 15px;
    }
    
    .form-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cce0ff; /* Light blue border */
        border-radius: 4px;
        font-size: 14px;
        transition: all 0.2s;
        background-color: white;
    }
    
    .form-input:focus {
        border-color: #0052a3;
        box-shadow: 0 0 0 2px rgba(0, 82, 163, 0.2);
        outline: none;
    }
    
    .input-hint {
        font-size: 12px;
        color: #6699cc; /* Medium blue */
        margin-top: 5px;
        display: block;
    }
    
    .button-group {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 25px;
    }
    
    .btn-submit {
        background-color: #0052a3; /* Dark blue */
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 15px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.2s;
        font-weight: 500;
    }
    
    .btn-submit:hover {
        background-color: #003d7a; /* Darker blue */
    }
    
    .btn-cancel {
        background-color: white;
        color: #0052a3;
        border: 1px solid #0052a3;
        padding: 10px 20px;
        font-size: 15px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 500;
    }
    
    .btn-cancel:hover {
        background-color: #f0f7ff; /* Very light blue */
    }
    
    @media (max-width: 480px) {
        .password-container {
            padding: 20px;
        }
        
        .form-table td {
            display: block;
            padding: 8px 0;
        }
        
        .button-group {
            flex-direction: column;
            gap: 10px;
        }
        
        .btn-submit, .btn-cancel {
            width: 100%;
        }
    }
</style>
</head>

<body>
<div class="password-container">
    <div class="password-header">
        <h2>Change Password</h2>
    </div>
    
    <form id="form1" name="form1" method="post" action="">
        <table class="form-table">
            <tr>
                <td class="form-label">Current Password</td>
                <td>
                    <input type="password" class="form-input" name="txt_oldpass" id="txt_oldpass" required />
                </td>
            </tr>
            <tr>
                <td class="form-label">New Password</td>
                <td>
                    <input type="password" class="form-input" name="txt_newpass" id="txt_newpass" required
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
                    <span class="input-hint">Minimum 8 characters with at least one uppercase, one lowercase and one number</span>
                </td>
            </tr>
            <tr>
                <td class="form-label">Confirm Password</td>
                <td>
                    <input type="password" class="form-input" name="txt_retype" id="txt_retype" required />
                </td>
            </tr>
        </table>
        
        <div class="button-group">
            <input type="submit" name="btn_submit" id="btn_submit" value="Change Password" class="btn-submit" />
            <input type="reset" name="btn_clear" id="btn_clear" value="Cancel" class="btn-cancel" />
        </div>
    </form>
</div>
</body>
</html>
<?php
include('Footer.php');
?>