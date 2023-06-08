<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title>PHP 프로그래밍 입문</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 슬라이드 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>"></script>
  <!--회원가입폼 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/member.js' ?>"></script>
  <!--로그인 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/login/js/login.js' ?>"></script>
  <!-- 공통, 슬라이드, 헤더 스타일 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/header.css' ?>">
  <!--회원가입폼 스타일  -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/member/css/member.css' ?>">
  <!--로그인 스타일  -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/login/css/login.css' ?>">
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
    <!-- 이미지 아래 최신 게시글 표시 영역 -->
    <div id="main_content">
      <!-- 1. 최신 게시글 목록 -->
      <article id="latest">
      </article>
      <!-- 이미지 아래 최신 게시글 표시 영역 -->
      <div id="main_content">
        <!-- 1. 최신 게시글 목록 -->
        <article id="latest">
          <ul></ul>
        </article>
        <section>
          <div id="main_img_bar">
          </div>
          <div id="main_content">
            <div id="join_box">
              <form name="member_form" method="post" action="./login.php">
                <h2>로그인</h2>
                <div class="form id">
                  <div class="col1">아이디</div>
                  <div class="col2">
                    <input type="text" name="id">
                  </div>
                  <div class="col3">
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">비밀번호</div>
                  <div class="col2">
                    <input type="password" name="pass">
                  </div>
                </div>

                <div class="buttons">
                  <input type="button" value="로그인" id="login">
                </div>
                <br>
                <hr>
              </form>
            </div> <!-- join_box -->
          </div> <!-- main_content -->
        </section>
      </div>
    </div>
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/footer.php"; ?>
  </footer>
</body>

</html>