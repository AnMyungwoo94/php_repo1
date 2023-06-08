document.addEventListener("DOMContentLoaded", ()=>{

  let regx1 = /^\d+$/ // 숫자만
  let regx2 =/[^A-z0-9]/g;  //
  let regx3 =/\[\]\{\}\/\(\)\.\?\<\>!@#$%^&*/g //
  let email_regx = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/;
  let phone1_regx  = /^(\d{2,3})-(\d{3,4})-(\d{4})$/; 
  let phone2_regx  = /^\d{3}-\d{3,4}-\d{4}$/; 
  let id_regx = /^[A-Za-z0-9_]{3,}$/;
  let name_regx =/^[가-힣]{2,4}$|^[A-z]{4,10}$/;
  let birthday_regx =/^(19|20)(\d{2})-(\d{1,2})-(\d{1,2})$/; 


  const regist = document.querySelector("#btn_secure_regist")
  regist.addEventListener("click", ()=>{
    const form = document.joinform

    if (form.id.value.match(id_regx) == null) {
      alert("영문자, 숫자,만 입력 가능. 최소 3자이상");
      form.id.value = ""
      form.id.focus();
      return false;
    }

    if (form.pwd.value == "") {
      alert("비밀번호를 입력하세요!");
      form.pwd.value.focus();
      return false;
    }
    if (form.pwdcheck.value == "") {
      alert("비밀번호 확인을 입력하세요!");
      form.pwdcheck.value.focus();
      return false;
    }
    if (
      form.pwd.value != form.pwdcheck.value
    ) {
      alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
      form.pwd.value.focus();
      form.pwdcheck.value = "";
      form.pwd.select();
      return false;
    }

    if (form.name.value.match(name_regx) == null) {
      alert("이름 한글 2자리, 영문 4자이상");
      form.name.focus();
      return false;
    }
    if (form.nickname.value.match(name_regx) == null) {
      alert("닉네임 한글 2자리, 영문 4자이상");
      form.nickname.focus();
      return false;
    }

    if (form.mail.value.match(email_regx) == null) {
      alert("이메일 주소가 올바르지 않습니다!");
      form.mail.focus();
      return false;
    }

  if (form.phone.value.match(phone1_regx) == null) {
      alert("전화번호 오류! 000-0000-0000 형식에 맞지 않습니다.");
      form.phone.value = "";
      form.phone.focus();
      return false;
    }

    if (form.cellphone.value.match(phone2_regx) == null) {
      alert("휴대폰 번호 오류! 010-0000-0000 형식에 맞지 않습니다.");
      form.cellphone.value = "";
      form.cellphone.focus();
      return false;
    }

    if (form.birthday.value == null ||form.birthday.value == "" ) {
      alert("생년월일을 입력하세요");
      form.birthday.value = "";
      form.birthday.focus();
      return false;
    }

    if (form.birthday.value.match(birthday_regx) == null ) {
      alert("생년월일 패턴이 맞지 않습니다.");
      form.birthday.focus();
      return false;
    }
    document.joinform.submit();
  })
})

function etcShow(){
 document.joinform.input_etc.style.display = "inline-block";

}
function etcShowHide(){
  document.joinform.input_etc.style.display = "none";
 
 }