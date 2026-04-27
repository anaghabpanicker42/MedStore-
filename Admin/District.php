<?php
include("../Assets/Connection/Connection.php");
include('Head.php');
$dis_name="";

$dis_id="";

if(isset($_POST['btn_submit']))
{
	
	$district=$_POST['txt_dist'];
	$hidden=$_POST['txt_hidden'];
	
	
	if($hidden=="")
	{
		$selQry="select * from tbl_district where district_name='".$district."'";
		$res=$Con->query($selQry);
		if($data=$res->fetch_assoc())
		{
		?>
        <script>
		alert("District Already Entered.");
		</script>
        <?php
		}
		else
		{
			$insQry="insert into tbl_district(district_name)values('".$district."')";
	
			if($Con->query($insQry))
			{
			?>
        	<script>
			alert("inserted")
			window.location="District.php";
			</script>
       		<?php
			}
		}
		
	
	
	
	}
	
	else
	{
		$upQry="update tbl_district set district_name='".$district."' where district_id='".$hidden."'";
		if($Con->query($upQry))
	{
		?>
        <script>
		alert("updated")
		window.location="District.php";
		</script>
        <?php
	}
	}
}






//delete

if(isset($_GET['did']))
{
	$delQry="delete from tbl_district where district_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("deleted")
		window.location="District.php";
		</script>
        <?php
	}
	
}





//edit

