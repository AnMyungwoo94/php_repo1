<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>메세지 박스</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/message/css/message.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/header.css' ?>">
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php"; ?>
  </header>
  <section>
    <div id="message_box">
      <h3>
        <?php
        $page = (isset($_GET['page']) && $_GET["page"] != '') ? $_GET['page'] : 1;
        $mode = (isset($_GET['mode']) && $_GET["mode"] != '') ? $_GET['mode'] : '';

        if ($mode == "send")
          echo "송신 쪽지함 > 목록보기";
        else
          echo "수신 쪽지함 > 목록보기";
        ?>
      </h3>
      <div>
        <ul id="message">
          <li>
            <span class="col1">번호</span>
            <span class="col2">제목</span>
            <span class="col3">
              <?php
              if ($mode == "send")
                echo "받은이";
              else
                echo "보낸이";
              ?>
            </span>
            <span class="col4">등록일</span>
          </li>
          <?php
          include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";

          if ($mode == "send")
            $sql = "select count(*) as cnt from message where send_id=:userid order by num desc";
          else
            $sql = "select count(*) as cnt from message where rv_id=:userid order by num desc";

          $stmt = $conn->prepare($sql);
          $stmt->setFetchMode(PDO::FETCH_ASSOC);
          $stmt->bindParam(':userid', $userid);
          $stmt->execute();
          $row = $stmt->fetch();
          // 전체 글 수
          $total_record = $row['cnt'];
          $scale = 10;

          // 전체 페이지 수($total_page) 계산 
          if ($total_record % $scale == 0)
            $total_page = floor($total_record / $scale);
          else
            $total_page = floor($total_record / $scale) + 1;

          // 표시할 페이지($page)에 따라 $start 계산  
          $start = ($page - 1) * $scale;
          $number = $total_record - $start;

          if ($mode == "send")
            $sql = "select * from message where send_id=:userid order by num desc limit {$start}, {$scale}";
          else
            $sql = "select * from message where rv_id=:userid order by num desc";

          $stmt = $conn->prepare($sql);
          $stmt->setFetchMode(PDO::FETCH_ASSOC);
          $stmt->bindParam(':userid', $userid);
          $stmt->execute();
          $rows = $stmt->fetchAll();


          // for ($i = $start; $i < $start + $scale && $i < $total_record; $i++) {
          foreach ($rows as $row) {
            // 하나의 레코드 가져오기
            $num = $row["num"];
            $subject = $row["subject"];
            $regist_day = $row["regist_day"];

            if ($mode == "send")
              $msg_id = $row["rv_id"];
            else
              $msg_id = $row["send_id"];

            $sql2 = "select name from members where id='$msg_id'";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            $stmt2->execute();
            $record = $stmt2->fetch();
            $msg_name = $record["name"];
          ?>
            <li>
              <span class="col1"><?= $number ?></span>
              <span class="col2"><a href="message_view.php?mode=<?= $mode ?>&num=<?= $num ?>"><?= $subject ?></a></span>
              <span class="col3"><?= $msg_name ?>(<?= $msg_id ?>)</span>
              <span class="col4"><?= $regist_day ?></span>
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
            echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a> </li>";
          } else
            echo "<li>&nbsp;</li>";

          // 게시판 목록 하단에 페이지 링크 번호 출력
          for ($i = 1; $i <= $total_page; $i++) {
            if ($page == $i)     // 현재 페이지 번호 링크 안함
            {
              echo "<li><b> $i </b></li>";
            } else {
              echo "<li> <a href='message_box.php?mode=$mode&page=$i'> $i </a> <li>";
            }
          }
          if ($total_page >= 2 && $page != $total_page) {
            $new_page = $page + 1;
            echo "<li> <a href='message_box.php?mode=$mode&page=$new_page'>다음 ▶</a> </li>";
          } else
            echo "<li>&nbsp;</li>";
          ?>
        </ul> <!-- page -->
        <ul class="buttons">
          <li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
          <li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
          <li><button onclick="location.href='message_form.php'">쪽지 보내기</button></li>
        </ul>
      </div> <!-- message_box -->
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/footer.php"; ?>
  </footer>
</body>

</html>