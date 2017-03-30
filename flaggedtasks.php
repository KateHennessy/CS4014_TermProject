<!-- Some pagination info and code taken from this question on stack overflow http://stackoverflow.com/questions/3705318/simple-php-pagination-script -->
<?php
    session_start();
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__."/models/Task.class.php";
    require_once __DIR__."/daos/TaskDAO.class.php";
    require_once __DIR__."/daos/UserDAO.class.php";

    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
      $id = $_SESSION["user_id"];
      $user = new User();
      $userDao = new UserDAO();
      $user = $userDao->getUserByID($id);
    } else {
        header("location:./register.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ReviUL-Flagged Tasks
    </title>
<?php
    require_once __DIR__.'/templates/loggedinuser.php';
    ?>
     <div class="container-fluid">
    <div class="col-xs-12 well">

          <?php
    require_once __DIR__.'/templates/usersidebar.php';

    $tasks = array();
    $totalnoAvailable = TaskDAO::find_no_flagged_tasks();
    $limit = 7;
    $pages = ceil($totalnoAvailable / $limit);

    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    // Calculate the offset for the query
   $offset = ($page - 1)  * $limit;
   // Some information to display to the user
 $start = $offset + 1;
 $end = min(($offset + $limit), $totalnoAvailable);
 $prevlink = ($page > 1) ? '<li><a href="flaggedtasks.php?page=' . ($page - 1) . '" title="Previous page">Previous</a></li>' : '<li class="disabled"><a href="flaggedtasks.php?page=1" title="First page">Previous</a></li>';

 $nextlink = ($page < $pages) ? '<li><a href="flaggedtasks.php?page=' . ($page + 1) . '" title="Next page">Next Page</a></li>' : '<li class="disabled"><a href="flaggedtasks.php?page=' .$pages .'" title="Next page">Next Page</a></li>';

 // echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $totalnoAvailable, ' results ', $nextlink, ' </p></div>';

    $tasks = TaskDAO::find_flagged_tasks_offset($limit, $offset);



    ?>
                <div class="col-md-9 profile-content">
                    <div class="" id="overview">
                        <div class="">
                          <div class="row">
                              <div class="col-xs-12">
                                  <h2>Flagged Tasks</h2>
                                  <p>These tasks were flagged by other users as inappropriate. Please review these flagged tasks.
                                    You can then ban the user or "de-flag" the task.</a></p>
                              </div>
                          </div>
                          <br />


                                  <?php
                                  foreach($tasks as $task){ ?>
                                    <div class="col-xs-12 fixedMax">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <a class="pull-left" href="<?php echo 'detailedtask.php?id=' .$task->get_id(); ?>" target="_parent">
                                                            <!-- </a> -->
                                                            <h4><div class="glyphicon glyphicon-edit"></div><?php echo $task->get_title(); ?></h4></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="pull-left col-sm-6">

                                                        <i class="glyphicon glyphicon-file pull-left text-primary"></i>
                                                        <p class="text-muted"><small class="pull-left">Type: <span class="text-primary"><?php echo $task->get_type(); ?></span></small><br>
                                                            <i class="glyphicon glyphicon-calendar pull-left text-primary"></i>
                                                            <small class="pull-left"> Claim Before: <span class="text-primary"><?php echo $task->get_claim_deadline()->format('d/m/Y'); ?></span></small><br>
                                                            <i class="glyphicon glyphicon-hourglass pull-left text-primary"></i>
                                                            <small class="pull-left">  Due Date: <span class="text-primary"> <?php echo $task->get_completion_deadline()->format('d/m/Y'); ?></span></small><br>
                                                            <i class="glyphicon glyphicon-duplicate pull-left text-primary"></i>
                                                            <small class="pull-left">Page Count: <span class="text-primary"><?php echo $task->get_no_pages(); ?></span></small><br>
                                                            <i class="glyphicon glyphicon-stats pull-left text-primary"></i>
                                                            <small class="pull-left">Word Count: <span class="text-primary"><?php echo $task->get_no_words(); ?></span></small><br></p>
                                                    </div>

                                                    <div class="divider pull-right hidden-xs col-sm-6 scroll">
                                                        <p class="hidden-xs fixedBodyLarge scroll"> <?php echo $task->get_description(); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php  }

                                echo('</ul> <br / ><span class="small">  Page '. $page .' of ' .$pages.' pages, displaying '.$start.'-'.$end.' of '.$totalnoAvailable .'</span><br /> <ul class="pagination">
                                ' .$prevlink);
                                for($i = 1; $i <= $pages; $i++){
                                  $class="";
                                  if($i == $page){
                                    $class= "page-item active";
                                  }
                                  echo('<li class="' .$class .'"><a href=flaggedtasks.php?page=' .$i .">" .$i ."</a></li>");
                                }
                                echo($nextlink);
                                ?>


                                    <!-- <ul class="pagination">
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                    </ul> -->

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

    <?php
    require_once __DIR__.'/templates/footer.php';
    ?>

</body>

</html>

<!--User Profile Sidebar by @keenthemes
    A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
    Licensed under MIT
    -->