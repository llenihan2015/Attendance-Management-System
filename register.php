
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sign up</title>

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
        Already have an account? <br>
        <a href="index.php">Click here to Login</a>
        <br>
      </p>
      
    </div>
  </nav>
  <!-- Masthead -->
  <header class="masthead text-white text-center"> 
    <div class="container" id="log-in">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5" id= "title">Please fill out the form: </h1>
        </div>

        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto" id="register-form">
            <form autocomplete="off" action="register.php" method="POST">
            <div class="form-row">
                <input type="text" name ="pfname" class="form-control form-control-lg mb-2" placeholder="Parent First Name">
                <input type="text" name ="plname" class="form-control form-control-lg " placeholder="Parent Last Name">
                <input type="text" name ="sfname" class="form-control form-control-lg mb-2" placeholder="StudentFirst Name">
                <input type="text" name ="slname" class="form-control form-control-lg " placeholder="Student Last Name">
                <input type="text" name ="bdate" class="form-control form-control-lg mb-2" placeholder="Student Birthdate">
                <input type="text" name ="email" class="form-control form-control-lg " placeholder="Enter email">
                <input type="text" name ="phone" class="form-control form-control-lg mb-2" placeholder="Enter phone number">
                <input type="text" name ="pwd" class="form-control form-control-lg " placeholder="Enter your password">
            </div>
            <div class="form-row">
              <div class="col-12 col-md-3 mt-2">
                <button type="submit" name="submit" class="btn btn-block btn-lg btn-primary" id="registerBtn">Register</button>
                <br>
                <br>
              </div>
            </div>


            <?php
            
                if (isset($_POST['submit'])){


                    $connect = mysqli_connect('localhost:3306', 'username', 'password', 'attendance');

                    $pfname ='';
                    $plname = '';
                    $sfname = '';
                    $slname = '';
                    $bdate = '';
                    $email = '';
                    $phone = '';
                    $pwd = '';

                    $pfname = $_POST['pfname'];
                    $plname = $_POST['plname'];
                    $sfname = $_POST['sfname'];
                    $slname = $_POST['slname'];
                    $bdate = $_POST['bdate'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $pwd = $_POST['pwd'];

                    $sql_parent = "INSERT INTO parent (first_name, last_name, email, phone, password)
                            VALUES ('$pfname', '$plname', '$email', '$phone', '$pwd')";
                    $query = mysqli_query($connect,$sql_parent);

                    if($query){
                        $last_parent = mysqli_insert_id($connect);
                        $sql_student = "INSERT INTO student (first_name, last_name, birthdate)
                        VALUES ('$sfname', '$slname', '$bdate')";

                        $result = mysqli_query($connect, $sql_student);

                        if($result){
                          $last_student = mysqli_insert_id($connect);
                          $sql_parent_student = "INSERT INTO parent_student (last_name, parent_id, student_id)
                                                VALUES ('$slname','$last_parent','$last_student')";

                          $res = mysqli_query($connect, $sql_parent_student);
                        }

                        echo "Your registration was successfully submitted";

                    }
                    else{
                        echo "There was an error in submitting your registration";
                    }
                }
                ?>
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
