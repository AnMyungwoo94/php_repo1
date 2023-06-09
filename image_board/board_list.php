<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP 프로그래밍 입문</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/common.css' ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/image_board/css/board.css?v=<?= date('Ymdhis') ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/css/slide.css?v=<?= date('Ymdhis') ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/header.css' ?>">
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>" defer></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/board/js/board.js?v=<?= date('Ymdhis') ?>"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/khs/board/js/board_excel.js?v=<?= date('Ymdhis') ?>"></script>
    <!-- 부트스트랩 CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- 부트스트랩 JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php";
        include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/create_table.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/page_lib.php";
        create_table($conn, "image_board");
        create_table($conn, "image_board_ripple");

        ?>
    </header>
    <section>
        <div id="board_box">
            <h3>
                이미지 게시판 > 목록보기
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
                    $image_width = 200;
                    $image_height = 200;
                    //이미지 정보를 가져오기 위한 함수 width, height, type
                    //                            if (!empty($file_name_0)) {
                    //                                $image_info = getimagesize("./data/" . $file_copied_0);
                    //                                $image_width = $image_info[0];
                    //                                $image_height = $image_info[1];
                    //                                $image_type = $image_info[2];
                    //                                if ($image_width > 200 ) $image_width = 200;
                    //                            }

                    //                            if ($row["file_name"])
                    //                                $file_image = "<img src='./img/file.gif'>";
                    //                            else
                    //                                $file_image = " ";
                ?>
                    <li>
                        <span>
                            <a href="board_view.php?num=<?= $num ?>&page=<?= $page ?>">
                                <?php if (strpos($file_type_0, "image") !== false) echo "<img src='./data/$file_copied_0' width='$image_width' height='$image_height'><br>";
                                else echo "<img src='./img/user.jpg' width='$image_width' height='$image_height'><br>" ?>
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



            <div class="container d-flex justify-content-center align-items-start mb-3 gap-3">
                <?php
                $set_page_limit = 5;
                echo pagination($total_record, $scale, $set_page_limit, $page);
                ?>
                <button type="button" class="btn btn-outline-dark " id="btn_excel">엑셀로 저장</button>
            </div>

            <ul class="buttons">
                <li>
                    <button onclick="location.href='board_list.php'">목록</button>
                </li>
                <li>
                    <?php
                    if ($userid) {
                    ?>
                        <button onclick="location.href='board_form.php'">글쓰기</button>
                    <?php
                    } else {
                    ?>
                        <a href="javascript:alert('로그인 후 이용해 주세요!')">
                            <button>글쓰기</button>
                        </a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div> <!-- board_box -->
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/footer.php"; ?>
    </footer>
</body>

</html>