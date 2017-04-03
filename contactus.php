<?php
  session_start();
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/daos/UserDAO.class.php';
    require_once __DIR__."/utils/Settings.class.php";
    require_once __DIR__."/database/DatabaseQueries.php";
    require_once __DIR__."/utils/PDOAccess.class.php";

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

   if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
     $id = $_SESSION["user_id"];
     ?>
      <!-- <div class="container-fluid">
     <div class="col-xs-12 well"> -->

     <!DOCTYPE html>
     <html lang="en">
       <head>
         <title>ReviUL-Contact Us
         </title>

           <?php
    require_once __DIR__.'/templates/loggedinuser.php';
     // echo("ID: " .$id);
   } else {
     // echo("In else " .$_SESSION["user_id"]);
     ?>


           <?php
        require_once __DIR__.'/templates/header.template.php';
   }
    ?>

<div class="container-fluid">
    <div class="col-xs-11 col-sm-8 well">
        <div class="profile-content">
            <h1><div class="glyphicon glyphicon-send"></div> Contact Us</h1><br>
            <p>
              If you encounter any issues, please contact the administration as listed below.
            </p>
              <ul>
                <li>Orla Bonar:  14031833@studentmail.ul.ie </li>
                <li>Kate Hennessy: 11108517@studentmail.ul.ie </li>
                <li>Mary Annie Vijula Ashok Kumar: 16136861@studentmail.ul.ie </li>
      </div>
  </div>
</div>

            <?php
            require_once __DIR__.'/templates/footer.php';
            ?>


</body>
</html>
