<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST['btn_submit']))
{
	$subcategory=$_POST['txt_sbctgry'];
	$category=$_POST['sel_ctgry'];
	$insQry="insert into tbl_subcategory(subcategory,category_id)values('".$subcategory."','".$category."')";

if($Con->query($insQry))
{
	?>
<script>
	alert("Inserted")
	window.location="Subcategory.php";
	</script>
    <?php
}
}
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SubCategory</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Category</td>
      <td><label for="sel_ctgry"></label>
        <select name="sel_ctgry" id="sel_ctgry">
        <option>Select</option>
      </select></td>
    </tr>
    <tr>
      <td>Subcategory</td>
      <td><label for="txt_sbctgry"></label>
      <input type="text" name="txt_sbctgry" id="txt_sbctgry" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="reset" name="btn_clear" id="btn_clear" value="Clear" />
      </div></td>
    </tr>
  </table>
  </form>
  
  <table width="200" border="1">
  <tr>
    <td>SL.NO</td>
    <td>Category</td>
    <td>Subcategory</td>
    <td>Action</td>
  </tr>
  <?php
  $i=0;
  $selQry="select * from tbl_subcategory s inner join
  tbl_category c on s.category_id=c.category_id";
  $result=$Con->query($selQry);
  while($data=$result->fetch_assoc())
  {
	  $i++;
	  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $data['category_name']?></td>
    <td><?php echo $data['subcategory']?></td>
    <td>
   
     </td>
  </tr>
    <?php
  }
  ?>
   
</table>


</body>
</html>