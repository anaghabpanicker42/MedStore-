<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
if(isset($_POST['btn_submit']))
{
    $name=$_POST['txt_name'];
    $email=$_POST['txt_email'];
    $address=$_POST['txt_address'];
    $phone=$_POST['txt_phone'];
    $pass=$_POST['txt_pass'];
    $photo=$_FILES['txt_proof']['name'];
    $path=$_FILES['txt_proof']['tmp_name'];
    $place=$_POST['sel_place'];
    move_uploaded_file($path,"../Assets/Files/User/".$photo);
    
    $selQry1="select * from tbl_user where user_email='".$email."'";
    
    $selQry2="select * from tbl_user where user_phone='".$phone."'";
    $res1=$Con->query($selQry1);
    $res2=$Con->query($selQry2);
    
    if($data=$res1->fetch_assoc())
    {
        ?>
        <script>
        alert("Email id already exists");
        </script>
        <?php
    }
    else if($data=$res2->fetch_assoc())
    {
        ?>
        <script>
        alert("Phone number already exists");
        </script>
        <?php
    }
    
    
    else
    {
    $insQry="insert into tbl_user(user_name,user_email,user_address,user_phone,user_password,user_proof,place_id)values('".$name."','".$email."','".$address."','".$phone."','".$pass."','".$photo."','".$place."')";
    if($Con->query($insQry))
    {
        ?>
        <script>
        alert("Registration Successful!");
        window.location="UserRegistration.php"
        </script>
        <?php
    }
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Registration</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #e6f2ff; /* Light blue background */
        margin: 0;
        padding: 20px;
        color: #2c3e50;
    }
    
    .registration-container {
        max-width: 600px;
        margin: 30px auto;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 102, 204, 0.1); /* Blue tinted shadow */
        border: 1px solid #cce0ff; /* Light blue border */
    }
    
    .registration-header {
        text-align: center;
        margin-bottom: 30px;
        color: #0066cc; /* Dark blue header color */
    }
    
    .registration-header h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 600;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table td {
        padding: 12px;
        border-bottom: 1px solid #e6f0ff; /* Very light blue border */
    }
    
    .form-table tr:last-child td {
        border-bottom: none;
    }
    
    .form-label {
        font-weight: 500;
        color: #0066cc; /* Blue label color */
        width: 30%;
    }
    
    .form-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #99c2ff; /* Light blue border */
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.3s;
        background-color: #f5f9ff; /* Very light blue background */
    }
    
    .form-input:focus {
        border-color: #0066cc;
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.2);
        outline: none;
        background-color: white;
    }
    
    textarea.form-input {
        min-height: 100px;
        resize: vertical;
    }
    
    select.form-input {
        padding: 10px;
    }
    
    .file-input {
        padding: 8px;
    }
    
    .btn-submit {
        background-color: #0066cc; /* Blue button */
        color: white;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-weight: 500;
        display: block;
        margin: 20px auto 0;
    }
    
    .btn-submit:hover {
        background-color: #0052a3; /* Darker blue on hover */
    }
    
    .input-hint {
        font-size: 12px;
        color: #6699cc; /* Medium blue hint text */
        margin-top: 5px;
        display: block;
    }
    
    @media (max-width: 600px) {
        .registration-container {
            padding: 20px;
            margin: 15px;
        }
        
        .form-table td {
            display: block;
            width: 100%;
            border-bottom: none;
            padding: 8px 0;
        }
        
        .form-label {
            width: 100%;
            margin-bottom: 5px;
        }
    }
</style>
</head>

<body>
<div class="registration-container">
    <div class="registration-header">
        <h2>User Registration</h2>
    </div>
    
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table class="form-table">
            <tr>
                <td class="form-label">Name</td>
                <td>
                    <input type="text" class="form-input" name="txt_name" id="txt_name" required 
                           title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" 
                           pattern="^[A-Z]+[a-zA-Z ]*$" />
                    <span class="input-hint">First letter must be capital, only alphabets and spaces allowed</span>
                </td>
            </tr>
            <tr>
                <td class="form-label">Email</td>
                <td><input type="email" class="form-input" name="txt_email" id="txt_email" required /></td>
            </tr>
            <tr>
                <td class="form-label">Address</td>
                <td><textarea class="form-input" name="txt_address" id="txt_address" required cols="45" rows="5"></textarea></td>
            </tr>
            <tr>
                <td class="form-label">Phone</td>
                <td>
                    <input type="text" class="form-input" name="txt_phone" id="txt_phone" required 
                           pattern="[6-9]{1}[0-9]{9}" 
                           title="Phone number with 6-9 and remaining 9 digits with 0-9" />
                    <span class="input-hint">10 digit number starting with 6-9</span>
                </td>
            </tr>
            <tr>
                <td class="form-label">Proof</td>
                <td><input type="file" class="form-input file-input" name="txt_proof" id="txt_proof" required/></td>
            </tr>
            <tr>
                <td class="form-label">District</td>
                <td>
                    <select class="form-input" name="sel_dist" id="sel_dist" onChange="getPlace(this.value)" required>
                        <option value="">-- Select District --</option>
                        <?php
                        $selQry="select * from tbl_district";
                        $row=$Con->query($selQry);
                        while($data=$row->fetch_assoc())
                        {
                            ?>
                            <option value="<?php echo $data['district_id']?>"><?php echo $data['district_name']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="form-label">Place</td>
                <td>
                    <select class="form-input" name="sel_place" id="sel_place" required>
                        <option value="">-- Select Place --</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="form-label">Password</td>
                <td>
                    <input type="password" class="form-input" name="txt_pass" id="txt_pass" required 
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
                    <span class="input-hint">Minimum 8 characters with at least one uppercase, one lowercase and one number</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Register" class="btn-submit" />
                </td>
            </tr>
        </table>
    </form>
</div>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
      success: function (result) {
        $("#sel_place").html(result);
      }
    });
  }
</script>
<?php
include('Footer.php');
?>