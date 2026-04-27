<?php
include('Head.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Brand</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background: linear-gradient(135deg, #e6f0ff 0%, #f5f9ff 100%);
        color: #333;
        min-height: 100vh;
        /* display: flex;
        justify-content: center;
        align-items: center; */
        /* padding: 20px; */
    }
    
    .container {
        width: 100%;
        max-width: 500px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 81, 255, 0.15);
        overflow: hidden;
    }
    
    .header {
        background: #1a73e8;
        color: white;
        padding: 25px;
        text-align: center;
        font-size: 24px;
        font-weight: 600;
    }
    
    .form-container {
        padding: 30px;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table tr td {
        padding: 15px;
    }
    
    .form-table tr td:first-child {
        width: 100px;
        font-weight: 600;
        color: #1a73e8;
        padding-right: 10px;
    }
    
    input[type="text"] {
        width: 100%;
        padding: 14px;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        font-size: 16px;
        transition: all 0.3s;
        outline: none;
    }
    
    input[type="text"]:focus {
        border-color: #1a73e8;
        box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
    }
    
    input[type="text"]::placeholder {
        color: #aaa;
    }
    
    .btn-container {
        text-align: center;
        margin-top: 20px;
    }
    
    input[type="submit"] {
        background: #1a73e8;
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
        box-shadow: 0 4px 12px rgba(26, 115, 232, 0.3);
    }
    
    input[type="submit"]:hover {
        background: #0d62c9;
        transform: translateY(-2px);
    }
    
    input[type="submit"]:active {
        transform: translateY(0);
    }
    
    .brand-icon {
        display: block;
        text-align: center;
        margin-bottom: 20px;
        color: #1a73e8;
    }
    
    .brand-icon svg {
        width: 60px;
        height: 60px;
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        Brand Management
    </div>
    
    <div class="form-container">
        <div class="brand-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M5.507 4.048A3 3 0 017.785 3h8.43a3 3 0 012.278 1.048l1.722 2.008A4.533 4.533 0 0019.5 6h-15c-.243 0-.482.02-.715.056l1.722-2.008z" />
                <path fill-rule="evenodd" d="M1.5 10.5a3 3 0 013-3h15a3 3 0 110 6h-15a3 3 0 01-3-3zm15 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm2.25.75a.75.75 0 100-1.5.75.75 0 000 1.5zM4.5 15a3 3 0 100 6h15a3 3 0 100-6h-15zm11.25 3.75a.75.75 0 100-1.5.75.75 0 000 1.5zM19.5 18a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" clip-rule="evenodd" />
            </svg>
        </div>
        
        <form id="form1" name="form1" method="post" action="">
            <table class="form-table">
                <tr>
                    <td>Brand</td>
                    <td>
                        <input type="text" name="txt_brand" id="txt_brand" placeholder="Enter brand name" required />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="btn-container">
                            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>
<?php
include('Foot.php');
?>