<?php
session_start();
$username = $_SESSION['email'];
$name = $_SESSION['first_name'];
$pid = $_SESSION['parent_id'];
$connect = mysqli_connect('localhost:3306', 'username', 'password', 'attendance');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Welcome</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Oswald&family=Roboto&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/welcome.css" rel="stylesheet">
</head>
<body>

  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Sunday School Attendance Tracker</a>
        <a href="index.php">Logout</a>
    </div>
  </nav>
<br>
<br>

<h1> Welcome, 
      <?php 
         echo $name;
      ?>
!</h1>
<br>
<br>
<div class="selection">
<form autocomplete="off" action="welcome.php" method="POST">
      <p> Please select the student: </p>
      <div class="select-box">
            <select name="students">
              <?php

              $student = "SELECT student.first_name
                          FROM student
                          INNER JOIN parent_student
                            ON parent_student.student_id = student.student_id
                            WHERE parent_student.parent_id ='".$pid."'";

              if($result = mysqli_query($connect, $student)){
                if(mysqli_num_rows($result)>0){
                  while($row = mysqli_fetch_array($result)){
                  $student_name = $row['first_name'];
                    echo "<option value='$student_name'>$student_name</option>";
                  }
                }
              }
            ?>
          </select>
            </div>
            <br>
            <p> Please select the teacher: </p>
            <div class="select-box">
          <select name="teachers">
              <?php
              $teacher = "SELECT *
                          FROM teacher";
              if($res = mysqli_query($connect, $teacher)){
                if(mysqli_num_rows($res)>0){
                  while($rw = mysqli_fetch_array($res)){
                  $teacher_name = $rw['first_name'];
                    echo "<option value='$teacher_name'>$teacher_name</option>";
                  }
                }
              }
            ?>
          </select>
        </div>
        <br>
      <div class="btndiv">
      <button type="submit" name="submit" class="btn btn-block btn-lg btn-primary" id="clockin">Clock In</button>
      </div>
      <br>
      <div class="btndiv">
      <button type="submit" name="submitbtn" class="btn btn-block btn-lg btn-primary" id="clockin">Clock Out</button>
      </div>
      <?php
        if(isset($_POST['submit'])){
         
          $s_name = $_POST['students'];
          $t_name = $_POST['teachers'];
          $s_id = "SELECT student_id
                   FROM student
                   WHERE first_name ='".$s_name."'";
                    if($s_result = mysqli_query($connect, $s_id)){
                      if(mysqli_num_rows($s_result)===1){
                        while($row2 = mysqli_fetch_array($s_result)){
                        $sid = $row2['student_id'];
                        }
                    }
                    }
          $t_id = "SELECT teacher_id
                   FROM teacher
                   WHERE first_name ='".$t_name."'";
                    if($t_result = mysqli_query($connect, $t_id)){
                      if(mysqli_num_rows($t_result)===1){
                        while($row1 = mysqli_fetch_array($t_result)){
                        $tid = $row1['teacher_id'];
                        }
                    }
                    }
                    
                    $dateToday = date("Y-m-d");
                    $time_in = date("h:i:s");
                    $time_out = '00:00:00';

                    $time_sheet = "INSERT INTO timesheet (date, time_in, time_out, parent, student, teacher)
                                   VALUES ('$dateToday', '$time_in','$time_out' , '$pid' ,'$sid','$tid')";
                    $in_query= mysqli_query($connect,$time_sheet);
      }

      if(isset($_POST['submitbtn'])){
        $dateToday = date("Y-m-d");
        $time_out = date("h:i:s");
        $s_name = $_POST['students'];
        $s_id = "SELECT student_id
        FROM student
        WHERE first_name ='".$s_name."'";
         if($s_result = mysqli_query($connect, $s_id)){
           if(mysqli_num_rows($s_result)===1){
             while($row2 = mysqli_fetch_array($s_result)){
             $sid = $row2['student_id'];
             }
         }
         }

         $time_sheet_add = "UPDATE timesheet
                            SET time_out = '".$time_out."'
                            WHERE date ='".$dateToday."'
                            AND student = '".$sid."'";

        $out_query = mysqli_query($connect,$time_sheet_add);
      }


      ?>
  </form>
</div>
  <!-- Footer -->
        <div class="footer">
          <p class="text-muted large mb-4 mb-lg-0">&copy; Attendance Management System Project 2020. All Rights Reserved.</p>
        </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>