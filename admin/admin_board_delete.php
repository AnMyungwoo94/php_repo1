<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";

session_start();
if (isset($_SESSION["userlevel"]) && $_SESSION["userlevel"] != 1) {
    echo ("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
    exit;
}

if (!isset($_POST["item"])) {
    echo ("
                    <script>
                    alert('삭제할 게시글을 선택해주세요!');
                    history.go(-1)
                    </script>
        ");
} else {

    for ($i = 0; $i < count($_POST["item"]); $i++) {
        $num = $_POST["item"][$i];

        $sql = "select * from board where num = :num";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':num', $num);
        $stmt->execute();
        $row = $stmt->fetch();

        $copied_name = $row["file_copied"];

        if ($copied_name) {
            $file_path = "./data/" . $copied_name;
            unlink($file_path);
        }

        $sql2 = "delete from board where num = :num";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bindParam(':num', $num);
        $stmt2->execute();
    }
}

echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
