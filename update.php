<?php
	//데이터 베이스 연결하기
	session_start();

	$db = mysqli_connect('localhost', 'root',password, 'login');

	if(!isset($_GET['id'])) die('ERROR : 어떤 글을 수정할지 알 수 없습니다.');
	$id = $_GET['id'];
	$list=$_GET['list'];

	// 글의 비밀번호를 가져온다.
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

	$result=mysqli_query($db,$query);
	$row= mysqli_fetch_array($result);


	//입력된 값과 비교한다.
	if ($_POST['pass']==$row['pass']) { //비밀번호가 일치하는 경우
		$name = strip_tags($_POST['name']);
		$title = strip_tags($_POST['title']);
		$content = strip_tags($_POST['content']);

		if($list==1){
		  $query = "UPDATE board SET name='$name',	title='$title', content='$content' WHERE id=$id";
		}
		else if($list==2){
		  $query = "UPDATE board2 SET name='$name',	title='$title', content='$content' WHERE id=$id";
		}
		else if($list==3){
		  $query = "UPDATE board3 SET name='$name',	title='$title', content='$content' WHERE id=$id";
		}
		else{
		  $query = "UPDATE board4 SET name='$name',	title='$title', content='$content' WHERE id=$id";
		}

		$result=mysqli_query($db,$query);
	}
	else { // 비밀번호가 일치하지 않는 경우
		$msg = '비밀번호가 틀립니다.';
    echo "<script type=\"text/javascript\">alert(\"$msg\");
		history.go(-1);</script>";
		exit;
	}

	//데이터베이스와의 연결 종료
	mysqli_close($db);

	//수정하기인 경우 수정된 글로.
	echo ("<meta http-equiv='Refresh' content='1; URL=read.php?id=$id&&list=$list'>");
	echo
	   "<script>
	   alert('수정되었습니다');
	   </script>";
	?>
