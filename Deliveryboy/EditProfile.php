<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");

// Check if delivery boy is logged in
if(!isset($_SESSION['dbid'])) {
    header("Location: login.php");
    exit();
}

$selQry = "select * from tbl_deliveryboy where deliveryboy_id='".$_SESSION['dbid']."'";
$res = $Con->query($selQry);
$data = $res->fetch_assoc();

if(isset($_POST['btn_submit'])) {
    $name = $_POST['txt_name'];
    $email = $_POST['txt_email'];
    $contact = $_POST['txt_contact'];
    $address = $_POST['txt_address'];
    
    $upQry = "update tbl_deliveryboy set deliveryboy_name='".$name."',deliveryboy_email='".$email."',
    deliveryboy_contactno='".$contact."',deliveryboy_address='".$address."' where deliveryboy_id='".$_SESSION['dbid']."'";
    
    if($Con->query($upQry)) {
        echo "<script>alert('Profile Updated Successfully'); window.location='MyProfile.php';</script>";
    } else {
        echo "<script>alert('Update failed. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Delivery Boy Profile</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f8fafc;
        color: #334155;
        line-height: 1.6;
    }
    
    .page-container {
        max-width: 800px;
        margin: 100px auto 40px;
        padding: 0 20px;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .page-title {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #4a6cf7, #6a11cb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
    }
    
    .page-description {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 40px;
    }
    
    .container-header {
        background: linear-gradient(135deg, #4a6cf7, #6a11cb);
        color: white;
        padding: 25px;
        text-align: center;
    }
    
    .container-header h2 {
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 1.8rem;
    }
    
    .form-container {
        padding: 30px;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: #475569;
        font-size: 1.05rem;
    }
    
    .form-group input, 
    .form-group textarea {
        width: 100%;
        padding: 14px 18px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s;
        background-color: #f9fafb;
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #4a6cf7;
        outline: none;
        box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.15);
        background-color: #fff;
    }
    
    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    .input-hint {
        font-size: 0.9rem;
        color: #64748b;
        margin-top: 8px;
        display: block;
        font-style: italic;
    }
    
    .btn-group {
        display: flex;
        gap: 15px;
        margin-top: 20px;
        flex-wrap: wrap;
    }
    
    .btn {
        flex: 1;
        padding: 15px 25px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        min-width: 150px;
        text-align: center;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-submit {
        background: #4a6cf7;
        color: white;
        box-shadow: 0 4px 6px rgba(74, 108, 247, 0.25);
    }
    
    .btn-submit:hover {
        background: #3a5cd8;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    .btn-cancel {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #d1d5db;
    }
    
    .btn-cancel:hover {
        background: #e2e8f0;
        transform: translateY(-2px);
    }
    
    .success-message {
        background: #dcfce7;
        color: #166534;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 25px;
        border-left: 4px solid #22c55e;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    @media (max-width: 768px) {
        .page-container {
            margin-top: 80px;
            padding: 0 15px;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
        
        .page-description {
            font-size: 1rem;
        }
        
        .container-header {
            padding: 20px;
        }
        
        .container-header h2 {
            font-size: 1.5rem;
        }
        
        .form-container {
            padding: 20px;
        }
        
        .btn-group {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
    }
    
    @media (max-width: 576px) {
        .page-container {
            margin-top: 70px;
        }
        
        .page-title {
            font-size: 1.6rem;
        }
        
        .form-group input, 
        .form-group textarea {
            padding: 12px 15px;
        }
    }
</style>
</head>

<body>
<div class="page-container">
    <div class="page-header">
        <h1 class="page-title">Update Your Profile</h1>
        <p class="page-description">Keep your delivery profile information current to ensure smooth operations and communication.</p>
    </div>

    <div class="container">
        <div class="container-header">
            <h2>Edit Profile Information</h2>
        </div>
        
        <div class="form-container">
            <form method="post" action="">
                <div class="form-group">
                    <label for="txt_name">Full Name</label>
                    <input type="text" name="txt_name" id="txt_name" value="<?php echo htmlspecialchars($data['deliveryboy_name']); ?>" 
                        pattern="^[A-Z]+[a-zA-Z ]*$" required />
                    <span class="input-hint">Name must start with a capital letter and contain only alphabets and spaces</span>
                </div>
                
                <div class="form-group">
                    <label for="txt_email">Email Address</label>
                    <input type="email" name="txt_email" id="txt_email" value="<?php echo htmlspecialchars($data['deliveryboy_email']); ?>" required />
                    <span class="input-hint">This will be used for important notifications and account recovery</span>
                </div>
                
                <div class="form-group">
                    <label for="txt_contact">Contact Number</label>
                    <input type="text" name="txt_contact" id="txt_contact" value="<?php echo htmlspecialchars($data['deliveryboy_contactno']); ?>" 
                        pattern="[7-9]{1}[0-9]{9}" required />
                    <span class="input-hint">Phone number must start with 7-9 and have 10 digits total</span>
                </div>
                
                <div class="form-group">
                    <label for="txt_address">Address</label>
                    <textarea name="txt_address" id="txt_address" cols="45" rows="5" required><?php echo htmlspecialchars($data['deliveryboy_address']); ?></textarea>
                    <span class="input-hint">Please provide your complete address for official records</span>
                </div>
                
                <div class="btn-group">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Update Profile" class="btn btn-submit" />
                    <a href="MyProfile.php" class="btn btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
include("Footer.php")
?>