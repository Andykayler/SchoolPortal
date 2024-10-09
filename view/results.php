<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stupagecss.css"link>
    <link rel="wwaynejs" href="stupagejs.js"link>
    <link rel="phpconn" href="stupagephp.php"link>
    <title>Student page</title>

    <style>
        img{
            max-height: 100%;
            max-width: 100%;
        }
        .site-logo{
            width: 160px;
            height: 70px;
        }
    </style>

</head>

<body>
<header class="header-area">

  <div class="navbar-area">
    <div class="container">
      <nav class="site-navbar">
      
        <a href="#home" class="site-logo">
            <img src="Logo final foreal.png"class="site-logo">
        </a>

       
        <ul>
          <li><a href="../students/login/land.php">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Results</a></li>
          <li><a href="#">Contacts</a></li>
        </ul>

        <button class="nav-toggler">
          <span></span>
        </button>
      </nav>
    </div>
  </div>
  <div class="intro-area">
    <div class="container">
      <h2>Daeyang University</h2>
      <p>Soli Deo</p>
      <main class="table">
        <section class="t-header">
          <h1>Student's results</h1>
        </section>
        <div class="iamBatman">        
              <div class="brucewayne">
                  <select class="semesterList">
                  <div class="iconholder">
                    <img src="drop.png"class="site-logo">
                  </div>
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
              </div>
        <section class="t-body">
          <table>
            <thead>
              <tr>
                <th> Course </th>
                <th> Percentage </th>
                <th> GPA </th>
                <th> Grade </th>
                <th> Comment</th>
                
              </tr>
            </thead>
            <tbody>
            <?php include 'stupagephp.php'; ?>
            </tbody>
          </table>
        </section>
      </main>
   
    </div>
  </div>
</header>
</body>
</html>