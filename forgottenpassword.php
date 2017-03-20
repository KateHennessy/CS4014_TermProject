

<?php
require_once __DIR__.'/templates/header.template.php';
require_once __DIR__.'/models/User.class.php';
require_once __DIR__."/utils/Settings.class.php";
require_once __DIR__."/database/DatabaseQueries.php";

$feedback = "";



 //Run if form was used
      if (isset($_POST) && count($_POST) > 0 && isset($_POST["email"])) {
 //Get and format email
          $email = $_POST["email"];
          $email = trim(strtolower($_POST["email"]));


 //set up db connection
          $dbquery = new DatabaseQueries();

 //check email exists
          $email_check = $dbquery -> returnSQLquery ("SELECT count(*) FROM user WHERE email= '".$email ."'");
          $row = $email_check -> fetch(PDO::FETCH_ASSOC);

          if(count($row) == 1) {
 //generate a new password
          $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
          $validCharNumber = strlen($validCharacters);
          $result ="";
          for ($i = 0; $i < 10; $i++) {
              $index = mt_rand(0, $validCharNumber - 1);
              $result .= $validCharacters[$index];
              $random_password = $result;
          }

//encrypt new Password
          $siteSalt  = "hPxmjz6hJc";
          $saltedHash = hash('sha256', $random_password.$siteSalt);
          //$user->set_password($saltedHash);

 //update db
          $result = $dbquery -> insertSQLquery ("UPDATE user SET pass = '$saltedHash' WHERE email = '".$email ."'");
          $feedback = '<h3 class="text-success text-center"> <i class="glyphicon glyphicon-ok"></i>' .$random_password .'</h3><br /><br /><br />';

//email new password to user


        //$subject = "ReviUL: Login Information";
        //$message = "Your password has been reset to $saltedHash";
        //$from = "From: orlabonar@gmail.com";
      //  $to = $email;
      //  $headers = "From:" .$from;

      //  ini_set("SMTP","ssl://smtp.gmail.com");
      //  ini_set("smtp_port","25");
      //  ini_set("sendmail_from","orlabonar@gmail.com");
      //  ini_set("sendmail_path", "C:\wamp64\www\CS4014_TermProject\send mail\sendmail.ini -t");

        //$retval = mail($to,$subject,$message,$headers);
          //if( $retval == true )   {
            //echo "Message sent successfully...";
          //} else {
            //echo "Message could not be sent...";
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
