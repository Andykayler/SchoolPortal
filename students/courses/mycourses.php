<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Modules</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: #333;
    color: white;
    padding: 15px;
    text-align: left;
}

.navbar .logo {
    display: inline-block;
    font-size: 24px;
    color: #ffa500;
}

.navbar .nav-links {
    display: inline-block;
    float: right;
    list-style-type: none;
}

.navbar .nav-links li {
    display: inline;
    margin: 0 10px;
}

.navbar .nav-links li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.course-list h2 {
    text-align: center;
    margin-bottom: 30px;
}

.courses {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.course-card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    width: 45%;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    padding: 20px;
    position: relative;
}

.course-info {
    width: 70%;
}

.course-info h3 {
    margin: 0;
    font-size: 20px;
    color: #333;
}

.course-info p {
    color: #666;
    margin: 10px 0;
}

.progress-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.progress-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: conic-gradient(#ffa500 calc(var(--percentage) * 1%), #ddd calc(var(--percentage) * 1%));
    display: flex;
    justify-content: center;
    align-items: center;
}

.progress-text {
    font-size: 18px;
    color: #333;
    position: absolute;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
}

    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <span>Daeyang University</span>
        </div>
        <ul class="nav-links">
            <li><a href="../login/land.php">Home</a></li>
            <li><a href="mycourses.php">My Courses</a></li>
            <li><a href="../../view/results.php">Results</a></li>
            <li><a href="">Contacts</a></li>
            <li><a href="../profile/profile.php">Profile</a></li>
            <li><a href="../../logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="course-list">
            <h2>Courses for Semester</h2>
            <div class="courses">
                <?php
                // Sample Data for Display
                $courses = [
                    ['CS101', 'Introduction to Computer Science', 'An introductory course on computer science principles.', 70],
                    ['CS102', 'Data Structures', 'Learn about various data structures and algorithms.', 50],
                    ['CS103', 'Web Development', 'A comprehensive course on front-end and back-end web development.', 85],
                ];

                // Loop through courses and display them in cards
                foreach ($courses as $course) {
                    echo "<div class='course-card'>
                        <div class='course-info'>
                            <h3>{$course[1]}</h3>
                            <p>{$course[2]}</p>
                            <p><strong>Course Code:</strong> {$course[0]}</p>
                        </div>
                        <div class='progress-container'>
                            <div class='progress-circle' data-percentage='{$course[3]}'>
                                <span class='progress-text'>{$course[3]}%</span>
                            </div>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Daeyang University - E-learning Platform</p>
    </footer>

    <script>// Update progress circles based on data-percentage
document.querySelectorAll('.progress-circle').forEach(circle => {
    const percentage = circle.dataset.percentage;
    circle.style.setProperty('--percentage', percentage);
});
</script>
</body>
</html>
