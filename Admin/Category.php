<?php


include("../Assets/Connection/Connection.php");
$cat_name="";
$cat_id="";

if(isset($_POST['btn_submit']))
{
	$category=$_POST['txt_ctgry'];
	$hidden=$_POST['txt_hidden'];
	
	if($hidden=="")
	{
	$insQry="insert into tbl_category(category_name)values('".$category."')";
	if($Con->query($insQry))
	{
		?>
		<script>
		alert("Inserted");
		window.location="Category.php";
		</script>
		<?php
	}
	}
	else
	{
		$upQry="update tbl_category set category_name='".$category."' where category_id='".$hidden."'";
		if($Con->query($upQry))
		{
			?>
            <script>
			alert("Updated");
			window.location="Category.php";
			</script>
            <?php
		}
	}
}

if(isset($_GET['did']))
{
	$delQry="delete from tbl_category where category_id='".$_GET['did']."'";
	
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("deleted")
		window.location="Category.php";
		</script>
        <?php
	}
	
}
if(isset($_GET['eid']))
{
	$selQry="select * from tbl_category where category_id='".$_GET['eid']."'";
	$row=$Con->query($selQry);
	$data=$row->fetch_assoc();
	
	$cat_id=$data['category_id'];
	$cat_name=$data['category_name'];
}

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Category</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Category Name</td>
      <td>
      <input type="hidden" name="txt_hidden" value="<?php echo $cat_id ?>"/> 
      <label for="txt_ctgry"></label>
      <input type="text" name="txt_ctgry" id="txt_ctgry" value="<?php echo $cat_name ?>" required="required" title="Numbers are not allowed" pattern="^[A-Z]+[a-zA-Z ]*$"/></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="reset" name="btn_reset" id="btn_reset" value="Reset" />
      </div></td>
    </tr>
  </table>
</form>
<table width="200" border="1">
  <tr>
    <td>Sl No.</td>
    <td>Category Name</td>
    <td>Action</td>
  </tr>
  <?php
  $i=0;
  $selQry="select * from tbl_category";
  $result=$Con->query($selQry);
  while($data=$result -> fetch_assoc())
  {
	  $i++;
	 ?> 
  <tr>
    <td><?php echo $i?></td>
    <td><?php echo $data['category_name']?></td>
    <td><a href="Category.php?did=<?php echo $data['category_id']?>">Delete</a>
    <a href="Category.php?eid=<?php echo $data['category_id']?>"> Edit </a>
    </td>
  </tr>
  <?php
  }
  ?>
</table>
</body>
</html>