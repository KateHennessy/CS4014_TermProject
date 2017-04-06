<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ReviUL-Forgotten Password
    </title>

<?php
  session_start();
require_once __DIR__.'/models/User.class.php';
require_once __DIR__.'/daos/UserDAO.class.php';
require_once __DIR__."/utils/Settings.class.php";
require_once __DIR__."/utils/PDOAccess.class.php";
require_once __DIR__."/scripts/phpvalidation.php";
$feedback = "";
 //Run if form was used
      if (isset($_POST) && count($_POST) > 0 && isset($_POST["reset_email"])) {
 //Get and format email
          $email = $_POST["reset_email"];
          $email = trim(strtolower($_POST["reset_email"]));
 //check email exists
        $user = UserDAO::getUserByEmail($email);
        if(!is_null($user)){
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
          if(!preg_match('/^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$/', $email)){
    				$feedback .= phpvalidation::displayFailure(" UL Email is required");
    			$uploadFormOK = false;

    			}

        }else{
          $feedback .=  phpvalidation::displayFailure("This email is not registered to an account");
        }
       }else if(isset($_POST["login_button"])){
         $email = trim(strtolower($_POST["email"]));
         $password = $_POST["password"];
         $user = new User();
         $user = UserDAO::login($email, $password);

         if(!is_null($user)){
           $banned = UserDAO::find_user_in_banned($user -> get_id());
               //if(!is_null($banned)){
               if($banned){
                 $feedback = ' <h3 class="alert alert-danger alert-dismissable">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                 <img class="center-block" src= "http://i3.kym-cdn.com/entries/icons/facebook/000/006/725/desk_flip.jpg" style = "width: 180px; height: 180px;" /><br /> <br />
                 <i class="glyphicon glyphicon-alert"></i> You have been banned for inappropriate content.
                 Contact administration with any issues. </h3> <br /><br />';
               }else{
                 $_SESSION["user_id"] = $user->get_id();

                header("location:./profilepage.php");
              }
         }else{
          //  header("location:./register.php");
          $feedback = ' <h3 class="alert alert-danger alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <i class="glyphicon glyphicon-alert"></i> Incorrect email or password. </h3> <br /><br />';
         }

        //  if(is_null($user)){
        //    header("location:./forgottenpassword.php");
        //  }

       }else{ $feedback = '
         <form method="post" data-toggle="validator" >
           <div class="col-sm-12">
             <div class="row">
               <?php echo $feedback; ?>
               <div class="col-sm-10 form-group has-feedback">
                 <label>Enter your email address<em class="text-danger"> *</em>
                 </label>

                 <div class="input-group">
                   <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                   <input type="email" pattern="^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$" placeholder="Enter email address" name="reset_email" id="emailForm" class="form-control" required="">
				   <span class="glyphicon form-control-feedback"></span>
                 </div>
				 <span class="help-block with-errors"></span>
               </div>
           </div>
           <button type="submit" class="btn btn-lg btn-success">Submit</button>
         </form>';
       }
require_once __DIR__.'/templates/header.template.php';
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


<?php
require_once __DIR__.'/templates/footer.php';
?>



</body>
</html>
