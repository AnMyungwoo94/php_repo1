<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";

$num = (isset($_GET['num']) && $_GET['num'] != '') ? $_GET['num'] : '';
$mode = (isset($_GET['mode']) && $_GET['mode'] != '') ? $_GET['mode'] : '';

$sql = "delete from message where num=:num";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':num', $num);
$result = $stmt->execute();

if (!$result) {
  echo ("<h2 style='text-align: center'>메시지 삭제 쿼리문 오류: {mysqli_error($conn)}</h2>");
  die("<script>
      history.go(-1);
    </script>");
}

if ($mode == "send") {
  $url = "http://{$_SERVER['HTTP_HOST']}/php_source/khs/message/message_box.php?mode=send";
} else {
  $url = "http://{$_SERVER['HTTP_HOST']}/php_source/khs/message/message_box.php?mode=rv";
}

echo "
<script>
  location.href = '$url';
</script>
";
