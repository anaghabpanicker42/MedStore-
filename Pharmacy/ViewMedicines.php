<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
//session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pharmacy - View Medicines</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f5f7fa;
        color: #333;
        line-height: 1.6;
        padding: 20px;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .header {
        background: linear-gradient(135deg, #2c3e50, #4a6491);
        color: white;
        padding: 25px;
        text-align: center;
    }
    
    .header h1 {
        margin-bottom: 10px;
        font-size: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }
    
    .header p {
        opacity: 0.9;
    }
    
    .content {
        padding: 25px;
    }
    
    .cart-button {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background-color: #e67e22;
        color: white;
        padding: 12px 25px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(230, 126, 34, 0.3);
        margin-bottom: 25px;
    }
    
    .cart-button:hover {
        background-color: #d35400;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(230, 126, 34, 0.4);
    }
    
    .search-container {
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
    }
    
    .search-input {
        flex: 1;
        padding: 12px 20px;
        border: 1px solid #ddd;
        border-radius: 50px;
        font-size: 16px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        outline: none;
        transition: all 0.3s;
    }
    
    .search-input:focus {
        border-color: #3498db;
        box-shadow: 0 2px 8px rgba(52, 152, 219, 0.2);
    }
    
    .medicines-table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-top: 20px;
    }
    
    .medicines-table th {
        background-color: #3498db;
        color: white;
        text-align: left;
        padding: 16px;
        font-weight: 600;
    }
    
    .medicines-table td {
        padding: 16px;
        border-bottom: 1px solid #eaeaea;
        vertical-align: top;
    }
    
    .medicines-table tr:nth-child(even) {
        background-color: #f8fafc;
    }
    
    .medicines-table tr:hover {
        background-color: #f1f5f9;
        transition: background-color 0.2s;
    }
    
    .add-to-cart {
        background-color: #2ecc71;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .add-to-cart:hover {
        background-color: #27ae60;
        transform: scale(1.05);
    }
    
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        border-radius: 8px;
        background-color: #2ecc71;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: none;
        z-index: 1000;
        animation: fadeIn 0.3s ease;
        max-width: 350px;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .product-name {
        font-weight: 600;
        color: #2c3e50;
    }
    
    .product-description {
        color: #7f8c8d;
        font-size: 14px;
        margin-top: 5px;
    }
    
    .product-price {
        font-weight: 700;
        color: #e74c3c;
        font-size: 18px;
    }
    
    .brand-name {
        background-color: #e6f2ff;
        color: #3498db;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    
    .footer {
        text-align: center;
        margin-top: 40px;
        padding: 20px;
        color: #7f8c8d;
        font-size: 14px;
    }
    
    .no-results {
        text-align: center;
        padding: 30px;
        color: #7f8c8d;
        font-style: italic;
    }
    
    @media (max-width: 768px) {
        .medicines-table {
            display: block;
            overflow-x: auto;
        }
        
        .header h1 {
            font-size: 24px;
        }
        
        .cart-button {
            padding: 10px 18px;
            font-size: 14px;
        }
        
        .search-container {
            flex-direction: column;
        }
        
        .medicines-table td, .medicines-table th {
            padding: 12px;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1><i class="fas fa-pills"></i> Pharmacy Medicines</h1>
        <p>Browse and add medicines to your cart</p>
    </div>
    
    <div class="content">
        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Search medicines by name, description or brand...">
            <button class="add-to-cart" onclick="filterMedicines()">
                <i class="fas fa-search"></i> Search
            </button>
        </div>
        
        <a href="PharmacyMyCart.php?rid=<?php echo $_GET['rid']?>" class="cart-button">
            <i class="fas fa-shopping-cart"></i> My Cart
        </a>
        
        <table class="medicines-table">
            <thead>
                <tr>
                    <th width="5%">Sl No</th>
                    <th width="20%">Product</th>
                    <th width="30%">Description</th>
                    <th width="15%">Brand</th>
                    <th width="10%">Price</th>   
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody id="medicineTableBody">
                <?php
                $i=0;
                $selQry="select * from tbl_product p inner join tbl_brand b on p.brand_id=b.brand_id where pharmacy_id='".$_SESSION['pid']."'";
                $result=$Con->query($selQry);
                if($result && $result->num_rows > 0) {
                    while($data=$result->fetch_assoc())
                    {
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td>
                        <div class="product-name"><?php echo $data['product_name']?></div>
                    </td>
                    <td>
                        <div class="product-description"><?php echo $data['product_details']?></div>
                    </td>
                    <td>
                        <span class="brand-name"><?php echo $data['brand_name']?></span>
                    </td>
                    <td class="product-price">$<?php echo $data['product_price']?></td>
                    <td>
                        <button class="add-to-cart" onclick="AddtoCart(<?php echo $data['product_id']?>,<?php echo $_GET['rid']; ?>)">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </td>
                </tr>
                <?php
                    }
                } else {
                ?>
                <tr>
                    <td colspan="6" class="no-results">No medicines found in your inventory.</td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <div class="footer">
        <p>© 2023 Pharmacy Management System | Designed for Better Healthcare</p>
    </div>
</div>

<div id="notification" class="notification"></div>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function AddtoCart(pid,rid) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxAddtoCart.php?id="+ pid + "&rid=" + rid,
            success: function(result) {
                showNotification(result);
            }
        });
    }
    
    function showNotification(message) {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.style.display = 'block';
        
        setTimeout(function() {
            notification.style.display = 'none';
        }, 3000);
    }
    
    function filterMedicines() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toUpperCase();
        const table = document.getElementById('medicineTableBody');
        const tr = table.getElementsByTagName('tr');
        let resultsFound = false;
        
        for (let i = 0; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName('td');
            let found = false;
            
            for (let j = 0; j < td.length; j++) {
                if (td[j]) {
                    const txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            
            if (found) {
                tr[i].style.display = '';
                resultsFound = true;
            } else {
                tr[i].style.display = 'none';
            }
        }
        
        if (!resultsFound) {
            table.innerHTML = '<tr><td colspan="6" class="no-results">No medicines match your search.</td></tr>';
        }
    }
    
    // Add event listener for Enter key in search input
    document.getElementById('searchInput').addEventListener('keyup', function(event) {
        if (event.key === 'Enter') {
            filterMedicines();
        }
    });
</script>
</body>
</html>

<?php
include("Footer.php");
?>