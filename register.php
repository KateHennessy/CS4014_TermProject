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

          if ($passOne != $passTwo) { //in case Javascript is disabled.
            $feedback = '  <h3 class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <i class="glyphicon glyphicon-alert"></i> Passwords are not the same. </h3> <br /><br />';
			 $uploadFormOK = false;
		  }

           if(count($tags) < 1 || count($tags) > 4){
            $feedback = '  <h3 class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <i class="glyphicon glyphicon-alert"></i> Incorrect number of tags entered. </h3> <br /><br />';
			 $uploadFormOK = false;
		   }

		   //check wheter user/email already exists
          $user = null;
        //  $userDao = new UserDAO();
          $user = UserDAO::getUserByEmail($email);

         if(!is_null($user->get_email())){
            // require_once __DIR__.'/templates/header.template.php';
            $feedback = '  <h3 class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <i class="glyphicon glyphicon-alert"></i> A user already exists with this email. </h3> <br /><br />';
			 $uploadFormOK = false;
		 }

           if(strlen($firstName > 25) || strlen($firstName) == 0 ){
			  $feedback = '  <h3 class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <i class="glyphicon glyphicon-alert"></i> First Name is required. </h3> <br /><br />';
			$uploadFormOK = false;

			}
			if(strlen($lastName > 25) || strlen( $lastName) == 0 ){
			  $feedback = '  <h3 class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <i class="glyphicon glyphicon-alert"></i> Last Name is required. </h3> <br /><br />';
			$uploadFormOK = false;

			}
			if(!preg_match('/^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$/', $email)){
				$feedback = '  <h3 class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <i class="glyphicon glyphicon-alert"></i> Email is required. </h3> <br /><br />';
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
             $banned = UserDAO::find_user_in_banned($user -> get_id());
                 //if(!is_null($banned)){
                 if($banned){
                   $feedback = ' <h3 class="alert alert-danger alert-dismissable">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                   <img class="center-block" src= "http://i3.kym-cdn.com/entries/icons/facebook/000/006/725/desk_flip.jpg" style = "width: 180px; height: 180px;" /><br /> <br />
                   <i class="glyphicon glyphicon-alert"></i> You have been banned for inappropriate content.
                   Contact administration with any issues. </h3> <br /><br />';
                 }else{
                   $_SESSION["user_id"] = $user->get_id();

                  header("location:./profilepage.php");
                }
           }else{
            //  header("location:./register.php");
            $feedback = ' <h3 class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <i class="glyphicon glyphicon-alert"></i> Incorrect email or password. </h3> <br /><br />';
           }



         }else{
          //  echo("nothing");
         }

      }
      // if (!isset($_POST) || count($_POST) == 0) {
          require_once __DIR__.'/templates/header.template.php';?>
          <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script> have put this in logged out header page as needed for login-->

    <!-- Main PAGE -->
    <div class="container-fluid">
      <div class="col-xs-11 col-sm-8 well">
        <div class="row">
          <h1 class="">Sign Up</h1>
          <br>
		  <!--  role="form" data-toggle="validator"-->
			<!--<script><form role="form" data-toggle="validator"></script>-->
				 
         <form novalidate method="post" role="form" data-toggle="validator">
		
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
                    <input type="email" pattern="^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$" placeholder="Enter UL Email Here.." required id="emailForm" name="signup_email"
                           class="form-control">
                  <span class="glyphicon form-control-feedback"></span>
                  </div>
                  <span class="help-block with-errors"></span>
                </div>


                <!-- /^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$/g -->


                <div class="col-sm-6 form-group has-feedback">
                  <label>Discipline <em class="text-danger"> *</em>
                  </label>
                  <div class="input-group"  id="discipline">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                    <select class="selectpicker" name="discipline" multiple data-max-options="1"
                    required="required" data-error="Please choose a discipline" data-width="75%">
                      <option>Computer Science</option>
                      <option>Psychology</option>
                    </select>

                  </div>
                  <span class="help-block with-errors"></span>
				  <noscript>
				  <div class="input-group"><select class="custom-select" name="discipline">
						<option>Computer Science</option>
                      <option>Psychology</option>
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
                    <select class="selectpicker" name="tags[]" data-width="75%" multiple
                    data-selected-text-format="count > 1" data-max-options="4" 
                    required="required">
                      <optgroup label="Computer Science" >
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
                  <span class="help-block with-errors"></span>
				  
				  <noscript>
				  <div class="input-group">
				  <select class="custom-select" name="tags[]" multiple>
						 <optgroup label="Computer Science" >
							 
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
		  
	  <div class="col-sm-1"></div>
		   
					<noscript>
					<div class="col-xs-12 col-sm-3 well">
				<div class="row" >
					 <h1 class="">Log In</h1>
					  <form class="form" role="form" method="post" accept-charset="UTF-8" id="login-nav">
                        <div class="form-group has-feedback">
                          <label class="sr-only" for="email">Email address
                          </label>
                          <input type="email" name ="email" class="form-control" pattern="^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$" id="emailLogin" placeholder="Email address" required>
                          <span class="glyphicon form-control-feedback"></span>
                          <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group has-feedback">
                          <label class="sr-only" for="password">Password
                          </label>
                          <input type="password" name="password" class="form-control" id="passwordLogin" placeholder="Password" required>
                          <span class="glyphicon form-control-feedback"></span>
                            <span class="help-block with-errors"></span>

                          <div class="small text-right">
                            <a href="<?php echo 'forgottenpassword.php'; ?>">Forget your password ?</a>
                          </div>
                         
                        </div>
                        <div class="form-group">
                          <button type="submit" name="login_button" class="btn btn-primary btn-block">Sign in
                          </button>
                        </div>                       
                      </form></noscript>
		  
		  

        </div>
      </div>
    </div>
    <?php  ?>
	

    <?php
    require_once __DIR__.'/templates/footer.php';
    ?>
	
    <script>
	

      $(document).ready(function(){
		  
		 $("#tags").show();
		 
		 $("#discipline").show();
		  
		  
		 
//}
		  

       // $('#multi-select').on('change', function () {
        //  var count = $(this).find("option:selected").length;
       //   if(count > 0 && count <= 4){
       //     successInput(this);
       //   }else{
	//failInput(this);
      //     }
      //  });
        
		//document.getElementById('multi-select').removeAttribute("multiple");;
        // $('#single-select').on('change', function () {
        //   var count = $(this).find("option:selected").length;
        //   if(count == 1){
        //     successInput(this);
        //   }else{
        //     failInput(this);
        //   }
        // });

        // TOOLTIP FOR TAGS
         $('#tooltip1').tooltip();


          //CHECKS ALL INPUTS (WHEN BLURRED) WITHIN FORM ELEMENTS ON PAGE
        // $('form input').blur(function(){
        //   //GETS THE ID OF ELEMENT JUST BLURRED
        //   id = $(this).attr("id");
        //
        //   // IF IT IS ONE OF TE EMAIL ELEMENTS put it through validate email function
        //   if(id.indexOf("email") != -1){
        //    validateEmail(this);
        //   }
        //
        //   // IF WE ARE IN ONE OF THE PASSWORD FIELDS
        //    else if(id.indexOf("pass") != -1){
        //     // IF ITS THE FIRST, CHECK THAT IT MEETS MINIMUM PASSWORD REQUIREMENTS
        //       if(id.indexOf("pass1") != -1){
        //
        //        if( $('#pass1Form').val().length >= 7){
        //          successInput(this);
        //           return true;
        //         }else{
        //           failInput(this);
        //           return false;
        //         }
        //       }
        //       if(id.indexOf("pass2") != -1){
        //         if(validateInput(this)){
        //         var pass = $('#pass1Form').val();
        //         var repass = $('#pass2Form').val();
        //         // passwords are not equal
        //       if(pass == repass){
        //         successInput(this);
        //         return false;
        //       }else{
        //         failInput(this);
        //         return true;
        //       }
        //     }else{
        //       failInput(this);
        //     }
        //     }
        //
        //     else{
        //
        //     }
        //   }
        //   // IF ITS NOT A TAG OR PASSWORD OR EMAIL WE NEED TO CHECK IF IT IS ENTERED
        //   else{
        //     validateInput(this);
        //   }
        // });

        // END OF ONBLUR CHECKING OF FORM
        //
        // function validateTags(element){
        //   id = element.id;
        //   var options =(element).val();
        //   alert(options);
        //   if((options != null && options.length >= 2 && options.length <= 4)){
        //     successInput(element);
        //     return true;
        //   }
        //   return false;
        // }
        //
        // //VERIFYING THAT THERE iS TEXT INPUT IN INPUTS
        // function validateInput(element){
        //   id = element.id;
        //   if(!$(element).val()){
        //     failInput(element);
        //     return false;
        //   }
        //   else {
        //
        //       successInput(element);
        //       return true;
        //   }
        // }
        //
        // function validateEmail(element){
        //   id = element.id;
        //   var email_regex = /^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$/g;
        //   //ul.ie domain
        //   if (!email_regex.test($("#" + id).val())) {
        //     failInput(element);
        //     return false;
        //   }
        //   else {
        //     successInput(element);
        //     return true;
        //   }
        // }
        // function failInput(element){
        //   id = element.id;
        //   var div = $("#" + id).closest("div");
        //   div.removeClass("has-success");
        //   $("#glypcn" + id).remove();
        //   div.addClass("has-error has-feedback");
        //   div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        // }
        //
        // function successInput(element){
        //   id = element.id;
        //   var div = $("#" + id).closest("div");
        //   div.removeClass("has-error");
        //   $("#glypcn" + id).remove();
        //   div.addClass("has-success has-feedback");
        //   div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
        // }

	// 		console.log("test");
  //   $('#reg_form').bootstrapValidator({
  //       // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
  //       feedbackIcons: {
  //           valid: 'glyphicon glyphicon-ok',
  //           invalid: 'glyphicon glyphicon-remove',
  //           validating: 'glyphicon glyphicon-refresh'
  //       },
  //       fields: {
  //           first_name: {
  //               validators: {
  //                       stringLength: {
  //                       min: 5,
  //                   },
  //                       notEmpty: {
  //                       message: 'Please enter your first name'
  //                   }
  //               }
  //           },
   //
  //            last_name: {
  //               validators: {
  //                    stringLength: {
  //                       min: 5,
  //                   },
  //                   notEmpty: {
  //                       message: 'Please enter your last name'
  //                   }
  //               }
  //           },
   //
   //
	//  email: {
  //               validators: {
  //                   notEmpty: {
  //                       message: 'Please enter your UL email address'
  //                   },
  //                   emailAddress: {
  //                       message: 'Please enter your UL address'
  //                   }
  //               }
  //           },
   //
   //
   //
  //           }
  //       })
   //
   //
  //       .on('success.form.bv', function(e) {
  //           $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
  //               $('#reg_form').data('bootstrapValidator').resetForm();
   //
  //           // Prevent form submission
  //           e.preventDefault();
   //
  //           // Get the form instance
  //           var $form = $(e.target);
   //
  //           // Get the BootstrapValidator instance
  //           var bv = $form.data('bootstrapValidator');
   //
  //           // Use Ajax to submit form data
  //           $.post($form.attr('action'), $form.serialize(), function(result) {
  //               console.log(result);
  //           }, 'json');
  //       });
});

 </script>





  </body>
</html>
