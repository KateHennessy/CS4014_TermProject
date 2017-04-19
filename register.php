<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ReviUL-Register
    </title>

<?php
    session_start();
    $feedback = ""; //this is the variable going to be used for feedback from db on user input
    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
        header("location:./profilepage.php");
    }
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__.'/models/Discipline.class.php';
    require_once __DIR__.'/daos/DisciplineDAO.class.php';
    require_once __DIR__.'/daos/TagDAO.class.php';
    require_once __DIR__.'/daos/UserDAO.class.php';
    require_once __DIR__.'/scripts/phpvalidation.php';
    require_once __DIR__.'/daos/TaskDAO.class.php';

      if (isset($_POST) && count ($_POST) > 0) {
        if(isset($_POST["signup_button"])){
			    $uploadFormOK = true;
          $firstName = htmlspecialchars(ucfirst(trim($_POST["first_name"])));
          $lastName = htmlspecialchars(ucfirst(trim($_POST["last_name"])));
          $email = trim(strtolower($_POST["signup_email"]));
          $passOne = $_POST["pass_one"];
          $passTwo = $_POST["pass_two"];
          $discipline_name = $_POST["discipline"];
          $tags= $_POST["tags"];

          if(count($tags) < 1 || count($tags) > 4){
            $feedback .=  phpvalidation::displayFailure('Incorrect number of tags entered.');
    			  $uploadFormOK = false;
    		  }


          if(strlen($email) < 7){
            $feedback .= phpvalidation::displayFailure('Please enter a UL email address');
            $uploadFormOK = false;
          }

          if(strlen($email) > 128){
            $feedback .= phpvalidation::displayFailure('Email entered is too long');
            $uploadFormOK = false;
          }
          if(!preg_match('/^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$/', $email)){
    				$feedback .= phpvalidation::displayFailureSubtext('UL Email is required.', 'Email must end with @ul.ie or @studentmail.ul.ie');
    			$uploadFormOK = false;
    			}
          //check wheter user/email already exists
          $user = null;
          if($uploadFormOK){
                $user = UserDAO::getUserByEmail($email);
               if(!is_null($user->get_email())){
                  // require_once __DIR__.'/templates/header.template.php';
                  $feedback .= phpvalidation::displayFailure('A user already exists with this email.');
      			       $uploadFormOK = false;
      		    }
         }

         if(strlen($firstName) > 25 || strlen($firstName) == 0 ){
    			  $feedback .=  phpvalidation::displayFailure('First Name is required.');
    			$uploadFormOK = false;
    			}

    			if(strlen($lastName) > 25 || strlen( $lastName) == 0 ){
    			  $feedback .= phpvalidation::displayFailure('Last Name is required.');
    			  $uploadFormOK = false;
    			}
          if(strlen($passOne) < 5){
             $feedback .= phpvalidation::displayFailure('Password is too short.');
             $uploadFormOK = false;
          }
          if(strlen($passOne) > 25){
            $feedback .= phpvalidation::displayFailure('Password is too long.');
            $uploadFormOK = false;
          }
          if ($passOne != $passTwo) { //in case Javascript is disabled.
                $feedback .= phpvalidation::displayFailure('Passwords are not the same.');
                $uploadFormOK = false;
           }

    			if($uploadFormOK == true){
              $siteSalt  = "hPxmjz6hJc";
              $saltedHash = hash('sha256', $passOne.$siteSalt);
              $user = new User();
              $user->set_first_name($firstName);
              $user->set_last_name($lastName);
              $user->set_email($email);
              $user->set_password($saltedHash);
              $user->set_discipline(DisciplineDAO::find_discipline_by_name($discipline_name));
              $tagArray = array();
              for($i = 0; $i < count($tags); $i++){
                  $tagArray[$i] = TagDAO::find_tag_by_name($tags[$i]);
              }
              $user->set_tags($tagArray);
              $user = UserDAO::save($user);
              if(!is_null($user->get_id())){
                //THE NEXT LINE - UPDATING TASK STATUSES IS PUT HERE (AFTER LOGIN) AS UNABLE TO SET UP SCHEDULED EVENTS ON CSIS SERVER
                TaskDAO::update_all_task_statuses();
                $_SESSION["user_id"] = $user->get_id();
                header("location:./profilepage.php");
              }else{
                echo("null");
              }
            }
         }
      }
      require_once __DIR__.'/templates/header.template.php';?>
    <!-- Main PAGE -->
    <div class="container-fluid">
      <div class="col-xs-11 col-sm-8 well">
        <div class="row">
          <h1 class="">Sign Up</h1>
          <br>
         <form  method="post" role="form" data-toggle="validator">
             <noscript>
               <div class="alert alert-warning">
                <p>  <i class="glyphicon glyphicon-alert"></i> Please enable javascript for best user experience</p>
              </div>
            </noscript>

            <div class="col-sm-12">
              <?php echo $feedback; ?>
              <div class="row">
                <div class="col-sm-6 form-group has-feedback">
                  <label for="first_name" class="">First Name <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" placeholder="Enter First Name Here.." maxlength="15" required id="firstName" name="first_name" class="form-control" >
                    <span class="glyphicon form-control-feedback"></span>
                  </div>
                    <span class="help-block with-errors"></span>
                </div>


                <div class="col-sm-6 form-group has-feedback">
                  <label>Last Name <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" placeholder="Enter Last Name Here.." maxlength="30" required id="lastName" name="last_name" class="form-control">
                    <span class="glyphicon form-control-feedback"></span>
                  </div>
                    <span class="help-block with-errors"></span>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6 form-group has-feedback">
                  <label>Email Address <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                    <input type="email" pattern="^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$"
                    placeholder="Enter UL Email Here.." required id="emailForm" name="signup_email"
                           maxlength="127" class="form-control">
                  <span class="glyphicon form-control-feedback"></span>
                  </div>
                  <span class="help-block with-errors"></span>
                </div>

                <div class="col-sm-6 form-group has-feedback">
                  <label>Discipline <em class="text-danger"> *</em>
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
              <div class="row">
                <div class="col-sm-6 form-group has-feedback">
                  <label>Password <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" placeholder="Enter Password Here.." name="pass_one" id="pass1Form" class="form-control"
					               data-minLength="5" data-error="" required/>
					         <span class="glyphicon form-control-feedback"></span>

                  </div>
                  <span class="help-block with-errors"></span>
                </div>


			      <div class="col-sm-6 form-group has-feedback">
                  <label>Confirm Password <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" placeholder="Reenter Password Here..." data-match="#pass1Form" name="pass_two" id="pass2Form" class="form-control"
					               data-minLength="5" required/>
						       <span class="glyphicon form-control-feedback"></span>

				  </div>
          <span class="help-block with-errors"></span>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 col-xs-hidden">
                </div>
                <div class="col-sm-6 form-group has-feedback">
                  <label>Tags <em class="text-danger"> *</em>
                  </label>
                  <button id="tooltip1" type="button" class="btn btn-primary btn-circle"
                  data-toggle="tooltip" data-placement="bottom"
                  data-original-title="Tags are used to identify areas you are interested in.
                  These tags will determine what tasks appear in your feed. Please choose between 1 and 4 tags.">
                    <span class="text-white"> ?</span>
                  </button>

                  <div class="input-group" id="tags">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span></span>
                    <select id="tagsSelect" class="selectpicker" name="tags[]" data-width="75%" multiple
                        data-selected-text-format="count > 1" data-max-options="4">
                    <?php
                      $allDisciplines = DisciplineDAO::find_all_disciplines();

                      foreach($allDisciplines as $aDisc){
                        echo '<optgroup label = "' .$aDisc->get_name() .'">';
                          $availTags = array();
                          $availTags = TagDAO::find_all_tags_in_discipline($aDisc->get_id());
                          foreach($availTags as $aTag){
                            echo'<option>' .$aTag->get_name() .'</option>';
                          }
                        echo '</optgroup>';
                      }  ?>
                    </select>
                  </div>
                  <span class="help-block with-errors"></span>

        				  <noscript>
          				  <div class="input-group" style="width:100%">
          				  <select class="custom-select" name="tags[]" multiple>
          						  <?php
                          $allDisciplines = DisciplineDAO::find_all_disciplines();
                          foreach($allDisciplines as $aDisc){
                            echo '<optgroup label = "' .$aDisc->get_name() .'">';
                              $availTags = array();
                              $availTags = TagDAO::find_all_tags_in_discipline($aDisc->get_id());
                              foreach($availTags as $aTag){
                                echo'<option>' .$aTag->get_name() .'</option>';
                              }

                            echo '</optgroup>';
                          }  ?>
          						</select>
        						</div>
        					</noscript>

                  </div>
                </div>
        			 </div>
              <button type="submit" name="signup_button" class="btn btn-lg btn-success">Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div><br><br>
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
