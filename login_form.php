<?php
 // to get values passe from form in login.php file
   $error='';//variable to store error passage

   $user = "";
   $pass= "";
   //connect to the server select database
   $conn = mysqli_connect("localhost", "root", password, "login");
//define $user and $pass
  if(isset($_POST['user'])){
      $user = $_POST['user'];
  }

  if(isset($_POST['pass'])){
      $pass = $_POST['pass'];
   }


   //check connection
   if (mysqli_connect_errno()) {
     printf("Connect failed : %s\n", mysqli_connect_error());
   }

   // Query the database for user
   $result = mysqli_query($conn, "select * from userpass where user = '$user' and pass = '$pass'") or die('Failed to query database'.mysqli_error($conn));
   $row = mysqli_fetch_array($result);
   if ( $row['user'] == $user && $row['pass'] == $pass ) {
    header("Location: welcome.php");//redirecting to other page
   }
  else{
    $error="Username of Password is invalid";
  }
  mysqli_close($conn);//close connection
?>
