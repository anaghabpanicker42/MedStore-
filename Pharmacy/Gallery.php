<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
$pr_id="";
if(isset($_POST['btn_submit']))
{
	$photo=$_FILES['txt_photo']['name'];
	$path1=$_FILES['txt_photo']['tmp_name'];
	move_uploaded_file($path1,"../Assets/Files/Pharmacy/".$photo);
	
	$insQry="insert into tbl_gallery(gallery_file,product_id)values('".$photo."','".$_GET["gid"]."')";
	
	if($Con->query($insQry))
    {
	?>
<script>
	alert("Inserted")
	window.location="Gallery.php?gid=<?php echo $_GET['gid']; ?>";
	</script>
    <?php
   }
}

if(isset($_GET['did']))
{
	$delQry="delete from tbl_gallery where gallery_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
<script>
		alert("Deleted")
		window.location="Gallery.php?gid=<?php echo $_GET['did']; ?>";
		</script>
        <?php
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pharmacy Gallery Management</title>
<style>
    /* Base styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }
    
    body {
        background-color: #f8fbff;
        color: #333;
        line-height: 1.6;
        padding: 20px;
    }
    
    /* Container styling */
    .container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 102, 204, 0.1);
        padding: 25px;
    }
    
    /* Header styling */
    .page-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #0066cc;
    }
    
    .page-header h1 {
        color: #0066cc;
        font-size: 28px;
    }
    
    /* Form styling */
    .upload-form {
        background: #e6f2ff;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table td {
        padding: 12px;
    }
    
    .form-label {
        font-weight: bold;
        color: #0066cc;
        width: 20%;
    }
    
    input[type="file"] {
        padding: 8px;
        border: 1px solid #99ccff;
        border-radius: 4px;
        background: white;
        width: 100%;
    }
    
    input[type="submit"] {
        background: #0066cc;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background 0.3s;
    }
    
    input[type="submit"]:hover {
        background: #004c99;
    }
    
    /* Gallery table styling */
    .gallery-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }
    
    .gallery-table th {
        background: #0066cc;
        color: white;
        padding: 12px;
        text-align: left;
    }
    
    .gallery-table td {
        padding: 12px;
        border-bottom: 1px solid #e6f2ff;
    }
    
    .gallery-table tr:nth-child(even) {
        background: #f0f8ff;
    }
    
    .gallery-table tr:hover {
        background: #e6f2ff;
    }
    
    /* Image styling */
    .gallery-image {
        border: 2px solid #99ccff;
        border-radius: 5px;
        transition: transform 0.3s;
    }
    
    .gallery-image:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(0, 102, 204, 0.3);
    }
    
    /* Action link styling */
    .action-link {
        color: #0066cc;
        text-decoration: none;
        padding: 6px 12px;
        border: 1px solid #0066cc;
        border-radius: 4px;
        transition: all 0.3s;
        display: inline-block;
    }
    
    .action-link:hover {
        background: #0066cc;
        color: white;
    }
    
    /* Message styling */
    .message {
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        text-align: center;
    }
    
    .success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .form-table td {
            display: block;
            width: 100%;
        }
        
        .form-label {
            width: 100%;
            margin-bottom: 5px;
        }
        
        input[type="file"] {
            width: 100%;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="page-header">
        <h1>Pharmacy Product Gallery</h1>
    </div>
    
    <div class="upload-form">
        <h2>Upload New Image</h2>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <table class="form-table">
                <tr>
                    <td class="form-label">Photo</td>
                    <td><input type="file" name="txt_photo" id="txt_photo" required /></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Upload Image" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <h2>Gallery Images</h2>
    <table class="gallery-table">
        <tr>
            <th>Sl No</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
        <?php
        $i = 0;
        $selQry = "select * from tbl_gallery where product_id=".$_GET['gid'];
        $result = $Con->query($selQry);
        if($result && $result->num_rows > 0) {
            while($data = $result->fetch_assoc()) {
                $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><img src="../Assets/Files/Pharmacy/<?php echo $data['gallery_file'] ?>" height="100" width="100" class="gallery-image" /></td>
            <td>
                <a href="Gallery.php?did=<?php echo $data['gallery_id']?>&gid=<?php echo $_GET['gid']?>" class="action-link" onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
            </td>
        </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="3" style="text-align: center;">No images found in gallery.</td></tr>';
        }
        ?>
    </table>
</div>

<script>
    // Simple confirmation for delete actions
    document.addEventListener('DOMContentLoaded', function() {
        const deleteLinks = document.querySelectorAll('.action-link');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if(!confirm('Are you sure you want to delete this image?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
</body>
</html>
<?php
include("Footer.php");
?>