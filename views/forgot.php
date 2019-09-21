<main>
<div class="wrapper-main">
 <section class="section-default">  
  <h1>Reset your password.</h1>
  <p>tan.awa sa imong email</p>
  
  <form action="/forgot/submit"  method="post">
     <input type="text" name="email" placeholder="Enter your e-mail address....">
     <button type="submit" name="reset-request-submit">Receive new password by email</button>
   
  </form>
		
      <?php
          
          if(isset($_GET["reset"])){
             if($_GET["reset"] == "success"){
                echo '<p class="signupsuccess">Check your e-mail! </p>';
             }
          }
          
      ?>

 </section>
</div>
</main>
