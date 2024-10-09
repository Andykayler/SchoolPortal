<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment Proof</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-content {
            border-radius: 15px;
            background-color: #f7f4f9;
        }
        .modal-header, .modal-footer {
            border: none;
        }
        .form-group label {
            font-weight: bold;
        }
        .drag-area {
            border: 2px dashed #6c757d;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            color: #6c757d;
        }
        .drag-area.drag-over {
            background-color: #e9ecef;
        }
        .pending-status {
            display: none;
            text-align: center;
            color: #ffc107;
            font-weight: bold;
            margin-top: 10px;
        }
        .spinner-border {
            width: 2rem;
            height: 2rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Payment Proof Form -->
                        <form id="paymentProofForm" method="POST" enctype="multipart/form-data">
                            <div class="form-group text-center">
                                <label>Account Number: 14412808</label><br>
                                <label>SWIFT: NBSTMWMW</label><br>
                                <label>NATIONAL BANK</label>
                            </div>
                            <div class="form-group">
                                <label for="userType">User Type</label>
                                <select class="form-control" id="userType" name="userType" required>
                                    <option value="">Select User Type</option>
                                    <option value="student">Student</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fileUpload">Proof of Payment</label>
                                <div class="drag-area" id="dragArea">
                                    <p>Drag & Drop to Upload Files</p>
                                    <p>or</p>
                                    <button type="button" class="btn btn-secondary" id="browseButton">Browse Files</button>
                                    <input type="file" id="fileUpload" name="fileUpload" multiple style="display:none;">
                                </div>
                                <div id="fileList" class="mt-3"></div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-secondary" id="cancelButton">Cancel</button>
                            </div>
                            <!-- Pending Status Message -->
                            <div class="pending-status" id="pendingStatus">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <p>Your payment proof is pending approval.</p>
                            </div>
                        </form>

                        <!-- PHP Script to Handle Form Submission -->
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "student_registration"; 

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // $userType = $conn->real_escape_string($_POST['userType']);
                            $name = $conn->real_escape_string($_POST['name']);
                            $email = $conn->real_escape_string($_POST['email']);
                            $gender = $conn->real_escape_string($_POST['gender']);
                            $fileName = '';

                            // File upload handling
                            if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
                                $fileName = basename($_FILES['fileUpload']['name']);
                                $targetFilePath = "uploads/" . $fileName;

                                if (!move_uploaded_file($_FILES['fileUpload']['tmp_name'], $targetFilePath)) {
                                    echo "Error uploading the file.";
                                    exit;
                                }
                            }

                            $sql = "INSERT INTO payment_requests (name, email, gender, file_name, status) 
                                    VALUES ( '$name', '$email', '$gender', '$fileName', 'pending')";

                            if ($conn->query($sql) === TRUE) {
                                echo "<script>document.getElementById('pendingStatus').style.display = 'block';</script>";
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                            $conn->close();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Drag & Drop and File Upload Handling
        const dragArea = document.getElementById('dragArea');
        const fileUpload = document.getElementById('fileUpload');
        const fileList = document.getElementById('fileList');
        const browseButton = document.getElementById('browseButton');
        const cancelButton = document.getElementById('cancelButton');
        const paymentProofForm = document.getElementById('paymentProofForm');

        dragArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dragArea.classList.add('drag-over');
        });

        dragArea.addEventListener('dragleave', () => {
            dragArea.classList.remove('drag-over');
        });

        dragArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dragArea.classList.remove('drag-over');
            handleFiles(event.dataTransfer.files);
        });

        browseButton.addEventListener('click', () => {
            fileUpload.click();
        });

        fileUpload.addEventListener('change', () => {
            handleFiles(fileUpload.files);
        });

        cancelButton.addEventListener('click', () => {
            paymentProofForm.reset();
            fileList.innerHTML = '';
        });

        function handleFiles(files) {
            fileList.innerHTML = '';
            Array.from(files).forEach(file => {
                const listItem = document.createElement('p');
                listItem.textContent = file.name;
                fileList.appendChild(listItem);
            });
        }
    </script>
</body>
</html>
