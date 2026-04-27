<?php
include("../Assets/Connection/Connection.php");

$ad_name="";
$ad_id="";
$ad_pass="";
$ad_mail="";


if(isset($_POST['btn_submit']))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_mail'];
	$pass=$_POST['txt_pass'];
	$hidden=$_POST['txt_hidden'];
	
	if($hidden=="")
	{
	$selQry="select * from tbl_admin where admin_email='".$email."'";
	$res=$Con->query($selQry);
	if($data=$res->fetch_assoc())
	{	
	?>
    <script>
	alert("Email id already exist")
	window.location="AdminRegistration.php";
	</script>
    <?php
	}
	else
	{
	$insQry="insert into tbl_admin(admin_name,admin_email,admin_password)values('".$name."','".$email."','".$pass."')";
    if($Con->query($insQry))
	{
		?>
        <script>
		alert("Inserted");
		window.location="AdminRegistration.php";
		</script>
        <?php
	}
	}
}
	else
	{
		$upQry="update tbl_admin set admin_name='".$name."',admin_email='".$email."',admin_password='".$pass."' where admin_id='".$hidden."'";
		if($Con->query($upQry))
		{
			?>
            <script>
			alert("Updated")
			window.location="AdminRegistration.php";
			</script>
		<?php
		}
	}
}
if(isset($_GET['did']))
{
	$delQry="delete from tbl_admin where admin_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("deleted")
		window.location="AdminRegistration.php";
		</script>
        <?php
	}
	
}


if(isset($_GET['eid']))
{
	$selQry="select * from tbl_admin where admin_id='".$_GET['eid']."'";
	$row=$Con->query($selQry);
	$data=$row->fetch_assoc();
	
	$ad_id=$data['admin_id'];
	$ad_name=$data['admin_name'];
	$ad_mail=$data['admin_email'];
	$ad_pass=$data['admin_password'];
}


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Registration</title>
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
        padding: 20px;
    }
    
    .container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .header {
        background: #1a73e8;
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    .content {
        padding: 30px;
    }
    
    .form-container {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 30px;
        border: 1px solid #e0e0e0;
    }
    
    table.form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    table.form-table td {
        padding: 12px;
    }
    
    table.form-table tr td:first-child {
        width: 150px;
        font-weight: 600;
        color: #1a73e8;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        transition: border 0.3s;
    }
    
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #1a73e8;
        outline: none;
        box-shadow: 0 0 5px rgba(26, 115, 232, 0.3);
    }
    
    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background 0.3s;
    }
    
    .btn-submit {
        background: #1a73e8;
        color: white;
    }
    
    .btn-submit:hover {
        background: #0d62c9;
    }
    
    .btn-reset {
        background: #f1f3f4;
        color: #5f6368;
        margin-left: 10px;
    }
    
    .btn-reset:hover {
        background: #e8eaed;
    }
    
    .data-table-container {
        overflow-x: auto;
    }
    
    table.data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    table.data-table th {
        background: #1a73e8;
        color: white;
        padding: 12px;
        text-align: left;
    }
    
    table.data-table td {
        padding: 12px;
        border-bottom: 1px solid #e0e0e0;
    }
    
    table.data-table tr:nth-child(even) {
        background: #f8f9fa;
    }
    
    table.data-table tr:hover {
        background: #e8f0fe;
    }
    
    .action-links a {
        color: #1a73e8;
        text-decoration: none;
        margin-right: 10px;
        padding: 5px 10px;
        border-radius: 3px;
        transition: background 0.3s;
    }
    
    .action-links a:hover {
        background: #e8f0fe;
        text-decoration: underline;
    }
    
    .action-links a:last-child {
        margin-right: 0;
    }
    
    .btn-container {
        text-align: center;
        margin-top: 20px;
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Admin Registration</h1>
    </div>
    
    <div class="content">
        <div class="form-container">
            <form id="form1" name="form1" method="post" action="">
                <table class="form-table">
                    <tr>
                        <td>Admin Name</td>
                        <td>
                            <input type="hidden" name="txt_hidden" value="<?php echo $ad_id ?>"/>
                            <input type="text" name="txt_name" id="txt_name" value="<?php echo $ad_name ?>" pattern="^[A-Z]+[a-zA-Z ]*$" required title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Admin Email</td>
                        <td>
                            <input type="email" name="txt_mail" id="txt_mail" value="<?php echo $ad_mail ?>" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>Admin Password</td>
                        <td>
                            <input type="password" name="txt_pass" id="txt_pass" value="<?php echo $ad_pass ?>" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
                        </td>
                    </tr>
                </table>
                <div class="btn-container">
                    <input type="submit" class="btn btn-submit" name="btn_submit" id="btn_submit" value="Submit" />
                    <input type="reset" class="btn btn-reset" name="btn_reset" id="btn_reset" value="Reset" />
                </div>
            </form>
        </div>
        
        <div class="data-table-container">
            <table class="data-table">
                <tr>
                    <th>Sl.No</th>
                    <th>Admin Name</th>
                    <th>Admin Email</th>
                    <th>Admin Password</th>
                    <th>Action</th>
                </tr>
                <?php
                $i=0;
                $selQry="select * from tbl_admin";
                
                $result=$Con->query($selQry);
                while($data=$result->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['admin_name']?></td>
                    <td><?php echo $data['admin_email']?></td>
                    <td><?php echo $data['admin_password']?></td>
                    <td class="action-links">
                        <a href="AdminRegistration.php?did=<?php echo $data['admin_id']?>">Delete</a>
                        <a href="AdminRegistration.php?eid=<?php echo $data['admin_id']?>">Edit</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>