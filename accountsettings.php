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

    $feedback ="";

          if (isset($_POST) && count ($_POST) > 0 && isset($_POST["confirmPass"])) {
            $url = 'accountsettings.php?passwordChangedOK=';
              $newPass = $_POST["newPass"];
              $confirmPass = $_POST["confirmPass"];
              //check wheter user/email alerady exists
              if(strlen($newPass) < 5){
                $url .= '2';
              }
              else if(strlen($newPass) > 25){
                $url .= '3';
              }
              else if ($newPass != $confirmPass) { //in case Javascript is disabled.
                $url .= '4';
              }
               else if($newPass == $confirmPass){
                      $siteSalt  = "hPxmjz6hJc";
                      $saltedHash = hash('sha256', $newPass.$siteSalt);
                      $user->set_password($saltedHash);
                      UserDAO::save($user);
                      $url .= '1';
            }

            header("Location: " .$url);
        }

          if(isset($_GET["passwordChangedOK"])){
            switch($_GET["passwordChangedOK"]){
                case 1: $feedback .= phpvalidation::displaySuccess("Password Changed Successfully");
                  break;
                case 2: $feedback .= phpvalidation::displayFailureSubtext("Your password is not long enough", "It must be between 5 and 25 characters");
                  break;
                case 3: $feedback .=phpvalidation::displayFailureSubtext("Your password is too long", "It must be between 5 and 25 characters");
                  break;
                case 4: $feedback .= phpvalidation::displayFailure("Your passwords do not match");
                  break;
                  default: $feedback .= phpvalidation::displayFailureSubtext("There was an issue changing your password", "If the problem continues please contact the site administrators");

            }
          }


          if(isset($_POST) && isset($_POST["changeFirstNameSubmit"])){

              $url = 'accountsettings.php?firstNameChangedOK=';
            $firstName = htmlspecialchars(ucfirst(trim($_POST["newFirstName"])));
            if(strlen($firstName) > 25 || strlen($firstName) == 0 ){
              $url .= '0';
       			}else{
              $user->set_first_name($firstName);
              if(UserDAO::save($user)){
                $url .= '1';
              }else{
                $url .= '2';
              }

            }
              header("Location: " .$url);
          }

          if(isset($_GET["firstNameChangedOK"])){
            switch($_GET["firstNameChangedOK"]){
                case 1: $feedback .= phpvalidation::displaySuccess("First Name Changed Successfully");
                break;
                case 2: $feedback .=  phpvalidation::displayFailureSubtext('There was an error updating your name.', 'If the issue persists please contact the system administators');
                break;
                  default:  $feedback .=  phpvalidation::displayFailure('First Name is required.');

            }
          }


          if(isset($_POST) && isset($_POST["changeLastNameSubmit"])){

              $url = 'accountsettings.php?lastNameChangedOK=';
            $lastName = htmlspecialchars(ucfirst(trim($_POST["newLastName"])));

            if(strlen($lastName) > 25 || strlen($lastName) == 0 ){
              $url .= '0';
            }else{
              $user->set_last_name($lastName);
              if(UserDAO::save($user)){
                $url .= '1';
              }else{
                $url .= '2';
              }

            }
              header("Location: " .$url);
          }

          if(isset($_GET["lastNameChangedOK"])){
            switch($_GET["lastNameChangedOK"]){
                case 1: $feedback .= phpvalidation::displaySuccess("Last Name Changed Successfully");
                  break;
                case 2: $feedback .=  phpvalidation::displayFailureSubtext('There was an error updating your surname.', 'If the issue persists please contact the system administators');
                  break;
                default:  $feedback .=  phpvalidation::displayFailure('Last Name is required.');

            }
          }

          if(isset($_POST["changeDisciplineSubmit"])){
              $url = 'accountsettings.php?disciplineChangedOK=';
             if(isset($_POST["discipline"])){
               $discipline_name = $_POST["discipline"];
               $discipline = DisciplineDAO::find_discipline_by_name($discipline_name);
               if(!is_null($discipline)){
                 $user->set_discipline($discipline);
                 if(UserDAO::save($user)){
                   $url .= "1";
                 }else{
                   $url = '0';
                 }
               }else{
                 $url = '2';
               }
             }
             header("Location: " .$url);
          }

          if(isset($_GET["disciplineChangedOK"])){
            switch($_GET["disciplineChangedOK"]){
                case 0: $feedback .=  phpvalidation::displayFailureSubtext('There was an error updating your discipline.', 'If the issue persists please contact the system administators');
                  break;
                case 1: $feedback .= phpvalidation::displaySuccess("Discipline Changed Successfully");
                  break;
                case 2:
                default:  $feedback .=  phpvalidation::displayFailure('Please select a discipline');

            }
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
require_once __DIR__."/daos/TaskDAO.class.php";
require_once __DIR__."/scripts/phpvalidation.php";


?>
 <div class="container-fluid">
<div class="col-xs-12 well">

      <?php
require_once __DIR__.'/templates/usersidebar.php';
            ?>

    <!-- Main PAGE -->
    <!-- <div class="container-fluid"> -->
      <div class="col-md-9 profile-content">
        <?php echo $feedback; ?>


        <div class="panel panel-footer">
          <h1><span class="glyphicon glyphicon-lock"></span>Change your password</h1>
                  <br><br>
          <form method="post" role="form" data-toggle="validator">
        		<div class="row">
                <div class="col-sm-6 form-group has-feedback">
                  <label>Enter New Password
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" placeholder="Enter Password Here.." name="newPass" id="pass1Form" class="form-control" data-minLength="7" maxlength ="25" data-error="" required="">
        			      <span class="glyphicon form-control-feedback"></span>
          			  </div>
          			  <span class="help-block with-errors"></span>
        		  </div>

                <div class="col-sm-6 form-group has-feedback">
                    <label>Confirm New Password
                    </label>
                    <div class="input-group">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                      <input type="password" placeholder="Re-enter Password Here..." data-match="#pass1Form"
                         name="confirmPass" id="pass2Form" class="form-control" data-minLength="7" maxlength = "25" required="">
          			      <span class="glyphicon form-control-feedback"></span>
                    </div>
          		      <span class="help-block with-errors"></span>
                </div>
        		</div>
                <button type="submit" class="btn btn-lg btn-success" name="changePasswordSubmit">Submit</button>
              </form>
          </div>

          <div class="panel panel-footer">
            <h1><span class="glyphicon glyphicon-user"></span> Change Your First Name</h1>
            <br><br>
            <form method="post" role="form" data-toggle="validator">
        		    <div class="row">
                  <div class="col-sm-6 form-group has-feedback">
                    <label>Enter New First Name
                    </label>
                    <div class="input-group">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                      <input type="text" placeholder="Enter First Name Here.." name="newFirstName" id="fNameForm" class="form-control" maxlength ="25" required="">
        			        <span class="glyphicon form-control-feedback"></span>
        			      </div>
        			      <span class="help-block with-errors"></span>
        		      </div>
        		    </div>
                <button type="submit" class="btn btn-lg btn-success" name="changeFirstNameSubmit">Submit</button>
             </form>
           </div>


          
          <!-- <div class="col-xs-12"> -->
            <div class="panel panel-footer">

              <h1><span class="glyphicon glyphicon-user"></span> Change Your Last Name</h1>
                <br><br>
                <form method="post" role="form" data-toggle="validator">
              		<div class="row">
                      <div class="col-sm-6 form-group has-feedback">
                        <label>Enter New Last Name
                        </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                          <input type="text" placeholder="Enter Last Name Here.." name="newLastName" id="lNameForm" class="form-control" maxlength ="25" required="">
              			<span class="glyphicon form-control-feedback"></span>
              			</div>
              			<span class="help-block with-errors"></span>
              		   </div>

              		</div>

                      <button type="submit" class="btn btn-lg btn-success" name="changeLastNameSubmit">Submit</button>
                  </form>
                </div>
              <!-- </div> -->

              <div class="panel panel-footer">

                <h1><span class="glyphicon glyphicon-user"></span> Change Your Discipline</h1>
                  <br><br>
                  <form method="post" role="form" data-toggle="validator">
                    <div class="row">
                      <div class="col-xs-12 form-group has-feedback">
                        <label>Pick New Discipline
                        </label>
                        <div class="input-group"  id="discipline">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                          <select id="disciplineSelect" class="selectpicker" name="discipline" multiple data-max-options="1"
                          data-error="Please choose a discipline" data-width="75%">
                          <?php $allDisciplines = DisciplineDAO::find_all_disciplines();
                            foreach($allDisciplines as $aDisc){
                              echo '<option>' .$aDisc->get_name() .'</option>';
                            } ?>
                          </select>

                        </div>
                        <span class="help-block with-errors"></span>


      				  <noscript>
      				  <div class="input-group" style="min-width:100%"><select required class="custom-select" name="discipline">
      						<?php $allDisciplines = DisciplineDAO::find_all_disciplines();
                            foreach($allDisciplines as $aDisc){
                              echo '<option>' .$aDisc->get_name() .'</option>';
                            } ?>
                          </select></div>
      					</noscript>
                </div>
              </div>
                <button type="submit" class="btn btn-lg btn-success" name="changeDisciplineSubmit">Submit</button>
            </form>
          </div>




        </div>
      <!-- </div> -->
    </div>
</div>
</div>


        <?php
        require_once __DIR__.'/templates/footer.php';
        ?>

        <script>
              $(document).ready(function(){

                      $("#tags").show();
                      $("#tagsSelect").attr('required','');      //adding this as chrome having issues with these hidden elements when js disabled if required set in above html

                      $("#discipline").show();
                      $("#disciplineSelect").attr('required','');
                      $("[id^='tooltip']").tooltip();

              });
         </script>

</body>
</html>
