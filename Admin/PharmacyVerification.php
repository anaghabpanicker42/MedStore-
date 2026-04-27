<?php
include("../Assets/Connection/Connection.php");
include('Head.php');
if(isset($_GET['did']))
{
	$upQry="update tbl_pharmacy set pharmacy_status='1' where pharmacy_id='".$_GET['did']."' ";
	if($Con->query($upQry))
		{
			?>
            <script>
			alert("Accepted")
			window.location="PharmacyVerification.php";
			</script>
		<?php
		}
}
if(isset($_GET['rid']))
{		
    $upQry="update tbl_pharmacy set pharmacy_status='2' where pharmacy_id='".$_GET['rid']."' ";
	if($Con->query($upQry))
	{
		?>
        <script>
		alert("Rejected")
		window.location="PharmacyVerification.php";
		</script>
     <?php
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pharmacy Verification</title>
<style>
    .container {
        max-width: 1183px;
        margin: 0 auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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
        overflow-x: auto;
    }
    
    .verification-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .verification-table th {
        background: #1a73e8;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        position: sticky;
        top: 0;
    }
    
    .verification-table td {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
        vertical-align: top;
    }
    
    .verification-table tr:nth-child(even) {
        background: #f8f9fa;
    }
    
    .verification-table tr:hover {
        background: #e8f0fe;
    }
    
    .action-cell {
        white-space: nowrap;
    }
    
    .btn {
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-block;
        text-decoration: none;
        margin-right: 5px;
    }
    
    .btn-accept {
        background: #28a745;
        color: white;
    }
    
    .btn-accept:hover {
        background: #218838;
    }
    
    .btn-reject {
        background: #dc3545;
        color: white;
    }
    
    .btn-reject:hover {
        background: #c82333;
    }
    
    .status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 5px;
    }
    
    .status-accepted {
        background: #d4edda;
        color: #155724;
    }
    
    .status-rejected {
        background: #f8d7da;
        color: #721c24;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .proof-link {
        color: #1a73e8;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        padding: 8px 12px;
        border-radius: 4px;
        background: #e8f0fe;
        transition: background 0.3s;
    }
    
    .proof-link:hover {
        background: #d2e3fc;
        text-decoration: underline;
    }
    
    .image-container {
        width: 100px;
        height: 100px;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
    }
    
    .image-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }
    
    .table-footer {
        margin-top: 20px;
        text-align: center;
        color: #6c757d;
        font-size: 14px;
    }
    
    @media (max-width: 1200px) {
        .content {
            padding: 15px;
        }
        
        .verification-table {
            font-size: 14px;
        }
        
        .verification-table th,
        .verification-table td {
            padding: 10px;
        }
    }
    
    @media (max-width: 992px) {
        .verification-table {
            display: block;
            overflow-x: auto;
        }
        
        .mobile-label {
            display: none;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Pharmacy Verification</h1>
    </div>
    
    <div class="content">
        <table class="verification-table">
            <tr>
                <th>SlNo</th>
                <th>Name</th>
                <th>Email</th>
                <th>License</th>
                <th>Contact</th>
                <th>Address</th>
                <th>District</th>
                <th>Place</th>
                <th>Photo</th>
                <th>Proof</th>
                <th>Action</th>
            </tr>
            <?php
            $i=0;
            
            $selQry="select * from tbl_pharmacy p inner join tbl_place pl on p.place_id=pl.place_id inner join tbl_district d on pl.district_id=d.district_id";
            $result=$Con->query($selQry);
            while($data=$result->fetch_assoc())
            {
                $i++;
            ?> 
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $data['pharmacy_name'] ?></td>
                <td><?php echo $data['pharmacy_email'] ?></td>
                <td><?php echo $data['pharmacy_license'] ?></td>
                <td><?php echo $data['pharmacy_contact'] ?></td>
                <td><?php echo $data['pharmacy_address'] ?></td>
                <td><?php echo $data['district_name'] ?></td>
                <td><?php echo $data['place_name'] ?></td>
                <td>
                    <div class="image-container">
                        <img src="../Assets/Files/Pharmacy/<?php echo $data['pharmacy_photo'] ?>" alt="Pharmacy Photo" />
                    </div>
                </td>
                <td>
                    <a href="../Assets/Files/Pharmacy/<?php echo $data['pharmacy_proof'] ?>" class="proof-link" target="_blank">View Proof</a>
                </td>
                <td class="action-cell">
                    <?php
                    if($data["pharmacy_status"] == 1)
                    {
                        echo '<div class="status status-accepted">Accepted</div><br>';
                        ?>
                        <a href="PharmacyVerification.php?rid=<?php echo $data['pharmacy_id']?>" class="btn btn-reject">Reject</a>
                        <?php
                    }
                    else if($data["pharmacy_status"] == 2)
                    {
                        echo '<div class="status status-rejected">Rejected</div><br>';
                        ?>
                        <a href="PharmacyVerification.php?did=<?php echo $data['pharmacy_id']?>" class="btn btn-accept">Accept</a>
                        <?php
                    }
                    else
                    {
                        echo '<div class="status status-pending">Pending</div><br>';
                        ?>
                        <a href="PharmacyVerification.php?rid=<?php echo $data['pharmacy_id']?>" class="btn btn-reject">Reject</a>
                        <a href="PharmacyVerification.php?did=<?php echo $data['pharmacy_id']?>" class="btn btn-accept">Accept</a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        
        <div class="table-footer">
            <?php echo $i ?> pharmacy(s) found
        </div>
    </div>
</div>
</body>
</html>
<?php
include('Foot.php');
?>