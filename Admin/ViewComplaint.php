<?php
include("../Assets/Connection/Connection.php");
// session_start();
include('Head.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint Management</title>
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
        padding: 20px;
    }
    
    .header {
        text-align: center;
        margin-bottom: 30px;
        color: #2c3e50;
        background: linear-gradient(135deg, #3498db, #2c3e50);
        padding: 25px;
        border-radius: 8px;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .header h1 {
        font-size: 2.2rem;
        margin-bottom: 10px;
    }
    
    .header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .complaint-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        margin-top: 20px;
    }
    
    .complaint-table th, .complaint-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eaeaea;
    }
    
    .complaint-table th {
        background-color: #3498db;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        text-align: center;
    }
    
    .complaint-table tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    
    .complaint-table tr:hover {
        background-color: #e8f4fc;
    }
    
    .action-btn {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        text-align: center;
    }
    
    .reply-btn {
        background-color: #3498db;
        color: white;
    }
    
    .reply-btn:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .user-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #eaeaea;
        transition: transform 0.3s;
        display: block;
        margin: 0 auto;
    }
    
    .user-image:hover {
        transform: scale(1.8);
        z-index: 10;
        position: relative;
        border-color: #3498db;
    }
    
    .content-cell {
        max-width: 300px;
        word-wrap: break-word;
    }
    
    .date-cell {
        white-space: nowrap;
    }
    
    .action-cell {
        text-align: center;
    }
    
    .no-complaints {
        text-align: center;
        padding: 40px;
        color: #7f8c8d;
        font-style: italic;
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    @media (max-width: 992px) {
        .complaint-table {
            font-size: 14px;
        }
        
        .complaint-table th, 
        .complaint-table td {
            padding: 10px 8px;
        }
        
        .complaint-table th:nth-child(4),
        .complaint-table td:nth-child(4) {
            display: none;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 10px;
        }
        
        .header {
            padding: 15px;
        }
        
        .header h1 {
            font-size: 1.8rem;
        }
        
        .complaint-table th:nth-child(2),
        .complaint-table td:nth-child(2),
        .complaint-table th:nth-child(3),
        .complaint-table td:nth-child(3) {
            display: none;
        }
    }
    
    @media (max-width: 480px) {
        .complaint-table th:nth-child(5),
        .complaint-table td:nth-child(5) {
            display: none;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Complaint Management</h1>
        <p>View and manage your submitted complaints</p>
    </div>
    
    <div class="table-container">
        <table class="complaint-table">
          <tr>
            <th>SL No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Photo</th>
            <th>Date</th>
            <th>Content</th>
            <th>Action</th>
          </tr>
          <?php
          $i=0;
          $selQry="select * from tbl_complaint c inner join tbl_user u on c.user_id=u.user_id ";
          $result=$Con->query($selQry);
          
          if($result->num_rows > 0) {
            while($data=$result->fetch_assoc())
            {
                $i++;
          ?>
          <tr>
            <td style="text-align: center;"><?php echo $i ?></td>
            <td><?php echo $data['user_name']?></td>
            <td><?php echo $data['user_email']?></td>
            <td style="text-align: center;">
                <img src="../Assets/Files/User/<?php echo $data['user_proof'] ?>" class="user-image" />
            </td>
            <td class="date-cell"><?php echo date('d M Y', strtotime($data['complaint_date']))?></td>
            <td class="content-cell"><?php echo $data['complaint_content']?></td>
            <td class="action-cell">
                <a href="Reply.php?rid=<?php echo $data['complaint_id']?>" class="action-btn reply-btn">Reply</a>
            </td>
          </tr>
          <?php
            }
          } else {
            echo '<tr><td colspan="7" class="no-complaints">No complaints found</td></tr>';
          }
          ?>
        </table>
    </div>
</div>
</body>
</html>
<?php
include('Foot.php');
?>