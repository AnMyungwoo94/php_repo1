document.addEventListener("DOMContentLoaded", ()=>{
    const btn_excel = document.querySelector("#btn_excel")
    btn_excel.addEventListener("click", ()=>{
      self.location.href = "./notice_to_excel.php";
    })
  });