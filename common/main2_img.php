<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>PHP 프로그래밍 입문</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/common.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/image_board/css/board.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/slide.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/header.css?v=<?= date('Ymdhis') ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>" defer></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/board/js/board.js?v=<?= date('Ymdhis') ?>"></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/board/js/board_excel.js?v=<?= date('Ymdhis') ?>"></script>
  <!-- 부트스트랩 CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- 부트스트랩 JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>

  <section>
    <div id="board_box">
      <h3>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non, corrupti accusantium. Quo porro iusto nesciunt optio quaerat. Explicabo, esse odio asperiores quod ea quam laudantium at quos soluta rem necessitatibus quae, dolore quibusdam, totam nam ullam. Doloremque nihil accusamus distinctio maxime assumenda natus harum tempora beatae, ex officia esse provident pariatur. Nemo nesciunt molestiae velit, soluta excepturi itaque, aliquid nisi deleniti nostrum voluptate corporis quia.
      </h3>
      <ul id="board_list">
        <?php

        include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
        if (isset($_GET["page"]))
          $page = $_GET["page"];
        else
          $page = 1;

        $page = (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : 1;
        $sql = "select count(*) as cnt from image_board order by num desc";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->execute();
        $row = $stmt->fetch();
        $total_record = $row['cnt'];
        $scale = 10;

        // 표시할 페이지($page)에 따라 $start 계산  
        $start = ($page - 1) * $scale;

        $number = $total_record - $start;
        $sql2 = "select * from  image_board order by num desc limit {$start}, {$scale}";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt2->execute();
        $rowArray = $stmt2->fetchAll();

        foreach ($rowArray as $row) {
          // 하나의 레코드 가져오기
          $num = $row["num"];
          $id = $row["id"];
          $name = $row["name"];
          $subject = $row["subject"];
          $regist_day = $row["regist_day"];
          $hit = $row["hit"];
          $file_name_0 = $row['file_name'];
          $file_copied_0 = $row['file_copied'];
          $file_type_0 = $row['file_type'];
          $image_width = 300;
          $image_height = 200;
        ?>
          <li>
            <span>
              <a href="board_view.php?num=<?= $num ?>&page=<?= $page ?>">
                <?php if (strpos($file_type_0, "image") !== false) { ?>
                  <img src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/php_source/khs/image_board/data/<?php echo $file_copied_0 ?>" width="<?php echo $image_width ?>" height="<?php echo $image_height ?>"><br>
                <?php } else { ?>
                  <img src="./img/logo.png" width="<?php echo $image_width ?>" height="<?php echo $image_height ?>"><br>
                <?php } ?>
                <?= $subject ?></a><br>
              <?= $id ?><br>
              <?= $regist_day ?>
            </span>
          </li>
        <?php
          $number--;
        }
        ?>
      </ul>

    </div> <!-- board_box -->
  </section>
</body>

</html>