if(isset($_GET['eid']))
{
	$selQry="select * from tbl_district where district_id='".$_GET['eid']."'";
	$row=$Con->query($selQry);
	$data=$row->fetch_assoc();
	
	
	$dis_id=$data['district_id'];
	$dis_name=$data['district_name'];
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District Management</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background: #f5f7fa;
        color: #333;
        padding: 20px;
    }
    
    .container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .header {
        background: #1a73e8;
        color: white;
        padding: 25px;
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
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table td {
        padding: 15px;
    }
    
    .form-table tr td:first-child {
        width: 150px;
        font-weight: 600;
        color: #1a73e8;
    }
    
    input[type="text"] {
        width: 100%;
        padding: 14px;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        font-size: 16px;
        transition: all 0.3s;
        outline: none;
    }
    
    input[type="text"]:focus {
        border-color: #1a73e8;
        box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
    }
    
    input[type="text"]::placeholder {
        color: #aaa;
    }
    
    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-submit {
        background: #1a73e8;
        color: white;
        box-shadow: 0 4px 12px rgba(26, 115, 232, 0.3);
    }
    
    .btn-submit:hover {
        background: #0d62c9;
        transform: translateY(-2px);
    }
    
    .btn-reset {
        background: #f1f3f4;
        color: #5f6368;
        margin-left: 15px;
    }
    
    .btn-reset:hover {
        background: #e8eaed;
    }
    
    .btn-container {
        text-align: center;
        margin-top: 20px;
    }
    
    .data-table-container {
        overflow-x: auto;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .data-table th {
        background: #1a73e8;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    
    .data-table td {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .data-table tr:nth-child(even) {
        background: #f8f9fa;
    }
    
    .data-table tr:hover {
        background: #e8f0fe;
    }
    
    .action-links a {
        color: #1a73e8;
        text-decoration: none;
        margin-right: 15px;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background 0.3s;
        display: inline-block;
        font-weight: 600;
    }
    
    .action-links a:first-child {
        color: #dc3545;
    }
    
    .action-links a:hover {
        background: #e8f0fe;
        text-decoration: underline;
    }
    
    .table-footer {
        margin-top: 20px;
        text-align: center;
        color: #6c757d;
        font-size: 14px;
    }
    
    .section-title {
        color: #1a73e8;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e0e0e0;
    }
    
    @media (max-width: 768px) {
        .content {
            padding: 15px;
        }
        
        .form-container {
            padding: 15px;
        }
        
        .form-table td {
            display: block;
            width: 100%;
            padding: 10px;
        }
        
        .form-table tr td:first-child {
            width: 100%;
            padding-bottom: 5px;
        }
        
        .btn {
            width: 100%;
            margin: 5px 0;
        }
        
        .btn-reset {
            margin-left: 0;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>District Management</h1>
    </div>
    
    <div class="content">
        <div class="form-container">
            <h2 class="section-title"><?php echo $dis_id ? 'Edit District' : 'Add New District'; ?></h2>
            <form id="form1" name="form1" method="post" action="">
                <table class="form-table">
                    <tr>
                        <td>District Name</td>
                        <td>
                            <input type="hidden" name="txt_hidden" value="<?php echo $dis_id ?>"/>
                            <input type="text" name="txt_dist" id="txt_dist" placeholder="Enter District Name" value="<?php echo $dis_name ?>" required="required" pattern="^[A-Z]+[a-zA-Z ]*$" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="btn-container">
                                <input type="submit" class="btn btn-submit" name="btn_submit" id="btn_submit" value="Submit" />
                                <input type="reset" class="btn btn-reset" name="btn_submit2" id="btn_submit2" value="Clear" />
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        
        <h2 class="section-title">District List</h2>
        <div class="data-table-container">
            <table class="data-table">
                <tr>
                    <th>Sl No</th>
                    <th>District</th>
                    <th>Action</th>
                </tr>
                <?php
                $i = 0;
                $selQry = "select * from tbl_district";
                $result = $Con -> query($selQry);
                while($data = $result -> fetch_assoc())
                {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['district_name']; ?></td>
                    <td class="action-links">
                        <a href="District.php?did=<?php echo $data['district_id']?>">Delete</a>
                        <a href="District.php?eid=<?php echo $data['district_id']?>">Edit</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
        
        <div class="table-footer">
            <?php echo $i ?> district(s) found
        </div>
    </div>
</div>
</body>
</html>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District Management</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background: #f5f7fa;
        color: #333;
        padding: 20px;
    }
    
    .container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .header {
        background: #1a73e8;
        color: white;
        padding: 25px;
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
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table td {
        padding: 15px;
    }
    
    .form-table tr td:first-child {
        width: 150px;
        font-weight: 600;
        color: #1a73e8;
    }
    
    input[type="text"] {
        width: 100%;
        padding: 14px;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        font-size: 16px;
        transition: all 0.3s;
        outline: none;
    }
    
    input[type="text"]:focus {
        border-color: #1a73e8;
        box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
    }
    
    input[type="text"]::placeholder {
        color: #aaa;
    }
    
    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-submit {
        background: #1a73e8;
        color: white;
        box-shadow: 0 4px 12px rgba(26, 115, 232, 0.3);
    }
    
    .btn-submit:hover {
        background: #0d62c9;
        transform: translateY(-2px);
    }
    
    .btn-reset {
        background: #f1f3f4;
        color: #5f6368;
        margin-left: 15px;
    }
    
    .btn-reset:hover {
        background: #e8eaed;
    }
    
    .btn-container {
        text-align: center;
        margin-top: 20px;
    }
    
    .data-table-container {
        overflow-x: auto;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .data-table th {
        background: #1a73e8;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    
    .data-table td {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .data-table tr:nth-child(even) {
        background: #f8f9fa;
    }
    
    .data-table tr:hover {
        background: #e8f0fe;
    }
    
    .action-links a {
        color: #1a73e8;
        text-decoration: none;
        margin-right: 15px;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background 0.3s;
        display: inline-block;
        font-weight: 600;
    }
    
    .action-links a:first-child {
        color: #dc3545;
    }
    
    .action-links a:hover {
        background: #e8f0fe;
        text-decoration: underline;
    }
    
    .table-footer {
        margin-top: 20px;
        text-align: center;
        color: #6c757d;
        font-size: 14px;
    }
    
    .section-title {
        color: #1a73e8;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e0e0e0;
    }
    
    @media (max-width: 768px) {
        .content {
            padding: 15px;
        }
        
        .form-container {
            padding: 15px;
        }
        
        .form-table td {
            display: block;
            width: 100%;
            padding: 10px;
        }
        
        .form-table tr td:first-child {
            width: 100%;
            padding-bottom: 5px;
        }
        
        .btn {
            width: 100%;
            margin: 5px 0;
        }
        
        .btn-reset {
            margin-left: 0;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>District Management</h1>
    </div>
    
    <div class="content">
        <div class="form-container">
            <h2 class="section-title"><?php echo $dis_id ? 'Edit District' : 'Add New District'; ?></h2>
            <form id="form1" name="form1" method="post" action="">
                <table class="form-table">
                    <tr>
                        <td>District Name</td>
                        <td>
                            <input type="hidden" name="txt_hidden" value="<?php echo $dis_id ?>"/>
                            <input type="text" name="txt_dist" id="txt_dist" placeholder="Enter District Name" value="<?php echo $dis_name ?>" required="required" pattern="^[A-Z]+[a-zA-Z ]*$" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="btn-container">
                                <input type="submit" class="btn btn-submit" name="btn_submit" id="btn_submit" value="Submit" />
                                <input type="reset" class="btn btn-reset" name="btn_submit2" id="btn_submit2" value="Clear" />
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        
        <h2 class="section-title">District List</h2>
        <div class="data-table-container">
            <table class="data-table">
                <tr>
                    <th>Sl No</th>
                    <th>District</th>
                    <th>Action</th>
                </tr>
                <?php
                $i = 0;
                $selQry = "select * from tbl_district";
                $result = $Con -> query($selQry);
                while($data = $result -> fetch_assoc())
                {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['district_name']; ?></td>
                    <td class="action-links">
                        <a href="District.php?did=<?php echo $data['district_id']?>">Delete</a>
                        <a href="District.php?eid=<?php echo $data['district_id']?>">Edit</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
        
        <div class="table-footer">
            <?php echo $i ?> district(s) found
        </div>
    </div>
</div>
</body>
</html>
<?php
include('Foot.php');
?>