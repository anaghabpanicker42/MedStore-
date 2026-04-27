<?php
include("../Assets/Connection/Connection.php");
session_start();
//include("Header.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pharmacy Request Manager</title>
<style>
    /* Base styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f0f7ff;
        color: #2c3e50;
        line-height: 1.6;
        padding: 20px;
    }
    
    /* Container styling */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 102, 204, 0.15);
        padding: 25px;
        overflow: hidden;
    }
    
    /* Header styling */
    .page-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #0066cc;
    }
    
    .page-header h1 {
        color: #0066cc;
        font-size: 32px;
        margin-bottom: 10px;
    }
    
    /* Table styling */
    .request-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }
    
    .request-table th {
        background: #0066cc;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    
    .request-table td {
        padding: 15px;
        border-bottom: 1px solid #e6f2ff;
        vertical-align: top;
    }
    
    .request-table tr:nth-child(even) {
        background: #f5f9ff;
    }
    
    .request-table tr:hover {
        background: #e6f2ff;
        transition: background 0.3s;
    }
    
    /* User details styling */
    .user-details {
        line-height: 1.8;
    }
    
    .user-name {
        font-weight: bold;
        color: #0066cc;
        font-size: 16px;
    }
    
    .user-contact {
        color: #555;
        font-size: 14px;
    }
    
    /* Action link styling */
    .action-link {
        display: inline-block;
        padding: 8px 16px;
        background: #0066cc;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.3s;
        margin: 5px 0;
        text-align: center;
    }
    
    .action-link.view-proof {
        background: #0099cc;
    }
    
    .action-link.view-products {
        background: #004c99;
    }
    
    .action-link:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    /* Status indicators */
    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 5px;
    }
    
    .status-pending {
        background: #fff4e6;
        color: #ff8c00;
    }
    
    .status-approved {
        background: #e6fffa;
        color: #00b38f;
    }
    
    .status-rejected {
        background: #ffe6e6;
        color: #ff4d4d;
    }
    
    /* Empty state styling */
    .empty-state {
        text-align: center;
        padding: 40px;
        color: #8898aa;
    }
    
    .empty-state i {
        font-size: 50px;
        margin-bottom: 15px;
        color: #c0d5f0;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .request-table {
            display: block;
            overflow-x: auto;
        }
        
        .request-table th, 
        .request-table td {
            min-width: 120px;
        }
        
        .container {
            padding: 15px;
        }
        
        .action-link {
            display: block;
            width: 100%;
            margin: 5px 0;
        }
    }
    
    /* Animation for table rows */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .request-table tr {
        animation: fadeIn 0.5s ease forwards;
    }
    
    .request-table tr:nth-child(1) { animation-delay: 0.1s; }
    .request-table tr:nth-child(2) { animation-delay: 0.2s; }
    .request-table tr:nth-child(3) { animation-delay: 0.3s; }
    .request-table tr:nth-child(4) { animation-delay: 0.4s; }
    .request-table tr:nth-child(5) { animation-delay: 0.5s; }
</style>
</head>

<body>
<div class="container">
    <div class="page-header">
        <h1>Pharmacy Requests</h1>
        <p>Manage prescription requests from users</p>
    </div>
    
    <?php
    if(isset($_GET['status'])) {
        echo '<div style="padding:10px; margin-bottom:20px; background:#d4edda; color:#155724; border-radius:5px; text-align:center;">
                Operation completed successfully!
              </div>';
    }
    ?>
    
    <table class="request-table">
        <tr>
            <th width="5%">Sl No</th>
            <th width="25%">User Details</th>
            <th width="20%">Proof Document</th>
            <th width="20%">Actions</th>
        </tr>
        <?php
        $i = 0;
        $selQry = "select * from tbl_request r inner join tbl_user u on r.user_id=u.user_id where r.pharmacy_id='".$_SESSION['pid']."'";
        $result = $Con->query($selQry);
        
        if($result && $result->num_rows > 0) {
            while($data = $result->fetch_assoc()) {
                $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td>
                <div class="user-details">
                    <div class="user-name"><?php echo $data['user_name']?></div>
                    <div class="user-contact"><?php echo $data['user_email']?></div>
                    <div class="user-contact"><?php echo $data['user_phone']?></div>
                </div>
            </td>
            <td>
                <a href="../Assets/Files/Request/<?php echo $data['request_file'] ?>" class="action-link view-proof" target="_blank">View Proof</a>
            </td>
            <td>
                <a href="ViewMedicines.php?rid=<?php echo $data['request_id']?>" class="action-link view-products">View Products</a>
            </td>
        </tr>
        <?php
            }
        } else {
        ?>
        <tr>
            <td colspan="4">
                <div class="empty-state">
                    <div>📋</div>
                    <h3>No Requests Found</h3>
                    <p>There are currently no prescription requests to display.</p>
                </div>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>

<script>
    // Add confirmation for important actions
    document.addEventListener('DOMContentLoaded', function() {
        const actionLinks = document.querySelectorAll('.action-link');
        actionLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if(this.classList.contains('delete-request')) {
                    if(!confirm('Are you sure you want to delete this request?')) {
                        e.preventDefault();
                    }
                }
            });
        });
        
        // Add subtle animation to table rows on hover
        const tableRows = document.querySelectorAll('.request-table tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 8px rgba(0, 102, 204, 0.1)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });
    });
</script>
</body>
</html>
<?php
include("Footer.php");
?>