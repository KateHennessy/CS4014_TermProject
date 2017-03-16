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
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__.'/templates/usersidebar.php';

    ?>


  <div class="col-md-9 profile-content">
      <div class="" id="overview">
          <div>

<!--Change Password Text -->
  <div class="container-fluid">
      <div class="col-xs-11 col-xs-8 well">
          <div class="row">
              <h1><div class="glyphicon glyphicon-lock"></div> Change Password </h1><br>
              <div class="col-xs-10">
                <p> Please enter your new password here </p>
                  <form>
                      <div class="row">
                          <div class="col-sm-12 form-group">
                              <div><input type="email" onblur="validateEmail()" id="contactEmail" placeholder="Enter New Password Here.." class="form-control"></div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12 form-group">
                              <div><input type="email" onblur="validateEmail()" id="contactEmail" placeholder="Re-Enter New Password Here.." class="form-control"></div>
                          </div>
                      </div>
                  <button type="button" class="btn btn-lg btn-success">Submit</button>
              </form>
      </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<!-- END MENU -->

<!--<script>
$(document).ready(function(){
    $('.tt-query').css('background-color', '#fff');

              //CHECKS ALL INPUTS (WHEN BLURRED) WITHIN FORM ELEMENTS ON PAGE
            $('form input').blur(function(){
              //GETS THE ID OF ELEMENT JUST BLURRED
              id = $(this).attr("id");
              // IF WE ARE IN ONE OF THE PASSWORD FIELDS
              else if(id.indexOf("pass") != -1){
                // IF ITS THE FIRST, CHECK THAT IT MEETS MINIMUM PASSWORD REQUIREMENTS
                  if(id.indexOf("pass1") != -1){

                    if( $('#pass1Form').val().length >= 7){
                      successInput(this);
                      return true;
                    }else{
                      failInput(this);
                      return false;
                    }
                  }
                  if(id.indexOf("pass2") != -1){
                    if(validateInput(this)){
                    var pass = $('#pass1Form').val();
                    var repass = $('#pass2Form').val();
                    // passwords are not equal
                  if(pass == repass){
                    successInput(this);
                    return false;
                  }else{
                    failInput(this);
                    return true;
                  }
                }else{
                  failInput(this);
                }

                }

                else{

                }
              }
              // IF ITS NOT A TAG OR PASSWORD OR EMAIL WE NEED TO CHECK IF IT IS ENTERED
              else{
                validateInput(this);
              }
            });
            // END OF ONBLUR CHECKING OF FORM

            // VERIFYING THAT THERE iS TEXT INPUT IN INPUTS
            function validateInput(element){
              id = element.id;
              if(!$(element).val()){
                failInput(element);
                return false;
              }
              else {

                  successInput(element);
                  return true;

              }
            }
            function failInput(element){
              id = element.id;
              var div = $("#" + id).closest("div");
              div.removeClass("has-success");
              $("#glypcn" + id).remove();
              div.addClass("has-error has-feedback");
              div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
            }

            function successInput(element){
              id = element.id;
              var div = $("#" + id).closest("div");
              div.removeClass("has-error");
              $("#glypcn" + id).remove();
              div.addClass("has-success has-feedback");
              div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
            }
          });
        </script> -->

        <?php
        require_once __DIR__.'/templates/footer.php';
        ?>


</body>
</html>
