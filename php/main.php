     <!-- 이미지 아래 최신 게시글 표시 영역 -->
     <div id="main_content">
       <!-- 1. 최신 게시글 목록 -->
       <article id="latest">
       </article>
       <!-- 이미지 아래 최신 게시글 표시 영역 -->
       <div id="main_content">
         <!-- 1. 최신 게시글 목록 -->
         <article id="latest">
           <ul></ul>
         </article>
         <section>
           <div id="main_img_bar">
           </div>
           <div id="main_content">
             <div id="join_box">
               <form name="member_form" method="post" action="./member_insert.php">
                 <h2>회원 가입</h2>
                 <div class="form id">
                   <div class="col1">아이디</div>
                   <div class="col2">
                     <input type="text" name="id">
                   </div>
                   <div class="col3">
                   </div>
                 </div>
                 <div class="clear"></div>
                 <div class="form">
                   <div class="col1">비밀번호</div>
                   <div class="col2">
                     <input type="password" name="pass">
                   </div>
                 </div>
                 <div class="clear"></div>
                 <div class="form">
                   <div class="col1">비밀번호 확인</div>
                   <div class="col2">
                     <input type="password" name="pass_confirm">
                   </div>
                 </div>
                 <div class="clear"></div>
                 <div class="form">
                   <div class="col1">이름</div>
                   <div class="col2">
                     <input type="text" name="name">
                   </div>
                 </div>
                 <div class="clear"></div>
                 <div class="form email">
                   <div class="col1">이메일</div>
                   <div class="col2">
                     <input type="text" name="email1">@
                     <select name="chk_email">
                       <option value="nothings">-선택하세요-</option>
                       <option value="naver.com">naver.com</option>
                       <option value="google.com">google.com</option>
                       <option value="daum.net">daum.net</option>
                     </select>
                   </div>
                 </div>
                 <div class="buttons">
                   <input type="submit" value="전송">
                 </div>
                 <br>
                 <hr>
               </form>
             </div> <!-- join_box -->
           </div> <!-- main_content -->
         </section>
       </div>
     </div>