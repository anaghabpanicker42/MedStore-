<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Assign DeliveryBoy</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f0f8ff;
    margin: 0;
    padding: 20px;
    color: #333;
  }
  
  .container {
    max-width: 1000px;
    margin: 0 auto;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 150, 0.1);
  }
  
  h1 {
    color: #1e90ff;
    text-align: center;
    margin-bottom: 20px;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  
  table, th, td {
    border: 1px solid #1e90ff;
  }
  
  th {
    background-color: #1e90ff;
    color: white;
    padding: 10px;
    text-align: left;
  }
  
  td {
    padding: 8px 10px;
    background-color: white;
  }
  
  tr:nth-child(even) td {
    background-color: #f0f8ff;
  }
  
  a {
    color: #1e90ff;
    text-decoration: none;
    font-weight: bold;
  }
  
  a:hover {
    color: #0066cc;
    text-decoration: underline;
  }
  
  .action-btn {
    background-color: #1e90ff;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
  }
  
  .action-btn:hover {
    background-color: #0066cc;
  }
  
  .alert {
    background-color: #d4edff;
    color: #0066cc;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 20px;
    border-left: 4px solid #1e90ff;
  }
</style>
</head>

<body>
<div class="container">
  <?php
  include("../Assets/Connection/Connection.php");
  session_start();
  if(isset($_GET["did"]))
  {
    $upQry="update tbl_booking set booking_status=3, deliveryboy_id='".$_GET['did']."' where booking_id='".$_GET['bid']."'";
    if($Con->query($upQry))
    {
      $update="update tbl_deliveryboy set deliveryboy_status=3 where deliveryboy_id='".$_GET['did']."'";
      if($Con->query($update))
      {
      ?>
      <div class="alert">
        <strong>Assigned!</strong> Delivery boy has been successfully assigned.
      </div>
      <script>
        setTimeout(function() {
          window.location="ViewBooking.php";
        }, 1500);
      </script>
      <?php
      }
    }
  }
  ?>
  
  <h1>Assign Delivery Boy</h1>
  <form id="form1" name="form1" method="post" action="">
    <table>
      <tr>
        <th>SI No</th>
        <th>Deliveryboy Name</th>
        <th>Deliveryboy Contact</th>
        <th>Deliveryboy Place</th>
        <th>Action</th>
      </tr>
      <?php
      $i=0;
      $sel="select * from tbl_pharmacy where pharmacy_id='".$_SESSION['pid']."'";
      $res=$Con->query($sel);
      $row=$res->fetch_assoc();
      $selQry="select * from tbl_deliveryboy where deliveryboy_status=1 and place_id='".$row['place_id']."'";
      $result=$Con->query($selQry);
      while($data=$result->fetch_assoc())
      {
        $i++;
      ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['deliveryboy_name'] ?></td>
        <td><?php echo $data['deliveryboy_contactno'] ?></td>
        <td><?php echo $data['place_id'] ?></td>
        <td><a href="AssignDeliveryboy.php?did=<?php echo $data['deliveryboy_id']?>&bid=<?php echo $_GET['bid']?>" class="action-btn">Assign</a></td>
      </tr>
      <?php
      }
      ?>
    </table>
  </form>
</div>
</body>
</html>