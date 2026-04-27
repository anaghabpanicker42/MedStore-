<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");


$selQry="select * from tbl_pharmacy where pharmacy_id='".$_SESSION['pid']."'";
$res=$Con->query($selQry);
$data=$res->fetch_assoc();

if(isset($_POST['btn_update'])) {
    $name=$_POST['txt_name'];
    $email=$_POST['txt_email'];
    $contact=$_POST['txt_contact'];
    $address=$_POST['txt_address'];
    $upQry="update tbl_pharmacy set pharmacy_name='".$name."',pharmacy_email='".$email."',
    pharmacy_contact='".$contact."',pharmacy_address='".$address."' where pharmacy_id='".$_SESSION['pid']."'";
    if($Con->query($upQry)) {
        ?>
        <script>
        alert("Updated")
        window.location="MyProfile.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pharmacy Edit Profile</title>
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
    
    .edit-profile-container {
        max-width: 600px;
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
        margin-bottom: 20px;
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
        transition: border 0.3s;
    }
    
    .form-input:focus {
        border-color: var(--primary-blue);
        outline: none;
        box-shadow: 0 0 0 2px rgba(25, 118, 210, 0.2);
    }
    
    textarea.form-input {
        min-height: 100px;
        resize: vertical;
    }
    
    .submit-btn {
        background-color: var(--primary-blue);
        color: white;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
        display: block;
        margin: 30px auto 0;
        width: 150px;
    }
    
    .submit-btn:hover {
        background-color: var(--dark-blue);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .input-hint {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 5px;
        display: block;
    }
</style>
</head>

<body>
    <div class="edit-profile-container">
        <h1 class="form-header">Edit Pharmacy Profile</h1>
        
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label class="form-label" for="txt_name">Name</label>
                <input class="form-input" required type="text" name="txt_name" id="txt_name" 
                       title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" 
                       pattern="^[A-Z]+[a-zA-Z ]*$" value="<?php echo $data['pharmacy_name']?>"/>
                <span class="input-hint">First letter must be capital, only alphabets and spaces allowed</span>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="txt_email">Email</label>
                <input class="form-input" type="email" name="txt_email" id="txt_email" 
                       value="<?php echo $data['pharmacy_email']?>"/>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="txt_contact">Contact</label>
                <input class="form-input" type="text" name="txt_contact" id="txt_contact" 
                       pattern="[7-9]{1}[0-9]{9}" 
                       title="Phone number with 7-9 and remaining 9 digits with 0-9" 
                       required="required" value="<?php echo $data['pharmacy_contact']?>" />
                <span class="input-hint">10 digit number starting with 7, 8 or 9</span>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="txt_address">Address</label>
                <textarea class="form-input" name="txt_address" id="txt_address" 
                          cols="45" rows="5"><?php echo $data['pharmacy_address']?></textarea>
            </div>
            
            <input type="submit" name="btn_update" id="btn_update" value="Update" class="submit-btn" />
        </form>
    </div>
</body>
</html>
<?php
include("Footer.php");
?>