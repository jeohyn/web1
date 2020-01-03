<?php
  session_start();

  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $user = ""; // 이름
  $id = ""; // 학번
  $pw = ""; // 비밀번호
  $pw_re = ""; // 비밀번호 다시 입력 받기
  $errors = array(); // 오류 목록

  $db = mysqli_connect('localhost', 'root', password, 'login');
  if (isset($_POST['reg'])) {
    if (isset($_POST['mbname'])) { $user = mysqli_real_escape_string($db, $_POST['mbname']); }
    if (isset($_POST['mbid'])) { $id = mysqli_real_escape_string($db, $_POST['mbid']); }
    if (isset($_POST['mbpw'])) { $pw = mysqli_real_escape_string($db, $_POST['mbpw']); }
    if (isset($_POST['mbpw_re'])) { $pw_re = mysqli_real_escape_string($db, $_POST['mbpw_re']); }

    if (empty($user)) { array_push($errors, "username is required"); }
    if (empty($id)) { array_push($errors, "id is required"); }
    if (empty($pw)) { array_push($errors, "password is required"); }
    if ($pw != $pw_re) { array_push($errors, "password is incorrect"); }

    $check = "SELECT * FROM userpass WHERE id='$id' or user='$user' LIMIT 1";
    $result = mysqli_query($db, $check);
    $user_check = mysqli_fetch_array($result);

    if ($user) {
      if ($user_check['user'] === $user) { array_push($errors, "already exited");}
      if ($user_check['id'] === $id) { array_push($errors, "already regitested");}
    }

    if (count($errors) == 0) {
      $query = "INSERT INTO userpass (user, id, pass) VALUES ('$user', '$id', '$pw')";
      mysqli_query($db, $query);
      //$_SESSION['user'] = $user;
      //$_SESSION['success'] = "success!!";
      header("Location: login.php");
    }
    else {
      print_r($errors);
    }
  }
  mysqli_close($db);
?>