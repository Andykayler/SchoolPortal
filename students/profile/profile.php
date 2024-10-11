<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - Dyuni Portal</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <nav>
            <div class="logo">Daeyang<span>University</span></div>
            <button class="menu-toggle" onclick="toggleMenu()">☰</button>
            <div class="nav-menu">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Academic sections</a></li>
                    <li><a href="https://elearning.dyuni.ac.mw/moodle/">ELearning</a></li>
                    <li><a href="PROJECT/contact.html">Contact Us</a></li>
                    <a href="students/login/login.html" class="login-btn">Login</a>
                </ul>
            </div>
        </nav>
        

    </header>

    <main>
        <div class="profile-container">
            <div class="student-profile">
                <img src="student-photo.jpg" alt="Student Photo">
                <h2>Student Profile</h2>
                <table>
                    <tr>
                        <th>Name:</th>
                        <td>John Doe</td>
                    </tr>
                    <tr>
                        <th>Class:</th>
                        <td>4th Year</td>
                    </tr>
                    <tr>
                        <th>Session:</th>
                        <td>2023/2024</td>
                    </tr>
                    <tr>
                        <th>Reg No.:</th>
                        <td>DYU123456</td>
                    </tr>
                    <tr>
                        <th>Major:</th>
                        <td>Computer Science</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>john@example.com</td>
                    </tr>
                </table>
                <a href="#" class="change-password">Change password</a>
            </div>

            <div class="personal-info">
                <h3>Personal Information</h3>
                <table>
                    <tr>
                        <th>Gender:</th>
                        <td>Male</td>
                    </tr>
                    <tr>
                        <th>Date of Birth:</th>
                        <td>1999/01/01</td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td>123 Main Street, Blantyre</td>
                    </tr>
                    <tr>
                        <th>Nationality:</th>
                        <td>Malawian</td>
                    </tr>
                    <tr>
                        <th>Phone Number:</th>
                        <td>0999999999</td>
                    </tr>
                </table>
            </div>

            <div class="sponsors">
                <h3>Sponsors</h3>
                <table>
                    <tr>
                        <th>Name:</th>
                        <td>John Doe Sr.</td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td>123 Main Street, Blantyre</td>
                    </tr>
                    <tr>
                        <th>Nationality:</th>
                        <td>Malawian</td>
                    </tr>
                    <tr>
                        <th>Phone Number:</th>
                        <td>0998888888</td>
                    </tr>
                </table>
            </div>
        </div>
    </main>

   
<footer class="bg-dark text-light py-5">
    <div class="container">
        <div class="row">
            <!-- Contact Section -->
            <div class="col-md-4 mb-4">
                <h5>Contact us</h5>
                <p>P.O.Box 30330, Lilongwe, Malawi</p>
                <p>+265 1 711 361</p>
            </div>
            <!-- Email Section -->
            <div class="col-md-4 mb-4">
                <h5>Email</h5>
                <p><a href="mailto:registrar@dyuni.ac.mw" class="text-light">registrar@dyuni.ac.mw</a></p>
            </div>
            <!-- About Section -->
            <div class="col-md-4 mb-4">
                <h5>About</h5>
                <p>Daeyang University is a Christian University founded by the Miracle for Africa Foundation. It is situated behind Malawi Institute of Management (MIM), off the M1 road passing between Kamuzu International Airport and Kanengo industrial area.</p>
            </div>
        </div>
        <!-- Social Media Icons -->
        <div class="text-center my-4">
            <a href="#" class="text-light mx-2">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="#" class="text-light mx-2">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="text-light mx-2">
                <i class="fab fa-google"></i>
            </a>
        </div>
        <!-- Footer Bottom -->
        <div class="text-center pt-3 border-top border-secondary">
            <p>&copy; Daeyang University 2024</p>
        </div>
    </div>
</footer>
</body>
</html>
