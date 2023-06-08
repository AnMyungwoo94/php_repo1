<?php

function create_table($conn, $table_name)
{
  $ctt_flag = false;
  $sql = "show tables from memberDB where tables_in_memberdb =:table_name ";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(":table_name", $table_name);
  $result = $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_NUM);
  $count = $stmt->rowCount();


  //테이블이 있는지 없는지 확인
  $ctt_flag = ($count >= 1) ? true : false;

  if ($ctt_flag == false) {
    switch ($table_name) {
      case 'members':
        $sql = "CREATE TABLE members (
      num int(11) NOT NULL AUTO_INCREMENT,
      id char(15) NOT NULL,
      pass char(15) NOT NULL,
      name char(10) NOT NULL,
      email char(80) DEFAULT NULL,
      zipcode char(5) DEFAULT '',
      addr1 varchar(255) DEFAULT '',
      addr2 varchar(255) DEFAULT '',
      regist_day char(20) DEFAULT NULL,
      level int(11) DEFAULT NULL,
      point int(11) DEFAULT NULL,
      PRIMARY KEY (num),
      UNIQUE KEY uk_id (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        break;
      case 'board':
        $sql = "CREATE TABLE `board` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `subject` char(200) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) NOT NULL,
          `hit` int(11) NOT NULL,
          `file_name` char(40) DEFAULT NULL,
          `file_type` char(40) DEFAULT NULL,
          `file_copied` char(40) DEFAULT NULL,
          PRIMARY KEY (`num`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4";
        break;
      case 'notice':
        $sql = "CREATE TABLE `notice` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `subject` char(200) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) NOT NULL,
          `hit` int(11) NOT NULL,
          `file_name` char(40) DEFAULT NULL,
          `file_type` char(40) DEFAULT NULL,
          `file_copied` char(40) DEFAULT NULL,
          PRIMARY KEY (`num`)
        ) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
        break;
      case '만들 테이블 명':
        break;
      case '만들 테이블 명':
        break;
      default:
        $sql != "";

        break;
    }
    if ($sql != "") {
      $stmt = $conn->prepare($sql);
      $result = $stmt->execute();
      if ($result) {

        echo "<script>
          alert('해당 테이블 생성 완료');
        </script>";
      } else {
        "<script>
          alert('해당 테이블 생성 오류');
        </script>";
      }
    };
  }
}
