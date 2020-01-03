<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$db = mysqli_connect('localhost', 'root', password, 'login');
//데이터 베이스 연결하기

if(!isset($_GET['id'])) die('ERROR : 어떤 글을 삭제할지 알 수 없습니다.');
$id = $_GET['id'];
$list=$_GET['list'];

if($list==1){
  $query="SELECT pass FROM board WHERE id = $id";
}
else if($list==2){
  $query="SELECT pass FROM board2 WHERE id = $id";
}
else if($list==3){
  $query="SELECT pass FROM board3 WHERE id = $id";
}
else{
  $query="SELECT pass FROM board4 WHERE id = $id";
}

$result=mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

if ($_POST['pass'] == $row['pass'] )
{
  if($list==1){
    $query="DELETE FROM board WHERE id=$id ";
  }
  else if($list==2){
    $query="DELETE FROM board2 WHERE id=$id ";
  }
  else if($list==3){
    $query="DELETE FROM board3 WHERE id=$id ";
  }
  else{
    $query="DELETE FROM board4 WHERE id=$id ";
  }
   $result=mysqli_query($db, $query);
}
else
{ echo "
   <script>
   alert('비밀번호가 틀립니다.');
   history.go(-1);
   </script>
   ";
   exit;
}

if($list==1){
  echo "<meta http-equiv='Refresh' content='1; URL=list.php?list=1'>";
}
else if($list==2){
  echo "<meta http-equiv='Refresh' content='1; URL=list.php?list=2'>";
}
else if($list==3){
  echo "<meta http-equiv='Refresh' content='1; URL=list.php?list=3'>";
}
else{
  echo "<meta http-equiv='Refresh' content='1; URL=list.php?list=4'>";
}

echo
   "<script>
   alert('삭제되었습니다');
   </script>";
?>
