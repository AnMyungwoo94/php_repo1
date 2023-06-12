<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>메세지 박스</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/common.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/message/css/message.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/slide.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/header.css?v=<?= date('Ymdhis') ?>">
  <!-- 부트스트랩 CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- 부트스트랩 JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/message_page_lib.php"; ?>
  </header>
  <section>
    <div id="message_box">
      <h3>
        <?php
        $page = (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : 1;
        $mode = (isset($_GET['mode']) && $_GET["mode"] != '') ? $_GET['mode'] : '';

        if ($mode == "send")
          echo "송신 쪽지함 > 목록보기";
        else
          echo "수신 쪽지함 > 목록보기";
        ?>
      </h3>
      <div>
        <table class="table table-striped table-hover">
          <thead class="table-light">
            <th class="col1">번호</th>
            <th class="col2">제목</th>
            <th class="col3">
              <?php if ($mode == "send") echo "받은이";
              else echo "보낸이"; ?>
            </th>
            <th class="col4">등록일</th>
          </thead>
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



          // 표시할 페이지($page)에 따라 $start 계산  
          $start = ($page - 1) * $scale;
          $number = $total_record - $start;

          if ($mode == "send")
            $sql = "select * from message where send_id=:userid order by num desc limit {$start}, {$scale}";
          else
            $sql = "select * from message where rv_id=:userid order by num desc limit {$start}, {$scale}";

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
            <tbody>
              <td class="col1"><?= $number ?></td>
              <td class="col2"><a href="message_view.php?mode=<?= $mode ?>&num=<?= $num ?>"><?= $subject ?></a></td>
              <td class="col3"><?= $msg_name ?>(<?= $msg_id ?>)</td>
              <td class="col4"><?= $regist_day ?></td>
            </tbody>
          <?php
            $number--;
          }
          ?>
        </table>
        <div class="container d-flex justify-content-center align-items-start mb-3 gap-3">
          <?php
          $set_page_limit = 5;
          echo pagination($total_record, $scale, $set_page_limit, $page);
          ?>
          <button type="button" class="btn btn-outline-dark " id="btn_excel">엑셀로 저장</button>
        </div>
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