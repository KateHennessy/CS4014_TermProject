<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ReviUL-Page Not Found</title>
      <?php
          session_start();
          require_once __DIR__."/../models/User.class.php";
          require_once __DIR__."/../daos/UserDAO.class.php";
          require_once __DIR__.'/../models/Tag.class.php';
          require_once __DIR__."/../daos/TaskDAO.class.php";
          require_once __DIR__."/../utils/Settings.class.php";
          require_once __DIR__."/../scripts/taskstatusbuttons.php";

          if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
            $id = $_SESSION["user_id"];
            $user = new User();
            $user = UserDAO::getUserByID($id);

            require_once __DIR__.'/../templates/loggedinuser.php';
          }else{
            require_once __DIR__.'/../templates/header.template.php';
          }
        ?>
         <div class="container-fluid">
        <div class="col-xs-12 well">
        <?php
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
          require_once __DIR__.'/../templates/usersidebar.php';
        }

        ?>
        <body>


        <?php
        require_once __DIR__.'/../templates/page_not_found.php';
        ?>

        </body>
        </html>
