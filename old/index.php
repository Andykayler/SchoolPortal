<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daeyang University Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Dropdown Hover Effect */
        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0; /* Remove the gap so it blends smoothly */
            transition: 0.3s ease-in-out;
        }

        /* Styling the dropdown */
        .dropdown-menu a {
            padding: 10px 20px;
            transition: background-color 0.3s ease-in-out;
        }

        .dropdown-menu a:hover {
            background-color: #007bff;
            color: white !important;
        }

        /* Ensure the dropdown has a smooth, nice look */
        .dropdown-menu {
            border-radius: 5px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Daeyang University</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Scholarships</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Faculty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <!-- Dropdown for Portal -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Portal
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="students/login/login.php">Student</a></li>
                            <li><a class="dropdown-item" href="staff/log/login.php">Staff</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Carousel -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="hero-content d-flex flex-column justify-content-center align-items-center">
                    <h1>Welcome to Daeyang University</h1>
                    <p>Soli Deo</p>
                    <button id="readMoreBtn" class="btn btn-outline-primary">Read More</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="students/login/images/ict.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Hidden Information Section -->
    <section id="universityInfo" class="container my-5" style="display:none;">
        <div class="card">
            <div class="card-body">
                <h2>About Daeyang University</h2>
                <p>Daeyang University is a renowned institution dedicated to providing top-tier education in various fields
                    including technology, medicine, and social sciences.</p>
                <h4>Our Values</h4>
                <p>We value excellence, integrity, and service to society, striving to produce professionals equipped to
                    tackle the challenges of the modern world.</p>
                <h4>Accessibility</h4>
                <p>The university is committed to creating a welcoming and accessible environment for students from all
                    backgrounds. We offer scholarships, facilities for students with disabilities, and an inclusive campus
                    life.</p>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
