<!DOCTYPE html>
<html>
  <head>
    <title> QnA for Noonsong by SISS</title>
    <meta charset="utf-8" >
    <link rel="stylesheet" href="style.css">
  </head>
  <body style="background-color:#6f8bca;">
    <form name="login_form" action="login_form.php" method="POST" style="text-align:center;"> <!-- * login_form 뒤에 확장자 php 주의, name 대신 action 써야함-->
      <div class="container">
         <!--여기에 이미지 위치 써야함(grid를 감싸는 div태그는 form 태그 안에 써야한다)-->
         <!--<img src="lock.png">-->
         <!--id/pw 입력 창-->
         <div class="log">
           ID : <input type="text" placeholder="Username" id="user" name="user"><br/><br/>
           PW : <input type="password" placeholder="Password" id="pass" name="pass">
         </div>
         <!--페이지 로그인 버튼-->
         <div class="lbtn">
           <input class="btn" type="submit" value="login" name="submit">&nbsp;&nbsp;
           <input class="btn" type="button" name="reg" value="register" onClick="location.href='join.php'"> <!--register.html 대신 join.php-->
         </div>
      </div>
    </form>
    <!--Error message-->
    <span><?php echo $error; ?></span>
  </body>
</html>
