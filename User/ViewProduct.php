<?php
include("../Assets/Connection/Connection.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Product</title>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f5f9ff;
        margin: 0;
        padding: 20px;
        color: #333;
    }
    
    .cart-link {
        display: inline-block;
        background-color: #1e88e5;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        margin: 20px 0;
        transition: background-color 0.3s;
    }
    
    .cart-link:hover {
        background-color: #1565c0;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0, 0, 150, 0.1);
    }
    
    th {
        background-color: #1e88e5;
        color: white;
        padding: 12px;
        text-align: left;
    }
    
    td {
        padding: 12px 15px;
        border-bottom: 1px solid #e0e9ff;
    }
    
    tr:nth-child(even) {
        background-color: #f8fbff;
    }
    
    tr:hover {
        background-color: #e1edff;
    }
    
    .action-btn {
        display: inline-block;
        background-color: #42a5f5;
        color: white;
        padding: 8px 15px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s;
    }
    
    .action-btn:hover {
        background-color: #1e88e5;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .product-name {
        font-weight: bold;
        color: #0d47a1;
    }
    
    .product-price {
        color: #1e88e5;
        font-weight: bold;
    }
</style>
</head>

<body>
<div class="container">
    <a href="MyCart.php" class="cart-link">My Cart</a>
    
    <table>
        <tr>
            <th>Product Name</th>
            <th>Product Details</th>
            <th>Product Price</th>
            <th>Brand Name</th>
            <th>Action</th>
        </tr>
        <?php
        $selQry = "select * from tbl_product p inner join tbl_brand b on p.brand_id=b.brand_id where p.pharmacy_id='".$_GET['did']."' and p.product_type=0";
        $result = $Con->query($selQry);
        while($data = $result->fetch_assoc()) {
        ?>
        <tr>
            <td class="product-name"><?php echo $data['product_name']?></td>
            <td><?php echo $data['product_details']?></td>
            <td class="product-price">₹<?php echo $data['product_price']?></td>
            <td><?php echo $data['brand_name']?></td>
            <td><a href="#" class="action-btn" onclick="AddtoCart(<?php echo $data['product_id']?>)">Add to Cart</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>
</body>
</html>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function AddtoCart(pid) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxAddCart.php?id=" + pid,
            success: function(result) {
                alert(result);
                window.location = "ViewProduct.php?did=<?php echo $_GET["did"]; ?>";
            }
        });
    }
</script>

<?php
include('Footer.php');
?>