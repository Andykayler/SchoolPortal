<?php
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
    $semester_name = $conn->real_escape_string($_POST['semester']); 
    $major = isset($_POST['major']) ? $conn->real_escape_string($_POST['major']) : NULL;

    $sql = "SELECT id FROM semesters WHERE name = '$semester_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $semester_id = $row['id'];
    } else {
        echo "<div class='alert alert-danger text-center'>Invalid semester selected.</div>";
        exit;
    }

    
    $conn->begin_transaction();
    try {
        
        $sql = "INSERT INTO students (userType, name, RegNo, gender, faculty, semester_id, major)
                VALUES ('$userType', '$name', '$regNo', '$gender', '$faculty', '$semester_id', '$major')";

        if ($conn->query($sql) === TRUE) {
           
            $student_id = $conn->insert_id;   

            // Fetch all courses related to the selected semester
            $courseSql = "SELECT id FROM courses WHERE semester_id = '$semester_id'";
            $courseResult = $conn->query($courseSql);

            if ($courseResult->num_rows > 0) {
                
                while ($courseRow = $courseResult->fetch_assoc()) {
                    $course_id = $courseRow['id'];

                   
                    $insertCourseSql = "INSERT INTO student_courses (student_id, course_id)
                                        VALUES ('$student_id', '$course_id')";
                    if (!$conn->query($insertCourseSql)) {
                        throw new Exception("Error inserting course: " . $conn->error);
                    }
                }
            }

           
            $conn->commit();
            echo "<div class='alert alert-success text-center'>Registration successful!</div>";
        } else {
            throw new Exception("Error: " . $sql . "<br>" . $conn->error);
        }
    } catch (Exception $e) {
        
        $conn->rollback();
        echo "<div class='alert alert-danger text-center'>Transaction failed: " . $e->getMessage() . "</div>";
    }

    
    $conn->close();
}
?>
