 <?php
 include("../Connection/Connection.php");
 ?>
		
		<table width="200" border="1" id="result">
  <tr>
    <td>Pharmacy Name</td>
    <td>Pharmacy Email</td>
    <td>Pharmacy Photo</td>
    <td>Pharmacy Contact</td>
    <td>Pharmacy Address</td>
    <td>Action</td>
  </tr>
  
  <?php
  $selQry="select * from tbl_pharmacy where pharmacy_status=1 and place_id=".$_GET["eid"];
  $result=$Con->query($selQry);
  while($data=$result->fetch_assoc())
	{
  ?>
  
  <tr>
    <td><?php  echo $data['pharmacy_name']?></td>
    <td><?php  echo $data['pharmacy_email']?></td>
    <td><img src="../Assets/Files/Pharmacy/<?php echo $data['pharmacy_photo'] ?>" heigt="100" width="100" /></td>
    <td><?php  echo $data['pharmacy_contact']?></td>
    <td><?php  echo $data['pharmacy_address']?></td>
    <td >
    <a href="ViewProduct.php?did=<?php echo $data['pharmacy_id']?>">View Product</a>
    <a href="Request.php?rid=<?php echo $data['pharmacy_id']?>">Request</a>
    </td>
  </tr>
 <?php
	}
	?>
</table>