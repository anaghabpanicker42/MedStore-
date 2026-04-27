<?php
session_start();
include("../Assets/Connection/Connection.php");
include("Header.php");
if(isset($_GET['pid']))
{
    $_SESSION['bid']=$_GET['pid'];
    ?>
    <script>
    window.location="Payment.php";
    </script>
    <?php 
}

$selQry="select * from tbl_booking b inner join tbl_cart c on c.booking_id = b.booking_id inner join  tbl_product p on p.product_id = c.product_id  where user_id='".$_SESSION["uid"]."' and booking_status>0 group by(b.booking_id)"; 
$res=$Con->query($selQry);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Bookings</title>
<style>
    :root {
        --primary: #1e88e5;
        --primary-dark: #0d47a1;
        --secondary: #f5f9ff;
        --success: #4caf50;
        --warning: #ff9800;
        --info: #2196f3;
        --text: #333;
        --text-light: #666;
        --border: #d0e3ff;
        --card-shadow: 0 4px 12px rgba(0, 0, 150, 0.1);
        --pending-bg: #fff3f3;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f9ff;
        margin: 0;
        padding: 20px;
        color: var(--text);
    }
    
    .container {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .page-title {
        color: var(--primary-dark);
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
    }
    
    .section-title {
        color: var(--primary);
        margin: 30px 0 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid var(--border);
    }
    
    .booking-cards {
        display: flex;
        flex-direction: column;
        gap: 25px;
        margin-bottom: 40px;
    }
    
    .booking-card {
        background: white;
        border-radius: 10px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        width: 100%;
    }
    
    /* Payment completed - green background */
    .booking-card.payment-completed {
        background-color: #e8f5e9; /* Light green background */
        border-left: 4px solid var(--success);
    }
    
    /* Payment pending - light red background */
    .booking-card.payment-pending {
        background-color: #ffebee; /* Light red background */
        border-left: 4px solid #f44336;
    }
    
    /* Other statuses - white background */
    .booking-card.other-status {
        background-color: white;
        border-left: 4px solid var(--primary);
    }
    
    .booking-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 150, 0.15);
    }
    
    .card-header {
        background-color: var(--primary);
        color: white;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .booking-id {
        font-weight: bold;
        font-size: 16px;
    }
    
    .booking-date {
        font-size: 14px;
        opacity: 0.9;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .product-item {
        display: flex;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px dashed var(--border);
    }
    
    .product-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .product-image {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 15px;
    }
    
    .product-details {
        flex: 1;
    }
    
    .product-name {
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .product-meta {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        color: var(--text-light);
    }
    
    .card-footer {
        padding: 15px 20px;
        background-color: var(--secondary);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .total-amount {
        font-weight: bold;
        font-size: 18px;
    }
    
    .status {
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
    
    .status-shipped {
        background-color: rgba(33, 150, 243, 0.1);
        color: var(--info);
    }
    
    .status-packed {
        background-color: rgba(156, 39, 176, 0.1);
        color: #9c27b0;
    }
    
    .action-link {
        display: inline-block;
        padding: 8px 15px;
        background-color: var(--primary);
        color: white;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.3s;
    }
    
    .action-link:hover {
        background-color: var(--primary-dark);
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: var(--text-light);
    }
    
    .empty-state-icon {
        font-size: 50px;
        margin-bottom: 20px;
        color: #ccc;
    }
</style>
</head>

<body>
    <div class="container">
        <h1 class="page-title">My Bookings</h1>
        
        <h2 class="section-title">Your Orders</h2>
        <div class="booking-cards">
            <?php
            $i = 0;
            if($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    $i++;
                    // Get all products for this booking
                    $productsQry = "SELECT p.*, c.cart_qty FROM tbl_product p 
                                    INNER JOIN tbl_cart c ON p.product_id = c.product_id 
                                    WHERE c.booking_id = '".$row['booking_id']."'";
                    $productsRes = $Con->query($productsQry);
                    
                    // Determine card class based on status
                    $cardClass = 'other-status';
                    if($row["booking_status"] == 1) {
                        $cardClass = 'payment-pending';
                    } elseif($row["booking_status"] == 2) {
                        $cardClass = 'payment-completed';
                    }
            ?>
            <div class="booking-card <?php echo $cardClass; ?>">
                <div class="card-header">
                    <span class="booking-id">Order #<?php echo $row['booking_id']; ?></span>
                    <span class="booking-date"><?php echo date('d M Y', strtotime($row['booking_date'])); ?></span>
                </div>
                
                <div class="card-body">
                    <?php 
                    while($product = $productsRes->fetch_assoc()) {
                    ?>
                    <div class="product-item">
                        <!-- <img src="../Assets/Files/Product/<?php echo $product['product_image']; ?>" class="product-image" alt="<?php echo $product['product_name']; ?>"> -->
                        <div class="product-details">
                            <div class="product-name"><?php echo $product['product_name']; ?></div>
                            <div class="product-meta">
                                <span>Qty: <?php echo $product['cart_qty']; ?></span>
                                <span>₹<?php echo $product['product_price'] * $product['cart_qty']; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="card-footer">
                    <div class="total-amount">Total: ₹<?php echo $row['booking_amount']; ?></div>
                    <div>
                        <?php 
                        if($row["booking_status"] == 1) {
                            echo '<a href="MyBooking.php?pid='.$row['booking_id'].'" class="action-link">Pay Now</a>';
                        } else {
                            $statusClass = '';
                            $statusText = '';
                            
                            if($row["booking_status"] == 2) {
                                $statusClass = 'status-completed';
                                $statusText = 'Payment Completed';
                            } else if($row["booking_status"] == 3) {
                                $statusClass = 'status-packed';
                                $sellboy = "select * from tbl_deliveryboy where deliveryboy_id=".$row['deliveryboy_id'];
                                $boyrows = $Con->query($sellboy);
                                $boydatas = $boyrows->fetch_assoc();
                                $statusText = $boydatas['deliveryboy_name'].' Assigned, Phone : '.$boydatas['deliveryboy_contactno'];
                            } else if($row["booking_status"] == 4) {
                                $statusClass = 'status-shipped';
                                $statusText = 'Delivered';
                            // } else if($row["booking_status"] == 5) {
                            //     $statusClass = 'status-completed';
                            //     $statusText = 'Delivered';
                            }
                            
                            echo '<span class="status '.$statusClass.'">'.$statusText.'</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo '<div class="empty-state">
                        <div class="empty-state-icon">📦</div>
                        <h3>No Orders Found</h3>
                        <p>You haven\'t placed any orders yet.</p>
                      </div>';
            }
            ?>
        </div>
        
        <h2 class="section-title">Requested Orders</h2>
        <div class="booking-cards">
            <?php
            $sel = "select * from tbl_booking b inner join tbl_cart c on c.booking_id = b.booking_id inner join tbl_product p on p.product_id = c.product_id inner join tbl_request r on r.pharmacy_id=p.pharmacy_id where r.user_id='".$_SESSION["uid"]."' and booking_status>0 group by(b.booking_id)"; 
            $ress = $Con->query($sel);
            $i = 0;
            
            if($ress->num_rows > 0) {
                while($row= $ress->fetch_assoc()) {
                    $i++;
                    // Get all products for this booking
                    $productsQry = "SELECT p.*, c.cart_qty FROM tbl_product p 
                                    INNER JOIN tbl_cart c ON p.product_id = c.product_id 
                                    WHERE c.booking_id = '".$row['booking_id']."'";
                    $productsRes = $Con->query($productsQry);
                    
                    // Determine card class based on status
                    $cardClass = 'other-status';
                    if($row["booking_status"] == 1) {
                        $cardClass = 'payment-pending';
                    } elseif($row["booking_status"] == 2) {
                        $cardClass = 'payment-completed';
                    }
            ?>
            <div class="booking-card <?php echo $cardClass; ?>">
                <div class="card-header">
                    <span class="booking-id">Request #<?php echo $row['booking_id']; ?></span>
                    <span class="booking-date"><?php echo date('d M Y', strtotime($row['booking_date'])); ?></span>
                </div>
                
                <div class="card-body">
                    <?php 
                    while($product = $productsRes->fetch_assoc()) {
                    ?>
                    <div class="product-item">
                        <!-- <img src="../Assets/Files/Product/<?php echo $product['product_image']; ?>" class="product-image" alt="<?php echo $product['product_name']; ?>"> -->
                        <div class="product-details">
                            <div class="product-name"><?php echo $product['product_name']; ?></div>
                            <div class="product-meta">
                                <span>Qty: <?php echo $product['cart_qty']; ?></span>
                                <span>₹<?php echo $product['product_price'] * $product['cart_qty']; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="card-footer">
                    <div class="total-amount">Total: ₹<?php echo $row['booking_amount']; ?></div>
                    <div>
                        <?php 
                        if($row["booking_status"] == 1) {
                            echo '<a href="MyBooking.php?pid='.$row['booking_id'].'" class="action-link">Pay Now</a>';
                        } else {
                            $statusClass = '';
                            $statusText = '';
                            
                            if($row["booking_status"] == 2) {
                                $statusClass = 'status-completed';
                                $statusText = 'Payment Completed';
                            } else if($row["booking_status"] == 3) {
                                $statusClass = 'status-packed';
                                $sellboy = "select * from tbl_deliveryboy where deliveryboy_id=".$row['deliveryboy_id'];
                                $boyrow = $Con->query($sellboy);
                                $boydata = $boyrow->fetch_assoc();
                                $statusText = $boydata['deliveryboy_name'].' Assigned, Phone : '.$boydata['deliveryboy_contactno'];
                            } else if($row["booking_status"] == 4) {
                                $statusClass = 'status-shipped';
                                $statusText = 'Delivered';
                            // } else if($roww["booking_status"] == 5) {
                            //     $statusClass = 'status-completed';
                            //     $statusText = 'Delivered';
                            }
                            
                            echo '<span class="status '.$statusClass.'">'.$statusText.'</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo '<div class="empty-state">
                        <div class="empty-state-icon">📦</div>
                        <h3>No Requested Orders</h3>
                        <p>You haven\'t placed any orders through requests yet.</p>
                      </div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php
include("Footer.php");
?>