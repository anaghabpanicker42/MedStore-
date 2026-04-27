<?php
include("../Assets/Connection/Connection.php");
include('Head.php');
if(isset($_POST['btn_submit']))
{
     $reply=$_POST['txt_reply'];
      $upQry="update tbl_complaint set complaint_reply='".$reply."' ,complaint_status=1 where complaint_id='".$_GET['rid']."'";
    if($Con->query($upQry))
        {
            ?>
<script>
            alert("Reply Sent Successfully")
            window.location="ViewComplaint.php";
            </script>
        <?php
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint Reply</title>
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
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    
    .container {
        max-width: 800px;
        width: 100%;
        margin: 0 auto;
        padding: 20px;
    }
    
    .header {
        text-align: center;
        margin-bottom: 30px;
        color: #2c3e50;
    }
    
    .header h1 {
        font-size: 2.2rem;
        margin-bottom: 10px;
        color: #3498db;
    }
    
    .header p {
        font-size: 1.1rem;
        color: #7f8c8d;
    }
    
    .card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .complaint-details {
        padding: 25px;
        border-bottom: 1px solid #eaeaea;
    }
    
    .detail-row {
        display: flex;
        margin-bottom: 15px;
        align-items: flex-start;
    }
    
    .detail-label {
        font-weight: 600;
        color: #2c3e50;
        width: 120px;
        flex-shrink: 0;
    }
    
    .detail-content {
        flex-grow: 1;
        color: #34495e;
        line-height: 1.5;
        padding: 10px 15px;
        background-color: #f8f9fa;
        border-radius: 5px;
        border-left: 3px solid #3498db;
    }
    
    .reply-section {
        padding: 25px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 10px;
        color: #2c3e50;
    }
    
    textarea {
        width: 100%;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border 0.3s;
        resize: vertical;
        min-height: 150px;
    }
    
    textarea:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 8px rgba(52, 152, 219, 0.3);
    }
    
    .btn-submit {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background 0.3s, transform 0.2s;
        display: block;
        margin-left: auto;
    }
    
    .btn-submit:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }
    
    .btn-submit:active {
        transform: translateY(0);
    }
    
    .back-link {
        display: inline-block;
        margin-top: 20px;
        color: #3498db;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }
    
    .back-link:hover {
        color: #2980b9;
        text-decoration: underline;
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .detail-row {
            flex-direction: column;
        }
        
        .detail-label {
            width: 100%;
            margin-bottom: 5px;
        }
        
        .detail-content {
            width: 100%;
        }
        
        .header h1 {
            font-size: 1.8rem;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Complaint Response</h1>
        <p>Review complaint and provide a response</p>
    </div>
    
    <div class="card">
        <div class="complaint-details">
            <?php
            $selQry="select * from tbl_complaint where complaint_id='".$_GET['rid']."'";
            $res=$Con->query($selQry);
            $data=$res->fetch_assoc()
            ?>
            
            <div class="detail-row">
                <div class="detail-label">Complaint ID:</div>
                <div class="detail-content">#<?php echo $data['complaint_id'] ?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Content:</div>
                <div class="detail-content"><?php echo $data['complaint_content'] ?></div>
            </div>
            
            <?php if(!empty($data['complaint_reply'])): ?>
            <div class="detail-row">
                <div class="detail-label">Previous Reply:</div>
                <div class="detail-content" style="background-color: #e8f4fc; border-left-color: #2ecc71;">
                    <?php echo $data['complaint_reply'] ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="reply-section">
            <form id="form1" name="form1" method="post" action="">
                <div class="form-group">
                    <label for="txt_reply">Your Response:</label>
                    <textarea name="txt_reply" id="txt_reply" placeholder="Type your response here..."><?php echo isset($data['complaint_reply']) ? $data['complaint_reply'] : ''; ?></textarea>
                </div>
                
                <div class="form-group">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Send Response" class="btn-submit" />
                </div>
            </form>
        </div>
    </div>
    
    <a href="ViewComplaint.php" class="back-link">← Back to Complaints</a>
</div>
</body>
</html>

<?php
include('Foot.php');
?>