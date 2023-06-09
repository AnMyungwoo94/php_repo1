<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";

header("Content-type: application/vnd.ms-excel; charset=utf-8");
//filename = 저장되는 파일명을 설정합니다.
header("Content-Disposition: attachment; filename = customer.xls");
header("Content-Description: PHP8 Generated Data");

//엑셀 파일로 만들고자 하는 데이터의 테이블을 만듭니다.
$EXCEL_FILE = "
<table border='1'>
    <tr>
    <td>NUM</td>
    <td>ID</td>
    <td>PASS</td>
    <td>NAME</td>
    <td>EMAIL</td>
    <td>DATE</td>
    <td>LEVEL</td>
    <td>POINT</td>
    <td>삭제</td>
    </tr>
";

$sql = "select * from members";
$stmt = $conn->prepare($sql);
$result = $stmt->execute();
if (!$result) {
  die("
  <script>
  alert('데이터 로딩오류');
  </script>");
}

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$rowArray = $stmt->fetchAll();
// DB 에 저장된 데이터를 테이블 형태로 저장합니다.
foreach ($rowArray as $row) {
  $EXCEL_FILE .= "
  <tr>
  <td>{$row['num']}</td>
  <td>{$row['id']}</td>
  <td>{$row['pass']}</td>
  <td>{$row['name']}</td>
  <td>{$row['email']}</td>
  <td>{$row['regist_day']}</td>
  <td>{$row['level']}</td>
  <td>{$row['point']}</td>
  </tr>
";
}

$EXCEL_FILE .= "</table>";

// 만든 테이블을 출력해줘야 만들어진 엑셀파일에 데이터가 나타납니다.
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo $EXCEL_FILE;
