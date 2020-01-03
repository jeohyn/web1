<?php
header('Content-Type: text/html; charset=utf-8');

//데이터 베이스 연결하기
session_start();

$db = mysqli_connect('localhost', 'root', password, 'login');

# LIST 설정
# 1. 한 페이지에 보여질 게시물의 수
$page_size=10;

# 2. 페이지 나누기에 표시될 페이지의 수
$page_list_size = 10;

if (!isset($_GET['no']) || $_GET['no'] < 0) $no=0;
else $no = $_GET['no'];
$list=$_GET['list'];

// 데이터베이스에서 페이지의 첫번째 글($no)부터
// $page_size 만큼의 글을 가져온다.
if($list==1){
  $query_1 = "SELECT * FROM board ORDER BY id DESC LIMIT $no,$page_size";
}
else if($list==2){
  $query_1 = "SELECT * FROM board2 ORDER BY id DESC LIMIT $no,$page_size";
}
else if($list==3){
  $query_1 = "SELECT * FROM board3 ORDER BY id DESC LIMIT $no,$page_size";
}
else{
  $query_1 = "SELECT * FROM board4 ORDER BY id DESC LIMIT $no,$page_size";
}

$result = mysqli_query($db,$query_1);

// 총 게시물 수 를 구한다.
if($list==1){
  $query_2="SELECT count(*) FROM board";
}
else if($list==2){
  $query_2="SELECT count(*) FROM board2";
}
else if($list==3){
  $query_2="SELECT count(*) FROM board3";
}
else{
  $query_2="SELECT count(*) FROM board4";
}

$result_count = mysqli_query($db,$query_2);
$result_row     = $result_count->fetch_row();
$total_row     = $result_row[0];
//결과의 첫번째 열이 count(*) 의 결과다.

# 총 페이지 계산
if ($total_row <= 0) $total_row = 0;
$total_page = ceil($total_row / $page_size);

# 현재 페이지 계산
$current_page = ceil(($no+1)/$page_size);
?>

<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
<div id="board_area">
  <h1>자유게시판</h1>
  <h4>자유롭게 글을 쓸 수 있는 게시판입니다.</h4>
    <table class="list-table">
      <thead>
          <tr>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
        <?php
            while($board= mysqli_fetch_array($result))
            {
              $title=$board["title"];
              if(strlen($title)>30)
              {
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]); //title이 30을 넘어서면 ...표시
              }
        ?>
      <tbody>
        <tr>
          <td width="500"><a href="read.php?id=<?= $board['id']?>&&list=<?=$list?>"> <?php echo $board['title'] ?></a></td>
          <td width="120"><?php echo $board['name']?></td>
          <td width="100"><?php echo $board['wdate']?></td>
          <td width="100"><?php echo $board['view']; ?></td>
        </tr>
      </tbody>
      <?php
			} // end While
//데이터베이스와의 연결을 끝는다.
		mysqli_close($db);
		?>
    </table>
	<table border=0>
<tr>
   <td width=600 height=20 align=center rowspan=4>
   <font color=gray>
   &nbsp;
<?php
$start_page = floor(($current_page - 1) / $page_list_size)
            * $page_list_size + 1;

# 페이지 리스트의 마지막 페이지가 몇 번째 페이지인지 구하는 부분이다.
$end_page = $start_page + $page_list_size - 1;

if ($total_page < $end_page){
   $end_page = $total_page;
}
if ($start_page >= $page_list_size) {
   # 이전 페이지 리스트값은 첫 번째 페이지에서 한 페이지 감소하면 된다.
   # $page_size 를 곱해주는 이유는 글번호로 표시하기 위해서이다.
   echo"start_page:$start_page<br>";
   //이전 페이지 블록으로 이동($page_size를 곱하여 글번호 계산)
   $prev_list=($start_page-2)*$page_size;
   echo"<a href=\"{$_SERVER['PHP_SELF']}?no=$prev_list\">◀</a>\n"; //$_SERVER[PHP_SELF]:현재 페이지의 주소
   }

# 페이지 리스트를 출력
for ($i=$start_page;$i <= $end_page;$i++) {
   $page= ($i-1) * $page_size;// 페이지값을 no 값으로 변환.
   if ($no!=$page){ //현재 페이지가 아닐 경우만 링크를 표시
      echo"<a href=\"{$_SERVER['PHP_SELF']}?no=$page\">";
   }

   echo " $i "; //페이지를 표시

   if ($no!=$page){
      echo "</a>";
   }
}

# 다음 페이지 리스트가 필요할때는 총 페이지가 마지막 리스트보다 클 때이다.
# 리스트를 다 뿌리고도 더 뿌려줄 페이지가 남았을때 다음 버튼이 필요할 것이다.
if($total_page > $end_page)
{
   $next_list = $end_page * $page_size;
   echo"<a href='{$_SERVER['PHP_SELF']}?no=$next_list'>▶</a>\n";
}
?>
    <div id="write_btn">
      <a href="write.php?list=<?=$list?>"><button>글쓰기</button></a>
    </div>
  </div>
</body>
<!--welcom.php로 돌아갈 수 있는 버튼(게시판 재선택)-->
<br><br>
<input type="button" name="return" value="게시판 다시 선택하기" onclick = "location.href = 'welcome.php' ">
</html>
