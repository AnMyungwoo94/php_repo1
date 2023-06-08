<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>PHP 프로그래밍 입문</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/common.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/notice/css/notice.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/slide.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/header.css' ?>">
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>" defer></script>
	<!-- 부트스트랩 CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- 부트스트랩 JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
	</script>
	<style>
		.pagination {
			margin: auto;
		}
	</style>
</head>

<body>
	<header>
		<?php
		include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
		include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php";
		include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php";
		include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/create_table.php";
		create_table($conn, "notice"); //DB에 테이블이 없을 경우 생성함
		?>
	</header>
	<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

	$page = (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : 1;

	include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
	$sql = "select count(*) as cnt from notice order by num desc";
	$stmt = $conn->prepare($sql);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->execute();
	$row = $stmt->fetch();
	$total_record = $row['cnt'];
	$scale = 10;
	?>

	<section>
		<div id="board_box">
			<h3>공지사항 > 목록보기</h3>
			<h4>총 <?= $total_record ?>개</h4>
			<table class="table table-striped table-hover">
				<thead class="table-dark">
					<th>번호</th>
					<th>제목</th>
					<th>글쓴이</th>
					<th>첨부</th>
					<th>등록일</th>
					<th>조회</th>
				</thead>
				<?php

				// 전체 페이지 수($total_page) 계산 
				if ($total_record % $scale == 0)
					$total_page = floor($total_record / $scale);
				else
					$total_page = floor($total_record / $scale) + 1;

				// 표시할 페이지($page)에 따라 $start 계산  
				$start = ($page - 1) * $scale;

				$number = $total_record - $start;
				$sql2 = "select * from notice order by num desc limit {$start}, {$scale}";
				$stmt2 = $conn->prepare($sql2);
				$stmt2->setFetchMode(PDO::FETCH_ASSOC);
				$result = $stmt2->execute();
				$rowArray = $stmt2->fetchAll();

				foreach ($rowArray as $row) {
					// mysqli_data_seek($result, $i);
					// 가져올 레코드로 위치(포인터) 이동

					// 하나의 레코드 가져오기
					$num         = $row["num"];
					$id          = $row["id"];
					$name        = $row["name"];
					$subject     = $row["subject"];
					$regist_day  = $row["regist_day"];
					$hit		 = $row["hit"];
					if ($row["file_name"])
						$file_image = "<img src='./img/file.gif'>";
					else
						$file_image = " ";
				?>
					<tbody>
						<td><?= $number ?></td>
						<td><a href="notice_view.php?num=<?= $num ?>&page=<?= $page ?>"><?= $subject ?></a></td>
						<td><?= $name ?></td>
						<td><?= $file_image ?></td>
						<td><?= $regist_day ?></td>
						<td><?= $hit ?></td>
					</tbody>
				<?php
					$number--;
				}
				?>
			</table>
			<nav aria-label="Page navigation example" class="nav mb-3">
				<ul class="pagination">
					<?php
					if ($total_page >= 2 && $page >= 2) {
						$new_page = $page - 1;
						echo "<li class='page-item'><a class='page-link' href='notice_list.php?page=$new_page'>◀ 이전</a></li>";
					} else
						echo "<li class='page-item'>&nbsp;</li>";

					// 게시판 목록 하단에 페이지 링크 번호 출력
					for ($i = 1; $i <= $total_page; $i++) {
						if ($page == $i)     // 현재 페이지 번호 링크 안함
						{
							echo "<li class='page-item'><b class='page-link'> $i </b></li>";
						} else {
							echo "<li class='page-item'><a class='page-link' href='notice_list.php?page=$i'>$i</a></li>";
						}
					}
					if ($total_page >= 2 && $page != $total_page) {
						$new_page = $page + 1;
						echo "<li class='page-item'><a class='page-link' href='notice_list.php?page=$new_page'>다음 ▶</a></li>";
					} else
						echo "<li class='page-item'>&nbsp;</li>";
					?>
				</ul> <!-- page -->
			</nav>
			<ul class="buttons">
				<li><button onclick="location.href='notice_list.php'">목록</button></li>
				<li>
					<?php
					if ($userid) {
					?>
						<button onclick="location.href='notice_form.php'">글쓰기</button>
					<?php
					} else {
					?>
						<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
					<?php
					}
					?>
				</li>
			</ul>
		</div>
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/footer.php"; ?>
	</footer>
</body>

</html>