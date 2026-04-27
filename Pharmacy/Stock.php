<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
$pr_id="";
if(isset($_POST['btn_submit']))
{
	$qty=$_POST['txt_qty'];
	$date=$_POST['txt_date'];
	
	$insQry="insert into tbl_stock(stock_qty,stock_date,product_id)values('".$qty."','".$date."','".$_GET["eid"]."')";
	
	if($Con->query($insQry))
    {
	?>
    <script>
	alert("Inserted")
	window.location="Stock.php?eid=<?php echo $_GET['eid']; ?>";
	</script>
    <?php
   }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stock Management System</title>
<style>
    /* Base styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f0f8ff;
        color: #2c3e50;
        line-height: 1.6;
        padding: 20px;
    }
    
    /* Container styling */
    .container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(173, 216, 230, 0.3);
        padding: 25px;
        overflow: hidden;
    }
    
    /* Header styling */
    .page-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #87ceeb;
    }
    
    .page-header h1 {
        color: #4682b4;
        font-size: 32px;
        margin-bottom: 10px;
    }
    
    /* Form styling */
    .stock-form {
        background: #e6f2ff;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 30px;
        box-shadow: 0 0 10px rgba(173, 216, 230, 0.2);
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table td {
        padding: 12px;
        vertical-align: top;
    }
    
    .form-label {
        font-weight: bold;
        color: #4682b4;
        width: 30%;
    }
    
    input[type="text"], 
    input[type="date"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #b0e0e6;
        border-radius: 4px;
        background: white;
        font-size: 15px;
    }
    
    input[type="text"]:focus, 
    input[type="date"]:focus,
    input[type="number"]:focus {
        outline: none;
        border-color: #87ceeb;
        box-shadow: 0 0 5px rgba(135, 206, 235, 0.5);
    }
    
    input[type="submit"] {
        background: #4682b4;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background 0.3s;
        display: block;
        margin: 0 auto;
    }
    
    input[type="submit"]:hover {
        background: #5f9ea0;
    }
    
    /* Inventory summary */
    .inventory-summary {
        background: #e6f2ff;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }
    
    .summary-item {
        text-align: center;
        padding: 10px;
    }
    
    .summary-value {
        font-size: 24px;
        font-weight: bold;
        color: #4682b4;
    }
    
    .summary-label {
        font-size: 14px;
        color: #666;
    }
    
    /* Stock table styling */
    .stock-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }
    
    .stock-table th {
        background: #87ceeb;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    
    .stock-table td {
        padding: 15px;
        border-bottom: 1px solid #e6f2ff;
        vertical-align: middle;
    }
    
    .stock-table tr:nth-child(even) {
        background: #f5f9ff;
    }
    
    .stock-table tr:hover {
        background: #e6f2ff;
        transition: background 0.3s;
    }
    
    /* Stock indicators */
    .stock-count {
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 14px;
        display: inline-block;
        text-align: center;
        min-width: 50px;
    }
    
    .stock-high {
        background: #e6fffa;
        color: #00b38f;
    }
    
    .stock-medium {
        background: #fff4e6;
        color: #ff8c00;
    }
    
    .stock-low {
        background: #ffe6e6;
        color: #ff4d4d;
    }
    
    .stock-out {
        background: #f0f0f0;
        color: #999;
    }
    
    /* Animation for stock updates */
    @keyframes stockUpdate {
        0% { background-color: #fff; }
        50% { background-color: #ffffd6; }
        100% { background-color: #fff; }
    }
    
    .stock-updated {
        animation: stockUpdate 1s ease;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .form-table {
            display: block;
        }
        
        .form-table tr {
            display: block;
            margin-bottom: 15px;
        }
        
        .form-table td {
            display: block;
            width: 100%;
        }
        
        .form-label {
            width: 100%;
            margin-bottom: 5px;
        }
        
        .stock-table {
            display: block;
            overflow-x: auto;
        }
        
        .container {
            padding: 15px;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="page-header">
        <h1>Stock Management</h1>
        <p>Manage inventory for your products</p>
    </div>
    
    <?php
    // Get product name for display
    $product_name = "Product";
    if(isset($_GET['eid'])) {
        $productQry = "SELECT product_name FROM tbl_product WHERE product_id = ".$_GET['eid'];
        $productResult = $Con->query($productQry);
        if($productResult && $productResult->num_rows > 0) {
            $productData = $productResult->fetch_assoc();
            $product_name = $productData['product_name'];
        }
    }
    ?>
    
    <div class="inventory-summary">
        <div class="summary-item">
            <div class="summary-value" id="total-stock">0</div>
            <div class="summary-label">Total Stock</div>
        </div>
        <div class="summary-item">
            <div class="summary-value" id="available-stock">0</div>
            <div class="summary-label">Available</div>
        </div>
        <div class="summary-item">
            <div class="summary-value" id="sold-items">0</div>
            <div class="summary-label">Items Sold</div>
        </div>
    </div>
    
    <div class="stock-form">
        <h2>Add Stock for: <?php echo $product_name; ?></h2>
        <form id="form1" name="form1" method="post" action="">
            <table class="form-table">
                <tr>
                    <td class="form-label">Stock Quantity</td>
                    <td><input type="number" name="txt_qty" id="txt_qty" min="1" required /></td>
                </tr>
                <tr>
                    <td class="form-label">Stock Date</td>
                    <td><input type="date" name="txt_date" id="txt_date" required /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Add Stock" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <h2>Stock History</h2>
    <table class="stock-table">
        <tr>
            <th width="10%">Sl No</th>
            <th width="30%">Stock Quantity</th>
            <th width="30%">Stock Date</th>
            <th width="30%">Status</th>
        </tr>
        <?php
        $i = 0;
        $total_stock = 0;
        $selQry = "select * from tbl_stock where product_id=".$_GET['eid'] . " ORDER BY stock_date DESC";
        $result = $Con->query($selQry);
        
        if($result && $result->num_rows > 0) {
            while($data = $result->fetch_assoc()) {
                $i++;
                $total_stock += $data['stock_qty'];
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $data['stock_qty']?></td>
            <td><?php echo $data['stock_date']?></td>
            <td><span class="stock-count stock-high">Added</span></td>
        </tr>
        <?php
            }
        } else {
        ?>
        <tr>
            <td colspan="4" style="text-align: center;">No stock records found.</td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>

<script>
    // Initialize variables
    let availableStock = <?php echo $total_stock; ?>;
    let soldItems = 0;
    
    // Update summary on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateStockDisplay();
    });
    
    // Function to update stock display
    function updateStockDisplay() {
        document.getElementById('total-stock').textContent = availableStock + soldItems;
        document.getElementById('available-stock').textContent = availableStock;
        document.getElementById('sold-items').textContent = soldItems;
    }
    
    // Set today's date as default for the date input
    document.getElementById('txt_date').valueAsDate = new Date();
</script>
</body>
</html>
<?php
include("Footer.php");
?>