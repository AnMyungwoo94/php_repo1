<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>관리자모드</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/slide.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/common.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/admin/css/admin.css?v=<?= date('Ymdhis') ?>">
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>"></script>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/header.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']  ?>/php_source/khs/main/css/main.css?v=<?= date('Ymdhis') ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@200&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/6a2bc27371.js" crossorigin="anonymous"></script>
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php"; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php"; ?>
	</header>
	<section>
		<div id="admin_box">
			<h3 id="member_title">
				관리자 모드 > 회원 관리
			</h3>
			<ul id="member_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">아이디</span>
					<span class="col3">이름</span>
					<span class="col4">레벨</span>
					<span class="col5">포인트</span>
					<span class="col6">가입일</span>
					<span class="col7">수정</span>
					<span class="col8">삭제</span>
				</li>
				<?php
				include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";

				if (!isset($_SESSION['userid']) && $_SESSION['userlevel'] != '1') {
					echo ("
						            <script>
						            alert('관리자만 접근가능합니다');
						            history.go(-1)
						            </script>
						        ");
					exit;
				}

				$sql = "select * from members";
				$stmt = $conn->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$stmt->execute();
				$rowArray = $stmt->fetchAll();

				foreach ($rowArray as $row) {
					$num = $row["num"];
					$id = $row["id"];
					$name = $row["name"];
					$level = $row["level"];
					$point = $row["point"];
					$regist_day = $row["regist_day"];
				?>
					<li>
						<form method="post" action="admin_member_update.php">
							<input type="hidden" name="num" value="<?= $num ?>">
							<span class="col1"><?= $num ?></span>
							<span class="col2"><?= $id ?></span>
							<span class="col3"><?= $name ?></span>
							<span class="col4"><input type="text" name="level" value="<?= $level ?>"></span>
							<span class="col5"><input type="text" name="point" value="<?= $point ?>"></span>
							<span class="col6"><?= $regist_day ?></span>
							<span class="col7"><button type="submit">수정</button></span>
							<span class="col8"><button type="button" onclick="location.href='admin_member_delete.php?num=<?= $num ?>'">삭제</button></span>
						</form>
					</li>

				<?php
				}
				?>
			</ul>
			<h3 id="member_title">
				관리자 모드 > 게시판 관리
			</h3>
			<ul id="board_list">
				<li class="title">
					<span class="col1">선택</span>
					<span class="col2">번호</span>
					<span class="col3">이름</span>
					<span class="col4">제목</span>
					<span class="col5">첨부파일명</span>
					<span class="col6">작성일</span>
				</li>
				<form method="post" action="admin_board_delete.php">
					<?php
					$sql = "select * from board order by num desc";
					$stmt = $conn->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
					$stmt->execute();
					$rowArray = $stmt->fetchAll();

					foreach ($rowArray as $row) {
						$num = $row["num"];
						$name = $row["name"];
						$subject = $row["subject"];
						$file_name = $row["file_name"];
						$regist_day = $row["regist_day"];
						$regist_day = substr($regist_day, 0, 10)
					?>
						<li>
							<span class="col1"><input type="checkbox" name="item[]" value="<?= $num ?>"></span>
							<span class="col2"><?= $num ?></span>
							<span class="col3"><?= $name ?></span>
							<span class="col4"><?= $subject ?></span>
							<span class="col5"><?= $file_name ?></span>
							<span class="col6"><?= $regist_day ?></span>
						</li>
					<?php
					}
					?>
					<button type="submit">선택된 글 삭제</button>
				</form>
			</ul>
		</div> <!-- admin_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/footer.php"; ?>
	</footer>
</body>

</html>