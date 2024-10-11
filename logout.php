<?php
// Start the session
session_start();

// If the user clicked the "Sign out" button, destroy the session
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION = array();
    session_destroy();
    header("Location: students/login/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Out</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signout-box {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .signout-box h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .signout-box p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .signout-box button {
            padding: 10px 20px;
            background-color: #f39c12;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .signout-box button:hover {
            background-color:  #e67e22;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="signout-box">
            <h1>Log<span style="color: #f39c12;">Out</span></h1>
          
            <p>Are you sure you want to sign out?</p>
            <!-- Form that submits the sign-out request via POST -->
            <form method="POST" action="">
                <button type="submit">Sign out</button>
            </form>
        </div>
    </div>
</body>
</html>
