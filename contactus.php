<?php
  session_start();
  $feedback = "";
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/daos/UserDAO.class.php';
    require_once __DIR__."/utils/Settings.class.php";
    require_once __DIR__."/utils/PDOAccess.class.php";
?>


    <!DOCTYPE html>
    <html lang="en">
      <head>
        <title>ReviUL-Contact Us
        </title>
<?php
   if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
     $id = $_SESSION["user_id"];
     $user = new User();
     $user = UserDAO::getUserByID($id);
    require_once __DIR__.'/templates/loggedinuser.php';
   } else {
     require_once __DIR__.'/templates/header.template.php';
   }
    ?>

<div class="container-fluid">

      <?php
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
           $id = $_SESSION["user_id"];
           echo '<div class="col-xs-12 well">';
           require_once __DIR__.'/templates/usersidebar.php';
           echo '<div class="col-md-9 profile-content">';
         }else{
           echo '<div class="col-xs-11 col-sm-8 well">
                  <div class="profile-content">';

         }
          echo $feedback; ?>
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
