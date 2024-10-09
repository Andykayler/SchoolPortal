<?php

$servername = "localhost"; 
$username = "root";     
$password = "";           
$dbname = "student_registration";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}


$sql = "SELECT id, name, RegNo, semester_id, gender, faculty, created_at FROM students WHERE name LIKE '%$search%'"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Office Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        #searchInput {
            display: none;
            width: 200px;
            transition: all 0.3s ease-in-out;
        }

        #searchIcon:hover {
            cursor: pointer;
        }

        .search-bar {
            position: relative;
        }

     
        .table-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: white;
        }

       
        .table-card .table th, .table-card .table td {
            padding: 12px 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-4">Account Office Dashboard</h1>
           
            <div class="position-relative">
                <i class="bi bi-bell" style="font-size: 2rem;"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                    <span class="visually-hidden">unread notifications</span>
                </span>
            </div>
        </div>

     
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card card-block">
                    <p class="card-text">Student Fees Management</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-block">
                    <p class="card-text">Payment requests</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-block">
                    <p class="card-text">Fees Balances</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-block">
                    <p class="card-text">Reports</p>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Registered Students</h4>
               
                <div class="search-bar">
                    <i class="bi bi-search" id="searchIcon" style="font-size: 1.5rem;"></i>
                    <form class="d-inline" method="GET" action="">
                        <input type="text" id="searchInput" name="search" placeholder="Search by name" class="form-control d-inline w-auto">
                    </form>
                </div>
            </div>

            <div class="table-card mt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>REGISTRATION #</th>
                            <th>SEMESTER</th>
                            <th>GENDER</th>
                            <th>FACULTY</th>
                            <th>DATE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["RegNo"] . "</td>";
                                echo "<td>" . $row["semester_id"] . "</td>";
                                echo "<td>" . $row["gender"] . "</td>";
                                echo "<td>" . $row["faculty"] . "</td>";
                                echo "<td>" . $row["created_at"] . "</td>";
                                echo "<td>
                                        <a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary'><i class='bi bi-pencil'></i></a>
                                        <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this student?\")'><i class='bi bi-trash'></i></a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No students found</td></tr>"; 
                        }
                       
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>d
        document.getElementById('searchIcon').addEventListener('click', function () {
            var searchInput = document.getElementById('searchInput');
            if (searchInput.style.display === 'none' || searchInput.style.display === '') {
                searchInput.style.display = 'inline-block';
                searchInput.focus(); 
            } else {
                searchInput.style.display = 'none';
            }
        });
    </script>
</body>
</html>
