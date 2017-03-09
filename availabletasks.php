<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- ONLINE BOOTSTRAP FILES -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <!-- LOCAL BOOTSTRAP FILES  -->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <script src="bootstrap/bootstrap.js"></script>

    <!-- Custom CSS FILES -->
    <link rel="stylesheet" href="css/style.css">
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
                <form>
                    <!--Menu bar on right hand side of nav bar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Menu</b> <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">

                                <li><a href="<?php echo 'profilepage.php'; ?>">My Profile</a></li>
                                <li><a href="<?php echo 'detailedtask.php'; ?>">My Tasks</a></li>
                                <li><a href="<?php echo 'information.php'; ?>">Information</a></li>
                                <li><a href="<?php echo 'changepassword.php'; ?>">Account Settings</a></li>
                                <div class="form-group">
                                    <input type="button" value="Log Out" class="btn-primary btn-block btn" onclick="window.location.href='index.html'">
                                </div>
                            </ul>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
        <!-- /.navbar-collapse -->

        <!-- /.container-fluid -->
    </nav>


    <!-- User Side Bar -->
    <div class="container-fluid">
        <div class="col-xs-12 well">
            <!-- <div class="row profile"> -->
                <div class="col-md-3 adapt">
                    <div class="profile-sidebar">

                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">Marcus Doe</div>
                            <div class="profile-usertitle-job">General User</div>
                        </div>

                        <!-- END SIDEBAR USER TITLE -->

                        <!-- USER REPUTATION -->

                        <div class="text text-center">
                            <label class="text-muted"><i class="glyphicon glyphicon-star"></i><var>21</var> Reputation Score</label>
                        </div>

                        <!-- END USER REPUTATION -->

                        <!-- Start User Tags -->


                        <div class="text text-center">

                            <label class="text-muted">  <i class="glyphicon glyphicon-tags"></i>  <var>4</var> Total Number of Tasks Uploaded</label>
                        </div>




                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li><a href="<?php echo 'profilepage.php'; ?>"><i class="glyphicon glyphicon-home"></i> Overview </a></li>
                                <li><a href="<?php echo 'changepassword.php'; ?>"><i class="glyphicon glyphicon-user"></i> Account Settings </a></li>
                                <li><a href="<?php echo 'detailedtask.php'; ?>"><i class="glyphicon glyphicon-check"></i> Tasks </a></li>
                                <li><a href="#" target="_blank"><i class="glyphicon glyphicon-ok"></i> Claimed Tasks </a> </li>
                                <li><a href="<?php echo 'uploadedtask.php'; ?>"><i class="glyphicon glyphicon-share"></i> Upload a Task</a> </li>
                                <li class="active"><a href="<?php echo 'availabletasks.php'; ?>"><i class="glyphicon glyphicon-search"></i>Available Tasks </a> </li>
                                <li><a href="<?php echo 'information.php'; ?>"><i class="glyphicon glyphicon-flag"></i> Information </a></li>
                            </ul>
                        </div>

                        <!-- END MENU -->
                    </div>
                </div>
              <!-- </div> -->

              <!-- <div class="row profile"> -->
                <div class="col-md-9 profile-content">
                    <div class="" id="overview">
                        <div class="">
                            <!-- <div class="container-fluid" >
                                <div class="col-xs-12"> -->

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h2>Available Tasks</h2>
                                            <p>These tasks were chosen based on your
                                                <a href="ProfilePage.html#overview">selected tags.</a></p>
                                        </div>
                                    </div>
                                    <br />

                                    <!-- Begin Task1-->
                                    <div class="col-xs-12 fixedMax">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <a class="pull-left" href="detailedtask.html" target="_parent">
                                                            <!-- </a> -->
                                                            <h4><div class="glyphicon glyphicon-edit"></div>The Study of Monkeys</h4></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="pull-left col-sm-6">

                                                        <i class="glyphicon glyphicon-file pull-left text-primary"></i>
                                                        <p class="text-muted"><small class="pull-left">Type: <span class="text-primary">Assignment</span></small><br>
                                                            <i class="glyphicon glyphicon-calendar pull-left text-primary"></i>
                                                            <small class="pull-left"> Claim Before: <span class="text-primary">8/03/2017</span></small><br>
                                                            <i class="glyphicon glyphicon-hourglass pull-left text-primary"></i>
                                                            <small class="pull-left">  Due Date: <span class="text-primary"> 24/03/2017</span></small><br>
                                                            <i class="glyphicon glyphicon-duplicate pull-left text-primary"></i>
                                                            <small class="pull-left">Page Count: <span class="text-primary">15</span></small><br>
                                                            <i class="glyphicon glyphicon-stats pull-left text-primary"></i>
                                                            <small class="pull-left">Word Count: <span class="text-primary">7500</span></small><br></p>
                                                    </div>

                                                    <div class="divider pull-right hidden-xs col-sm-6 scroll">
                                                        <p class="hidden-xs fixedBodyLarge scroll">A study on the native habitat and behvaiour of monkeys. </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End Task1-->

                                    <!-- Begin Task2-->
                                    <div class="col-xs-12 fixedMax">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <a class="pull-left" href="detailedtask.html" target="_parent">
                                                            <!-- </a> -->
                                                            <h4><div class="glyphicon glyphicon-edit"></div>Methods in Empirical Psychology</h4></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="pull-left col-sm-6">

                                                        <i class="glyphicon glyphicon-file pull-left text-primary"></i>
                                                        <p class="text-muted"><small class="pull-left">Type: <span class="text-primary">PhD Thesis</span></small><br>
                                                            <i class="glyphicon glyphicon-calendar pull-left text-primary"></i>
                                                            <small class="pull-left"> Claim Before: <span class="text-primary">10/03/2017</span></small><br>
                                                            <i class="glyphicon glyphicon-hourglass pull-left text-primary"></i>
                                                            <small class="pull-left">  Due Date: <span class="text-primary"> 01/04/2017</span></small><br>
                                                            <i class="glyphicon glyphicon-duplicate pull-left text-primary"></i>
                                                            <small class="pull-left">Page Count: <span class="text-primary">35</span></small><br>
                                                            <i class="glyphicon glyphicon-stats pull-left text-primary"></i>
                                                            <small class="pull-left">Word Count: <span class="text-primary">18000</span></small><br></p>
                                                    </div>

                                                        <div class="divider pull-right hidden-xs col-sm-6 smallfixed">

                                                            <p class="hidden-xs fixedBodyLarge scroll">A study investigating the best methods for carrying out psychological research by testing both qualitative and quantative approaches. A study investigating the best methods for carrying out psychological
                                                                research by testing both qualitative and quantative approaches. A study investigating the best methods for carrying out psychological research by testing both qualitative and quantative approaches.</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End Task2-->

                                    <ul class="pagination">
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                    </ul>




                                <!-- </div>
                            </div> -->
                        </div>



                    </div>
                </div>

            <!-- </div> -->
            <!-- End Col -->
        </div>
        <!-- </div> -->

        <!-- <center>
        <strong>Powered by <a href="http://j.mp/metronictheme" target="_blank">KeenThemes</a></strong>
    </center> -->
        <br>
        <br>
    </div>

</body>

</html>

<!--User Profile Sidebar by @keenthemes
    A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
    Licensed under MIT
    -->
