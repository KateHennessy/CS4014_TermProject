
<?php
    session_start();
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__.'/models/Discipline.class.php';
    require_once __DIR__.'/daos/DisciplineDAO.class.php';
    require_once __DIR__.'/daos/TagDAO.class.php';
    require_once __DIR__.'/daos/UserDAO.class.php';



      if (isset($_POST) && count ($_POST) > 0) {

        if(isset($POST["signup_button"])){

          $firstName = htmlspecialchars(ucfirst(trim($_POST["first_name"])));
          $lastName = htmlspecialchars(ucfirst(trim($_POST["last_name"])));
          $email = trim(strtolower($_POST["email"]));
          $passOne = $_POST["pass_one"];
          $passTwo = $_POST["pass_two"];
          $discipline_name = $_POST["discipline"];
          $tags= $_POST["tags"];
          //check wheter user/email alerady exists
          if ($passOne != $passTwo) { //in case Javascript is disabled.
              printf("<h2> Passwords do not match. </h2>");
          }else if(count($tags) < 1 || count($tags) > 4){
            printf("<h2> Incorrect number of tags entered. </h2>");
          $user = new User();
          $userDao = new UserDAO();
          $user = $userDao->getUserByEmail($email);
        } else if(isset($user)){
            require_once __DIR__.'/templates/header.template.php';
            echo('<div class="container-fluid">
                    <div class="col-xs-11 col-sm-8 well">
                      <h2> A user already exists with this email</h2>
                      <br />
                      Please login or click back to try register again. <br /><br />
                        <a href = "logout.php"><button class="btn btn-success"> Back </button></a>
                    </div>
                  </div>

                  </div>');
          }else{

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
                    $_SESSION["user_id"] = $user->get_id();
                    header("location:./profilepage.php");
                  }else{
                    echo("null");
                  }
              }
         }else if(isset($_POST["login_button"])){
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

         }else{
           echo("nothing");
         }

      }
            if (!isset($_POST) || count($_POST) == 0) {
                require_once __DIR__.'/templates/header.template.php';?>

    <!-- Main PAGE -->
    <div class="container-fluid">
      <div class="col-xs-11 col-sm-8 well">
        <div class="row">
          <h1 class="">Sign Up</h1>
          <br>
          <form method="post">
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-6 form-group">
                  <label>First Name <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" placeholder="Enter First Name Here.." id="firstName" name="first_name" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 form-group">
                  <label>Last Name <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" placeholder="Enter Last Name Here.." id="lastName" name="last_name" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 form-group">
                  <label>Email Address <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                    <input type="email" placeholder="Enter UL Email Here.." id="emailForm" name="email"
                           class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 form-group">
                  <label>Discipline <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                    <select class="selectpicker" name="discipline" id="single-select" multiple data-max-options="1"
                    required="required" data-width="75%">
                      <option>Computer Science</option>
                      <option>Psychology</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 form-group">
                  <label>Password <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" placeholder="Enter Password Here.." name="pass_one" id="pass1Form" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 form-group">
                  <label>Confirm Password <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" placeholder="Reenter Password Here..." name="pass_two" id="pass2Form" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 form-group">
                  <label>Tags <em class="text-danger"> *</em>
                  </label>
                  <button id="tooltip1" type="button" class="btn btn-primary btn-circle"
                  data-toggle="tooltip" data-placement="bottom"
                  data-original-title="Tags are used to identify areas you are interested in.
                  These tags will determine what tasks appear in your feed. Please choose between 1 and 4 tags.">
                    <span class="text-white"> ?</span>
                  </button>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span></span>
                    <select class="selectpicker" id="multi-select" name="tags[]" data-width="75%" multiple
                    data-selected-text-format="count > 1" data-max-options="4"
                    required="required">
                      <optgroup label="Computer Science">
                        <option>Graphics</option>
                        <option>Artificial Intelligence</option>
                        <option>Computer Architecture & Engineering</option>
                        <option>Biosystems & Computational Biology</option>
                        <option>Human-Computer Interaction</option>
                        <option>Operating Systems & Networking</option>
                        <option>Programming Systems</option>
                        <option>Scientific Computing</option>
                        <option>Security</option>
                        <option>Theory</option>
                    </optgroup>
                    <optgroup label="Psychology">
                      <option>Abnormal Psychology</option>
                      <option>Behavioral Psychology</option>
                      <option>Biopsychology</option>
                      <option>Cognitive Psychology</option>
                      <option>Comparative Psychology</option>
                      <option>Cross-Cultural Psychology</option>
                      <option>Developmental Psychology</option>
                      <option>Educational Psychology</option>
                      <option>Experimental Psychology</option>
                    </optgroup>
                  </select>


                  </div>
                </div>

              </div>
            </div>
            <button type="submit" name="signup_button" class="btn btn-lg btn-success">Submit
            </button>
          </form>
            <?php } ?>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function(){

        $('#multi-select').on('change', function () {
          var count = $(this).find("option:selected").length;
          if(count > 0 && count <= 4){
            successInput(this);
          }else{
            failInput(this);
          }
        });

        $('#single-select').on('change', function () {
          var count = $(this).find("option:selected").length;
          if(count == 1){
            successInput(this);
          }else{
            failInput(this);
          }
        });

        // TOOLTIP FOR TAGS
         $('#tooltip1').tooltip();

          //CHECKS ALL INPUTS (WHEN BLURRED) WITHIN FORM ELEMENTS ON PAGE
        $('form input').blur(function(){
          //GETS THE ID OF ELEMENT JUST BLURRED
          id = $(this).attr("id");

          // IF IT IS ONE OF TE EMAIL ELEMENTS put it through validate email function
          if(id.indexOf("email") != -1){
            validateEmail(this);
          }

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

        function validateTags(element){
          id = element.id;
          var options =(element).val();
          alert(options);
          if((options != null && options.length >= 2 && options.length <= 4)){
            successInput(element);
            return true;
          }
          return false;
        }
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
        function validateEmail(element){
          id = element.id;
          var email_regex = /^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$/g;
          //ul.ie domain
          if (!email_regex.test($("#" + id).val())) {
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
    </script>

  //  <?php
    //require_once __DIR__.'/templates/footer.php';
  //  ?>

  </body>
</html>
