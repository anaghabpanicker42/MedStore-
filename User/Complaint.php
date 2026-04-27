<?php
include("../Assets/Connection/Connection.php");
session_start();

include('Header.php');
$cmp_id='';
$cmp_content='';

if(isset($_POST['btn_submit']))
{
	$content=$_POST['txt_content'];
	$hidden=$_POST['txt_hidden'];
	
	if($hidden=="")
	{
	$insQry="insert into tbl_complaint(complaint_content,complaint_date,user_id)values('".$content."',curdate(),'".$_SESSION['uid']."')";
	if($Con->query($insQry))
	{
		?>
<script>
		alert("Inserted");
		window.location="Complaint.php";
		</script>
        <?php
	}
	}
	else
	{
	
	$upQry="update tbl_complaint set complaint_content='".$content."' where complaint_id='".$hidden."'";
		if($Con->query($upQry))
		{
			?>
            <script>
			alert("Updated")
			window.location="Complaint.php";
			</script>
		<?php
		}
}
}
if(isset($_GET['did']))
{
	$delQry="delete from tbl_complaint where complaint_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted")
		window.location="Complaint.php";
		</script>
        <?php
	}
	
}

if(isset($_GET['eid']))
{
	$selQry="select * from tbl_complaint where complaint_id='".$_GET['eid']."'";
	$row=$Con->query($selQry);
	$data=$row->fetch_assoc();
	
	$cmp_id=$data['complaint_id'];
	$cmp_content=$data['complaint_content'];
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint Management</title>
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
        padding: 20px;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .header {
        text-align: center;
        margin-bottom: 30px;
        color: #2c3e50;
        background: linear-gradient(135deg, #3498db, #2c3e50);
        padding: 25px;
        border-radius: 8px;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .header h1 {
        font-size: 2.2rem;
        margin-bottom: 10px;
    }
    
    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 25px;
        margin-bottom: 30px;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table td {
        padding: 15px;
        vertical-align: top;
    }
    
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        width: 120px;
    }
    
    textarea {
        width: 100%;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border 0.3s;
        resize: vertical;
        min-height: 120px;
    }
    
    textarea:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 8px rgba(52, 152, 219, 0.3);
    }
    
    .btn-submit {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background 0.3s;
    }
    
    .btn-submit:hover {
        background-color: #2980b9;
    }
    
    .complaints-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        margin-top: 20px;
    }
    
    .complaints-table th, .complaints-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eaeaea;
    }
    
    .complaints-table th {
        background-color: #3498db;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
    }
    
    .complaints-table tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    
    .complaints-table tr:hover {
        background-color: #e8f4fc;
    }
    
    .action-links a {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 600;
        margin-right: 10px;
        transition: all 0.3s;
    }
    
    .edit-link {
        background-color: #3498db;
        color: white;
    }
    
    .edit-link:hover {
        background-color: #2980b9;
    }
    
    .delete-link {
        background-color: #e74c3c;
        color: white;
    }
    
    .delete-link:hover {
        background-color: #c0392b;
    }
    
    .reply-content {
        max-width: 300px;
        word-wrap: break-word;
        color: #2c3e50;
        font-style: italic;
    }
    
    .no-reply {
        color: #95a5a6;
        font-style: italic;
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 10px;
        }
        
        .header {
            padding: 15px;
        }
        
        .header h1 {
            font-size: 1.8rem;
        }
        
        .form-table {
            display: block;
        }
        
        .form-table tr {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        
        .complaints-table {
            font-size: 14px;
        }
        
        .complaints-table th, 
        .complaints-table td {
            padding: 10px 8px;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Complaint Management</h1>
        <p>Submit and manage your complaints</p>
    </div>
    
    <div class="card">
        <form id="form1" name="form1" method="post" action="">
            <table class="form-table">
                <tr>
                    <td class="form-label">Content</td>
                    <td>
                        <input type="hidden" name="txt_hidden" value="<?php echo $cmp_id ?>"/>
                        <textarea name="txt_content" id="txt_content" placeholder="Enter your complaint here..."><?php echo $cmp_content?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn-submit" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <h2 style="color: #2c3e50; margin-bottom: 15px;">Your Complaints</h2>
    
    <div class="table-container">
        <table class="complaints-table">
            <tr>
                <th>SI No</th>
                <th>Content</th>
                <th>Date</th>
                <th>Reply</th>
                <th>Action</th>
            </tr>
            <?php
            $i=0;
            $selQry="select * from tbl_complaint where user_id='".$_SESSION['uid']."'";
            $result=$Con->query($selQry);
            
            if($result->num_rows > 0) {
                while($data=$result->fetch_assoc())
                {
                    $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $data['complaint_content']?></td>
                <td><?php echo date('d M Y', strtotime($data['complaint_date']))?></td>
                <td class="reply-content">
                    <?php 
                    if(!empty($data['complaint_reply'])) {
                        echo $data['complaint_reply'];
                    } else {
                        echo '<span class="no-reply">No reply yet</span>';
                    }
                    ?>
                </td>
                <td class="action-links">
                    <a href="Complaint.php?eid=<?php echo $data['complaint_id']?>" class="edit-link">Edit</a>
                    <a href="Complaint.php?did=<?php echo $data['complaint_id']?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this complaint?')">Delete</a>
                </td>
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="5" style="text-align: center; padding: 20px; color: #7f8c8d;">No complaints found</td></tr>';
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
<?php
include('Footer.php');
?>