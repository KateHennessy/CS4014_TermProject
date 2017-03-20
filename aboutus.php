<?php
  session_start();

    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
      $id = $_SESSION["user_id"];
	   require_once __DIR__.'/templates/loggedinuser.php';
      // echo("ID: " .$id);
    } else {
      // echo("In else " .$_SESSION["user_id"]);
         require_once __DIR__.'/templates/header.template.php';
    }
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ReviUL-About Us
    </title>
<?php
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    ?>

    <div class="container-fluid">
        <div class="col-xs-11 col-sm-8 well">
            <div class="row">
                <h1 class="">About Us</h1><br>
                <p>
                  We are a group of student's completing our Higher Diploma in Software Development in the University of Limerick.
                </p>
                <p>
                  We value the time students and lecturers alike put into assignments and are hoping that this website will help ye along the way!
                </p>
              </div>
          </div>
      </div>

                <?php
                require_once __DIR__.'/templates/footer.php';
                ?>


</body>
</html>
