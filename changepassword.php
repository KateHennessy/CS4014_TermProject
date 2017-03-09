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
                    <li><a href="aboutus.php">About Us</a></li>

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
                              <li><a href="profilepage.php">My Profile</a></li>
                              <li><a href="#">My Tasks</a></li>
                              <li><a href="information.php">Information</a></li>
                              <li><a href="changepassword.php">Change Password</a></li>
                                <div class="form-group">
                                    <input type="button" value="Log Out" class="btn-primary btn-block btn" onclick="window.location.href='index.html'">
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
            <li><a href="#"><i class="glyphicon glyphicon-home"></i> Overview </a></li>
            <li class="active"><a href="#"><i class="glyphicon glyphicon-user"></i> Change Password </a></li>
            <li><a href="detailedtask.html" target="_blank"><i class="glyphicon glyphicon-ok"></i> Tasks </a></li>
            <li><a href="#" target="_blank"><i class="glyphicon glyphicon-ok"></i> Claimed Tasks </a> </li>
            <li><a href="information.html"><i class="glyphicon glyphicon-flag"></i> Information </a></li>
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

</body>
</html>
