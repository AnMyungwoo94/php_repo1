<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>PHP 프로그래밍 입문</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/common.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']  ?>/php_source/khs/image_board/css/board.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']  ?>/php_source/khs/css/slide.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/header.css?v=<?= date('Ymdhis') ?>">
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/image_board/js/board.js?v=<?= date('Ymdhis') ?>"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>" defer></script>
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php";
		include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php";
		include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
		include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/page_lib.php";
		include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/create_table.php";
		create_table($conn, "image_board");
		create_table($conn, "image_board_ripple"); ?>
		?>
	</header>
	<?php
	if (!$userid) {
		die("<script>alert('로그인 후 이용해주세요!');
						history.go(-1);
					</script>");
	}
	?>
	<section>

		<?php
		$mode = isset($_POST["mode"]) ? $_POST["mode"] : "insert";
		$subject = "";
		$content = "";
		$file_name = "";

		if (isset($_POST["mode"]) && $_POST["mode"] === "modify") {
			$num = $_POST["num"];
			$page = $_POST["page"];

			$sql = "select * from image_board where num = $num";
			// $result = mysqli_query($con, $sql);
			// $row = mysqli_fetch_array($result);
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$row = $stmt->fetch();


			// 비로그인 이거나 관리자가 아닌경우
			if (!isset($userid) && $userlevel != 1) {
				"alert_back('수정권한이 없습니다.')";
				exit;
			}

			$writer = $row["id"];
			$name = $row["name"];
			$subject = $row["subject"];
			$content = $row["content"];
			$file_name = $row["file_name"];
			$file_copied = $row["file_copied"];
			if (empty($file_name)) $file_name = "없음";
		}
		?>
		<div id="board_box">
			<h3 id="board_title">
				<?php if ($mode === "modify") : ?>
					이미지 게시판 > 수정 하기
				<?php else : ?>
					이미지 게시판 > 글 쓰기
				<?php endif; ?>
			</h3>
			<form name="board_form" method="post" action="dmi_board.php" enctype="multipart/form-data">
				<?php if ($mode === "modify") : ?>
					<input type="hidden" name="num" value=<?= $num ?>>
					<input type="hidden" name="page" value=<?= $page ?>>
				<?php endif; ?>

				<input type="hidden" name="mode" value=<?= $mode ?>>
				<ul id="board_form">
					<li>
						<span class="col1">이름 : </span>
						<span class="col2"><?= $username ?></span>
					</li>
					<li>
						<span class="col1">제목 : </span>
						<span class="col2"><input name="subject" type="text" value=<?= $subject ?>></span>
					</li>
					<li id="text_area">
						<span class="col1">내용 : </span>
						<span class="col2">
							<textarea name="content"><?= $content ?></textarea>
						</span>
					</li>
					<li>
						<span class="col1"> 첨부 파일 : </span>
						<span class="col2"><input type="file" name="upfile">
							<?php if ($mode === "modify") : ?>
								<input type="checkbox" value="yes" name="file_delete">&nbsp;파일 삭제하기
								<br>현재 파일 : <?= $file_name ?>
							<?php endif; ?>
						</span>
					</li>
				</ul>
				<ul class="buttons">
					<li>
						<button type="button" onclick="check_input()">완료</button>
					</li>
					<li>
						<button type="button" onclick="location.href='board_list.php'">목록</button>
					</li>
				</ul>
			</form>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/footer.php"; ?>
	</footer>
</body>

</html>