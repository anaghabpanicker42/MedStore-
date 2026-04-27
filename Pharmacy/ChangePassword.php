<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");
$selQry="select * from tbl_pharmacy where pharmacy_id='".$_SESSION['pid']."'";
$res=$Con->query($selQry);
$data=$res->fetch_assoc();
$phpassword=$data['pharmacy_password'];

if(isset($_POST['btn_update'])) {
    $oldpass=$_POST['txt_oldpass'];
    $newpass=$_POST['txt_newpass'];
    $repass=$_POST['txt_retype'];
    if($phpassword == $oldpass) {
        if($newpass == $repass) {
            $upQry="update tbl_pharmacy set pharmacy_password='".$newpass."' where pharmacy_id='".$_SESSION['pid']."'";
            if($Con->query($upQry)) {
                ?>
                <script>
                alert("Password Changed")
                window.location="MyProfile.php";
                </script>
                <?php
            }
        }
        else {
            ?>
            <script>
            alert("Password not match");
            </script>
            <?php
        }
    }
    else {
        ?>
        <script>
        alert("Enter correct password");
        </script>
        <?php
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pharmacy Password Change</title>
<style>
    :root {
        --primary-blue: #1976D2;
        --dark-blue: #0D47A1;
        --light-blue: #E3F2FD;
        --white: #FFFFFF;
        --light-gray: #F5F5F5;
        --text-dark: #212121;
        --text-light: #757575;
        --error-red: #F44336;
        --success-green: #4CAF50;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--light-gray);
        margin: 0;
        padding: 20px;
        color: var(--text-dark);
    }
    
    .password-container {
        max-width: 500px;
        margin: 30px auto;
        background-color: var(--white);
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        padding: 30px;
    }
    
    .form-header {
        color: var(--primary-blue);
        text-align: center;
        margin-bottom: 30px;
        font-size: 24px;
        font-weight: 500;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--primary-blue);
    }
    
    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: all 0.3s;
    }
    
    .form-input:focus {
        border-color: var(--primary-blue);
        outline: none;
        box-shadow: 0 0 0 2px rgba(25, 118, 210, 0.2);
    }
    
    .input-hint {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 5px;
        display: block;
    }
    
    .password-strength {
        height: 5px;
        background: #eee;
        margin-top: 10px;
        border-radius: 3px;
        overflow: hidden;
    }
    
    .strength-meter {
        height: 100%;
        width: 0;
        background: var(--error-red);
        transition: all 0.3s;
    }
    
    .button-group {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 30px;
    }
    
    .btn {
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }
    
    .btn-primary {
        background-color: var(--primary-blue);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: var(--dark-blue);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .btn-secondary {
        background-color: var(--light-gray);
        color: var(--text-dark);
    }
    
    .btn-secondary:hover {
        background-color: #e0e0e0;
        transform: translateY(-2px);
    }
    
    @media (max-width: 600px) {
        .password-container {
            padding: 20px;
        }
        
        .button-group {
            flex-direction: column;
            gap: 10px;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const newPassInput = document.getElementById('txt_newpass');
        const strengthMeter = document.createElement('div');
        strengthMeter.className = 'strength-meter';
        const strengthContainer = document.createElement('div');
        strengthContainer.className = 'password-strength';
        strengthContainer.appendChild(strengthMeter);
        newPassInput.parentNode.insertBefore(strengthContainer, newPassInput.nextSibling);
        
        newPassInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length > 0) strength += 1;
            if (password.length >= 8) strength += 1;
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            const width = (strength / 5) * 100;
            strengthMeter.style.width = width + '%';
            
            if (strength <= 2) {
                strengthMeter.style.backgroundColor = 'var(--error-red)';
            } else if (strength <= 4) {
                strengthMeter.style.backgroundColor = 'var(--warning)';
            } else {
                strengthMeter.style.backgroundColor = 'var(--success-green)';
            }
        });
    });
</script>
</head>

<body>
    <div class="password-container">
        <h1 class="form-header">Change Password</h1>
        
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label class="form-label" for="txt_oldpass">Old Password</label>
                <input class="form-input" type="password" name="txt_oldpass" id="txt_oldpass" 
                       placeholder="Enter your current password" required />
            </div>
            
            <div class="form-group">
                <label class="form-label" for="txt_newpass">New Password</label>
                <input class="form-input" type="password" name="txt_newpass" id="txt_newpass"
                       placeholder="Enter new password" required 
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                       title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" />
                <span class="input-hint">Must contain at least 8 characters including uppercase, lowercase and numbers</span>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="txt_retype">Confirm New Password</label>
                <input class="form-input" type="password" name="txt_retype" id="txt_retype"
                       placeholder="Retype new password" required />
            </div>
            
            <div class="button-group">
                <input type="submit" name="btn_update" id="btn_update" 
                       value="Change Password" class="btn btn-primary" />
                <input type="reset" name="btn_cancel" id="Cancel" 
                       value="Cancel" class="btn btn-secondary" />
            </div>
        </form>
    </div>
</body>
</html>
<?php
include("Footer.php");
?>