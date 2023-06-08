document.addEventListener("DOMContentLoaded",()=>{
  const login = document.querySelector("#login")
  login.addEventListener("click",()=>{
    if (!document.member_form.id.value) {
          alert("아이디를 입력하세요!");
          document.member_form.id.focus();
          return;
        }
        if (!document.member_form.pass.value) {
          alert("비밀번호를 입력하세요!");
          document.member_form.pass.focus();
          return;
        }
        // alert("확인")
        document.member_form.submit();
  })
})