<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>회원 가입</title>
 </head>
 <body style="background-color:#6f8bca;">
   <form name="write_form_member" action="joinphp.php" method="post">
     <div class="container">
     <!--디자인1-->
       <div id="hr1"><hr></div>
       <!--회원가입 입력 창-->
       <div class="join_i1">이름</div>
       <div class="join_i2">학번(아이디로 사용)</div>
       <div class="join_i3">비밀번호</div>
       <div class="join_i4">비밀번호 확인</div>
       <div class="join_p1"><input type="text" name="mbname"></div>
       <div class="join_p2"><input type="text" name="mbid"></div>
       <div class="join_p3"><input type="password" name="mbpw"></div>
       <div class="join_p4"><input type="password" name="mbpw_re"></div>
       <!--디자인2-->
       <div id="hr2"><hr></div>
       <!--입력 제출/취소 버튼-->
        <div class="jbtn">
           <input type="submit" class="btn" name="reg" value="회원가입">
           <input type="reset" class="btn" value="취소">
        </div>
    </div>
  </form>
  <!--Error message-->
  <span><?php echo $error; ?></span>
 </body>
</html>