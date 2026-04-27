<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Pharmacy</title>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f5f9ff;
        margin: 0;
        padding: 20px;
        color: #333;
    }
    
    form {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 150, 0.1);
        max-width: 600px;
        margin: 20px auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    
    table.form-table {
        width: auto;
        margin: 0 auto;
    }
    
    th {
        background-color: #1e88e5;
        color: white;
        padding: 12px;
        text-align: left;
    }
    
    td {
        padding: 10px 12px;
        border-bottom: 1px solid #e0e9ff;
    }
    
    tr:nth-child(even) {
        background-color: #f0f7ff;
    }
    
    tr:hover {
        background-color: #e1edff;
    }
    
    select {
        width: 200px;
        padding: 8px;
        border: 1px solid #b3d1ff;
        border-radius: 4px;
        background-color: white;
    }
    
    select:focus {
        outline: none;
        border-color: #1e88e5;
        box-shadow: 0 0 5px rgba(30, 136, 229, 0.5);
    }
    
    img {
        border-radius: 4px;
        border: 1px solid #d0e3ff;
    }
    
    a {
        color: #1e88e5;
        text-decoration: none;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 4px;
        transition: all 0.3s;
    }
    
    a:hover {
        color: white;
        background-color: #1e88e5;
        text-decoration: none;
    }
    
    #result {
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 150, 0.1);
    }
    
    .action-links {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
</style>
</head>

<body>
<form>
<table class="form-table">
  <tr>
    <td><strong>District</strong></td>
    <td>
      <select name="sel_district" id="sel_district" onChange="getPlace(this.value)">
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
      </select>
    </td>
  </tr>
  <tr>
    <td><strong>Place</strong></td>
    <td>
      <select name="sel_place" id="sel_place" required="required" onChange="getPharmacy(this.value)">
       <option value="">--select--</option>
      </select>
    </td>
  </tr>
</table>
</form>

<table id="result">
  <tr>
    <th>Pharmacy Name</th>
    <th>Pharmacy Email</th>
    <th>Pharmacy Photo</th>
    <th>Pharmacy Contact</th>
    <th>Pharmacy Address</th>
    <th>Action</th>
  </tr>
  <!-- Removed the initial PHP loop to prevent displaying pharmacies without selection -->
</table>

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
  
  function getPharmacy(eid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPharmacy.php?eid=" + eid,
      success: function (result) {
        $("#result").html(result);
      }
    });
  }
</script>
</body>
</html>

<?php
include('Footer.php');
?>
