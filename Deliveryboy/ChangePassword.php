<?php
include("../Assets/Connection/Connection.php");
session_start();

// Check if delivery boy is logged in
if(!isset($_SESSION['dbid'])) {
    header("Location: login.php");
    exit();
}

$selQry = "select deliveryboy_password from tbl_deliveryboy where deliveryboy_id='".$_SESSION['dbid']."'";
$res = $Con->query($selQry);
$data = $res->fetch_assoc();
$dbpassword = $data['deliveryboy_password'];

if(isset($_POST['btn_submit'])) {
    $oldpass = $_POST['txt_oldpass'];
    $newpass = $_POST['txt_newpass'];
    $repass = $_POST['txt_retype'];
    
    if($dbpassword == $oldpass) {
        if($newpass == $repass) {
            $upQry = "update tbl_deliveryboy set deliveryboy_password='".$newpass."' where deliveryboy_id='".$_SESSION['dbid']."'";
            if($Con->query($upQry)) {
                echo "<script>alert('Password Changed'); window.location='MyProfile.php';</script>";
            } else {
                echo "<script>alert('Update failed. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('New passwords do not match');</script>";
        }
    } else {
        echo "<script>alert('Current password is incorrect');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Boy - Change Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4a6cf7;
            --primary-dark: #3a5cd8;
            --secondary: #6c757d;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --border-radius: 8px;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .main-container {
            flex: 1;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .page-title {
            text-align: center;
            margin: 20px 0 30px;
            color: var(--dark);
            font-weight: 600;
            font-size: 28px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .page-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }
        
        .card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .card-header {
            background: var(--primary);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 22px;
            font-weight: 600;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
            display: flex;
            align-items: center;
        }
        
        .form-group label i {
            margin-right: 10px;
            color: var(--primary);
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
        }
        
        .input-with-icon input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.2);
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--secondary);
        }
        
        .password-requirements {
            font-size: 13px;
            color: #666;
            margin-top: 8px;
            background: var(--light);
            padding: 12px;
            border-radius: var(--border-radius);
            border-left: 3px solid var(--primary);
        }
        
        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .btn {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--secondary);
            border: 1px solid #ddd;
        }
        
        .btn-outline:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        
        .alert {
            padding: 12px 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        
        .alert-error {
            background: #ffebee;
            color: var(--danger);
            border-left: 4px solid var(--danger);
        }
        
        .alert-success {
            background: #e8f5e9;
            color: var(--success);
            border-left: 4px solid var(--success);
        }
        
        .alert i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        @media (max-width: 768px) {
            .main-container {
                padding: 15px;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .page-title {
                font-size: 24px;
                margin: 15px 0 25px;
            }
        }
        
        @media (max-width: 480px) {
            .input-with-icon input {
                padding: 12px 15px 12px 40px;
            }
            
            .card-header {
                padding: 15px;
                font-size: 19px;
            }
        }
    </style>
</head>
<body>
    <?php include("Header.php"); ?>
    
    <div class="main-container">
        <h1 class="page-title">Change Your Password</h1>
        
        <div class="card">
            <div class="card-header">
                <i class="fas fa-lock"></i> Password Update
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="txt_oldpass"><i class="fas fa-key"></i> Current Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="txt_oldpass" id="txt_oldpass" placeholder="Enter your current password" required />
                            <span class="password-toggle" onclick="togglePassword('txt_oldpass')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="txt_newpass"><i class="fas fa-key"></i> New Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="txt_newpass" id="txt_newpass" placeholder="Enter your new password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required />
                            <span class="password-toggle" onclick="togglePassword('txt_newpass')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="password-requirements">
                            <i class="fas fa-info-circle"></i> Must contain at least one number, one uppercase letter, one lowercase letter, and at least 8 characters
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="txt_retype"><i class="fas fa-key"></i> Confirm New Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="txt_retype" id="txt_retype" placeholder="Re-enter your new password" required />
                            <span class="password-toggle" onclick="togglePassword('txt_retype')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="btn-group">
                        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Password
                        </button>
                        <button type="reset" name="btn_clear" id="btn_clear" class="btn btn-outline">
                            <i class="fas fa-times"></i> Clear Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php include("Footer.php"); ?>
    
    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = passwordInput.parentNode.querySelector('.fa-eye');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
        
        // Add real-time password validation
        document.getElementById('txt_newpass').addEventListener('input', function() {
            const password = this.value;
            const hasNumber = /\d/.test(password);
            const hasLower = /[a-z]/.test(password);
            const hasUpper = /[A-Z]/.test(password);
            const hasMinLength = password.length >= 8;
            
            let message = '<i class="fas fa-info-circle"></i> ';
            
            if (hasNumber && hasLower && hasUpper && hasMinLength) {
                message += 'Password meets all requirements';
                document.querySelector('.password-requirements').style.borderLeftColor = 'var(--success)';
            } else {
                message += 'Must contain: ';
                const requirements = [];
                
                if (!hasNumber) requirements.push('one number');
                if (!hasLower) requirements.push('one lowercase letter');
                if (!hasUpper) requirements.push('one uppercase letter');
                if (!hasMinLength) requirements.push('8+ characters');
                
                message += requirements.join(', ');
                document.querySelector('.password-requirements').style.borderLeftColor = 'var(--primary)';
            }
            
            document.querySelector('.password-requirements').innerHTML = message;
        });
    </script>
</body>
</html>