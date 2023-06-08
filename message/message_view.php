<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>PHP 프로그래밍 입문</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/message/css/message.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/header.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/message/js/message.js' ?>"></script>
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php"; ?>
  </header>
  <section>
    <div id="message_box">
      <h3 class="title">
        <?php
        $mode = (isset($_GET['mode']) && $_GET['mode'] != '') ? $_GET['mode'] : '';
        $num = (isset($_GET['num']) && $_GET['num'] != '') ? $_GET['num'] : '';
        if ($mode == "" && $num == "") {
          die("
          <script>
          alert('경고');
          history.go(-1);
          </script>
          ");
        }

        include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
        $sql = "select * from message where num=:num";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':num', $num);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $row = $stmt->fetch();

        $send_id = $row["send_id"];
        $rv_id = $row["rv_id"];
        $regist_day = $row["regist_day"];
        $subject = $row["subject"];
        $content = $row["content"];

        $content = str_replace(" ", "&nbsp;", $content);
        $content = str_replace("\n", "<br>", $content);

        if ($mode == "send") {
          $sql2 = "select name from members where id='$rv_id'";
        } else {
          $sql2 = "select name from members where id='$send_id'";
        }
        $stmt2 = $conn->prepare($sql2);
        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
        $stmt2->execute();
        $record = $stmt2->fetch();
        $msg_name = $record["name"];

        if ($mode == "send") {
          echo "송신 쪽지함 > 내용보기";
        } else {
          echo "수신 쪽지함 > 내용보기";
        }
        ?>
      </h3>
      <ul id="view_content">
        <li>
          <span class="col1"><b>제목 :</b> <?= $subject ?></span>
          <span class="col2"><?= $msg_name ?> | <?= $regist_day ?></span>
        </li>
        <li>
          <?= $content ?>
        </li>
      </ul>
      <ul class="buttons">
        <li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
        <li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
        <li><button onclick="location.href='message_response_form.php?num=<?= $num ?>'">답변 쪽지</button></li>
        <li><button onclick="location.href='message_delete.php?num=<?= $num ?>&mode=<?= $mode ?>'">삭제</button></li>
      </ul>
    </div> <!-- message_box -->
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/footer.php"; ?>
  </footer>
</body>

</html>