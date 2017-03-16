<?php
    session_start();
    require_once __DIR__."/models/User.class.php";
    require_once __DIR__."/daos/UserDAO.class.php";



            if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
              $id = $_SESSION["user_id"];
              $user = new User();
              $userDao = new UserDAO();
              $user = $userDao->getUserByID($id);
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
    require_once __DIR__."/utils/Settings.class.php";
    require_once __DIR__."/database/DatabaseQueries.php";
    require_once __DIR__.'/templates/usersidebar.php';
    ?>

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
                                                        <a class="pull-left"  href="<?php echo 'detailedtask.php'; ?>" target="_parent">

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
                                                        <a class="pull-left" href="<?php echo 'detailedtask.php'; ?>" target="_parent">
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
                                                        <a class="pull-left" href="<?php echo 'detailedtask.php'; ?>" target="_parent">
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
                                                        <a class="pull-left" href="<?php echo 'detailedtask.php'; ?>" target="_parent">
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

                                    <br />

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
                                                        <a class="pull-left" href="<?php echo 'detailedtask.php'; ?>" target="_parent">

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
                                                        <a class="pull-left" href="<?php echo 'detailedtask.php'; ?>" target="_parent">
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
                                            <h2 id="mytags"> My Tags</h2>
                                        </div>
                                    </div>
                                    <br />

                                    <div>
                                        <div class="row">
                                            <div>
                                                  <div class="tags col-md-12">

                                                      <!--php to get tag names from database -->
                                                      <?php
                                                      foreach($user->get_tags() as $atag){
                                                        echo('
                                                              
                                                          <label class="info">'.$atag->get_name() .'<br />
                                                            </label>');
                                                      }
                                                      ?>


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

    </div>

    <?php
    require_once __DIR__.'/templates/footer.php';
    ?>


</body>

</html>

<!--User Profile Sidebar by @keenthemes
    A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
    Licensed under MIT
    -->
