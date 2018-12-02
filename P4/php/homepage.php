<?php session_start(); ?>

 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Home</title>
        <link href="styles.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
 <body>
   <div class="bg">
   <div class="content">

     <header>

     </header>
      <main>


         <div class="login-wrap">
           <div class=" login-box">
             <div class="row">
               <div class=" login-form">

                   <div class="column2 login-left">
                       <?php include("login.php"); ?>
                   </div>

                   <div class="column2 register-right">
                     <?php include("register.php"); ?>
                  </div>
                </div>
               </div>
             </div>
           </div>


      </main>
      <footer>
          <p>Copyright&#169; TheNetworking Gurus</p>
      </footer>
    </div>
   </div>

   <script>
   function myFunction() {
       var x = document.getElementById("myTopnav");
       if (x.className === "nav") {
           x.className += " responsive";
       } else {
           x.className = "nav";
       }
   }
   </script>
 </body>
 </html>
