<?php 
session_start();

// Check if studentID is set in the session
if (!isset($_SESSION['studentID'])) {
    header("Location: login.php");
    exit;
}

$studentID = $_SESSION['studentID'];  // Get the student ID from the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <script src="script.js" defer></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Body styling */
        body {
            background-color: #2c2c2c;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Header styling */
        header {
            width: 100%;
            background-color: black;
            color: white;
            display: flex;
            align-items: center;
            padding: 10px 0;
            position: fixed;
            top: 0;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        .logo img {
            height: 50px;
        }

        .logo h1 {
            font-size: 1.5rem;
            margin-left: 10px;
        }

        /* Navigation styling */
        nav {
            display: flex;
            justify-content: flex-end;
            margin-right: 50px;
            flex-grow: 1;
        }

        nav ul {
            display: flex;
            list-style: none;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px;
            font-size: 1.1rem;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            transition: all 0.3s ease;
            border-radius: 50%;
            display: block;
        }

        /* Circular hover effect */
        nav ul li a:hover {
            background-color: #f39c12;
            color: black;
            transform: scale(1.1);
            border-radius: 50%;
        }

        /* Registration form */
        .registration-form {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
            width: 500px;
            color: white;
            margin-top: 100px; /* Add margin for header */
        }

        @media (max-width: 768px) {
            .registration-form {
                width: 90%;
            }

            header {
                flex-direction: column;
            }

            nav {
                justify-content: center;
            }
        }

        /* Form styling */
        label {
            color: #f39c12;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            border-bottom: 2px solid #a67c00;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .btn-custom {
            background-color: #f39c12;
            color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .btn-custom:hover {
            background-color: #e67e22;
        }

        .btn-cancel {
            background-color: #333333;
            color: white;
            border-radius: 8px;
        }

        .btn-cancel:hover {
            background-color: #555555;
        }
    </style>
</head>
<body>
<!-- Header -->
<header>
    <div class="logo">
        <img src="Daeyang.png" alt="University Logo">
        <h1>Daeyang University</h1>
    </div>
    <nav>
        <ul>
            <li><a href="../login/land.php">Home</a></li>
            <li><a href="about.php">my modules</a></li>
            <li><a href="results.php">Results</a></li>
            <li><a href="contacts.php">Contacts</a></li>
            <li><a href="contacts.php">profile</a></li>
            <li><a href="contacts.php">Logout</a></li>
        </ul>
    </nav>
</header>

<!-- Registration Form -->
<div class="registration-form">
    <h5 class="text-center">Register</h5>
    <form id="registrationForm" method="POST" action="">
        <div class="form-group">
            <label for="userType">User Type</label>
            <select class="form-control" id="userType" name="userType" required>
                <option value="student">Student</option>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="regNo">Registration No.</label>
            <!-- Automatically insert the studentID from session into the input field -->
            <input type="text" class="form-control" id="regNo" name="regNo" value="<?php echo $studentID; ?>" required>
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
            <label for="faculty">Faculty</label>
            <select class="form-control" id="faculty" name="faculty" required>
                <option value="">Select Faculty</option>
                <option value="ict">ICT</option>
                <option value="nursing">Nursing</option>
                <option value="commerce">Commerce</option>
            </select>
        </div>
        <div class="form-group">
            <label for="semester">Semester</label>
            <select class="form-control" id="semester" name="semester" required>
                <option value="">Select Semester</option>
                <option value="semester1">Semester 1</option>
                <option value="semester2">Semester 2</option>
                <option value="semester3">Semester 3</option>
                <option value="semester4">Semester 4</option>
                <option value="semester5">Semester 5</option>
                <option value="semester6">Semester 6</option>
                <option value="semester7">Semester 7</option>
                <option value="semester8">Semester 8</option>
            </select>
        </div>
        <div class="form-group" id="coursesContainer" style="display:none;">
            <label for="courses">Courses</label>
            <div id="coursesList"></div>
        </div>
        <button type="button" class="btn btn-cancel btn-block" onclick="cancelForm()">Cancel</button>
        <button type="submit" class="btn btn-custom btn-block">Request approval</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
