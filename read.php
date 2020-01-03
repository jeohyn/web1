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

<body>
</script>
<center>
<br />
<?php
	//데이터 베이스 연결하기
	header('Content-Type: text/html; charset=utf-8');
	session_start();
	$db = mysqli_connect('localhost', 'root', password, 'login');

	$list=$_GET['list'];
	if (!isset($_GET['id'])) die('ERROR :  페이지를 표시하기 위한 정보가 부족합니다.');
	$id = (int)$_GET['id'];
	$no =0;
	if(isset($_GET['no'])) $no = (int)$_GET['no'];

	// 글 정보 가져오기
	if($list==1){
		$query_1="SELECT * FROM board WHERE id=$id";
		$query_2="SELECT id FROM board WHERE id = $id+1";
		$query_3="SELECT id FROM board WHERE id < $id ORDER BY id DESC LIMIT 1";
		$query_4="UPDATE board SET view=view+1 WHERE id=$id";
	}
	else if($list==2){
		$query_1="SELECT * FROM board2 WHERE id=$id";
		$query_2="SELECT id FROM board2 WHERE id = $id+1";
		$query_3="SELECT id FROM board2 WHERE id < $id ORDER BY id DESC LIMIT 1";
		$query_4="UPDATE board2 SET view=view+1 WHERE id=$id";
	}
	else if($list==3){
		$query_1="SELECT * FROM board3 WHERE id=$id";
		$query_2="SELECT id FROM board3 WHERE id = $id+1";
		$query_3="SELECT id FROM board3 WHERE id < $id ORDER BY id DESC LIMIT 1";
		$query_4="UPDATE board3 SET view=view+1 WHERE id=$id";
	}
	else{
		$query_1="SELECT * FROM board4 WHERE id=$id";
		$query_2="SELECT id FROM board4 WHERE id = $id+1";
		$query_3="SELECT id FROM board4 WHERE id < $id ORDER BY id DESC LIMIT 1";
		$query_4="UPDATE board4 SET view=view+1 WHERE id=$id";
	}

	$result=mysqli_query($db, $query_1);
	$row=mysqli_fetch_array($result);
?>
<table width=780 border=0 cellpadding=2 cellspacing=1 bgcolor=#cccccc>
<tr>
	<td height=20 colspan=4 align=center bgcolor=#eeeeee>
		<B><?=$row['title']?></B>
	</td>
</tr>
<tr>
	<td width=50 height=20 align=center bgcolor=#EEEEEE>글쓴이</td>
	<td	width=240 bgcolor=white><?=$row['name']?></td>
</tr>
<tr>
	<td width=50 height=20 align=center bgcolor=#EEEEEE>
	날&nbsp;&nbsp;&nbsp;짜</td><td width=240
	bgcolor=white><?=$row['wdate']?></td>
	<td width=50 height=20 align=center bgcolor=#EEEEEE>조회수</td>
	<td	width=240 bgcolor=white><?=$row['view']?></td>
</tr>
<tr height=150>
	<td bgcolor=white colspan=4 valign=top>
		<table width=95% height=95% border=0 cellpadding=5>
		<tr><td>
		<pre><?=$row['content']?></pre>
		</td></tr>
		</table>
	</td>
</tr>
<!--기타 버튼 들-->
<tr>
	<td colspan=4 bgcolor=#eeeeee>
	<table width=100%>
		<tr>
			<td width=200 align=left height=20>
			<?php
			if($list==1){
				echo "<a href=list.php?list=1>[목록보기]</a>";
			}
			else if($list==2){
				echo "<a href=list.php?list=2>[목록보기]</a>";
			}
			else if($list==3){
				echo "<a href=list.php?list=3>[목록보기]</a>";
			}
			else{
				echo "<a href=list.php?list=4>[목록보기]</a>";
			}
			?>
				<a href=write.php?list=<?=$list?>>
				[글쓰기]</a>
				<a href=edit.php?list=<?=$list?>&&id=<?=$id?>>
				[수정]</a>
				<a href=predel.php?list=<?=$list?>&&id=<?=$id?>>
				[삭제]</a>
			</td>
			<!-- 기타 버튼 끝 -->
			<!-- 이전 다음 표시 -->
			<td align=right>
<?php
	// 현재 글보다 id 값이 큰 글 중 가장 작은 것을 가져온다.
	// 즉 바로 이전 글

	$result_pid = mysqli_query($db, $query_2);
	$prev_id = mysqli_fetch_array($result_pid);

	if ($prev_id['id']) // 이전 글이 있을 경우
	{
		echo "<a href=read.php?id=$prev_id[id]&&list=$list>[이전]</a>";
	}
	else
	{
		echo "<font color=grey>[이전]</font>";
	}


	$result_nid = mysqli_query($db, $query_3);
	$next_id = mysqli_fetch_array($result_nid);

	if ($next_id['id'])
	{
		echo "<a href=read.php?id={$next_id['id']}&&list=$list>[다음]</a>";
	}
	else
	{
		echo "<font color=grey>[다음]</font>";
	}
?>
			</td>
		</tr>
	</table>
	</b></font>
	</td>
</tr>
</table>
</center>
</body>
</html>
<?php
	// 조회수 업데이트
	$result=mysqli_query($db, $query_4);
	mysqli_close($db);
?>
