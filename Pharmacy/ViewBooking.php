<?php
//session_start();
include("../Assets/Connection/Connection.php");
include("Header.php");

if(isset($_GET['pid'])) {
    $_SESSION['bid']=$_GET['pid'];
    ?>
    <script>
    window.location="Payment.php";
    </script>
    <?php 
}

$selQry="select * from tbl_booking b inner join tbl_cart c on c.booking_id = b.booking_id inner join  tbl_product p on p.product_id = c.product_id  where pharmacy_id='".$_SESSION["pid"]."' and booking_status>0 group by(b.booking_id)"; 
$res=$Con->query($selQry);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pharmacy Bookings</title>
<style>
    :root {
        --primary-blue: #1976D2;
        --dark-blue: #0D47A1;
        --light-blue: #E3F2FD;
        --white: #FFFFFF;
        --light-gray: #F5F5F5;
        --text-dark: #212121;
        --text-light: #757575;
        --success: #4CAF50;
        --warning: #FF9800;
        --info: #2196F3;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--light-gray);
        margin: 0;
        padding: 20px;
        color: var(--text-dark);
    }
    
    .container {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .page-title {
        color: var(--primary-blue);
        text-align: center;
        margin: 20px 0 30px;
        font-size: 28px;
    }
    
    .booking-card {
        background-color: var(--white);
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .card-header {
        background-color: var(--primary-blue);
        color: var(--white);
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .booking-id {
        font-weight: 600;
        font-size: 18px;
    }
    
    .booking-date {
        font-size: 14px;
        opacity: 0.9;
    }
    
    .card-body {
        padding: 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    
    .detail-group {
        margin-bottom: 10px;
    }
    
    .detail-label {
        font-size: 14px;
        color: var(--text-light);
        margin-bottom: 5px;
    }
    
    .detail-value {
        font-weight: 500;
        font-size: 16px;
    }
    
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    
    .status-pending {
        background-color: rgba(255, 152, 0, 0.1);
        color: var(--warning);
    }
    
    .status-completed {
        background-color: rgba(76, 175, 80, 0.1);
        color: var(--success);
    }
    
    .status-assigned {
        background-color: rgba(33, 150, 243, 0.1);
        color: var(--info);
    }
    
    .status-delivered {
        background-color: rgba(76, 175, 80, 0.2);
        color: var(--success);
    }
    
    .card-footer {
        padding: 15px 20px;
        background-color: var(--light-blue);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .action-btn {
        display: inline-block;
        padding: 8px 20px;
        background-color: var(--primary-blue);
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .action-btn:hover {
        background-color: var(--dark-blue);
        transform: translateY(-2px);
    }
    
    .disabled-action {
        color: var(--text-light);
        font-style: italic;
    }
    
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        background-color: var(--white);
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .empty-icon {
        font-size: 50px;
        color: var(--text-light);
        margin-bottom: 15px;
    }
</style>
</head>

<body>
    <div class="container">
        <h1 class="page-title">Pharmacy Bookings</h1>
        
        <?php
        $i=0;
        if($res->num_rows > 0) {
            while($row=$res->fetch_assoc()) {
                $i++;
        ?>
        <div class="booking-card">
            <div class="card-header">
                <span class="booking-id">Booking #<?php echo $row['booking_id']; ?></span>
                <span class="booking-date"><?php echo date('d M Y', strtotime($row['booking_date'])); ?></span>
            </div>
            
            <div class="card-body">
                <div class="detail-group">
                    <div class="detail-label">Product Name</div>
                    <div class="detail-value"><?php echo $row["product_name"]; ?></div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-label">Quantity</div>
                    <div class="detail-value"><?php echo $row["cart_qty"]; ?></div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-label">Total Amount</div>
                    <div class="detail-value">₹<?php echo $row["booking_amount"]; ?></div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">
                        <?php 
                        if($row["booking_status"]==1) {
                            echo '<span class="status-badge status-pending">Payment Pending</span>';
                        }
                        else if($row["booking_status"]==2) {
                            echo '<span class="status-badge status-completed">Payment Completed</span>';
                        }
                        else if($row["booking_status"]==3) {
                            echo '<span class="status-badge status-assigned">Assigned Delivery Boy</span>';
                        }
                        else if($row["booking_status"]==4) {
                            echo '<span class="status-badge status-delivered">Delivered</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <div class="detail-value">
                    <?php
                    if($row['booking_status']==2) {
                        echo '<a href="AssignDeliveryBoy.php?bid='.$row['booking_id'].'" class="action-btn">Assign Delivery Boy</a>';
                    }
                    else if($row['booking_status']==1) {
                        echo '<span class="disabled-action">Payment Pending</span>';
                    }
                    else {
                        echo '<span class="disabled-action">Delivery in progress</span>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo '<div class="empty-state">
                    <div class="empty-icon">📦</div>
                    <h3>No Bookings Found</h3>
                    <p>There are currently no bookings to display.</p>
                  </div>';
        }
        ?>
    </div>
</body>
</html>
<?php
include("Footer.php");
?>