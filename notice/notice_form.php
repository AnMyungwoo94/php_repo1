<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>PHP 프로그래밍 입문</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/common.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/notice/css/notice.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/slide.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/header.css?v=<?= date('Ymdhis') ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/notice/js/notice.js?v=<?= date('Ymdhis') ?>"></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/notice/js/notice.js' ?>"></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>" defer></script>
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/create_table.php";
    create_table($conn, "notice");
    ?>
  </header>
  <section>
    <div id="board_box">
      <h3 id="board_title">
        게시판 > 글 쓰기
      </h3>
      <form name="notice_form" method="post" action="notice_insert.php" enctype="multipart/form-data">
        <ul id="board_form">
          <li>
            <span class="col1">이름 : </span>
            <span class="col2"><?= $_SESSION["username"] ?></span>
          </li>
          <li>
            <span class="col1">제목 : </span>
            <span class="col2"><input name="subject" type="text"></span>
          </li>
          <li id="text_area">
            <span class="col1">내용 : </span>
            <span class="col2">
              <textarea name="content"></textarea>
            </span>
          </li>
          <li>
            <span class="col1"> 첨부 파일</span>
            <span class="col2"><input type="file" name="upfile"></span>
          </li>
        </ul>
        <ul class="buttons">
          <li><button type="button" id="complete">완료</button></li>
          <li><button type="button" onclick="location.href='notice_list.php'">목록</button></li>
        </ul>
      </form>
    </div>
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/footer.php"; ?>
  </footer>
</body>

</html>