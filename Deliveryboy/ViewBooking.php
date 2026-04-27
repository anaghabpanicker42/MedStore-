<?php
include("../Assets/Connection/Connection.php");
//session_start();
include("Header.php");

// Check if delivery boy is logged in
if(!isset($_SESSION['dbid'])) {
    header("Location: login.php");
    exit();
}

if(isset($_GET['bid'])) {
    $update = "update tbl_booking set booking_status=4 where booking_id='".$_GET['bid']."'";
    if($Con->query($update)) {
        echo "<script>alert('Delivered'); window.location='ViewBooking.php';</script>";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delivery Boy - View Bookings</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f8fafc;
        color: #334155;
        line-height: 1.6;
        padding: 0;
    }
    
    .page-container {
        max-width: 1200px;
        margin: 100px auto 40px;
        padding: 0 20px;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #4a6cf7, #6a11cb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 15px;
    }
    
    .page-description {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 800px;
        margin: 0 auto 30px;
        line-height: 1.8;
    }
    
    .info-box {
        background: linear-gradient(to right, #f0f4ff, #e6eeff);
        border-left: 4px solid #4a6cf7;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 40px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .info-title {
        font-size: 1.4rem;
        color: #4a6cf7;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .info-content {
        color: #475569;
        line-height: 1.8;
        margin-bottom: 15px;
    }
    
    .info-list {
        list-style-type: none;
        padding-left: 20px;
    }
    
    .info-list li {
        margin-bottom: 10px;
        position: relative;
        padding-left: 25px;
    }
    
    .info-list li:before {
        content: "→";
        position: absolute;
        left: 0;
        color: #4a6cf7;
        font-weight: bold;
    }
    
    .container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 40px;
    }
    
    .container-header {
        background: linear-gradient(135deg, #4a6cf7, #6a11cb);
        color: white;
        padding: 25px;
        text-align: center;
    }
    
    .container-header h2 {
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 1.8rem;
    }
    
    .container-header p {
        opacity: 0.9;
        font-size: 1.05rem;
    }
    
    .table-container {
        padding: 25px;
        overflow-x: auto;
    }
    
    .booking-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    
    .booking-table th {
        background-color: #f1f5f9;
        padding: 18px 15px;
        text-align: left;
        font-weight: 600;
        color: #475569;
        border-bottom: 2px solid #e2e8f0;
        font-size: 1.05rem;
    }
    
    .booking-table td {
        padding: 18px 15px;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: top;
        color: #475569;
    }
    
    .booking-table tr:nth-child(even) {
        background-color: #f8fafc;
    }
    
    .booking-table tr:hover {
        background-color: #f1f5f9;
        transition: background-color 0.2s;
    }
    
    .action-btn {
        display: inline-block;
        padding: 10px 20px;
        background: #4a6cf7;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        font-size: 0.95rem;
        box-shadow: 0 4px 6px rgba(74, 108, 247, 0.25);
    }
    
    .action-btn:hover {
        background: #3a5cd8;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    .no-bookings {
        text-align: center;
        padding: 60px 40px;
        color: #64748b;
    }
    
    .no-bookings-icon {
        font-size: 70px;
        margin-bottom: 20px;
        display: block;
        color: #cbd5e1;
    }
    
    .no-bookings h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: #475569;
    }
    
    .no-bookings p {
        font-size: 1.1rem;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.6;
    }
    
    @media (max-width: 992px) {
        .page-container {
            margin-top: 90px;
        }
        
        .page-title {
            font-size: 2.2rem;
        }
    }
    
    @media (max-width: 768px) {
        .page-container {
            margin-top: 80px;
            padding: 0 15px;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
        
        .page-description {
            font-size: 1rem;
        }
        
        .info-box {
            padding: 20px;
        }
        
        .info-title {
            font-size: 1.2rem;
        }
        
        .container-header {
            padding: 20px;
        }
        
        .container-header h2 {
            font-size: 1.5rem;
        }
        
        .table-container {
            padding: 15px;
        }
        
        .booking-table {
            display: block;
            width: 100%;
        }
        
        .booking-table thead {
            display: none;
        }
        
        .booking-table tr {
            display: block;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        
        .booking-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 10px;
            text-align: right;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .booking-table td:last-child {
            border-bottom: none;
            justify-content: center;
        }
        
        .booking-table td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #475569;
            margin-right: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .page-container {
            margin-top: 70px;
        }
        
        .page-title {
            font-size: 1.6rem;
        }
        
        .container-header {
            padding: 15px;
        }
        
        .booking-table td {
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
        }
        
        .booking-table td::before {
            margin-bottom: 8px;
            width: 100%;
            border-bottom: 1px dashed #e2e8f0;
            padding-bottom: 8px;
        }
        
        .action-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
</head>

<body>
<div class="page-container">
    <div class="page-header">
        <h1 class="page-title">Delivery Management System</h1>
        <p class="page-description">Efficiently manage and track all your delivery assignments in one place. Update delivery statuses with a single click and keep customers informed about their orders.</p>
    </div>
    
    <div class="info-box">
        <h3 class="info-title">Delivery Management Guidelines</h3>
        <p class="info-content">Our delivery management system is designed to help you efficiently handle customer orders. Below are some important guidelines to follow:</p>
        <ul class="info-list">
            <li>Always verify the customer's address before marking an order as delivered</li>
            <li>Contact the customer if you encounter any issues with delivery</li>
            <li>Update delivery status promptly after successful completion</li>
            <li>Handle all packages with care to ensure products arrive in perfect condition</li>
            <li>Maintain professional communication with customers at all times</li>
        </ul>
        <p class="info-content">Your attention to these details ensures customer satisfaction and helps maintain our company's reputation for excellent service.</p>
    </div>

    <div class="container">
        <div class="container-header">
            <h2>Pending Deliveries</h2>
            <p>Orders awaiting delivery confirmation</p>
        </div>
        
        <div class="table-container">
            <?php
            $i = 0;
            $selQry = "select * from tbl_booking b inner join tbl_user u on b.user_id=u.user_id where booking_status=3 and deliveryboy_id='".$_SESSION['dbid']."'";
            $result = $Con->query($selQry);
            
            if($result->num_rows > 0) {
            ?>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Order Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($data = $result->fetch_assoc()) {
                        $i++;
                    ?>
                    <tr>
                        <td data-label="Sl No"><?php echo $i; ?></td>
                        <td data-label="Customer Name"><?php echo htmlspecialchars($data['user_name']); ?></td>
                        <td data-label="Customer Email"><?php echo htmlspecialchars($data['user_email']); ?></td>
                        <td data-label="Contact Number"><?php echo htmlspecialchars($data['user_phone']); ?></td>
                        <td data-label="Address"><?php echo htmlspecialchars($data['user_address']); ?></td>
                        <td data-label="Order Amount">₹<?php echo htmlspecialchars($data['booking_amount']); ?></td>
                        <td data-label="Action">
                            <a href="ViewBooking.php?bid=<?php echo $data['booking_id']; ?>" class="action-btn" 
                               onclick="return confirm('Mark this order as delivered?')">Mark as Delivered</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
            } else {
            ?>
            <div class="no-bookings">
                <span class="no-bookings-icon">📦</span>
                <h3>No Pending Deliveries</h3>
                <p>You don't have any orders to deliver at the moment. New assignments will appear here when they become available.</p>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    
    <!-- <div class="info-box">
        <h3 class="info-title">Delivery Performance Metrics</h3>
        <p class="info-content">Your performance is important to us. We track several metrics to ensure efficient delivery operations:</p>
        <ul class="info-list">
            <li><strong>On-time delivery rate:</strong> Maintain a high percentage of deliveries completed within the promised timeframe</li>
            <li><strong>Customer satisfaction:</strong> Positive feedback from customers about your service</li>
            <li><strong>Order accuracy:</strong> Ensuring the right products are delivered to the right customers</li>
            <li><strong>Communication effectiveness:</strong> Keeping customers informed about delivery status</li>
        </ul>
        <p class="info-content">Consistently high performance in these areas may lead to recognition and additional opportunities within our delivery network.</p>
    </div> -->
</div>

<script>
    // Add confirmation for marking as delivered
    document.addEventListener('DOMContentLoaded', function() {
        const actionLinks = document.querySelectorAll('.action-btn');
        actionLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if(!confirm('Are you sure you want to mark this order as delivered? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
</body>
</html>
<?php
include('Footer.php');
?>