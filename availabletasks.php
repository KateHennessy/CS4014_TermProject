<?php
    require_once __DIR__.'/templates/header.template.php';
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    ?>


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
                                                <a href="ProfilePage.php#mytags">selected tags.</a></p>
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
