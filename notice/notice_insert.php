<meta charset="utf-8">
<?php
session_start();

$userid = (isset($_SESSION["userid"]) && $_SESSION["userid"] != '') ? $_SESSION["userid"] : '';
$name = (isset($_SESSION["username"]) && $_SESSION["username"] != '') ? $_SESSION["username"] : '';

if ($userid == '' && $name == '') {
	die("
	<script>
    alert('공지사항 글쓰기는 로그인 후 이용해 주세요!');
    history.go(-1)
    </script>           
   ");
}


$subject = (isset($_POST["subject"]) && $_POST["subject"] != '') ? $_POST["subject"] : '';
$content = (isset($_POST["content"]) && $_POST["content"] != '') ? $_POST["content"] : '';

$subject = htmlspecialchars($subject, ENT_QUOTES);
$content = htmlspecialchars($content, ENT_QUOTES);

$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

$upload_dir = './data/';

$upfile_name	 = $_FILES["upfile"]["name"];
$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
$upfile_type     = $_FILES["upfile"]["type"];
$upfile_size     = $_FILES["upfile"]["size"];
$upfile_error    = $_FILES["upfile"]["error"];

if ($upfile_name && !$upfile_error) {
	$file = explode(".", $upfile_name);
	$file_name = $file[0];
	$file_ext  = $file[1];

	$new_file_name = date("Y_m_d_H_i_s");
	$copied_file_name = $new_file_name . "." . $file_ext;
	$uploaded_file = $upload_dir . $copied_file_name;

	if ($upfile_size  > 1000000) {
		die("
				<script>
				alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				");
	}

	if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
		die("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
	}
} else {
	$upfile_name      = "";
	$upfile_type      = "";
	$copied_file_name = "";
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";

$sql = "insert into notice (id, name, subject, content, regist_day, hit, file_name, file_type, file_copied) ";
$sql .= "values(:userid, :name, :subject, :content, :regist_day, 0,";
$sql .= ":upfile_name, :upfile_type, :copied_file_name)";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->bindParam(':userid', $userid);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':subject', $subject);
$stmt->bindParam(':content', $content);
$stmt->bindParam(':regist_day', $regist_day);
$stmt->bindParam(':upfile_name', $upfile_name);
$stmt->bindParam(':upfile_type', $upfile_type);
$stmt->bindParam(':copied_file_name', $copied_file_name);
$stmt->execute();

// 포인트 부여하기
$point_up = 100;
$sql2 = "select point from members where id=:userid";

$stmt2 = $conn->prepare($sql2);
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
$stmt2->bindParam(':userid', $userid);
$stmt2->execute();
$row = $stmt2->fetch();


$new_point = $row["point"] + $point_up;


$sql3 = "update members set point=:new_point where id=:userid";

$stmt3 = $conn->prepare($sql3);
$stmt3->bindParam(':new_point', $new_point);
$stmt3->bindParam(':userid', $userid);
$stmt3->execute();

echo "
	   <script>
	    location.href = 'notice_list.php';
	   </script>
	";
?>