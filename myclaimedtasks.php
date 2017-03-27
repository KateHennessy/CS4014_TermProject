<?php
    session_start();
    require_once __DIR__."/models/User.class.php";
    require_once __DIR__."/daos/UserDAO.class.php";
    require_once __DIR__."/daos/TaskDAO.class.php";



            if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
              $id = $_SESSION["user_id"];
              $user = new User();
              $userDao = new UserDAO();
              $user = $userDao->getUserByID($id);
              $uploadedTasks = TaskDAO::find_user_uploaded_tasks($user);
              $claimedTasks = TASKDAO::find_user_claimed_tasks($user->get_id());
              // print_r($uploadedTasks);

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
                        <div class="col-sm-6 col-md-12">
                            <h2> My  Claimed Tasks </h2>
                            <p>Tasks that I have claimed</p>
                        </div>
                    </div>
                    <br />

                    <?php
                    if(count($claimedTasks) == 0) { ?>
                      <h5 class="col-sm-6 text-primary"> No tasks claimed. To claim one <a href="<?php echo 'availabletasks.php'?>"> <em>Click here </em></a></h5> 
                    <?php }

                    foreach($claimedTasks as $task){ ?>

                    <!-- Begin Task1-->
                    <div class="col-sm-6 col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading fixed">
                                <div class="row">
                                    <div class="col-sm-8 col-xs-12">
                                        <a class="pull-left" href="<?php echo 'detailedtask.php'; ?>" target="_parent">

                                            <!-- </a> -->
                                            <h4><div class="glyphicon glyphicon-edit"></div><?php echo $task->get_title(); ?></h4></a>
                                    </div>
                                    <div class="pull-right hidden-xs col-sm-4">
                                        <h4><small class="pull-right"><?php echo $task->get_type(); ?></small></h4>
                                    </div>
                                </div>
                                <ul class="list-inline">
                                    <li><?php echo $task->get_format(); ?></li>
                                    <li style="list-style: none">|</li>
                                    <li><?php echo $task->get_no_pages(); ?> Pages</li>
                                    <li style="list-style: none">|</li>
                                    <li><?php echo $task->get_no_words(); ?> Words</li>
                                </ul>
                                <p class="hidden-xs fixedBody"><?php echo $task->get_description(); ?> </p>
                                <?php
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
                    </div><?php } ?>
                    <!-- End Task1-->


                    <!--End Claimed Tasks-->

                  </div>
                </div>
              </div>
            </div>
          </div>

                    <!--End Claimed Tasks-->

                    <?php
                    require_once __DIR__.'/templates/footer.php';
                    ?>

                </body>

                </html>
