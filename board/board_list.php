<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>PHP 프로그래밍 입문</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/common.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/board/css/board.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/slide.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/header.css' ?>">
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>" defer></script>

</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php";
		include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php";
		include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
		include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/create_table.php";
		create_table($conn, "board");
		?>

	</header>
	<section>
		<div id="board_box">
			<h3>
				게시판 > 목록보기
			</h3>
			<ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col4">첨부</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
				</li>
				<?php

				$page = (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : 1;

				include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
				$sql = "select count(*) as cnt from board order by num desc";
				$stmt = $conn->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$result = $stmt->execute();
				$row = $stmt->fetch();
				$total_record = $row['cnt'];
				$scale = 10;             // 전체 페이지 수($total_page) 계산


				// 전체 페이지 수($total_page) 계산 
				if ($total_record % $scale == 0)
					$total_page = floor($total_record / $scale);
				else
					$total_page = floor($total_record / $scale) + 1;

				// 표시할 페이지($page)에 따라 $start 계산  
				$start = ($page - 1) * $scale;

				$number = $total_record - $start;
				$sql2 = "select * from board order by num desc limit {$start}, {$scale}";
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
					$hit         = $row["hit"];
					if ($row["file_name"])
						$file_image = "<img src='./img/file.gif'>";
					else
						$file_image = " ";
				?>
					<li>
						<span class="col1"><?= $number ?></span>
						<span class="col2"><a href="board_view.php?num=<?= $num ?>&page=<?= $page ?>"><?= $subject ?></a></span>
						<span class="col3"><?= $name ?></span>
						<span class="col4"><?= $file_image ?></span>
						<span class="col5"><?= $regist_day ?></span>
						<span class="col6"><?= $hit ?></span>
					</li>
				<?php
					$number--;
				}

				?>
			</ul>
			<ul id="page_num">
				<?php
				if ($total_page >= 2 && $page >= 2) {
					$new_page = $page - 1;
					echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a> </li>";
				} else
					echo "<li>&nbsp;</li>";

				// 게시판 목록 하단에 페이지 링크 번호 출력
				for ($i = 1; $i <= $total_page; $i++) {
					if ($page == $i)     // 현재 페이지 번호 링크 안함
					{
						echo "<li><b> $i </b></li>";
					} else {
						echo "<li><a href='board_list.php?page=$i'> $i </a><li>";
					}
				}
				if ($total_page >= 2 && $page != $total_page) {
					$new_page = $page + 1;
					echo "<li> <a href='board_list.php?page=$new_page'>다음 ▶</a> </li>";
				} else
					echo "<li>&nbsp;</li>";
				?>
			</ul>
			<ul class="buttons">
				<li><button onclick="location.href='board_list.php'">목록</button></li>
				<li>
					<?php
					if ($userid) {
					?>
						<button onclick="location.href='board_form.php'">글쓰기</button>
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