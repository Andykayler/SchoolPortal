<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Body styling */
body {
    background-color: #f0f0f0; /* Light background */
    font-family: Arial, sans-serif; /* Use a clean font */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Header styling */
header {
    width: 100%;
    background-color: #333; /* Dark header */
    color: white;
    display: flex;
    align-items: center;
    padding: 10px 20px;
    position: fixed;
    top: 0;
    z-index: 100;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Logo */
.logo {
    display: flex;
    align-items: center;
}

.logo img {
    height: 40px;
}

.logo h1 {
    font-size: 1.2rem;
    margin-left: 10px;
    font-weight: normal;
}

/* Navigation styling */
nav {
    display: flex;
    justify-content: flex-end;
    margin-left: auto;
}

nav ul {
    display: flex;
    list-style: none;
    padding: 0;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    padding: 8px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

nav ul li a:hover {
    background-color: #f39c12;
    color: black;
}

/* Form container */
.registration-form {
    background-color: white;
    padding: 30px;
    margin-top: 120px;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    width: 600px;
}

/* Form styling */
label {
    font-weight: bold;
    color: #333;
}

.form-control {
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 15px;
    width: 100%;
}

.form-control::placeholder {
    color: #999;
}

.btn-custom {
    background-color: #f39c12;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    width: 100%;
}

.btn-custom:hover {
    background-color: #e67e22;
}

.btn-cancel {
    background-color: #555;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

.btn-cancel:hover {
    background-color: #333;
}

/* Responsive design */
@media (max-width: 768px) {
    .registration-form {
        width: 90%;
    }

    header {
        flex-direction: column;
        padding: 10px;
    }

    nav ul {
        flex-direction: column;
        align-items: center;
    }
}
.swal-popup-custom {
        background-color: #e0e0e0;
        border-radius: 10px;      
    }

 
    .swal-title-custom {
        color: #cf9d25;            
        font-size: 1.5rem;        
        font-weight: bold;          
    }

  
    .swal-content-custom {
        color: #333;             
        font-size: 1.1rem;          
    }

    /* Footer customization */
    .swal-footer-custom a {
        color: #f39c12;          
    }
    .custom-icon .swal2-icon.swal2-error [class^="swal2-x-mark-line"] {
    background-color: #cf9d25 !important;  /* Change the color of the "X" in error icon */
}

/* Customizing success icon color */
.custom-icon .swal2-icon.swal2-success [class^="swal2-success-line"] {
    stroke: #cf9d25 !important;  /* Change success checkmark color */
}

/* General SVG icon customization */
.custom-icon .swal2-icon svg {
    fill: #cf9d25 !important;  /* Fill color for the icon */
}
.tags-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tag-button {
    background-color: #374151;
    color: #ffffff;
    padding: 10px 20px;
    border-radius: 30px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.tag-button.active {
    background-color: #4F46E5; /* Active button color */
}

.tag-button:hover {
    background-color: #2563EB; /* Hover color */
}

    </style>
</head>
<body><?php 


// Check if studentID is set in the session
if (!isset($_SESSION['studentID'])) {
    header("Location: login.php");
    exit;
}

$studentID = $_SESSION['studentID'];  // Get the student ID from the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "student_registration";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userType = $conn->real_escape_string($_POST['userType']);
    $name = $conn->real_escape_string($_POST['name']);
    $regNo = $conn->real_escape_string($_POST['regNo']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $faculty = $conn->real_escape_string($_POST['faculty']);
    $semester = $conn->real_escape_string($_POST['semester']);
    $major = isset($_POST['major']) ? $conn->real_escape_string($_POST['major']) : NULL;

    if (isset($_POST['courses']) && is_array($_POST['courses'])) {
        $courses = implode(", ", $_POST['courses']); 
    } else {
        $courses = NULL; 
    }

    // Check if Registration No. exists
    $checkSql = "SELECT * FROM `table 2` WHERE phone = '$regNo'";
    $result = $conn->query($checkSql);

    if ($result === FALSE) {
        echo "<div class='alert alert-danger text-center'>Error: Could not execute the query.</div>";
    } elseif ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $openBalance = (float)$row['Open balance']; 

        if ($openBalance > 0.00) {
            echo "<div class='alert alert-danger text-center'>Error: Cannot register. Outstanding balance of MK" . number_format($openBalance, 2) . " found.</div>";
            echo "<div class='text-center'><form method='POST' action='payment.php'>";
            echo "<input type='hidden' name='regNo' value='$regNo'>";
            echo "<input type='hidden' name='openBalance' value='$openBalance'>";
            echo "</form></div>";
        } else {
            $sql = "INSERT INTO students (userType, name, RegNo, gender, faculty, semester, major, courses)
                    VALUES ('$userType', '$name', '$regNo', '$gender', '$faculty', '$semester', '$major', '$courses')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success text-center'>Registration successful!</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }
    } else {
        $errorMessage = "Registration No. does not exist in the system.";       }

    $conn->close();
}
?>

<header>
    <div class="logo">
        <h1>Daeyang  <span style="color: #f39c12;">University</span></h1>
    </div>
    <nav>
        <ul>
            <li><a href="../login/land.php">Home</a></li>
            <li><a href="../courses/mycourses.php">my modules</a></li>
            <li><a href="../../view/results.php">Results</a></li>
            <li><a href="contacts.php">Contacts</a></li>
            <li><a href="contacts.php">profile</a></li>
            <li><a href="../../logout.php">Logout</a></li>
        </ul>
    </nav>
</header>


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
        <div class="form-group" id="majorContainer" style="display:none;">
            <label for="major">Select Major</label>
            <select class="form-control" id="major" name="major">
               
            </select>
        </div>
        <div class="form-group" id="coursesContainer" style="display:none;">
            <label for="courses">Courses</label>
            <select class="form-control" id="courses" name="courses[]" multiple>
               
            </select>
        </div>
        <button type="button" class="btn btn-secondary btn-block" onclick="cancelForm()">Cancel</button>
        <button type="submit" class="btn btn-primary btn-block">Request approval</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    const facultyCourses = {
        ict: {
            semester1: ['BICT1101', 'BICT1102', 'BICT1103', 'BMAT1104', 'BLAN1105', 'BCWV1106'],
            semester2: ['BICT1201', 'BICT1202', 'BICT1203', 'BMAT1204', 'BLAN1205', 'BCWV1206'],
            semester3: ['BICT2101', 'BSOC2102', 'BICT2103', 'BICT2104', 'BICT2105'],
            semester4: ['BICT2201', 'BBUS2202', 'BICT2203', 'BMAT2204', 'BICT2205'],
            semester5: {
                core: ['BICT3101', 'BICT3102'],
                majors: {
                    "Software Engineering": ['BSSE3103', 'BSSE3104', 'BSSE3105'],
                    "Network Engineering": ['BSNE3201', 'BSNE3202', 'BSNE3203']
                }
            },
            semester6: {
                core: ['BICT3201', 'BICT3202'],
                majors: {
                    "Software Engineering": ['BICT3203', 'BICT3204', 'BICT3205'],
                    "Network Engineering": ['BICT3303', 'BICT3304', 'BICT3305']
                }
            },
            semester7: ['Internships'],
            semester8: {
                core: ['BAUD4402'],
                majors: {
                    "Software Engineering": ['BSSE4202', 'BSSE4203'],
                    "Network Engineering": ['BSNE4202', 'BSNE4203']
                }
            },
        },
        nursing: {
            semester1: ['OSCE', 'BNUR1102', 'BNUR1103', 'BMAT1104', 'BPHY1105'],
            semester2: ['OSCE', 'HUMAN NUTRITION', 'MEDICAL SERVICAL NURSING', 'ETHICS AND LAW', 'MICROBIOLOGY & PARASITOLOGY', 'COMMUNITY HEALTH NURSING 1'],
            semester3: ['OSCE', 'BNUR1202', 'BNUR1203', 'BMAT1204', 'BPHY1205'],
            semester4: ['OSCE', 'S&R HEALTH', 'MENTAL HEALTH NURSING', 'COMMUNITY HEALTH NURSING 3',],
            semester5: ['OSCE', 'BNUR1202', 'BNUR1203', 'BMAT1204', 'BPHY1205'],
            semester6: ['OSCE', 'ANATOMY AND PHYSIOLOGY OF OBSTETRICS', 'HEALTH SERVICE AND MANAGEMENT', 'MIDWIFERY SCIENCE'],
            semester7: ['OSCE', 'BNUR1202', 'BNUR1203', 'BMAT1204', 'BPHY1205'],
            semester8: ['OSCE', 'COMMUNITY MIDWIFER'],


            
        },
        
        commerce: {
            semester1: ['BCOM1101', 'BCOM1102', 'BCOM1103', 'BECO1104', 'BLAN1105'],
            semester2: ['BCOM1201', 'BCOM1202', 'BCOM1203', 'BECO1204', 'BLAN1205'],
            semester1: ['BCOM1101', 'BCOM1102', 'BCOM1103', 'BECO1104', 'BLAN1105'],
            semester2: ['BCOM1201', 'BCOM1202', 'BCOM1203', 'BECO1204', 'BLAN1205'],
            
        }
    };

    function cancelForm() {
        document.getElementById('registrationForm').reset();
        document.getElementById('majorContainer').style.display = 'none';
        document.getElementById('coursesContainer').style.display = 'none';
    }

    document.getElementById('faculty').addEventListener('change', function() {
        const faculty = this.value;
        const semester = document.getElementById('semester').value;

        if (faculty && semester) {
            populateCourses(faculty, semester);
        }
    });

    document.getElementById('semester').addEventListener('change', function() {
        const faculty = document.getElementById('faculty').value;
        const semester = this.value;

        if (faculty && semester) {
            populateCourses(faculty, semester);
        }
    });

    function populateCourses(faculty, semester) {
        const majorContainer = document.getElementById('majorContainer');
        const majorSelect = document.getElementById('major');
        const coursesContainer = document.getElementById('coursesContainer');
        const coursesSelect = document.getElementById('courses');

        majorContainer.style.display = 'none';
        coursesContainer.style.display = 'none';
        majorSelect.innerHTML = '';
        coursesSelect.innerHTML = '';

        const courses = facultyCourses[faculty][semester];

        if (Array.isArray(courses)) {
            coursesContainer.style.display = 'block';
            courses.forEach(course => {
                const option = document.createElement('option');
                option.value = course;
                option.textContent = course;
                coursesSelect.appendChild(option);
            });
        } else if (typeof courses === 'object') {
            majorContainer.style.display = 'block';
            coursesContainer.style.display = 'block';

            const coreCourses = courses.core;
            const majors = courses.majors;

            Object.keys(majors).forEach(major => {
                const majorOption = document.createElement('option');
                majorOption.value = major;
                majorOption.textContent = major;
                majorSelect.appendChild(majorOption);
            });

            coreCourses.forEach(course => {
                const option = document.createElement('option');
                option.value = course;
                option.textContent = course;
                coursesSelect.appendChild(option);
            });

            majorSelect.addEventListener('change', function() {
                const selectedMajor = this.value;

                const majorCourses = majors[selectedMajor];

                const coreOptions = Array.from(coursesSelect.options);
                coreOptions.forEach(option => {
                    if (!coreCourses.includes(option.value)) {
                        option.remove();
                    }
                });

                majorCourses.forEach(course => {
                    const option = document.createElement('option');
                    option.value = course;
                    option.textContent = course;
                    coursesSelect.appendChild(option);
                });
            });

            majorSelect.dispatchEvent(new Event('change'));
        }
    }
 
 

</script>
<script>
       document.addEventListener("DOMContentLoaded", function () {
        <?php if (!empty($errorMessage)) : ?>
            Swal.fire({
                title: 'Registration failed',
                text: '<?php echo addslashes($errorMessage); ?>',
                icon: 'error',
                confirmButtonText: 'Try Again', // Change button text
                confirmButtonColor: '#cf9d25', // Set button color
                customClass: {
                    popup: 'swal-popup-custom',
                    title: 'swal-title-custom',
                    content: 'swal-content-custom',
                    footer: 'swal-footer-custom',
                    confirmButton: 'btn-custom' // Add custom class to button
                },
                buttonsStyling: false // Disable default styling
            });
        <?php endif; ?>

        document.addEventListener("DOMContentLoaded", function () {
        <?php if (!empty($errorrMessage)) : ?>
            Swal.fire({
                title: 'Registration failed',
                text: '<?php echo addslashes($errorrMessage); ?>',
                icon: 'error',
                confirmButtonText: 'Try Again', // Change button text
                confirmButtonColor: '#cf9d25', // Set button color
                customClass: {
                    popup: 'swal-popup-custom',
                    title: 'swal-title-custom',
                    content: 'swal-content-custom',
                    footer: 'swal-footer-custom',
                    confirmButton: 'btn-custom' // Add custom class to button
                },
                buttonsStyling: false // Disable default styling
            });
        <?php endif; ?>
    });
    });
</script>
</body>
</html>
