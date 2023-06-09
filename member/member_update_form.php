<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title>회원수정</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 슬라이드 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>"></script>
  <!--회원가입폼 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/member/js/member_update.js?v=<?= date('Ymdhis') ?>"></script>
  <!-- 공통, 슬라이드, 헤더 스타일 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/header.css' ?>">
  <!--회원가입폼 스타일  -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/member/css/member.css?v=<?= date('Ymdhis') ?>">
  <!-- 구글폰트 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@200&display=swap" rel="stylesheet">
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php"; ?>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
    $num = (isset($_SESSION['num']) && $_SESSION['num'] != "" && is_numeric($_SESSION['num'])) ? $_SESSION['num'] : "";
    if ($num == "") {
      die("<script>
            alert('로그인을 해주세요.');
            history.go(-1);
            </script>");
    }

    $sql = "select * from members where num=:num";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':num', $num);
    $result = $stmt->execute();

    if (!$result) {
      die("<script>
            alert('데이터 검색 오류');
            history.go(-1);
          </script>");
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $emailArray = explode("@", $row['email']);
    ?>
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
              <form name="member_form" method="post" action="./member_update.php">
                <input type="hidden" name="num" value=<?= $row['num'] ?>>
                <h2>회원 수정</h2>
                <div class="form id">
                  <div class="col1">아이디</div>
                  <div class="col2">
                    <input type="text" name="id" value=<?= $row['id'] ?> readonly>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">비밀번호</div>
                  <div class="col2">
                    <input type="password" name="pass" placeholder="새로운 비밀번호 입력가능" ?>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">비밀번호 확인</div>
                  <div class="col2">
                    <input type="password" name="pass_confirm" placeholder="새로운 비밀번호 입력가능" ?>
                  </div>
                </div>
                <div class=" clear">
                </div>
                <div class="form">
                  <div class="col1">이름</div>
                  <div class="col2">
                    <input type="text" name="name" value=<?= $row['name'] ?>>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form email">
                  <div class="col1">이메일</div>
                  <div class="col2">
                    <input type="text" name="email1" value=<?= $emailArray[0] ?>>@
                    <select name="email2" id="email2">
                      <option value="">-선택하세요-</option>
                      <option value="naver.com">naver.com</option>
                      <option value="google.com">google.com</option>
                      <option value="daum.net">daum.net</option>
                    </select>
                  </div>
                </div>
                <div class="buttons">
                  <input type="button" value="수정완료" id="send">
                  <input type="button" value="취소" id="cancel">
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
  <script>
    const email2 = document.querySelector("#email2")
    email2.value = '<?= $emailArray[1] ?>'
  </script>

</body>

</html>