﻿<?php
   header('Content-Type: text/html; charset=utf-8');
   $list = $_GET['list'];
   ?>
<!DOCTYPE html>
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
<meta charset="utf-8">
</head>

<body topmargin=0 leftmargin=0 text=#464646>
<center>
<br />
<!--입력된 값을 다음 페이지로 넘기기 위해 FORM을 만든다.-->
<form action=insert.php?list=<?=$list?> method=post>
<table width=780 border=0 cellpadding=2 cellspacing=1 bgcolor=#cccccc>
	<tr>
		<td height=20 align=center bgcolor=#eeeeee>
		<B>글 쓰 기</B>
		</td>
	</tr>
	<!-- 입력 부분 -->
	<tr>
		<td bgcolor=white>&nbsp;
		<table>
			<tr>
				<td width=60 align=left >이름</td>
				<td align=left >
					<INPUT type=text name=name size=20 maxlength=10>
				</td>
			</tr>
			<tr>
				<td width=60 align=left >비밀번호</td>
				<td align=left >
					<INPUT type=password name=pass size=8>
					(수정,삭제시 반드시 필요)
				</td>
			</tr>
			<tr>
				<td width=60 align=left >제 목</td>
				<td align=left >
					<INPUT type=text name=title size=60 maxlength=35>
				</td>
			</tr>
			<tr>
				<td width=60 align=left >내용</td>
				<td align=left >
					<TEXTAREA name=content cols=65 rows=15></TEXTAREA>
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
