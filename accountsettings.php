<?php
    session_start();
    require_once __DIR__."/models/User.class.php";
    require_once __DIR__ . '/models/Tag.class.php';
    require_once __DIR__. '/scripts/phpvalidation.php';
    require_once __DIR__."/daos/UserDAO.class.php";

    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
      $id = $_SESSION["user_id"];
      $user = new User();
      $user = UserDAO::getUserByID($id);

    } else {
        header("location:./register.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ReviUL-Account Settings
    </title>

<?php
require_once __DIR__.'/templates/loggedinuser.php';
require_once __DIR__.'/models/User.class.php';
require_once __DIR__."/utils/Settings.class.php";
require_once __DIR__."/database/DatabaseQueries.php";
require_once __DIR__."/daos/TaskDAO.class.php";


?>
 <div class="container-fluid">
<div class="col-xs-12 well">

      <?php
require_once __DIR__.'/templates/usersidebar.php';

$feedback ="";

      if (isset($_POST) && count ($_POST) > 0 && isset($_POST["confirmPass"])) {
          $newPass = $_POST["newPass"];
          $confirmPass = $_POST["confirmPass"];

          //check wheter user/email alerady exists
          if ($newPass != $confirmPass) { //in case Javascript is disabled.
            $feedback = '<h3 class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <i class="glyphicon glyphicon-remove"></i>Your passwords do not match</h3>' .$feedback;

          } else if($newPass == $confirmPass){
                  $siteSalt  = "hPxmjz6hJc";
                  $saltedHash = hash('sha256', $newPass.$siteSalt);
                  $dbquery = new DatabaseQueries();
                  $result = $dbquery -> insertSQLquery ("UPDATE user SET pass = '$saltedHash' WHERE user_id = '".$id ."'");
                  // echo '<script type="text/javascript">',
                  //         'successMessage();',
                  //       '</script>';
                    $feedback = '<h3 class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <i class="glyphicon glyphicon-ok"></i> Password Changed Successfully</h3>' .$feedback;
                  }
                } else { $feedback = '';
                  }



            ?>

    <!-- Main PAGE -->
    <!-- <div class="container-fluid"> -->
      <div class="col-md-9 profile-content">

          <h1><div class="glyphicon glyphicon-lock"></div>Change your password</h1>
          <br><br>
  <?php echo $feedback; ?>
 
  <form method="post" role="form" data-toggle="validator">
		<div class="row">
        <div class="col-sm-6 form-group has-feedback">
          <label>Enter New Password <em class="text-danger"> *</em>
          </label>
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" placeholder="Enter Password Here.." name="newPass" id="pass1Form" class="form-control" data-minLength="5" data-error="" required="">
			<span class="glyphicon form-control-feedback"></span>
			</div>
			<span class="help-block with-errors"></span>
		   </div>
		
        <div class="col-sm-6 form-group has-feedback">
          <label>Confirm New Password <em class="text-danger"> *</em>
          </label>
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" placeholder="Re-enter Password Here..." data-match="#pass1Form"  name="confirmPass" id="pass2Form" class="form-control" data-minLength="5" required="">
			<span class="glyphicon form-control-feedback"></span>
          </div>
		   <span class="help-block with-errors"></span>
        </div>
		</div>
		
        <button type="submit" class="btn btn-lg btn-success">Submit</button>
      </form>
	  



        </div>
      <!-- </div> -->
    </div>
</div>
</div>


        <?php
        require_once __DIR__.'/templates/footer.php';
        ?>



</body>
</html>
