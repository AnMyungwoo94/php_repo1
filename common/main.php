<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div id="main_content">
    <div id="latest">
      <h4>최근 게시글</h4>
      <ul>
        <!-- 최근 게시 글 DB에서 불러오기 -->
        <?php
        include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
        $sql = "select * from board order by num desc limit 5";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->execute();

        if (!$result)
          echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
        else {
          while ($row = $stmt->fetch()) {
            $regist_day = substr($row["regist_day"], 0, 10);
        ?>
            <li>
              <span><?= $row["subject"] ?></span>
              <span><?= $row["name"] ?></span>
              <span><?= $regist_day ?></span>
            </li>
        <?php
          }
        }
        ?>
    </div>
    <div id="point_rank">
      <h4>포인트 랭킹</h4>
      <ul>
        <!-- 포인트 랭킹 표시하기 -->
        <?php
        $rank = 1;
        $sql2 = "select * from members order by point desc limit 5";
        $stmt2 = $conn->prepare($sql2);

        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
        $result2 = $stmt2->execute();


        if (!$result2)
          echo "회원 DB 테이블(members)이 생성 전이거나 아직 가입된 회원이 없습니다!";
        else {
          while ($row2 = $stmt2->fetch()) {
            $name  = $row2["name"];
            $id    = $row2["id"];
            $point = $row2["point"];
            $name = mb_substr($name, 0, 1) . " * " . mb_substr($name, 2, 1);
        ?>
            <li>
              <span><?= $rank ?></span>
              <span><?= $name ?></span>
              <span><?= $id ?></span>
              <span><?= $point ?></span>
            </li>
        <?php
            $rank++;
          }
        }
        ?>
      </ul>
    </div>
  </div>
</body>

</html>