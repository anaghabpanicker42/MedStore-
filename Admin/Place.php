<?php
include("../Assets/Connection/Connection.php");
include('Head.php');
$pl_name="";
$pl_id="";
$dis_id="";

if(isset($_POST['btn_submit']))
{
$place=$_POST['txt_place'];
$dis=$_POST['sel_dist'];
$hidden=$_POST['txt_hidden'];
if($hidden=="")
{
$insQry="insert into tbl_place(place_name,district_id)values('".$place."','".$dis."')";
if($Con->query($insQry))
{
	?>
    <script>
	alert("Inserted")
	window.location="Place.php";
	</script>
    <?php
}
}
else
{
	$upQuery="update tbl_place set place_name='".$place."'where place_id='".$hidden."'";
	if($Con->query($upQuery))
	{
		?>
        <script>
		alert("Updated")
		window.location="Place.php";
		</script>
        <?php
	}
}
}
if(isset($_GET['did']))
{
	$delQry="delete from tbl_place where place_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted")
		window.location="Place.php";
		</script>
        <?php
	}
}

if(isset($_GET['eid']))
{
   $selQry="select * from tbl_place where place_id='".$_GET['eid']."'";
   $row=$Con->query($selQry);
   $data=$row->fetch_assoc();
	
	$pl_id=$data['place_id'];
	$pl_name=$data['place_name'];
	$dis_id=$data['district_id'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Place Management</title>
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
    }
    
    .header h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
        color: #3498db;
    }
    
    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 25px;
        margin-bottom: 30px;
    }
    
    table.form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    table.form-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #eaeaea;
    }
    
    table.form-table tr:last-child td {
        border-bottom: none;
    }
    
    input[type="text"], select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        transition: border 0.3s;
    }
    
    input[type="text"]:focus, select:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
    }
    
    input[type="submit"], input[type="reset"] {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-right: 10px;
        transition: background 0.3s;
    }
    
    input[type="reset"] {
        background-color: #7f8c8d;
    }
    
    input[type="submit"]:hover {
        background-color: #2980b9;
    }
    
    input[type="reset"]:hover {
        background-color: #636e72;
    }
    
    .actions {
        text-align: center;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .data-table th, .data-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eaeaea;
    }
    
    .data-table th {
        background-color: #3498db;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
    }
    
    .data-table tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    
    .data-table tr:hover {
        background-color: #e8f4fc;
    }
    
    .action-link {
        color: #3498db;
        text-decoration: none;
        margin-right: 15px;
        padding: 6px 12px;
        border-radius: 4px;
        transition: all 0.3s;
    }
    
    .action-link.delete {
        color: #e74c3c;
    }
    
    .action-link:hover {
        background-color: #ebf5fb;
        text-decoration: none;
    }
    
    .action-link.delete:hover {
        background-color: #fdedec;
    }
</style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Place Management</h1>
        <p>Add, edit and manage places in the system</p>
    </div>
    
    <div class="card">
        <form id="form1" name="form1" method="post" action="">
          <table class="form-table">
            <tr>
              <td width="120"><strong>District</strong></td>
              <td> 
                <label for="sel_dist"></label>
                <select name="sel_dist" id="sel_dist">
                <option value="">Select District</option>
                <?php
                $selQry="select * from tbl_district";
                $row=$Con->query($selQry);
                while($data=$row->fetch_assoc())
                {
                    ?>
                    <option
              <?php 
              if($dis_id==$data['district_id'])
              {
                  echo "selected";
              }
              ?>
              value="<?php echo $data['district_id']?>">
              <?php
              echo $data['district_name']
              ?>
              </option>
            
                <?php
                }
                ?>
                </select>
              </td>
            </tr>
            <tr>
              <input type="hidden" name="txt_hidden" value="<?php echo $pl_id ?>" />
              <td><strong>Place</strong></td>
              <td><label for="txt_place"></label>
              <input type="text" name="txt_place" id="txt_place" placeholder="Enter Place Name" value="<?php echo $pl_name ?>" /></td>
            </tr>
            <tr>
              <td colspan="2" class="actions">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                <input type="reset" name="btn_clear" id="btn_clear" value="Clear" />
              </td>
            </tr>
          </table>
        </form>
    </div>
    
    <h2>Places List</h2>
    <table class="data-table">
      <tr>
        <th>SL.NO</th>
        <th>District</th>
        <th>Place</th>
        <th>Actions</th>
      </tr>
      <?php
      $i=0;
      $selQry="select * from tbl_place p
       inner join tbl_district d 
       on p.district_id=d.district_id";
      $result=$Con->query($selQry);
      while($data=$result->fetch_assoc())
      {
          $i++;
          ?>
          
      
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['district_name'] ?></td>
        <td><?php echo $data['place_name'] ?></td>
        <td> 
            <a href="Place.php?eid=<?php echo $data['place_id']?>" class="action-link">Edit</a>
            <a href="Place.php?did=<?php echo $data['place_id']?>" class="action-link delete" onclick="return confirm('Are you sure you want to delete this place?')">Delete</a>
        </td>
      </tr>
      <?php
      }
      ?>
    </table>
</div>
</body>
</html>

<?php
include('Foot.php');
?>