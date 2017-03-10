<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- JAVASCRIPT FOR AUTOCOMPLETE -->
    <!-- <script src="https://raw.githubusercontent.com/bassjobsen/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.min.js" /></script> -->
    <script src="js/typeahead.js"> </script>
    <!-- JQUERY UI FOR TAGS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>

    <!-- ONLINE BOOTSTRAP FILES -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <!-- LOCAL BOOTSTRAP FILES  -->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <script src="bootstrap/bootstrap.js"></script>

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
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
                <a class="navbar-brand" href="#">RevIUL</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!--   <li class="active"> - used to highlight current tab in menu bar -->
                    <li><a href="<?php echo 'aboutus.php'; ?>">About Us</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form> -->
                <form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Menu</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                              <li><a href="<?php echo 'profilepage.php'; ?>">My Profile</a></li>
                              <li><a href="<?php echo 'detailedtask.php'; ?>">My Tasks</a></li>
                              <li><a href="<?php echo 'information.php'; ?>">Information</a></li>
                              <li><a href="<?php echo 'changepassword.php'; ?>">Account Settings</a></li>
                                <div class="form-group">
                                    <input type="button" value="Log Out" class="btn-primary btn-block btn" onclick="window.location.href="<?php echo 'information.php'; ?>">
                                </div>
                              </ul>
                          </li>
                      </ul>
                  </form>

            <!-- <div class="bottom text-center">
                                        New here ? <a href="#"><b>Join Us</b></a>
                                    </div> Not neccessary here-->
        <!-- /.navbar-collapse -->
        </div>
      </div>
        <!-- /.container-fluid -->
    </nav>


<!-- User Side Bar -->
    <div class="container-fluid">
    <div class="col-xs-12 well">
    <!--<div class="row profile"> -->
    <div class="col-md-3 adapt">
    <div class="profile-sidebar">

<!-- SIDEBAR USER TITLE -->
    <div class="profile-usertitle">
    <div class="profile-usertitle-name">Marcus Doe</div>
    <div class="profile-usertitle-job">General User</div>
    </div>

<!-- END SIDEBAR USER TITLE -->

<!-- SIDEBAR MENU -->
    <div class="profile-usermenu">
        <ul class="nav">
            <li><a href="<?php echo 'profilepage.php'; ?>"><i class="glyphicon glyphicon-home"></i> Overview </a></li>
            <li class="active"><a href="<?php echo 'changepassword.php'; ?>"><i class="glyphicon glyphicon-user"></i> Account Settings </a></li>
            <li><a href="<?php echo 'detailedtask.php'; ?>"><i class="glyphicon glyphicon-check"></i> Tasks </a></li>
            <li><a href="<?php echo 'detailedtask.php'; ?>"><i class="glyphicon glyphicon-ok"></i> Claimed Tasks </a> </li>
            <li><a href="<?php echo 'uploadedtask.php'; ?>"><i class="glyphicon glyphicon-share"></i> Upload a Task</a> </li>
            <li><a href="<?php echo 'availabletasks.php'; ?>"><i class="glyphicon glyphicon-search"></i>Available Tasks </a> </li>
            <li><a href="<?php echo 'information.php'; ?>"><i class="glyphicon glyphicon-flag"></i> Information </a></li>
        </ul>
    </div>
<!-- END MENU -->
  </div>
  </div>
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


</body>
</html>
