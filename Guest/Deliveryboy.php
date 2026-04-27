<?php
include("../Assets/Connection/Connection.php");
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
	move_uploaded_file($path,"../Assets/Files/Delivery/".$proof);
	
	$photo=$_FILES['txt_photo']['name'];
	$path1=$_FILES['txt_photo']['tmp_name'];
	move_uploaded_file($path1,"../Assets/Files/Delivery/".$photo);
	
	$address=$_POST['txt_address'];
	$selQry1="select * from tbl_deliveryboy where deliveryboy_email='".$email."'";
	$selQry2="select * from tbl_deliveryboy where deliveryboy_licenseno='".$license."'";
	$selQry3="select * from tbl_deliveryboy where deliveryboy_contactno='".$contact."'";
	$res1=$Con->query($selQry1);
	$res2=$Con->query($selQry2);
	$res3=$Con->query($selQry3);
	if($data=$res1->fetch_assoc())
	{
		?>
        <script>
		alert("Email id already exist");
		</script>
        <?php
	}
	else if($data=$res2->fetch_assoc())
	{
		?>
		<script>
		alert("License number already exist");
		</script>
        <?php
	}
	else if($data=$res3->fetch_assoc())
	{
		?>
        <script>
		alert("Contact number exist");
		</script>
        <?php
	}
	else
	{
	$insQry="insert into tbl_deliveryboy(deliveryboy_name,deliveryboy_email,deliveryboy_licenseno,deliveryboy_contactno,deliveryboy_password,deliveryboy_proof,deliveryboy_photo,deliveryboy_address,place_id)values('".$name."','".$email."','".$license."','".$contact."','".$pass."','".$proof."','".$photo."','".$address."','".$place."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Inserted")
		window.location="Deliveryboy.php"
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
<title>Delivery Boy Registration</title>
<style>
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
    }
    
    .container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
    }
    
    .header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .header h1 {
        color: #1a5276;
        font-size: 28px;
        margin-bottom: 10px;
    }
    
    .header p {
        color: #7f8c8d;
    }
    
    .form-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table tr {
        border-bottom: 1px solid #eaeaea;
    }
    
    .form-table td {
        padding: 15px 10px;
    }
    
    .form-table tr:last-child {
        border-bottom: none;
    }
    
    .label {
        color: #2c3e50;
        font-weight: 600;
        width: 30%;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="password"],
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        transition: border 0.3s;
    }
    
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    select:focus,
    textarea:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
    }
    
    input[type="file"] {
        padding: 8px 0;
    }
    
    .submit-btn {
        background-color: #2980b9;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background-color 0.3s;
    }
    
    .submit-btn:hover {
        background-color: #1a5276;
    }
    
    .btn-container {
        text-align: center;
        margin-top: 20px;
    }
    
    .required:after {
        content: " *";
        color: #e74c3c;
    }
    
    .form-note {
        font-size: 12px;
        color: #7f8c8d;
        margin-top: 5px;
        display: block;
    }
    
    @media (max-width: 768px) {
        .form-table td {
            display: block;
            width: 100%;
        }
        
        .label {
            width: 100%;
            padding-bottom: 5px;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Delivery Boy Registration</h1>
        <p>Please fill in all the required information to register as a delivery boy</p>
    </div>
    
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table class="form-table">
            <tr>
              <td class="label required">Name</td>
              <td>
                <input type="text" name="txt_name" id="txt_name" required title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$"/>
                <span class="form-note">Must start with capital letter, only letters and spaces allowed</span>
              </td>
            </tr>
            <tr>
              <td class="label required">Email</td>
              <td>
                <input type="email" name="txt_email" id="txt_email" required/>
              </td>
            </tr>
            <tr>
              <td class="label required">Password</td>
              <td>
                <input type="password" name="txt_pass" id="txt_pass" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
                <span class="form-note">Must contain at least one number, one uppercase and lowercase letter, and at least 8 characters</span>
              </td>
            </tr>
            <tr>
              <td class="label required">License No</td>
              <td>
                <input type="text" name="txt_license" id="txt_license" required>
              </td>
            </tr>
            <tr>
              <td class="label required">Contact No</td>
              <td>
                <input type="text" name="txt_contact" id="txt_contact" pattern="[6-9]{1}[0-9]{9}" 
                            title="Phone number with 6-9 and remaing 9 digit with 0-9" required />
                <span class="form-note">Must be a valid 10-digit phone number starting with 6-9</span>
              </td>
            </tr>
            <tr>
              <td class="label required">Proof</td>
              <td>
                <input type="file" name="txt_proof" id="txt_proof" required />
              </td>
            </tr>
            <tr>
              <td class="label required">Photo</td>
              <td>
                <input type="file" name="txt_photo" id="txt_photo" required />
              </td>
            </tr>
            <tr>
              <td class="label required">Address</td>
              <td>
                <textarea name="txt_address" id="txt_address" required cols="45" rows="5"></textarea>
              </td>
            </tr>
            <tr>
              <td class="label required">District</td>
              <td>
                <select name="sel_district" id="sel_district" required onChange="getPlace(this.value)">
                <option value="">--select--</option>
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
              </select></td>
            </tr>
            <tr>
              <td class="label required">Place</td>
              <td>
                <select name="sel_place" id="sel_place" required>
                <option value="">--select--</option>
              </select></td>
            </tr>
            <tr>
              <td colspan="2">
                <div class="btn-container">
                  <input type="submit" name="btn_submit" id="btn_submit" value="Register" class="submit-btn" />
                </div>
              </td>
            </tr>
          </table>
        </form>
    </div>
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
</body>
</html>