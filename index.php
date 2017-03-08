<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bootstrap Example
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>
    <!-- JAVASCRIPT FOR AUTOCOMPLETE -->
    <!-- <script src="https://raw.githubusercontent.com/bassjobsen/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.min.js" /></script> -->
    <script src="js/typeahead.js"> </script>
    <!-- JQUERY UI FOR TAGS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js">
    </script>
    <!-- ONLINE BOOTSTRAP FILES -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>
    <!-- LOCAL BOOTSTRAP FILES  -->
    <!-- <link rel="stylesheet" href="bootstrap/bootstrap.css">
<script src="bootstrap/bootstrap.js"></script> -->
    <!-- Custom CSS FILES -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/typeahead.css">
  </head>
  <body>
    <!-- NAV BAR -->
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
      <div class="container-fluid background-image">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
          </button>
          <a class="navbar-brand" href="#">RevIUL
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <!--   <li class="active"> - used to highlight current tab in menu bar -->
            <li>
              <a href="AboutUs.html">About Us
              </a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <p class="navbar-text">Already have an account?
              </p>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <b>Login
                </b>
                <span class="caret">
                </span>
              </a>
              <ul id="login-dp" class="dropdown-menu">
                <li>
                  <div class="row">
                    <div class="col-md-12">
                      <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputEmail2">Email address
                          </label>
                          <input type="email" class="form-control" id="emailLogin" placeholder="Email address" required>
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2">Password
                          </label>
                          <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                          <div class="help-block text-right">
                            <a href="ForgottenPassword.html">Forget your password ?
                            </a>
                          </div>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block">Sign in
                          </button>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"> keep me logged-in
                          </label>
                        </div>
                      </form>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    <!-- Main PAGE -->
    <div class="container-fluid">
      <div class="col-xs-11 col-sm-8 well">
        <div class="row">
          <h1 class="">Sign Up
          </h1>
          <br>
          <form>
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-6 form-group">
                  <label>First Name <em class="text-danger"> *</em>
                  </label>
                  <div>
                    <input type="text" placeholder="Enter First Name Here.." id="firstName" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 form-group">
                  <label>Last Name <em class="text-danger"> *</em>
                  </label>
                  <div>
                    <input type="text" placeholder="Enter Last Name Here.." id="lastName" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 form-group">
                  <label>Email Address <em class="text-danger"> *</em>
                  </label>
                  <div>
                    <input type="email" placeholder="Enter Discipline Here.." id="emailForm"
                           class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 form-group">
                  <label>Discipline <em class="text-danger"> *</em>
                  </label>
                  <div>
                    <input type="text" placeholder="Enter Discipline Here.." id="discipline" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 form-group">
                  <label>Password <em class="text-danger"> *</em>
                  </label>
                  <div>
                    <input type="password" placeholder="Enter Password Here.." id="pass1Form" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 form-group">
                  <label>Confirm Password <em class="text-danger"> *</em>
                  </label>
                  <div>
                    <input type="password" placeholder="Reenter Password Here..." id="pass2Form" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 form-group">
                  <label>Tag 1 <em class="text-danger"> *</em>
                  </label>
                  <!-- <input class="form-control autocomplete" placeholder="Tag 1" /> -->
                  <div>
                    <input class="form-control" name="tag1" id="tag1" placeholder="Enter 1st Tag..." type="text">
                  </div>
                </div>
                <div class="col-sm-6 form-group">
                  <label>Tag 2
                  </label>
                  <!-- <input class="form-control autocomplete" placeholder="Tag 1" /> -->
                  <input class="form-control" name="tag2" id="tag2" placeholder="Enter 2nd Tag..." type="text">
                </div>
                <div class="col-sm-6 form-group">
                  <label>Tag 3
                  </label>
                  <!-- <input class="form-control autocomplete" placeholder="Tag 1" /> -->
                  <input class="form-control" name="tag3" id="tag3" placeholder="Enter 3rd Tag..." type="text">
                </div>
                <div class="col-sm-6 form-group">
                  <label>Tag 4
                  </label>
                  <!-- <input class="form-control autocomplete" placeholder="Tag 1" /> -->
                  <input class="form-control" name="tag4" id="tag4" placeholder="Enter 4th Tag..." type="text">
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-lg btn-success">Submit
            </button>
          </form>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function(){
        // FUNCTION TO PROVIDE AUTO COMPLETE FOR TAGS
        $('[id^=tag]').typeahead({
          //[id^=tag] -- anything starting with 'tag'
          // $('tag1').typeahead({
          local: ['Performing Arts', 'Visual Arts', 'Geography', 'History', 'Languages',
                  'Literature', 'Philosophy', 'Economics', 'Law', 'Political Science', 'Psychology',
                  'Sociology', 'Biology', 'Chemistry', 'Earth and Space Sciences', 'Mathematics',
                  'Physics', 'Agricultural Sciences', 'Computer Science', 'Engineering and Technology',
                  'Medicine and Health Sciences'
                 ]
        }
                                );
        $('.tt-query').css('background-color', '#fff');
        // END OF TAG code

          //CHECKS ALL INPUTS (WHEN BLURRED) WITHIN FORM ELEMENTS ON PAGE
        $('form input').blur(function(){
          //GETS THE ID OF ELEMENT JUST BLURRED
          id = $(this).attr("id");


          // IF IT IS ONE OF TE EMAIL ELEMENTS put it through validate email function
          if(id.indexOf("email") != -1){
            validateEmail(this);
          }
          // IF IT IS HAS A TAG ID, ONLY VALIDATE IF tag1 (the rest are optional)
          else if(id.indexOf("tag") != -1){
            if(id.indexOf("tag1") != -1){
              validateInput(this);
            }
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
  </body>
</html>
