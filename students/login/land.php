<?php
session_start();


if (!isset($_SESSION['studentID'])) {
   
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daeyang University</title>
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
    
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        background: url('andy.jpeg') no-repeat center center/cover;
        color: white;
    }
    
  
    .header {
        height: 100vh;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .header h1 {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .header p {
        font-size: 1.2rem;
    }

    /* Button Styles */
    .btn-custom {
        padding: 10px 20px;
        border-radius: 25px;
        background-color: #CFB198; /* Gold Color */
        color: white;
        border: none;
        transition: background-color 0.3s;
    }

    .btn-custom:hover {
        background-color: #C48756; /* Darker Gold on hover */
    }

    .btn-custom1 {
        padding: 10px 20px;
        border-radius: 25px;
        background-color: #282828; /* Dark Gray/Black */
        color: white;
        border: none;
        transition: background-color 0.3s;
    }

    .btn-custom1:hover {
        background-color: #404040; /* Lighter Gray/Black on hover */
    }

    /* Navbar Styling */
    .navbar-custom {
        position: absolute;
        top: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.8); /* Black with transparency */
        padding: 15px 0;
        z-index: 999;
    }

    .navbar-custom .navbar-brand {
        color: #CFB198; /* Gold Color for Brand */
        font-size: 1.5rem;
        font-weight: bold;
    }

    .navbar-custom .nav-link {
        color: #f4f4f4; /* White for links */
        margin-right: 20px;
        transition: color 0.3s;
    }

    .navbar-custom .nav-link:hover {
        color: #CFB198; /* Gold on hover */
    }

    /* Table Styling */
    .results-table {
        background-color: rgba(0, 0, 0, 0.7); /* Transparent Black */
        color: white;
    }

    .results-table th {
        background-color: #CFB198; /* Gold for table headers */
        color: black;
    }

    .results-table td {
        color: white;
    }

    .results-table td:hover {
        background-color: rgba(255, 255, 255, 0.1); /* Light transparent hover effect on table cells */
    }

    /* Carousel Indicator Styling */
    .carousel-indicators button {
        background-color: #CFB198; /* Gold indicators */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(100%); /* White arrows for carousel */
    }

    /* Footer Styling (if any) */
    footer {
        background-color: rgba(0, 0, 0, 0.8); /* Transparent black footer */
        color: white;
        padding: 20px;
        text-align: center;
    }

    footer a {
        color: #CFB198; /* Gold links */
    }

    footer a:hover {
        color: #C48756; /* Darker Gold on hover */
    }

    </style>
</head>
<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="daeyang_university_cover.jpg" alt="Logo" style="height: 40px;"> Daeyang
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../view/results.php">Results</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header section -->
    <header class="header text-center" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
        <h1>Welcome to Student Portal</h1>
        <p>View results, Register courses, upload assignments and check your in-semester progress</p>
        <div>
            <button class="btn btn-custom"><a href="../Registration/reg.php" class="nav-link">Register</a></button>
            <button class="btn btn-custom1">dashboard</button>
        </div>
        </div>
    </header>

    <!-- Rest of the content (Carousel) -->
    <section id="carousel-section" class="py-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="image1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="image2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="image3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Bootstrap JS and other scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
