<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/db_connect.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title>회원리스트</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 슬라이드 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>" defer></script>
  <!-- secure 자바스트립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/secure_member.js' ?> " defer></script>
  <!-- 부트스트랩 CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- 부트스트랩 JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- 공통, 슬라이드, 해더 스타일 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/header.css' ?>">
  <style>
    .container {
      margin: auto;
    }
  </style>
</head>

<body>
  <header>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/header.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/page_lib.php"; ?>
  </header>
  <div class="container w-50 border p-5 my-3 rounded-5">
    <h2 class="text-center">회 원 가 입</h2>
    <button type="button" class="btn btn-secondary">
      사이트 이용정보 입력
    </button>
    <form name="joinform" method="post" autocomplete="off" action="./secure_member_insert.php">
      <fieldset>
        <table class="table">
          <colgroup>
            <col width=15%>
            <col width=85%>
          </colgroup>
          <tr>
            <td>
              <label for="id"><b>아이디</b></label>
            </td>
            <td>
              <label id="instruction">영문자, 숫자,_만 입력 가능, 최소 3글자 이상 입력하세요</label><br>
              <input type="text" name="id" id="id" min="3" required="required">
            </td>
          </tr>
          <tr>
            <td>
              <label for="pwd"><b>비밀번호</b></label>
            </td>
            <td>
              <input type="password" name="pwd" id="pwd" required="required">
            </td>
          </tr>
          <tr>
            <td>
              <label for="pwd"><b>비밀번호 확인</b></label>
            </td>
            <td>
              <input type="password" name="pwdcheck" id="pwdcheck" required="required">
            </td>
          </tr>
        </table>
        <fieldset>
          <br />
          <button type="button" class="btn btn-secondary">
            개인정보 입력
          </button>
          <table class="table">
            <colgroup>
              <col width=15%>
              <col width=85%>
            </colgroup>
            <tr>
              <td>
                <label class="private" for="name"><b>이름</b></label>
              </td>
              <td>
                <input type="text" name="name" id="name" size="6" required="required">
              </td>
            </tr>
            <tr>
              <td>
                <label class="private" for="nickname"><b>닉네임</b></label>
              </td>
              <td>
                <label for="instruction2">공백없이 한글, 영문, 숫자만 입력 가능(한글 2자리, 영문 4자이상)<br />
                  닉네임을 바꾸시면 앞으로 1일 이내에는 변경 할 수 없습니다.</label><br />
                <input type="text" name="nickname" id="nickname" size="6" required="required">
              </td>
            </tr>
            <tr>
              <td>
                <label class="private" for="mail"><b>E-mail</b></label>
              </td>
              <td>
                <input type="email" name="mail" id="mail" size="50" required="required">
              </td>
            </tr>
            <tr>
              <td>
                <label class="private" for="route"><b>가입경로 </b></label>
              </td>
              <td>
                <div class="route">
                  <input type="radio" name="route" id="route" value="internet" onclick="etcShowHide()" checked>
                  <label>인터넷검색</label>
                  <input type="radio" name="route" id="route" value="banner" onclick="etcShowHide()">
                  <label>배너광고</label>
                  <input type="radio" name="route" id="route" value="article" onclick="etcShowHide()">
                  <label>관련기사</label>
                  <br>
                  <input type="radio" name="route" id="route" value="homepage" onclick="etcShowHide()">
                  <label>홈페이지</label>
                  <input type="radio" name="route" id="route" value="friend" onclick="etcShowHide()">
                  <label>지인소개</label>
                  <input type="radio" name="route" id="route" value="etc" onclick="etcShow()">
                  <label>기타</label>
                  <input type="text" name="input_etc" id="input_etc" value="" style="display:none">
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <label class="private" for="phone"><b>전화번호</b></label>
              </td>
              <td>
                <input type="text" name="phone" id="phone">
              </td>
            </tr>

            <tr>
              <td>
                <label class="private" for="cellphone"><b>휴대폰 번호</b></label>
              </td>
              <td>
                <input type="text" name="cellphone" id="cellphone" required="required" title="####-####-####" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}">
              </td>
            </tr>

            <tr>
              <td>
                <label class="private" for="birthday"><b>생년월일</b></label>
              </td>
              <td>
                <input type="date" name="birthday" id="birthday" required="required">
                <!-- <input type="text" name="birthday" id="birthday" size="10" required="required" title="########" pattern="[0-9]{8}"> -->
              </td>
            </tr>
            <tr>
              <td>
                <label class="private" for="addr"><b>주소</b></label>
              </td>
              <td>
                <input type="text" name="addr" id="addr" size="5" required="required" title="#####" pattern="[0-9]{5}">
                <input id="searchaddr" type="button" value="주소 검색" id="searchaddr"><br />
                <input class="addr" type="text" name="basicaddr" id="basicaddr" size="40" required="required">
                <label class="addr">기본주소</label><br />
                <input class="addr" type="text" name="detailaddr" id="detailaddr" size="40" required="required">
                <label class="addr">상세주소</label><br />
              </td>
            </tr>
          </table>
        </fieldset>

        <button type="button" class="btn btn-secondary">기타 개인설정</button>
        <fieldset>
          <table class="table">
            <colgroup>
              <col width=15%>
              <col width=85%>
            </colgroup>
            <tr>
              <td>
                <label for="kokoatalk"><b>카카오톡 메시지</b></label>
              </td>
              <td>
                <input type="checkbox" name="setting" id="setting" value="kokoatalk" checked="checked">
                <label><b>카카오톡 메세지를 받겠습니다.</b></label>
                <label for="check"> > 수신체크를 하시면 세일 소식을 가장 먼저 받아보실 수 있습니다.</label>
              </td>
            </tr>
            <tr>
              <td>
                <label for="mailingService"><b>메일링서비스</b></label>
              </td>
              <td>
                <input type="checkbox" name="setting" id="setting" value="mailingService" checked="checked">
                <label>정보 메일을 받겠습니다.</label>
              </td>
            </tr>
            <tr>
              <td>
                <label for="sms"><b>SMS 수신여부</b></label>
              </td>
              <td>
                <input type="checkbox" name="setting" id="setting" value="sms" checked="checked">
                <label>휴대폰 문자메세지를 받겠습니다.</label>
              </td>
            </tr>

            <tr>
              <td>
                <label for="infomation"><b>정보공개</b></label>
              </td>
              <td>
                <label>정보공개를 바꾸시면 앞으로 0일 이내에는 변경이 안됩니다.</label><br />
                <input type="checkbox" name="setting" id="setting" value="information" checked="checked">
                <label>다른분들이 나의 정보를 볼 수 있도록 합니다.</label>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
          <div class="d-flex justify-content-center gap-2 ">
            <button class="btn btn-primary btn-sm" type="button" id="btn_secure_regist">회원가입</button>
            <input type="reset" class="btn btn-secondary btn-sm" value="가입취소">
          </div>
        </fieldset>
    </form>
  </div>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/footer.php"; ?>
  </footer>
</body>

</html>