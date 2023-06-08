document.addEventListener("DOMContentLoaded", () => {

  const check_input = document.querySelector("#check_input");
  check_input.addEventListener("click",() => {
    if(!document.login_form.id.value){
      alert("아이디를 입력하세요");
      document.login_form.id.focus();
      return
    }
    if(!document.login_form.pass.value){
      alert("비밀번호를 입력하세요");
      document.login_form.pass.focus();
      return
    }
    document.login_form.submit();
  })

  let email_regx = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/;
  let id_regx = /^[A-Za-z0-9_]{3}$/;
  let name_regx =/^[가-힣]{2,4}$|^[A-z]{4,10}$/;

  const send = document.querySelector("#send")
  send.addEventListener("click", ()=>{
    const form = document.member_form

    if(form.id.value.match(id_regx)== null){
      alert("영문자, 숫자,만 입력 가능. 최소 3자이상");
      form.id.value = ""
      form.id.focus();
      return false;
    }



  })

})
