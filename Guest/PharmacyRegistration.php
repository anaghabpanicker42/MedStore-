<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
if(isset($_POST['btn_submit']))
{
    $name=$_POST['txt_name'];
    $email=$_POST['txt_email'];
    $license=$_POST['txt_license'];
    $contact=$_POST['txt_contact'];
    $pass=$_POST['txt_pass'];
    $place=$_POST['sel_place'];
    
    $proof=$_FILES['txt_proof']['name'];
    $path=$_FILES['txt_proof']['tmp_name'];
    move_uploaded_file($path,"../Assets/Files/Pharmacy/".$proof);
    
    $photo=$_FILES['txt_photo']['name'];
    $path1=$_FILES['txt_photo']['tmp_name'];
    move_uploaded_file($path1,"../Assets/Files/Pharmacy/".$photo);
    
    $address=$_POST['txt_address'];
    $selQry1="select * from tbl_pharmacy where pharmacy_email='".$email."'";
    $selQry2="select * from tbl_pharmacy where pharmacy_license='".$license."'";
    $selQry3="select * from tbl_pharmacy where pharmacy_contact='".$contact."'";
    $res1=$Con->query($selQry1);
    $res2=$Con->query($selQry2);
    $res3=$Con->query($selQry3);
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
        alert("License number already exists");
        </script>
        <?php
    }
    else if($data=$res3->fetch_assoc())
    {
        ?>
        <script>
        alert("Contact number already exists");
        </script>
        <?php
    }
    
    else
    {
    $insQry="insert into tbl_pharmacy(pharmacy_name,pharmacy_email,pharmacy_license,pharmacy_contact,pharmacy_password,pharmacy_proof,pharmacy_photo,pharmacy_address,place_id)values('".$name."','".$email."','".$license."','".$contact."','".$pass."','".$proof."','".$photo."','".$address."','".$place."')";
    if($Con->query($insQry))
    {
        ?>
        <script>
        alert("Registration Successful!");
        window.location="PharmacyRegistration.php"
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
<title>Pharmacy Registration</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #e6f2ff; /* Light blue background */
        margin: 0;
        padding: 0;
        color: #2c3e50;
    }
    
    .registration-container {
        max-width: 800px;
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
    
    .form-group {
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .form-group label {
        width: 150px;
        font-weight: 500;
        margin-right: 15px;
        color: #0066cc; /* Blue label color */
    }
    
    .form-control {
        flex: 1;
        min-width: 200px;
        padding: 12px;
        border: 1px solid #99c2ff; /* Light blue border */
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.3s;
        background-color: #f5f9ff; /* Very light blue background */
    }
    
    .form-control:focus {
        border-color: #0066cc;
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.2);
        outline: none;
        background-color: white;
    }
    
    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }
    
    select.form-control {
        padding: 12px;
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
        display: block;
        margin: 30px auto 0;
        font-weight: 500;
    }
    
    .btn-submit:hover {
        background-color: #0052a3; /* Darker blue on hover */
    }
    
    .input-hint {
        font-size: 12px;
        color: #6699cc; /* Medium blue hint text */
        margin-top: 5px;
        width: 100%;
        padding-left: 165px;
    }
    
    @media (max-width: 768px) {
        .form-group label {
            width: 100%;
            margin-bottom: 8px;
        }
        
        .input-hint {
            padding-left: 0;
        }
        
        .registration-container {
            padding: 20px;
            margin: 15px;
        }
    }
</style>
</head>

<body>
<div class="registration-container">
    <div class="registration-header">
        <h2>Pharmacy Registration</h2>
    </div>
    
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div class="form-group">
            <label for="txt_name">Name</label>
            <input type="text" class="form-control" name="txt_name" id="txt_name" required="required" 
                   title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" 
                   pattern="^[A-Z]+[a-zA-Z ]*$" />
            <span class="input-hint">First letter must be capital, only alphabets and spaces allowed</span>
        </div>
        
        <div class="form-group">
            <label for="txt_email">Email</label>
            <input type="email" class="form-control" name="txt_email" id="txt_email" required />
        </div>
        
        <div class="form-group">
            <label for="txt_license">License No</label>
            <input type="text" class="form-control" name="txt_license" id="txt_license" required />
        </div>
        
        <div class="form-group">
            <label for="txt_contact">Contact No</label>
            <input type="text" class="form-control" name="txt_contact" id="txt_contact" required="required" 
                   pattern="[6-9]{1}[0-9]{9}" 
                   title="Phone number with 6-9 and remaining 9 digits with 0-9" />
            <span class="input-hint">10 digit number starting with 6-9</span>
        </div>
        
        <div class="form-group">
            <label for="txt_pass">Password</label>
            <input type="password" class="form-control" name="txt_pass" id="txt_pass" required="required" 
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
            <span class="input-hint">Minimum 8 characters with at least one uppercase, one lowercase and one number</span>
        </div>
        
        <div class="form-group">
            <label for="txt_proof">Proof Document</label>
            <input type="file" class="form-control file-input" name="txt_proof" id="txt_proof" required="required" />
        </div>
        
        <div class="form-group">
            <label for="txt_photo">Photo</label>
            <input type="file" class="form-control file-input" name="txt_photo" id="txt_photo" required="required" />
        </div>
        
        <div class="form-group">
            <label for="txt_address">Address</label>
            <textarea class="form-control" name="txt_address" id="txt_address" cols="45" rows="5" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="sel_district">District</label>
            <select class="form-control" name="sel_district" id="sel_district" required="required" onChange="getPlace(this.value)">
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
        </div>
        
        <div class="form-group">
            <label for="sel_place">Place</label>
            <select class="form-control" name="sel_place" id="sel_place" required>
                <option value="">-- Select Place --</option>
            </select>
        </div>
        
        <button type="submit" name="btn_submit" id="btn_submit" class="btn-submit">Register</button>
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