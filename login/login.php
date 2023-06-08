<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";

$id = (isset($_POST["id"]) && $_POST["id"] != '') ? $_POST["id"] : "";
$pass = (isset($_POST["pass"]) && $_POST["pass"] != '') ? $_POST["pass"] : "";
if ($id == "" or $pass == "") {
  die("<script>
        alert('아이디와 패스워드를 입력해주세요.');
        history.go(-1);
        </script>");
}
// sql 침입방지
$sql = "select * from members where id=:id and pass=:pass";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':pass', $pass);
$stmt->execute();
$info = $stmt->rowCount() ? true : false;

if ($info == false) {
  die("<script>
        alert('아이디나 패스워드 잘못 입력되었습니다');
        history.go(-1);
        </script>");
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// 세션설정
session_start();
$_SESSION["num"] = $row["num"];
$_SESSION["userid"] = $row["id"];
$_SESSION["username"] = $row["name"];
$_SESSION["userlevel"] = $row["level"];
$_SESSION["userpoint"] = $row["point"];

echo "
      <script>
        self.location.href = 'http://{$_SERVER['HTTP_HOST']}/php_source/khs/index.php'
      </script>
    ";
