<?php
  session_start();
  $db_hostname = "127.0.0.1";
  $db_user = "root";
  $db_password = "";
  $db_name = "complaintregistration";

  $conn = mysqli_connect($db_hostname, $db_user, $db_password, $db_name);

  if (!$conn) {
      echo "connection failed! " . mysqli_connect_error();
      exit;
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST['emailid']) || empty($_POST['uname']) ||  empty($_POST['phnno']) || empty($_POST['pin']) || empty($_POST['state']) ||empty($_POST['address']) || empty($_POST['types']) || empty($_POST['details']) || empty($_POST['area']) || empty($_POST['specificloc'])){
      header("location: ./user.php");
    }
    else{
      $email = $_POST['emailid'];
      $name = $_POST['uname'];
      $phone = $_POST['phnno'];
      $pincode = $_POST['pin'];
      $state = $_POST['state'];
      $address = $_POST['address'];
      $complainttypes = $_POST['types'];
      $compdetails = $_POST['details'];
      $area = $_POST['area'];
      $location = $_POST['specificloc'];
      $sql = "INSERT INTO users(email,name,phone,pincode,state,address) VALUES ('$email','$name','$phone','$pincode','$state','$address')";

      if (mysqli_query($conn, $sql)) 
      {
          $last_id = mysqli_insert_id($conn);
      } 
      else 
      {
        $_SESSION['register'] = "no";
        header("location: ./user.php");
        exit;
      }
      $sql2 = "INSERT INTO complaints(usercomp_id,comptype,compdetail,comparea,complocality) VALUES('$last_id','$complainttypes','$compdetails','$area','$location')";
      $result1 = mysqli_query($conn, $sql2);
      if (!$result1) 
      {
        $_SESSION['register'] = "yes";
      }
      else{
        $_SESSION['register'] = "no";
      }
      header("location: ./user.php");
      exit;
    }
  }
  mysqli_close($conn);
?>
