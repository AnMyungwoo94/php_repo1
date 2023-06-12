document.addEventListener("DOMContentLoaded", () => {
  const send = document.querySelector("#send");
  const cancel = document.querySelector("#cancel");
  const btn_zipcode = document.querySelector("#btn_zipcode");
  const input_id = document.querySelector("#id");
  const input_email1 = document.querySelector("#email1");
  const input_email2 = document.querySelector("#email2");


  input_id.addEventListener("input",()=>{
    document.member_form.id_check.value = "0";
  })

  input_email1.addEventListener("input",()=>{
    document.member_form.email_check.value = "0";
  })


  input_email2.addEventListener("change",()=>{
    document.member_form.email_check.value = "0";
  })
  

  send.addEventListener("click", () => {
    if (document.member_form.id.value == "") {
      alert("아이디를 입력하세요!");
      document.member_form.id.focus();
      return false;
    }

     if (document.member_form.id_check.value == "0") {
       alert("아이디를 체크하세요");
       document.member_form.id.focus();
       return false;
     }
     
    if (document.member_form.pass.value == "") {
      alert("비밀번호를 입력하세요!");
      document.member_form.pass.focus();
      return false;
    }
    if (document.member_form.pass_confirm.value == "") {
      alert("비밀번호 확인을 입력하세요!");
      document.member_form.pass_confirm.focus();
      return false;
    }
    if (
      document.member_form.pass.value != document.member_form.pass_confirm.value
    ) {
      alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
      document.member_form.pass.focus();
      document.member_form.pass_confirm.value = "";
      document.member_form.pass.select();
      return false;
    }
    if (document.member_form.name.value == "") {
      alert("이름을 입력하세요!");
      document.member_form.name.focus();
      return false;
    }

    let name_regx =/^[가-힣]{2,4}$|^[A-z]{4,10}$/;
    if (document.member_form.name.value.match(name_regx) == null) {
      alert("이름 한글 2자리, 영문 4자이상");
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
    if (document.member_form.email_check.value == "0") {
      alert("이메일을 체크하세요");
      document.member_form.id.focus();
      return false;
    }
    document.member_form.submit();
  });
  cancel.addEventListener("click", () => {
    // alert("취소버튼");
    document.member_form.id.value = "";
    document.member_form.pass.value = "";
    document.member_form.pass_confirm.value = "";
    document.member_form.name.value = "";
    document.member_form.email1.value = "";
    document.member_form.email2.value = "";
    return;
  });

  btn_zipcode.addEventListener("click", () => {
    new daum.Postcode({
      oncomplete: function(data) {

        let addr = "";
        let extra_addr = ""
        //지번, 도로명 선택하기
        if(data.userSelectedType == "J"){
            addr = data.jibunAddress
        }else if(data.userSelectedType == "R"){
          addr = data.roadAddress
        }

        //동이름이 점검
        if(data.bname != ''){
          extra_addr = data.bname
        }

        //빌딩명 점검
        if(data.buildingName != ''){
          extra_addr += ","+data.buildingName
        }
        if(extra_addr != ''){
          extra_addr ="("+extra_addr+")" 
        }
        addr = addr + extra_addr

        document.member_form.zipcode.value = data.zonecode;
        document.member_form.addr1.value = addr;

      }
    }).open();
  })
    const btn_excel = document.querySelector("#btn_excel")
    btn_excel.addEventListener("click", ()=>{
      self.location.href = "./member_to_excel.php";
    })
});

function check_id() {
  if (document.member_form.id.value == "") {
    alert("아이디를 입력하세요!");
    document.member_form.id.focus();
    return false;
  }

  //아이디 패턴
  let id_regx = /^[A-Za-z0-9_]{3,}$/;

  if (document.member_form.id.value.match(id_regx) == null) {
    alert("영문자, 숫자,만 입력 가능. 최소 3자이상");
    document.member_form.id.value = "";
    document.member_form.id.focus();
    return false;
  }

  // AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "./member_check.php", true);
  // 전송할 데이터 생성
  const formdata = new FormData();
  formdata.append("id", document.member_form.id.value);
  formdata.append("mode", "id_check");
  xhr.send(formdata);
  // 서버에 JSON 데이터가 도착 완료
  xhr.onload = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // json.parse = json객체를 javascript객체로 변환
      // {'result': 'success'} => {result: 'success'}
      const data = JSON.parse(xhr.responseText);
      switch (data.result) {
        case "fail":
          alert("사용 불가능한 아이디입니다.");
          document.member_form.id.value = "";
          document.member_form.id_check.value = "0";
          document.member_form.id.focus();
          break;
        case "success":
          alert("사용 가능한 아이디입니다.");
          document.member_form.id_check.value = "1";
          document.member_form.pass.focus();
          break;
        case "empty_id":
          alert("아이디를 입력해주세요.");
          document.member_form.id_check.value = "0";
          document.member_form.id.focus();
          break;
        default:
      }
    } else {
      alert("서버 통신 불가");
    }
  };
}

function check_email(){
  // 이메일 점검
  if (document.member_form.email1.value == '') {
    alert("이메일 입력하세요!");
    document.member_form.email1.focus();
    return false;
  }
  if (document.member_form.email2.value == '') {
    alert("이메일 입력하세요!");
    document.member_form.email2.focus();
    return false;
  }
  let email = document.member_form.email1.value + "@" +document.member_form.email2.value

  let email_regx = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/;
  if (email.match(email_regx) == null) {
    alert("이메일 주소가 올바르지 않습니다!");
    document.member_form.email1.focus();
    return false;
  }

    //AJAX
    const xhr = new XMLHttpRequest()
    xhr.open("POST", "./member_check.php", true)

    //전송할데이터 생성
    const formdata =  new FormData()
    formdata.append('email1', document.member_form.email1.value)
    formdata.append('email2', document.member_form.email2.value)
    formdata.append('mode',"email_check")
    xhr.send(formdata)

    //서버에서 member_check_id.php 요청을 하면 돌려줄 JSON 데이터 도착이 완료하면 발생
    xhr.onload = () => {
      if(xhr.status == 200){
        //{'result': 'success'} => {'result': 'success'}
        //JSON.parse json 객체를 자바스트립트 객체로 바꿔줌
        const data = JSON.parse(xhr.responseText)
       switch(data.result){
        case 'fail' : 
        alert('사용할 수 없는 이메일입니다.')
        document.member_form.email_check.value="0";
        document.member_form.email1.value = "";
        document.member_form.email2.value = "";
        document.member_form.email1.focus()
        break;
        case 'success' :
        alert('사용할 수 있는 이메일입니다.')
        document.member_form.email_check.value="1";
        document.member_form.email2.focus()
        break;
        case 'empty_email' : 
        alert('이메일를 입력해주세요')
        document.member_form.email_check.value="0";
        document.member_form.email1.focus()
        break;
        default : 
       }
      }else{
        alert("서버통신이 안됩니다.")
      }
    }
  }
  
  