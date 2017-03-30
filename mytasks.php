<!-- Some pagination info and code taken from this question on stack overflow http://stackoverflow.com/questions/3705318/simple-php-pagination-script -->

<?php
    session_start();
    require_once __DIR__."/models/User.class.php";
    require_once __DIR__."/daos/UserDAO.class.php";
    require_once __DIR__."/daos/TaskDAO.class.php";



            if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
              $id = $_SESSION["user_id"];
              $user = new User();
              $user = UserDAO::getUserByID($id);
              $totalnoAvailable = TaskDAO::find_no_user_uploaded_tasks($id);
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
			  if($start < 0){ $start = 0;}
              $end = min(($offset + $limit), $totalnoAvailable);
              $prevlink = ($page > 1) ? '<li><a href="mytasks.php?page=' . ($page - 1) . '" title="Previous page">Previous</a></li>' : '<li class="disabled"><a href="mytasks.php?page=1" title="First page">Previous</a></li>';

              $nextlink = ($page < $pages) ? '<li><a href="mytasks.php?page=' . ($page + 1) . '" title="Next page">Next Page</a></li>' : '<li class="disabled"><a href="mytasks.php?page=' .$pages .'" title="Next page">Next Page</a></li>';


              $uploadedTasks = TaskDAO::find_user_uploaded_tasks_offset($user->get_id(),$limit, $offset );
              // print_r($uploadedTasks);

            } else {
              // echo("In else " .$_SESSION["user_id"]);
                header("location:./register.php");
            }

              $count_tasks = TaskDAO::count_tasks($user->get_id());
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

// $tasks = array();

// echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $totalnoAvailable, ' results ', $nextlink, ' </p></div>';

// $tasks = TaskDAO::find_available_tasks_offset($id, $limit, $offset);


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
                                <h2> My Tasks </h2>
                                <p>Tasks I have uploaded</p>
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
                                    </div>


                                    <?php  } ?>
                                      </div>
                                    <?php
									if($pages > 0){
										echo('</ul> <br / ><span class="small">  Page '. $page .' of ' .$pages.' pages, displaying '.$start.'-'.$end.' of '.$totalnoAvailable .'</span><br /> <ul class="pagination">
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
