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
                                </li>
                            </ul>
                        </li>
                    </ul>
                </form>

                <!-- <div class="bottom text-center">
                                        New here ? <a href="#"><b>Join Us</b></a>
                                    </div> Not neccessary here-->
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </nav>


    <!-- User Side Bar -->
    <div class="container-fluid">
        <div class="col-xs-12 well">
          <!--  <div class="row profile"> -->
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
                                <li><a href="<?php echo 'changepassword.php'; ?>"><i class="glyphicon glyphicon-user"></i> Account Settings </a></li>
                                <li class="active"><a href="<?php echo 'detailedtask.php'; ?>"><i class="glyphicon glyphicon-check"></i> Tasks </a></li>
                                <li><a href="#" target="_blank"><i class="glyphicon glyphicon-ok"></i> Claimed Tasks </a> </li>
                                <li><a href="<?php echo 'uploadedtask.php'; ?>"><i class="glyphicon glyphicon-share"></i> Upload a Task</a> </li>
                                <li><a href="<?php echo 'availabletasks.php'; ?>"><i class="glyphicon glyphicon-search"></i>Available Tasks </a> </li>
                                <li><a href="<?php echo 'information.php'; ?>"><i class="glyphicon glyphicon-flag"></i> Information </a></li>
                            </ul>
                        </div>

                        <!--end menu-->
                    </div>
                </div>

                <div class="col-md-9 profile-content">
                    <div class="" id="overview">
                        <div class="">
                <!--<div class="col-md-9">
                    <div class="profile-content" id="overview">
                        <div class="profile-content">
                            <div class="container-fluid" style="background-color:#e8e8e8">
                                <div class="col-xs-12"> -->

                                    <div class="row">
                                        <div class="col-sm-6 col-md-12">
                                            <h2>Methods in Empirical Pyschology</h2>
                                        </div>
                                    </div>
                                    <br />

                                    <!--detailed task starts -->
                                    <!--<div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Methods in Empirical Pyschology</h3>
            </div>
            <div class="panel-body">
              <div class="row"> -->


                                    <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                                    <div class=" col-sm-6 col-md-12 ">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <td>Task Type:</td>
                                                    <td>PhD Thesis</td>
                                                </tr>
                                                <tr>
                                                    <td>Brief Description:</td>
                                                    <td>A study investigating the best methods for carrying out psychological research by testing both qualitative and quantative approaches.</td>
                                                </tr>
                                                <tr>
                                                    <td>Tags:</td>
                                                    <td>Empricial Psychology, Research, Experiments</td>
                                                </tr>

                                                <tr>
                                                    <tr>
                                                        <td>Number of Pages:</td>
                                                        <td>35</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Number of Words:</td>
                                                        <td>18000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Document Type:</td>
                                                        <td>.docx</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Preview</td>
                                                        <td><a href="">Click Here For Preview</a></td>
                                                    </tr>
                                                </tr>

                                            </tbody>
                                        </table>

                                        <!--  <a href="#" class="btn btn-primary">My Sales Performance</a>
                  <a href="#" class="btn btn-primary">Team Sales Performance</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <!--<a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i> Message To Claim Task</a> -->
                                <span class="pull-right">
                            <!--<a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a> -->
                            <a data-original-title="Claim" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-check"></i>Claim Task</a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-flag"></i> Flag Task</a>
                        </span>
                        <br />

                                <!--</div> -->
                                <!--End of detailed task section-->

                                <!--</div> -->

                                <!-- Contact Me Section -->
                                <div>
                                    <h2>Message To Claim Task</h2>
                                </div>

                                <!-- <div class="container"> -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="well well-sm">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name" placeholder="Enter name" required="required" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">My Email Address</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                                                <input type="email" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Message</label>
                                                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required" placeholder="Message"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <!--<button type="submit" class="btn  pull-right" id="btnContactUs"> Send Message</button> -->
                                                        <a data-original-title="Submit" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary pull-right"><i class="glyphicon glyphicon-envelope"></i>Send Message</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
