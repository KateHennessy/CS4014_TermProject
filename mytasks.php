

<!-- Some pagination info and code taken from this question on stack overflow http://stackoverflow.com/questions/3705318/simple-php-pagination-script -->

<?php
    session_start();
    require_once __DIR__."/models/User.class.php";
    require_once __DIR__."/daos/UserDAO.class.php";
    require_once __DIR__."/daos/TaskDAO.class.php";
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__."/utils/Settings.class.php";
    require_once __DIR__."/scripts/taskstatusbuttons.php";

            if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
              $user = UserDAO::getUserByID($_SESSION["user_id"]);
              $totalnoAvailable = TaskDAO::find_no_user_uploaded_tasks($_SESSION["user_id"]);
              $limit = 6;
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
			        if($start < 0){ $start = 0;}
              $end = min(($offset + $limit), $totalnoAvailable);
              $prevlink = ($page > 1) ? '<li><a href="mytasks.php?page=' . ($page - 1) . '" title="Previous page">Previous</a></li>' : '<li class="disabled"><a href="mytasks.php?page=1" title="First page">Previous</a></li>';
              $nextlink = ($page < $pages) ? '<li><a href="mytasks.php?page=' . ($page + 1) . '" title="Next page">Next Page</a></li>' : '<li class="disabled"><a href="mytasks.php?page=' .$pages .'" title="Next page">Next Page</a></li>';
              $uploadedTasks = TaskDAO::find_user_uploaded_tasks_offset($user->get_id(),$limit, $offset );

            } else {
              // echo("In else " .$_SESSION["user_id"]);
                header("location:./register.php");
            }

            //  $count_tasks = TaskDAO::count_tasks($user->get_id());
		  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ReviUL-My Tasks
    </title>
<?php
    require_once __DIR__.'/templates/loggedinuser.php';
    ?>
     <div class="container-fluid">
    <div class="col-xs-12 well">

  <?php
require_once __DIR__.'/templates/usersidebar.php';
    ?>

    <div class="col-md-9 profile-content">
        <div class="" id="overview">
            <div class="">
                        <div class="row">

                            <div class="col-xs-12">
                                <h2> My Tasks </h2>
                                <p>Tasks I have uploaded</p>
                            </div>
                        </div>
                        <br />
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
                                                        <h4><small class="pull-right"><?php  $fullType = $task->get_type(); $shortenedType= strlen($fullType) > 35 ? substr($fullType,0,35)."..." : $fullType; echo($shortenedType); ?></small></h4>
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
                                                echo TaskStatusButtons::create_task_status_button($task->get_status()->get_name());
                                                ?>
                                            </div>
                                        </div>
                                    </div>


                                    <?php  } ?>
                                      </div>
                                    <?php
									if($pages > 0){
										echo('<br / ><span class="small">  Page '. $page .' of ' .$pages.' pages, displaying '.$start.'-'.$end.' of '.$totalnoAvailable .'</span><br /> <ul class="pagination">
                                    ' .$prevlink);
                                    for($i = 1; $i <= $pages; $i++){
                                      $class="";
                                      if($i == $page){
                                        $class= "page-item active";
                                      }
                                      echo('<li class="' .$class .'"><a href=mytasks.php?page=' .$i .">" .$i ."</a></li>");
                                    }
                                    echo($nextlink);
									}

                                    ?>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>


                                  <?php
                                  require_once __DIR__.'/templates/footer.php';
                                  ?>

                              </body>

                              </html>
