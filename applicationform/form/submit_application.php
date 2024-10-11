<?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "student_registration";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $nationality = isset($_POST['nationality']) ? $_POST['nationality'] : '';
    $home_district = isset($_POST['home-district']) ? $_POST['home-district'] : '';
    $traditional_authority = isset($_POST['traditional-authority']) ? $_POST['traditional-authority'] : '';
    $village = isset($_POST['village']) ? $_POST['village'] : '';
    $national_id = isset($_POST['national-id']) ? $_POST['national-id'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $other_number = isset($_POST['other-number']) ? $_POST['other-number'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $religion = isset($_POST['religion']) ? $_POST['religion'] : '';
    $denomination = isset($_POST['denomination']) ? $_POST['denomination'] : '';
    $degree = isset($_POST['degree']) ? $_POST['degree'] : '';
    $examining_body = isset($_POST['examining-body']) ? $_POST['examining-body'] : '';
    $exam_centre = isset($_POST['exam-centre']) ? $_POST['exam-centre'] : '';
    $exam_year = isset($_POST['exam-year']) ? $_POST['exam-year'] : '';
    $work_experience = isset($_POST['work-experience']) ? $_POST['work-experience'] : '';
    $entry_mode = isset($_POST['entryMode']) ? $_POST['entryMode'] : '';
    $study_mode = isset($_POST['studyMode']) ? $_POST['studyMode'] : '';
    $course1 = isset($_POST['course1']) ? $_POST['course1'] : '';
    $course2 = isset($_POST['course2']) ? $_POST['course2'] : '';
    $course3 = isset($_POST['course3']) ? $_POST['course3'] : '';
    $sponsor_name = isset($_POST['sponsor-name']) ? $_POST['sponsor-name'] : '';
    $sponsor_address = isset($_POST['sponsor-address']) ? $_POST['sponsor-address'] : '';
    $sponsor_phone = isset($_POST['sponsor-phone']) ? $_POST['sponsor-phone'] : '';
    $sponsor_email = isset($_POST['sponsor-email']) ? $_POST['sponsor-email'] : '';

    // Handle file upload
    $target_dir = "uploads/";
    
    // Check if the uploads directory exists and create if not
    if (!is_dir($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            die("Failed to create upload directory.");
        }
    }

    $proof_of_payment = $target_dir . basename($_FILES["photo"]["name"]);
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $proof_of_payment)) {
        echo "Proof of payment uploaded successfully.<br>";
    } else {
        die("Error uploading file.<br>");
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO applicants (
                surname, firstname, sex, dob, nationality, home_district, traditional_authority, village, 
                national_id, address, mobile, other_number, email, religion, denomination, degree, 
                examining_body, exam_centre, exam_year, work_experience, entry_mode, study_mode, 
                course1, course2, course3, sponsor_name, sponsor_address, sponsor_phone, 
                sponsor_email, proof_of_payment
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param(
        "ssssssssssssssssssssssssssssss", 
        $surname, 
        $firstname, 
        $sex, 
        $dob, 
        $nationality, 
        $home_district, 
        $traditional_authority, 
        $village, 
        $national_id, 
        $address, 
        $mobile, 
        $other_number, 
        $email, 
        $religion, 
        $denomination, 
        $degree, 
        $examining_body, 
        $exam_centre, 
        $exam_year, 
        $work_experience, 
        $entry_mode, 
        $study_mode, 
        $course1, 
        $course2, 
        $course3, 
        $sponsor_name, 
        $sponsor_address, 
        $sponsor_phone, 
        $sponsor_email, 
        $proof_of_payment
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo "Application submitted successfully!";
    } else {
        die("Error: " . $stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
