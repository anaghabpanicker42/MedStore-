<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");
$brnd_id="";

if(isset($_POST['btn_submit']))
{
$name=$_POST['txt_name'];
$details=$_POST['txt_details'];
$type=$_POST['radio'];
$price=$_POST['txt_price'];
$brand=$_POST['sel_brand'];


$insQry="insert into tbl_product(product_name,product_details,product_type,product_price,brand_id,pharmacy_id)values('".$name."','".$details."','".$type."','".$price."','".$brand."','".$_SESSION['pid']."')";
if($Con->query($insQry))
{
	?>
    <script>
	alert("Inserted")
	window.location="Product.php";
	</script>
    <?php
}
}
if(isset($_GET['did']))
{
	$delQry="delete from tbl_product where product_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted")
		window.location="Product.php";
		</script>
        <?php
	}
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pharmacy Product Management</title>
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
        max-width: 1200px;
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
    .product-form {
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
        width: 20%;
    }
    
    input[type="text"], 
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #b0e0e6;
        border-radius: 4px;
        background: white;
        font-size: 15px;
    }
    
    input[type="text"]:focus, 
    select:focus {
        outline: none;
        border-color: #87ceeb;
        box-shadow: 0 0 5px rgba(135, 206, 235, 0.5);
    }
    
    .radio-group {
        display: flex;
        gap: 20px;
    }
    
    .radio-option {
        display: flex;
        align-items: center;
        gap: 5px;
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
    
    /* Products table styling */
    .products-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }
    
    .products-table th {
        background: #87ceeb;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    
    .products-table td {
        padding: 15px;
        border-bottom: 1px solid #e6f2ff;
        vertical-align: top;
    }
    
    .products-table tr:nth-child(even) {
        background: #f5f9ff;
    }
    
    .products-table tr:hover {
        background: #e6f2ff;
        transition: background 0.3s;
    }
    
    /* Action link styling */
    .action-link {
        display: inline-block;
        padding: 6px 12px;
        background: #4682b4;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.3s;
        margin: 3px 0;
        text-align: center;
    }
    
    .action-link.delete {
        background: #f08080;
    }
    
    .action-link.stock {
        background: #20b2aa;
    }
    
    .action-link.gallery {
        background: #6495ed;
    }
    
    .action-link:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    /* Type indicators */
    .type-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .type-prescription {
        background: #e6f7ff;
        color: #0080ff;
    }
    
    .type-without {
        background: #f0f8ff;
        color: #4682b4;
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
        
        .products-table {
            display: block;
            overflow-x: auto;
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
    
    .products-table tr {
        animation: fadeIn 0.5s ease forwards;
    }
</style>
</head>

<body>
<div class="container">
    <div class="page-header">
        <h1>Product Management</h1>
        <p>Add and manage your pharmacy products</p>
    </div>
    
    <div class="product-form">
        <h2>Add New Product</h2>
        <form id="form1" name="form1" method="post" action="">
            <table class="form-table">
                <tr>
                    <td class="form-label">New</td>
                    <td><input type="text" name="txt_new" id="txt_new" required /></td>
                </tr>
                <tr>
                    <td class="form-label">Name</td>
                    <td><input type="text" name="txt_name" id="txt_name" required /></td>
                </tr>
                <tr>
                    <td class="form-label">Details</td>
                    <td><input type="text" name="txt_details" id="txt_details" required /></td>
                </tr>
                <tr>
                    <td class="form-label">New Field</td>
                    <td><input type="text" name="txt_new" id="txt_new" required /></td>
                </tr>
                <tr>
                    <td class="form-label">Type</td>
                    <td>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" name="radio" id="rad_type1" value="1" />
                                <label for="rad_type1">Prescription needed</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" name="radio" id="rad_type2" value="0" />
                                <label for="rad_type2">Without prescription</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="form-label">Price</td>
                    <td><input type="text" name="txt_price" id="txt_price" required /></td>
                </tr>
                <tr>
                    <td class="form-label">Brand</td>
                    <td>
                        <select name="sel_brand" id="sel_brand" required>
                            <option value="">-- Select Brand --</option>
                            <?php
                            $selQry = "select * from tbl_brand";
                            $row = $Con->query($selQry);
                            while($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['brand_id']?>" 
                                <?php if($brnd_id == $data['brand_id']) echo "selected"; ?>>
                                <?php echo $data['brand_name']?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Add Product" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <h2>Product List</h2>
    <table class="products-table">
        <tr>
            <th width="5%">Sl No</th>
            <th width="15%">Name</th>
            <th width="20%">Details</th>
            <th width="15%">Type</th>
            <th width="15%">Brand</th>
            <th width="10%">Price</th>
            <th width="20%">Actions</th>
        </tr>
        <?php
        $i = 0;
        $selQry = "select * from tbl_product p inner join tbl_brand b on p.brand_id=b.brand_id WHERE p.pharmacy_id='".$_SESSION['pid']."'";
        $result = $Con->query($selQry);
        
        if($result && $result->num_rows > 0) {
            while($data = $result->fetch_assoc()) {
                $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $data['product_name']?></td>
            <td><?php echo $data['product_details'] ?></td>
            <td>
                <span class="type-badge <?php echo $data['product_type'] == 1 ? 'type-prescription' : 'type-without' ?>">
                    <?php echo $data['product_type'] == 1 ? "Prescription needed" : "Without prescription" ?>
                </span>
            </td>
            <td><?php echo $data['brand_name']?></td>
            <td>₹<?php echo $data['product_price']?></td>
            <td>
                <a href="Product.php?did=<?php echo $data['product_id']?>" class="action-link delete" 
                   onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                <a href="Stock.php?eid=<?php echo $data['product_id']?>" class="action-link stock">Add Stock</a>
                <a href="Gallery.php?gid=<?php echo $data['product_id']?>" class="action-link gallery">Add Gallery</a>
            </td>
        </tr>
        <?php
            }
        } else {
        ?>
        <tr>
            <td colspan="7">
                <div class="empty-state">
                    <div>📦</div>
                    <h3>No Products Found</h3>
                    <p>Add your first product using the form above.</p>
                </div>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>

<script>
    // Add confirmation for delete actions
    document.addEventListener('DOMContentLoaded', function() {
        const deleteLinks = document.querySelectorAll('.action-link.delete');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if(!confirm('Are you sure you want to delete this product?')) {
                    e.preventDefault();
                }
            });
        });
        
        // Add price validation
        const priceInput = document.getElementById('txt_price');
        if(priceInput) {
            priceInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
            });
        }
    });
</script>
</body>
</html>
<?php
include("Footer.php");
?>
