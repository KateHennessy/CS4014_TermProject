<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                                    <!-- <button type="submit" class="btn btn-primary btn-block">Log Out</button> -->
                                    <input type="button" value="Log Out" class="btn-primary btn-block btn" onclick="window.location.href='index.html'">
                                </div>

                                <!-- <div class="bottom text-center">
                                        New here ? <a href="#"><b>Join Us</b></a>
                                    </div> Not neccessary here-->
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
          <!--  <div class="row profile"> -->
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

                        <!-- Start User Tasks -->


                        <div class="text text-center">

                            <label class="text-muted">  <i class="glyphicon glyphicon-tags"></i>  <var>4</var> Total Number of Tasks Uploaded</label>
                        </div>




                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li class="active"><a href="<?php echo 'profilepage.php'; ?>"><i class="glyphicon glyphicon-home"></i> Overview </a></li>
                                <li><a href="<?php echo 'changepassword.php'; ?>"><i class="glyphicon glyphicon-user"></i> Account Settings </a></li>
                                <li><a href="<?php echo 'detailedtask.php'; ?>"><i class="glyphicon glyphicon-check"></i> Tasks </a></li>
                                <li><a href="#" target="_blank"><i class="glyphicon glyphicon-ok"></i> Claimed Tasks </a> </li>
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
                        <div class="">

                <!-- <div class="col-md-9">
                    <div class="profile-content" id="overview">
                        <div class="profile-content">
                            <div class="container-fluid" style="background-color:#e8e8e8">
                                <div class="col-xs-12"> -->

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h2> My Tasks Overview</h2>
                                            <p>A snippet of information on tasks I have uploaded</p>
                                        </div>
                                    </div>
                                    <br />

                                    <!-- <div class="row"> -->
                                    <!-- Begin Task1-->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading fixed">
                                                <div class="row">
                                                    <div class="col-sm-8 col-xs-12">
                                                        <a class="pull-left" href="detailedtask.html" target="_parent">

                                                            <!-- </a> -->
                                                            <h4><div class="glyphicon glyphicon-edit"></div>The Study of Monkeys</h4></a>
                                                    </div>
                                                    <div class="pull-right hidden-xs col-sm-4">
                                                        <h4><small class="pull-right">Assignment</small></h4>
                                                    </div>
                                                </div>
                                                <ul class="list-inline">
                                                    <li>PDF</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>5 Pages</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>2000 Words</li>
                                                </ul>
                                                <p class="hidden-xs fixedBody">A study on the native habibtat and behvaiour of monkeys. </p>
                                                <div><label for="danger" class="btn btn-danger">Not Claimed</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Task1-->

                                    <!-- Begin Task2-->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading fixed">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-8">
                                                        <a class="pull-left" href="detailedtask.html" target="_parent">
                                                            <h4><div class="glyphicon glyphicon-edit"></div>Methods in Empirical Psychology</h4>
                                                        </a>
                                                    </div>
                                                    <div class="pull-right hidden-xs col-sm-4">
                                                        <h4><small class="pull-right">PhD Thesis</small></h4>
                                                    </div>
                                                </div>
                                                <ul class="list-inline">
                                                    <li>Docx</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>18000 Words</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>35 Pages</li>
                                                </ul>
                                                <p class="hidden-xs fixedBody"> A study investigating the best methods for carrying out psychological research by testing both qualitative and quantative approaches.</p>
                                                <div><label for="warning" class="btn btn-warning">In Progress</label></div>
                                                <br />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Task2-->


                                    <!-- Begin Task3-->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading fixed">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-8">
                                                        <a class="pull-left" href="detailedtask.html" target="_parent">
                                                            <h4><div class="glyphicon glyphicon-edit"></div>Software Development Paradigms</h4>
                                                        </a>
                                                    </div>
                                                    <div class="pull-right hidden-xs col-sm-4">
                                                        <h4><small class="pull-right">Master's Assignment</small></h4>
                                                    </div>
                                                </div>
                                                <ul class="list-inline">
                                                    <li>PDF</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>5000 Words</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>20 Pages</li>
                                                </ul>
                                                <p class="hidden-xs  fixedBody">An investigation of the best method to develop software in specific contexts</p>
                                                <div><label for="Success" class="btn btn-success">Completed</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <!-- End Task3-->

                                    <!-- Begin Task4-->
                                    <!-- <div class="row"> -->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading fixed">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-8">
                                                        <a class="pull-left" href="detailedtask.html" target="_parent">
                                                            <h4><div class="glyphicon glyphicon-edit"></div>Social Issues</h4>
                                                        </a>
                                                    </div>
                                                    <div class="pull-right hidden-xs col-sm-4">
                                                        <h4><small class="pull-right">Assignment</small></h4>
                                                    </div>
                                                </div>
                                                <ul class="list-inline">
                                                    <li>Word Document</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>1000 Words</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>7 Pages</li>
                                                </ul>
                                                <p class="hidden-xs fixedBody">A brief overview of social issues we face today</p>
                                                <div><label for="danger" class="btn btn-danger">Not Claimed</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div> -->

                                    <!-- End Task4-->


                                    <br />

                                    <!-- Reputation Section-->
                                    <!-- <div class="row">
                                        <div class="col-sm-4 pull-left">
                                            <div class="hero-widget well well-sm">
                                                <div class="icon">
                                                    <i class="glyphicon glyphicon-star"></i>
                                                </div>
                                                <div class="text">
                                                    <var>21</var>
                                                    <label class="text-muted">Reputation Score</label>
                                                </div>
                                            </div>
                                        </div> -->
                                    <!-- <div class="col-sm-4 pull-right">
                                            <div class="hero-widget well well-sm">
                                                <div class="icon">
                                                    <i class="glyphicon glyphicon-tags"></i>
                                                </div>
                                                <div class="text">
                                                    <var>4</var>
                                                    <label class="text-muted">Total Number of Tasks Uploaded</label>
                                                </div>
                                            </div>
                                        </div> -->

                                    <!-- Contact Me Section -->
                                    <!--  <div>
                                <h2>Contact Me</h2>
                            </div> -->

                                    <!-- <div class="container"> -->
                                    <!--   <div class="row">
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
                                                    <button type="submit" class="btn btn-primary pull-right" id="btnContactUs"> Send Message</button>
                                                </div>
                                            </div>
                                        </form>
                                      </div>-->

                                    <!--Claimed Tasks -->
                                    <div class="row">
                                        <div class="col-sm-6 col-md-12">
                                            <h2> My  Claimed Tasks Overview</h2>
                                            <p>A snippet of information on tasks I have claimed</p>
                                        </div>
                                    </div>
                                    <br />
                                    <!-- Begin Task1-->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading fixed">
                                                <div class="row">
                                                    <div class="col-sm-8 col-xs-12">
                                                        <a class="pull-left" href="detailedtask.html" target="_parent">

                                                            <!-- </a> -->
                                                            <h4><div class="glyphicon glyphicon-edit"></div>The Study of Pineapples</h4></a>
                                                    </div>
                                                    <div class="pull-right hidden-xs col-sm-4">
                                                        <h4><small class="pull-right">Assignment</small></h4>
                                                    </div>
                                                </div>
                                                <ul class="list-inline">
                                                    <li>PDF</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>10 Pages</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>7000 Words</li>
                                                </ul>
                                                <p class="hidden-xs fixedBody">A study on the groweing habitats of pineapples </p>
                                                <div><label for="Success" class="btn btn-success">Completed</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Task1-->

                                    <!-- Begin Task2-->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading fixed">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-8">
                                                        <a class="pull-left" href="detailedtask.html" target="_parent">
                                                            <h4><div class="glyphicon glyphicon-edit"></div>Are Video Games Bad?</h4>
                                                        </a>
                                                    </div>
                                                    <div class="pull-right hidden-xs col-sm-4">
                                                        <h4><small class="pull-right">PhD Thesis</small></h4>
                                                    </div>
                                                </div>
                                                <ul class="list-inline">
                                                    <li>Docx</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>35000 Words</li>
                                                    <li style="list-style: none">|</li>
                                                    <li>100 Pages</li>
                                                </ul>
                                                <p class="hidden-xs fixedBody"> A study investigating the side effects of violent video games on children</p>
                                                <div><label for="Warning" class="btn btn-warning">In Progress</label></div>
                                                <br />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Task2-->
                                    <!--End Claimed Tasks-->

                                    <!--Tags-->
                                    <div class="row">
                                        <div class="col-sm-6 col-md-12">
                                            <h2> My Tags</h2>
                                        </div>
                                    </div>
                                    <br />

                                    <div>
                                        <div class="row">
                                            <div>
                                                <div>
                                                    <button class="btn btn-info btn-lg btn-block">Computer Science</button>
                                                    <button class="btn btn-info btn-lg btn-block">Empirical Psychology</button>
                                                    <button class="btn btn-info btn-lg btn-block">Research Methods</button>
                                                    <button class="btn btn-info btn-lg btn-block">Fruit</button>
                                                </div>
                                                <br />
                                            </div>

                                        </div>
                                    </div>
                                    <!--End of Tags-->

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!--  </div>
                <!-- End Col -->
        <!--</div> -->
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
