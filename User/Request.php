<?php
include("../Assets/Connection/Connection.php");

session_start();
//include("Header.php");
if(isset($_POST['btn_submit']))
{
 $file=$_FILES['txt_file']['name'];
 $path=$_FILES['txt_file']['tmp_name'];
 move_uploaded_file($path,"../Assets/Files/Request/".$file);
	
 $insQry="insert into tbl_request(request_file,pharmacy_id,user_id)values ('".$file."','".$_GET['rid']."','".$_SESSION['uid']."')";
 if($Con->query($insQry))
 {
	?>
    <script>
	alert("Inserted")
	window.location="Request.php";
	</script>
    <?php 
 }	
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Prescription | Pharmacy Request</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4efe9 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
        }
        
        .header {
            background: #2a7de1;
            color: white;
            padding: 25px 30px;
            text-align: center;
        }
        
        .header h1 {
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header p {
            opacity: 0.9;
            font-size: 14px;
        }
        
        .form-container {
            padding: 30px;
        }
        
        .upload-area {
            border: 2px dashed #2a7de1;
            border-radius: 8px;
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 25px;
            background: #f8fafc;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .upload-area:hover {
            background: #e8f4ff;
        }
        
        .upload-area.highlight {
            background: #e1f0ff;
            border-color: #1a6ac1;
        }
        
        .upload-icon {
            font-size: 48px;
            color: #2a7de1;
            margin-bottom: 15px;
        }
        
        .upload-text {
            margin-bottom: 15px;
        }
        
        .upload-text h3 {
            color: #2a7de1;
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .upload-text p {
            color: #64748b;
            font-size: 14px;
        }
        
        .browse-btn {
            display: inline-block;
            background: #2a7de1;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
            font-weight: 500;
        }
        
        .browse-btn:hover {
            background: #1a6ac1;
        }
        
        #fileInput {
            display: none;
        }
        
        .file-details {
            display: none;
            background: #f1f9ff;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            text-align: left;
        }
        
        .file-details.active {
            display: block;
        }
        
        .file-details h4 {
            color: #2a7de1;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        .file-info {
            display: flex;
            align-items: center;
        }
        
        .file-icon {
            color: #2a7de1;
            font-size: 24px;
            margin-right: 12px;
        }
        
        .file-name {
            font-weight: 500;
            color: #334155;
        }
        
        .file-size {
            color: #64748b;
            font-size: 13px;
            margin-left: 10px;
        }
        
        .remove-btn {
            color: #ef4444;
            margin-left: auto;
            cursor: pointer;
            font-size: 14px;
        }
        
        .submit-btn {
            width: 100%;
            background: #10b981;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }
        
        .submit-btn:hover {
            background: #0da271;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #64748b;
            font-size: 13px;
        }
        
        .form-footer a {
            color: #2a7de1;
            text-decoration: none;
        }
        
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }
        
        .alert.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            display: block;
        }
        
        .requirements {
            background: #fff9db;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            font-size: 13px;
            color: #8c6b0a;
        }
        
        .requirements h4 {
            margin-bottom: 8px;
            font-size: 14px;
            color: #8c6b0a;
        }
        
        .requirements ul {
            padding-left: 20px;
        }
        
        @media (max-width: 600px) {
            .container {
                max-width: 100%;
            }
            
            .form-container {
                padding: 20px;
            }
            
            .header {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-prescription"></i> Upload Prescription</h1>
            <p>Submit your prescription for pharmacy processing</p>
        </div>
        
        <!-- <div class="form-container"> -->
            <!-- <div class="alert success">
                 <i class="fas fa-check-circle"></i> Your prescription has been uploaded successfully! -->
            <!-- </div>  -->
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="upload-area" id="uploadArea">
                <div class="upload-icon">
                    <i class="fas fa-file-medical"></i>
                </div>
                <div class="upload-text">
                    <h3>Select a prescription file</h3>
                    <p>or drag and drop it here</p>
                </div>
                <div class="browse-btn" id="browseBtn">Browse Files</div>
                <input type="file" id="fileInput" name="txt_file" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
            </div>
            
            <div class="file-details" id="fileDetails">
                <h4>Selected File:</h4>
                <div class="file-info">
                    <div class="file-icon">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="file-name" id="fileName">prescription.pdf</div>
                    <div class="file-size" id="fileSize">(2.4 MB)</div>
                    <div class="remove-btn" id="removeFile">
                        <i class="fas fa-times"></i> Remove
                    </div>
                </div>
            </div>
            
            
                <!-- <input type="hidden" name="txt_file" id="hiddenFileInput"> -->
                <button type="submit" name="btn_submit" id="btn_submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Submit Prescription
                </button>
            </form>
            
            <div class="requirements">
                <h4><i class="fas fa-info-circle"></i> Requirements:</h4>
                <ul>
                    <li>Accepted formats: JPG, PNG, PDF, DOC, DOCX</li>
                    <li>Maximum file size: 5MB</li>
                    <li>Ensure prescription is clear and readable</li>
                    <li>Include doctor's signature and contact information</li>
                </ul>
            </div>
            
            <!-- <div class="form-footer">
                Need help? <a href="#">Contact our support team</a>
            </div> -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadArea = document.getElementById('uploadArea');
            const fileInput = document.getElementById('fileInput');
            const browseBtn = document.getElementById('browseBtn');
            const fileDetails = document.getElementById('fileDetails');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const removeFile = document.getElementById('removeFile');
            const hiddenFileInput = document.getElementById('hiddenFileInput');
            const form = document.getElementById('form1');
            
            // Click on upload area
            uploadArea.addEventListener('click', function() {
                fileInput.click();
            });
            
            // Prevent clicking on upload area from triggering file input when clicking buttons
            browseBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.click();
            });
            
            // File input change
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    showFileDetails(file);
                }
            });
            
            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                uploadArea.classList.add('highlight');
            }
            
            function unhighlight() {
                uploadArea.classList.remove('highlight');
            }
            
            uploadArea.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                
                if (files.length > 0) {
                    const file = files[0];
                    showFileDetails(file);
                }
            }
            
            // Show file details
            function showFileDetails(file) {
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                
                if (!validTypes.includes(file.type)) {
                    alert('Error: Please select a valid file format (JPG, PNG, PDF, DOC, DOCX).');
                    resetFileInput();
                    return;
                }
                
                // Validate file size (5MB max)
                const maxSize = 5 * 1024 * 1024; // 5MB in bytes
                if (file.size > maxSize) {
                    alert('Error: File size exceeds the maximum limit of 5MB.');
                    resetFileInput();
                    return;
                }
                
                // Display file details
                fileName.textContent = file.name;
                fileSize.textContent = `(${formatFileSize(file.size)})`;
                
                // Set file icon based on type
                const fileIcon = document.querySelector('.file-icon i');
                if (file.type.includes('image')) {
                    fileIcon.className = 'fas fa-file-image';
                } else if (file.type.includes('pdf')) {
                    fileIcon.className = 'fas fa-file-pdf';
                } else if (file.type.includes('word')) {
                    fileIcon.className = 'fas fa-file-word';
                } else {
                    fileIcon.className = 'fas fa-file';
                }
                
                fileDetails.classList.add('active');
                
                // Set value for hidden input (for demonstration only)
                hiddenFileInput.value = file.name;
            }
            
            // Format file size
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
            
            // Remove selected file
            removeFile.addEventListener('click', function(e) {
                e.stopPropagation();
                resetFileInput();
                fileDetails.classList.remove('active');
            });
            
            // Reset file input
            function resetFileInput() {
                fileInput.value = '';
                hiddenFileInput.value = '';
            }
            
            // Form submission
            form.addEventListener('submit', function(e) {
                if (!fileInput.value) {
                    e.preventDefault();
                    alert('Please select a prescription file to upload.');
                    uploadArea.style.borderColor = '#ef4444';
                    return;
                }
                
                // Show success message (in a real application, this would be after successful server processing)
                document.querySelector('.alert.success').style.display = 'block';
            });
        });
    </script>
</body>
</html>