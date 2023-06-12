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
$num = (isset($_POST["num"]) &&  $_POST["num"] != '' && is_numeric($_POST["num"])) ? $_POST["num"] : '';
$level = (isset($_POST["level"]) &&  $_POST["level"] != '' && is_numeric($_POST["level"])) ? $_POST["level"] : '';
$point = (isset($_POST["point"]) &&  $_POST["point"] != '' && is_numeric($_POST["point"])) ? $_POST["point"] : '';


$sql = "update members set level=:level, point=:point where num=:num";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':level', $level);
$stmt->bindParam(':point', $point);
$stmt->bindParam(':num', $num);
$stmt->execute();


echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
