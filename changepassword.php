<?php
    session_start();

    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
      $id = $_SESSION["user_id"];
      // echo("ID: " .$id);
    } else {
      // echo("In else " .$_SESSION["user_id"]);
        header("location:./register.php");
    }
?>



<?php
require_once __DIR__.'/templates/loggedinuser.php';
require_once __DIR__.'/models/User.class.php';
require_once __DIR__."/utils/Settings.class.php";
require_once __DIR__."/database/DatabaseQueries.php";
require_once __DIR__.'/templates/usersidebar.php';

      if (isset($_POST) && count ($_POST) > 0) {
          $newPass = $_POST["newPass"];
          $confirmPass = $_POST["confirmPass"];

          //check wheter user/email alerady exists
          if ($newPass != $confirmPass) { //in case Javascript is disabled.
              printf("<h2> Passwords do not match. </h2>");

          } else {
                  $siteSalt  = "hPxmjz6hJc";
                  $saltedHash = hash('sha256', $newPass.$siteSalt);
                  $dbquery = new DatabaseQueries();
                  $result = $dbquery -> insertSQLquery ("UPDATE user SET pass = '$saltedHash' WHERE user_id = '".$id ."'");
                  echo '<script type="text/javascript">',
                          'successMessage();',
                        '</script>';
                  }
                  }

            ?>

    <!-- Main PAGE -->
    <div class="container-fluid">
      <div class="col-xs-11 col-sm-8 well">
        <div class="row">
          <h1 class="">Change your password</h1>
          <br>
          <form method="post">
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-6 form-group">
                  <label>Enter New Password <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" placeholder="Enter Password Here.." name="newPass" id="pass1Form" class="form-control" required="">
                  </div>
                </div>
                <div class="col-sm-6 form-group">
                  <label>Confirm New Password <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" placeholder="Re-enter Password Here..." name="confirmPass" id="pass2Form" class="form-control" required="">
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-lg btn-success" id="Success">Submit</button>
            <div id = "success" style="visibility: hidden;"><p> Your password has been successfully reset </p></div>

          </form>
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
