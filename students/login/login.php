<?php
session_start();
require 'db_connect.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form inputs
    $studentID = $_POST['studentID'];
    $password = $_POST['password'];

    // Prepare SQL query
    $sql = "SELECT * FROM student WHERE studentID = ? AND password = ?";
    
    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the query
        $stmt->bind_param("ss", $studentID, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Login successful, start session
            $_SESSION['studentID'] = $studentID; // Store student ID in session
            header("Location: land.php");    // Redirect to dashboard
            exit;
        } else {
            // Invalid credentials
            $error = "Invalid Student ID or Password.";
        }

        $stmt->close();
    } else {
        // SQL error occurred
        echo "Error: " . $conn->error; // Output the error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Daeyang University</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg rounded" style="width: 350px;">
      <h2 class="text-center" style="color: #f39c12;">Daeyang University</h2>

      <!-- Display error message if login fails -->
      <?php if (isset($error)): ?>
        <div class="alert alert-danger">
          <?php echo $error; ?>
        </div>
      <?php endif; ?>

      <form action="login.php" method="POST">
        <div class="mb-3">
          <label for="studentID" class="form-label">Student ID</label>
          <input type="text" class="form-control" id="studentID" name="studentID" placeholder="BSCICT/00/010" required>
        </div>

        <div class="mb-3 position-relative">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Sign In</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
