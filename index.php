<?php 
session_start();
$connect = mysqli_connect('localhost:3306', 'username', 'password', 'attendance');


 if(isset($_POST['submit'])){
  
  $username = $_POST['email'];
  $password = $_POST['pwd'];
  $_SESSION['email'] = $username;
  $sql = mysqli_query($connect, "SELECT * from parent where email ='".$username."' and 
                        password ='".$password."'") or die(mysqli_error($connect));
  if(mysqli_num_rows($sql) === 1){
    $rw = mysqli_fetch_array($sql);
    if($rw['email'] === $username && $rw['password']===$password){
      
      $_SESSION['first_name'] = $rw['first_name'];
      $_SESSION['parent_id'] = $rw['parent_id'];
     }
      echo"<script>alert('username and password are correct')</script>";
      header('location: welcome.php');
      exit();
    }

    else{
      echo"<script>alert('username and password are incorrect')</script>";
  }
  }



  
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Log In</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Oswald&family=Roboto&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Sunday School Attendance Tracker</a>
      <p class="nav-item ml-auto"> 
        Don't have an account? <br>
        <a href="register.php">Click here to Register</a>
        <br>
      </p>
      
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead text-white text-center"> 
    <div class="container" id="log-in">

        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5" id= "title">Attendance Management System</h1>
        </div>

        <div class="controls" id="selectProfile">
          <button id="parent-btn" class="parent-btn btn"> Log In </button>
       </div>

        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto hide" id="login-form">
            <form autocomplete="off" action="index.php" method="POST">
            <div class="form-row">
                <input type="text" name="email" class="form-control form-control-lg mb-2" placeholder="Enter email">
                <input type="password" name="pwd"class="form-control form-control-lg " placeholder="Enter password">
            </div>
            <div class="form-row">
              <div class="col-12 col-md-3 mt-2">
                <button type="submit" name="submit" class="btn btn-block btn-lg btn-primary" id="loginBtn">Log in</button>
                <br>
                <br>
                <button id="back" class="back-btn btn"> Back </button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </header>
  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <p class="text-muted small mb-4 mb-lg-0">&copy; Attendance Management System Project 2020. All Rights Reserved.</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
        </div>
      </div>
    </div>
  </footer>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
