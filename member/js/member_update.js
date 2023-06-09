document.addEventListener("DOMContentLoaded", () => {
 
  let name_regx = /^[가-힣]{2,4}$|^[A-z]{4,10}$/

  const send = document.querySelector("#send");
  const cancel = document.querySelector("#cancel");

  send.addEventListener("click", () => {

    if (document.member_form.pass.value != "") {
      if (document.member_form.pass_confirm.value == "") {
        alert("비밀번호 확인을 입력하세요!");
        document.member_form.pass_confirm.focus();
        return false;
      }
    }

    if (document.member_form.pass_confirm.value != "") {
      if (document.member_form.pass.value == "") {
        alert("비밀번호를 입력하세요!");
        document.member_form.pass.focus();
        return false;
      }
    }
    if (document.member_form.pass.value != "" && document.member_form.pass_confirm !="") {
      //패턴검색 진행을 해서 안맞으면 경고메세지
      if (
        document.member_form.pass.value != document.member_form.pass_confirm.value
      ) {
        alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
        document.member_form.pass.focus();
        document.member_form.pass_confirm.value = "";
        document.member_form.pass.select();
        return false;
      }
    }
    
    if (document.member_form.name.value == "") {
      alert("이름을 입력하세요!");
      document.member_form.name.focus();
      return false;
    }
    if(document.member_form.name.value.match(name_regx) == null){
      alert("이름 한글 2글자 이상 4글자 이하, 영문4자 이상 10자 이하");
      document.member_form.name.focus();
      return false;
    }

    if (document.member_form.email1.value == "") {
      alert("이메일 주소를 입력하세요!");
      document.member_form.email1.focus();
      return false;
    }
    if (document.member_form.email2.value == "") {
      alert("이메일 주소를 입력하세요!");
      document.member_form.email2.focus();
      return false;
    }
    document.member_form.submit();
  });

  cancel.addEventListener("click", () => {
    // alert("취소버튼");
    document.member_form.pass.value = "";
    document.member_form.pass_confirm.value = "";
    document.member_form.name.value = "";
    document.member_form.email1.value = "";
    document.member_form.email2.value = "";
    return;
  });
});