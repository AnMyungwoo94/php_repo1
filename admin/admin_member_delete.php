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

$num = (isset($_GET["num"]) &&  $_GET["num"] != '' && is_numeric($_GET["num"])) ? $_GET["num"] : '';

$sql = "delete from members where num = :num";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':num', $num);
$stmt->execute();

echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
