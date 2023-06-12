<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title>PHP 프로그래밍 입문</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 슬라우드 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>"></script>
  <!-- 회원가입폼 스트립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/member/js/member.js' ?> " defer></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/member/js/login.js' ?> " defer></script>
  <!-- 공통, 슬라이드, 헤더, 스타일 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/login.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/header.css' ?>">
  <!--회원가입폼 스타일-->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/member/css/member.css' ?>">
  <!-- 구글폰트 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@200&display=swap" rel="stylesheet">
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php"; ?>

    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php"; ?>
  </header>
  <section>
    <div id="main_content">
      <div id="login_box">
        <div id="login_title">
          <span>로그인</span>
        </div>
        <div id="login_form">
          <form name="login_form" method="post" action="login.php">
            <ul>
              <li><input type="text" name="id" placeholder="아이디"></li>
              <li><input type="password" id="pass" name="pass" placeholder="비밀번호"></li> <!-- pass -->
            </ul>
            <div id="login_btn">
              <a href="#"><img src="../img/login.png" id="check_input"></a>
            </div>
          </form>
        </div> <!-- login_form -->
      </div> <!-- login_box -->
    </div> <!-- main_content -->
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/footer.php"; ?>
  </footer>
</body>

</html>