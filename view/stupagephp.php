<?php

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

session_start();

if (!isset($_SESSION['studentID'])) {
    header("Location: ../students/login/login.html");
    exit;
}

$studentID = $_SESSION['studentID'];  

// Use prepared statement for SQL query
$sql = "SELECT c.course_code, c.percentage, s.gpa 
        FROM course_data c 
        JOIN student_results s ON c.reg_number = s.reg_number 
        WHERE c.reg_number = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $studentID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $course_code = htmlspecialchars($row['course_code']);
        $percentage = htmlspecialchars($row['percentage']);
        $gpa = htmlspecialchars($row['gpa']);

        if ($course_code === 'nan') {
            continue; 
        }

        // Calculate grade based on percentage
        if ($percentage >= 85) {
            $grade = 'A+';
        } elseif ($percentage >= 75) {
            $grade = 'A';
        } elseif ($percentage >= 70) {
            $grade = 'B+';
        } elseif ($percentage >= 65) {
            $grade = 'B';
        } elseif ($percentage >= 60) {
            $grade = 'C+';
        } elseif ($percentage >= 55) {
            $grade = 'C';
        } elseif ($percentage >= 50) {
            $grade = 'C-';
        } elseif ($percentage >= 45) {
            $grade = 'D';
        } elseif ($percentage >= 40) {
            $grade = 'E';
        } else {
            $grade = 'F';
        }

        // Comment based on grade
        if ($grade == 'A' || $grade == 'A+') {
            $comment = "Excellent";
        } elseif ($grade == 'F' || $grade == 'E') {
            $comment = "Fail";
        } else {
            $comment = "Pass";
        }

        // Output the table row
        echo "<tr>
                <td>{$course_code}</td>
                <td>{$percentage}%</td>
                <td>{$gpa}</td>
                <td>{$grade}</td>
                <td>{$comment}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No results found for reg_number $studentID</td></tr>";
}

$stmt->close();
$conn->close();
?>

