<?php
	header('Content-Type: text/html; charset=utf-8');
	session_start();
	$db = mysqli_connect('localhost', 'root', password,, 'login');
     //데이터 베이스 연결하기

    $name = $_POST['name'];
    $pass = $_POST['pass'];
		$title = $_POST['title'];
    $content = $_POST['content'];
		$LIST_NUM = $_GET['list'];
    $REMOTE_ADDR = $_SERVER["REMOTE_ADDR"];

		if($LIST_NUM==1){
			$query = "INSERT INTO board
			(name, pass, title, content, wdate, ip, view)
      VALUES ('$name', '$pass', '$title',
     '$content', now(), '$REMOTE_ADDR', 0)";
	 }
	 else if($LIST_NUM==2){
		 $query = "INSERT INTO board2
		 (name, pass, title, content, wdate, ip, view)
		 VALUES ('$name', '$pass', '$title',
		'$content', now(), '$REMOTE_ADDR', 0)";
	 }
	 else if($LIST_NUM==3){
		$query = "INSERT INTO board3
		(name, pass, title, content, wdate, ip, view)
		VALUES ('$name', '$pass', '$title',
	 '$content', now(), '$REMOTE_ADDR', 0)";
  }
  else{
	 $query = "INSERT INTO board4
	 (name, pass, title, content, wdate, ip, view)
	 VALUES ('$name', '$pass', '$title',
	'$content', now(), '$REMOTE_ADDR', 0)";
 }
 $result=mysqli_query($db, $query) or die(mysqli_error($db));

     //데이터베이스와의 연결 종료
    mysqli_close($db);

		// 새 글 쓰기인 경우 리스트로..
		if($LIST_NUM==1){
		  echo "<meta http-equiv='Refresh' content='1; URL=list.php?list=1'>";
		}
		else if($LIST_NUM==2){
			echo "<meta http-equiv='Refresh' content='1; URL=list.php?list=2'>";
		}
		else if($LIST_NUM==3){
			echo "<meta http-equiv='Refresh' content='1; URL=list.php?list=3'>";
		}
		else{
			echo "<meta http-equiv='Refresh' content='1; URL=list.php?list=4'>";
		}

		echo
		   "<script>
		   alert('저장되었습니다');
		   </script>";
		?>
