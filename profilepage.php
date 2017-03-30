<?php
    session_start();
    require_once __DIR__."/models/User.class.php";
    require_once __DIR__."/daos/UserDAO.class.php";
    require_once __DIR__."/daos/TaskDAO.class.php";



            if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
              $id = $_SESSION["user_id"];
              $user = new User();
              $user = UserDAO::getUserByID($id);
              $uploadedTasks = TaskDAO::find_user_uploaded_tasks_offset($user->get_id(), 4, 0);
              $claimedTasks = TASKDAO::find_user_claimed_tasks_offset($user->get_id(), 4, 0);
              $count_tasks = TaskDAO::count_tasks($user->get_id());
              // print_r($claimedTasks);

            } else {
              // echo("In else " .$_SESSION["user_id"]);
                header("location:./register.php");
            }
		  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ReviUL-Profile Page
    </title>
<?php
    require_once __DIR__.'/templates/loggedinuser.php';
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__."/utils/Settings.class.php";
    require_once __DIR__."/database/DatabaseQueries.php";
    ?>
     <div class="container-fluid">
    <div class="col-xs-12 well">

  <?php
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
                                    <div class="row">

                                      <?php
                                      if(count($uploadedTasks) == 0) { ?>
                                        <h5 class="col-sm-6 text-primary"> No tasks uploaded. To create one <a href="uploadtask.php"> <em>Click here </em></a></h5>
                                      <?php }

                                      foreach($uploadedTasks as $task){ ?>



                                    <div class="col-sm-6 col-lg-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading fixed">
                                                <div class="row fixedHead">
                                                    <div class="col-sm-8 col-xs-12">
                                                        <a class="pull-left"  href="<?php echo 'detailedtask.php?id='.$task->get_id()?>" target="_parent">

                                                            <!-- </a> -->
                                                            <h4 class="ellipsis"><div class="glyphicon glyphicon-edit"></div><?php
                                                            $fullTitle = $task->get_title();
                                                            $out = strlen($fullTitle) > 35 ? substr($fullTitle,0,35)."..." : $fullTitle;
                                                            echo $out ?></h4></a>
                                                    </div>
                                                    <div class="pull-right hidden-xs col-sm-4">
                                                        <h4><small class="pull-right"><?php echo$task->get_type() ?></small></h4>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                <div class="col-xs-12">
                                                <ul class="list-inline">
                                                    <li><?php echo $task->get_format() ?> </li>

                                                    <li><?php echo$task->get_no_pages() ?> Pages</li>

                                                    <li><?php echo$task->get_no_words() ?> Words</li>
                                                </ul>
                                              </div>
                                              </div>
                                                <p class="hidden-xs fixedBody"><?php echo$task->get_description() ?>. </p>
                                                <?php
                                                // $status = StatusDAO::find_most_recent_status($task_id);
                                                switch($task->get_status()->get_name()){
                                                  case "unclaimed":
                                                  echo '<div><label for="primary" class="btn btn-info">Not Claimed</label></div>';
                                                  break;
                                                  case "in progress":
                                                  echo '<div><label for="warning" class="btn btn-warning">In Progress</label></div>';
                                                  break;
                                                  case "expired":
                                                  echo '<div><label for="danger" class="btn btn-danger">Expired</label></div>';
                                                  break;
                                                  case "cancelled":
                                                  echo '<div><label for="danger" class="btn btn-danger">Cancelled</label></div>';
                                                  break;
                                                  case "unfinished":
                                                  echo '<div><label for="danger" class="btn btn-danger">Unfinished</label></div>';
                                                  break;
                                                  default:
                                                  echo '';
                                                  break;
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div> <?php } ?>

                                  </div>

                                    <br />

                                    <div class="row">
                                        <div class="col-sm-6 col-md-12">
                                            <h2> My  Claimed Tasks Overview</h2>
                                            <p>A snippet of information on tasks I have claimed</p>
                                        </div>
                                    </div>
                                    <br />


                                    <div class="row">

                                      <?php
                                      if(count($claimedTasks) == 0) { ?>
                                        <h5 class="col-sm-6 text-primary"> No claimed Tasks. To find tasks view the  <a href="availabletasks.php"> <em> Available Tasks Stream</em></a></h5>
                                      <?php }

                                      foreach($claimedTasks as $task){ ?>

                                    <div class="col-sm-6 col-lg-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading fixed">
                                                <div class="row fixedHead">
                                                    <div class="col-sm-8 col-xs-12">
                                                        <a class="pull-left"  href="<?php echo 'detailedtask.php?id='.$task->get_id()?>" target="_parent">

                                                            <!-- </a> -->
                                                            <h4 class="ellipsis"><div class="glyphicon glyphicon-edit"></div><?php
                                                            $fullTitle = $task->get_title();
                                                            $out = strlen($fullTitle) > 35 ? substr($fullTitle,0,35)."..." : $fullTitle;
                                                            echo $out ?></h4></a>
                                                    </div>
                                                    <div class="pull-right hidden-xs col-sm-4">
                                                        <h4><small class="pull-right"><?php echo$task->get_type() ?></small></h4>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                <div class="col-xs-12">
                                                <ul class="list-inline">
                                                    <li><?php echo $task->get_format() ?> </li>

                                                    <li><?php echo$task->get_no_pages() ?> Pages</li>

                                                    <li><?php echo$task->get_no_words() ?> Words</li>
                                                </ul>
                                              </div>
                                              </div>
                                                <p class="hidden-xs fixedBody"><?php echo$task->get_description() ?>. </p>
                                                <?php
                                                // $status = StatusDAO::find_most_recent_status($task_id);
                                                switch($task->get_status()->get_name()){
                                                  case "unclaimed":
                                                  echo '<div><label for="primary" class="btn btn-info">Not Claimed</label></div>';
                                                  break;
                                                  case "in progress":
                                                  echo '<div><label for="warning" class="btn btn-warning">In Progress</label></div>';
                                                  break;
                                                  case "expired":
                                                  echo '<div><label for="danger" class="btn btn-danger">Expired</label></div>';
                                                  break;
                                                  case "cancelled":
                                                  echo '<div><label for="danger" class="btn btn-danger">Cancelled</label></div>';
                                                  break;
                                                  case "unfinished":
                                                  echo '<div><label for="danger" class="btn btn-danger">Unfinished</label></div>';
                                                  break;
                                                  default:
                                                  echo '';
                                                  break;
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div> <?php } ?>

                                  </div>


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
