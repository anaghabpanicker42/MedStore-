<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");


$selQry="select * from tbl_user where user_id='".$_SESSION['uid']."'";
$res=$Con->query($selQry);
$data=$res->fetch_assoc();

if(isset($_POST['btn_submit']))
{
    $name=$_POST['txt_name'];
    $email=$_POST['txt_email'];
    $contact=$_POST['txt_contact'];
    $address=$_POST['txt_address'];
    $upQry="update tbl_user set user_name='".$name."',user_email='".$email."',
    user_phone='".$contact."',user_address='".$address."' where user_id='".$_SESSION['uid']."'";
    if($Con->query($upQry))
    {
        ?>
        <script>
        alert("Profile Updated Successfully");
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
<title>Edit Profile</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f9ff; /* Very light blue background */
        margin: 0;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    
    .profile-edit-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 82, 163, 0.1);
        padding: 30px;
        width: 500px;
        max-width: 95%;
    }
    
    .profile-edit-header {
        text-align: center;
        margin-bottom: 25px;
        color: #0052a3; /* Dark blue */
    }
    
    .profile-edit-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 600;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table tr {
        border-bottom: 1px solid #e6f0ff; /* Very light blue border */
    }
    
    .form-table tr:last-child {
        border-bottom: none;
    }
    
    .form-table td {
        padding: 15px 0;
    }
    
    .form-label {
        font-weight: 500;
        color: #0052a3; /* Dark blue */
        width: 30%;
        vertical-align: top;
        padding-top: 12px;
    }
    
    .form-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cce0ff; /* Light blue border */
        border-radius: 4px;
        font-size: 14px;
        transition: all 0.2s;
    }
    
    .form-input:focus {
        border-color: #0052a3;
        box-shadow: 0 0 0 2px rgba(0, 82, 163, 0.2);
        outline: none;
    }
    
    textarea.form-input {
        min-height: 100px;
        resize: vertical;
    }
    
    .input-hint {
        font-size: 12px;
        color: #6699cc; /* Medium blue */
        margin-top: 5px;
        display: block;
    }
    
    .btn-update {
        background-color: #0052a3; /* Dark blue */
        color: white;
        border: none;
        padding: 10px 25px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.2s;
        font-weight: 500;
    }
    
    .btn-update:hover {
        background-color: #003d7a; /* Darker blue */
    }
    
    @media (max-width: 600px) {
        .profile-edit-container {
            padding: 20px;
        }
        
        .form-table td {
            display: block;
            width: 100%;
            padding: 10px 0;
        }
        
        .form-label {
            width: 100%;
            padding-top: 0;
        }
    }
</style>
</head>

<body>
<div class="profile-edit-container">
    <div class="profile-edit-header">
        <h2>Edit Profile</h2>
    </div>
    
    <form id="form1" name="form1" method="post" action="">
        <table class="form-table">
            <tr>
                <td class="form-label">Name</td>
                <td>
                    <input type="text" class="form-input" name="txt_name" id="txt_name" 
                           title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" 
                           pattern="^[A-Z]+[a-zA-Z ]*$" 
                           value="<?php echo $data['user_name']?>" required />
                    <span class="input-hint">First letter must be capital, only alphabets and spaces allowed</span>
                </td>
            </tr>
            <tr>
                <td class="form-label">Email</td>
                <td>
                    <input type="email" class="form-input" name="txt_email" id="txt_email" 
                           value="<?php echo $data['user_email'] ?>" required />
                </td>
            </tr>
            <tr>
                <td class="form-label">Contact</td>
                <td>
                    <input type="text" class="form-input" name="txt_contact" id="txt_contact" 
                           value="<?php echo $data['user_phone']?>" 
                           pattern="[7-9]{1}[0-9]{9}" 
                           title="Phone number with 7-9 and remaining 9 digits with 0-9" required />
                    <span class="input-hint">10 digit number starting with 7-9</span>
                </td>
            </tr>
            <tr>
                <td class="form-label">Address</td>
                <td>
                    <textarea class="form-input" name="txt_address" id="txt_address" 
                              cols="45" rows="5" required><?php echo $data['user_address']?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Update Profile" class="btn-update" />
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
<?php
include('Footer.php');
?>