<html>
<head>
<title>일반 게시판</title>
<style>
<!--
td {font-size : 9pt; color:#333333}
A:link {font : 9pt; color : black; text-decoration : none;
font-family : 굴림; font-size : 9pt;}
A:visited {text-decoration : none; color : #333333; font-size : 9pt;}
A:hover {text-decoration : underline; color : #333333;
font-size : 9pt;}
-->
</style>
</head>

<body topmargin=0 leftmargin=0 text=#464646>
<center>
<br />
<!--입력된 값을 다음 페이지로 넘기기 위해 FORM을 만든다.  -->
<?php
	if(!isset($_GET['id'])) die('ERROR : 페이지를 표시하기 위한 정보가 부족합니다.');
	$id = $_GET['id'];
	$list=$_GET['list'];
?>
<form action=update.php?id=<?=$id?>&&list=<?=$list?> method=post>
<table width=780 border=0 cellpadding=2 cellspacing=1 bgcolor=#cccccc>
	<tr>
		<td height=20 align=center bgcolor=#eeeeee>
			<font color=white><B>글 수 정 하 기</B></font>
		</td>
	</tr>
<?php
	//데이터 베이스 연결하기
	session_start();

	$db = mysqli_connect('localhost', 'root', password, 'login');

	// 먼저 쓴 글의 정보를 가져온다.
	if($list==1){
	  $query="SELECT * FROM board WHERE id=$id";
	}
	else if($list==2){
	  $query="SELECT * FROM board2 WHERE id=$id";
	}
	else if($list==3){
	  $query="SELECT * FROM board3 WHERE id=$id";
	}
	else{
	  $query="SELECT * FROM board4 WHERE id=$id";
	}

	$result=mysqli_query($db,$query);
	$row= mysqli_fetch_array($result);
?>
<!-- 입력 부분 -->
	<tr>
		<td bgcolor=white>&nbsp;
		<table>
			<tr>
				<td width=60 align=left>이름</td>
				<td align=left >
					<INPUT type=text name=name size=20
					value=<?=$row['name']?>>
				</td>
			</tr>
			<tr>
				<td width=60 align=left >비밀번호</td>
				<td align=left >
					<INPUT type=password name=pass size=8>
					(비밀번호가 맞아야 수정가능)
				</td>
			</tr>
			<tr>
				<td width=60 align=left >제 목</td>
				<td align=left >
					<INPUT type=text name=title size=60
					value=<?=$row['title']?>>
				</td>
			</tr>
			<tr>
				<td width=60 align=left >내용</td>
				<td align=left >
					<TEXTAREA name=content cols=65 rows=15><?=$row['content']?></TEXTAREA>
				</td>
			</tr>
			<tr>
				<td colspan=10 align=center>
					<INPUT type=submit value="글 저장하기">
					&nbsp;&nbsp;
					<INPUT type=reset value="다시 쓰기">
					&nbsp;&nbsp;
					<INPUT type=button value="되돌아가기"
					onclick="history.back(-1)">
				</td>
			</tr>
			</TABLE>
		</td>
	</tr>
<!-- 입력 부분 끝 -->
</table>
</form>
</center>
</body>
</html>
