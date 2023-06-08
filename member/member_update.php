<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";

$num = (isset($_POST["num"]) &&  $_POST["num"] != '' && is_numeric($_POST["num"])) ? $_POST["num"] : '';
$id = (isset($_POST["id"]) &&  $_POST["id"] != '') ? $_POST["id"] : '';
$pass = (isset($_POST["pass"]) &&  $_POST["pass"] != '') ? $_POST["pass"] : '';
$name = (isset($_POST["name"]) &&  $_POST["name"] != '') ? $_POST["name"] : '';
$email1 = (isset($_POST["email1"]) &&  $_POST["email1"] != '') ? $_POST["email1"] : '';
$email2 = (isset($_POST["email2"]) &&  $_POST["email2"] != '') ? $_POST["email2"] : '';
$email = $email1 . "@" . $email2;

if ($num == '' or $id == '' or $pass == '' or $name == '' or $email1 == '' or $email2 == '') {
  die("<script>
      alert('데이터 입력이 잘못되었습니다.\n 확인해주세요.');
      history.go(-1);
    </script>");
}

$sql = "UPDATE members set pass=:pass, name=:name, email=:email where num=:num";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":pass", $pass);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":num", $num);
$result = $stmt->execute();

if (!$result) {
  die("<script>
      alert('데이터 수정 오류');
      history.go(-1);
    </script>");
}

echo "
  <script>
    self.location.href = 'http://{$_SERVER['HTTP_HOST']}/php_source/khs/index.php'
  </script>
";
