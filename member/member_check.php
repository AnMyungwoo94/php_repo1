<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
$id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';

$email1 = (isset($_POST["email1"])) ? $_POST["email1"] : '';
$email2 = (isset($_POST["email2"])) ? $_POST["email2"] : '';
$email = $email1 . "@" . $email2;

$mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';

if ($mode == '') {
  die(json_encode(['result' => 'empty_mode']));
}

if ($mode == "id_check") {
  if ($id == '') {
    // $value = ['result' => 'empty_id'];
    // $jsonEncode = json_encode($value); // json: {'result'=>'empty_id'}, xml: <result>empty_id</result>
    die(json_encode(['result' => 'empty_id']));
  }
  $sql = "select * from members where id=:id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $rows = $stmt->rowCount();

  if ($rows >= 1) {
    die(json_encode(['result' => 'fail']));
  } else {
    die(json_encode(['result' => 'success']));
  }
} else if ($mode == "email_check") {
  $sql = "select * from members where email=:email";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $rows = $stmt->rowCount();

  if ($rows >= 1) {
    die(json_encode(['result' => 'fail']));
  } else {
    die(json_encode(['result' => 'success']));
  }
}
