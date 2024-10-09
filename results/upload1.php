<?php
if (isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $tmpName = $file['tmp_name'];
        $fileName = basename($file['name']);

        
        $url = 'http://127.0.0.1:5000';  
        $fileData = curl_file_create($tmpName, $file['type'], $fileName);
        $postData = array('file' => $fileData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            
            echo "<p>Response from server: $response</p>";
        }

        curl_close($ch);
    } else {
        echo "<p style='color: red;'>Error uploading file.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Exam Results</title>
  
    <link rel="stylesheet" href="style.css"link>
</head>
<body>
    <div class="container">
        <h2>Upload Exam Results</h2>
        <div id="dropzone" class="dropzone">Drag and drop your file here</div>
        <form id="uploadForm" action="" method="post" enctype="multipart/form-data">
            <input type="file" id="fileInput" name="excel_file" accept=".xlsx, .csv, .xls">
            <button type="button" id="browseButton">Browse</button>
            <input type="submit" value="Upload">
        </form>
    </div>

    <script>
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('fileInput');
        const uploadForm = document.getElementById('uploadForm');
        const browseButton = document.getElementById('browseButton');

        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => e.preventDefault());
            dropzone.addEventListener(eventName, (e) => e.stopPropagation());
        });

        // Highlight drop area when file is dragged over
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, () => {
                dropzone.style.borderColor = '#28a745';
                dropzone.style.color = '#28a745';
            });
        });

        // Remove highlight on dragleave or drop
        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, () => {
                dropzone.style.borderColor = '#ccc';
                dropzone.style.color = '#aaa';
            });
        });

        // Handle drop event
        dropzone.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            if (files.length) {
                fileInput.files = files;  // Assign files to hidden input
                uploadForm.submit();  // Auto-submit the form on file drop
            }
        });

        // Browse button triggers file input click
        browseButton.addEventListener('click', () => {
            fileInput.click();
        });

        // Submit form on file selection from file dialog
        fileInput.addEventListener('change', () => {
            uploadForm.submit();
        });
    </script>
</body>
</html>
