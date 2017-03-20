

<?php
require_once __DIR__.'/templates/header.template.php';
require_once __DIR__.'/models/User.class.php';
require_once __DIR__.'/daos/UserDAO.class.php';
require_once __DIR__."/utils/Settings.class.php";
require_once __DIR__."/database/DatabaseQueries.php";
require_once __DIR__."/utils/PDOAccess.class.php";

$feedback = "";



 //Run if form was used
      if (isset($_POST) && count($_POST) > 0 && isset($_POST["email"])) {
 //Get and format email
          $email = $_POST["email"];
          $email = trim(strtolower($_POST["email"]));

 //check email exists
        $user = UserDAO::getUserByEmail($email);
        if(!is_null($user->get_id())){
          ///generate a new password
                   $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
                   $validCharNumber = strlen($validCharacters);
                   $result ="";
                   for ($i = 0; $i < 10; $i++) {
                       $index = mt_rand(0, $validCharNumber - 1);
                       $result .= $validCharacters[$index];

                   // }
                  //  $random_password = $result;
                 }
                 $random_password = $result;

         //encrypt new Password
                   $siteSalt  = "hPxmjz6hJc";
                   $saltedHash = hash('sha256', $random_password.$siteSalt);
                   //echo($saltedHash);
          if(UserDAO::change_password($user, $saltedHash)){
            $feedback = '<h3 class="text-success text-center"> <i class="glyphicon glyphicon-ok"></i>' .$random_password .'</h3><br /><br /><br />';


          }

       }else{ $feedback = '
         <form method="post">
           <div class="col-sm-12">
             <div class="row">
               <?php echo $feedback; ?>
               <div class="col-sm-10 form-group">
                 <label>Enter your email address<em class="text-danger"> *</em>
                 </label>
                 <div class="input-group">
                   <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                   <input type="text" placeholder="Enter email address" name="email" id="emailForm" class="form-control" required="">
                 </div>
               </div>

           </div>
           <button type="submit" class="btn btn-lg btn-success">Submit</button>

         </form>';
       }
     }

     if(isset($_POST["login_button"])){
       $email = trim(strtolower($_POST["email"]));
       $password = $_POST["password"];
       $user = new User();
       $user = UserDAO::login($email, $password);

       if(!is_null($user)){
         $_SESSION["user_id"] = $user->get_id();
        header("location:./profilepage.php");
       }else{
         header("location:./register.php");
       }
     }

     if (!isset($_POST) || count($_POST) == 0) {
         require_once __DIR__.'/templates/header.template.php';
       }

?>

    <!-- Main PAGE -->
    <div class="container-fluid">
      <div class="col-xs-11 col-sm-8 well">
        <div class="row">
          <h1><div class="glyphicon glyphicon-lock"></div> Forgotten Password </h1><br>
          <?php echo $feedback; ?>

        </div>
      </div>
    </div>
</div>
</div>





</body>
</html>
