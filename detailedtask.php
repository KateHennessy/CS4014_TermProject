<?php
    session_start();

    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__.'/models/Task.class.php';
    require_once __DIR__.'/daos/UserDAO.class.php';
    require_once __DIR__.'/daos/TaskDAO.class.php';

      $feedback = "";

    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
      $id = $_SESSION["user_id"];
      $user = new User();
      $userDao = new UserDAO();
      $user = $userDao->getUserByID($id);
      $task = NULL;
      if(isset($_GET["id"])){
        $task_id = $_GET["id"];
      $task = new Task();
      $task = TaskDAO::find_task_by_id($task_id);
      $count_tasks = TaskDAO::count_tasks($user->get_id());
      }
      // echo("ID: " .$id);
    } else {
      // echo("In else " .$_SESSION["user_id"]);
        header("location:./register.php");
    }

    if(isset($_POST["claimTask"])){
      // echo("<h1> IN CLAIMED TASK </h1>");
      if(TaskDAO::claim_task($user->get_id(), $task->get_id())){
        $task = TaskDAO::find_task_by_id($task_id);
        $feedback = '<h3 class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> Task Claimed Successfully</h3>';
      }else{

      }

    }
    if(isset($_POST["download"])){
      $absolutePath = $task->get_storage_address();
      $pathParts = pathinfo($absolutePath);
      $fileName = $pathParts['basename'];
      $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
      $fileType = finfo_file($fileInfo, $absolutePath);
      finfo_close($fileInfo);
      $fileSize = filesize($absolutePath);
      header('Content-Length: ' .$fileSize);
      header('Content-Type: ' .$fileType);
      header('Content-Disposition: attachment;filename=' .$fileName);
      ob_clean();
      flush();
      readfile($absolutePath);
      exit;

  }

    if(isset($_POST["flagTask"])){
      if(TaskDAO::flag_task($task->get_id(), $user->get_id())){
        $feedback = '<h3 class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> Task Has Been Flagged</h3>';
      }else{
        $feedback = '<h3 class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> PROBLEMS</h3>';
      }
    }

    if(isset($_POST["removeFlag"])){
      if(TaskDAO::deflag_task($task->get_id())){
        $feedback = '<h3 class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> Task Has Been De-Flagged</h3>';
      }else{
        $feedback = '<h3 class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> PROBLEMS</h3>';
      }
    }

    if(isset($_POST["banUser"])){
      if(UserDAO::ban_user($task->get_creator_id())){
        $feedback = '<h3 class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> User has been banned.</h3>';
      }else{
        $feedback = '<h3 class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> PROBLEMS</h3>';
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ReviUL-Detailed Task
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
              <div class="" id="detailedTask">

                                <?php
                                // echo($task->get_creator_id());
                                    echo($feedback);
                                    if(!is_null($task->get_id())){
                                          if($task->get_status()->get_name() != 'expired'){?>
                                    <div class="panel panel-default">
                                  <div class="panel-heading">
                                  <div class="">
                                      <h2><?php echo $task->get_title(); ?></h2>
                                  </div>
                              </div>
                              <br />
                              <div class="panel-body">
                                  <!-- <table class="table table-user-information"> -->
                                      <!-- <tbody> -->
                                      <div class = "row">
                                          <div class="form-group">
                                            <label class="col-md-3 control-label" for="Task Type">Task Type: </label>
                                              <div class="col-md-9">
                                                  <div><?php echo $task->get_type(); ?> </div>
                                            </div>
                                          </div>
                                        </div>
                                        <hr />

                                        <div class = "row">
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Brief Description Of The Task:</label>
                                                  <div class="col-md-9">
                                                    <div><?php echo $task->get_description(); ?></div>
                                                  </div>
                                          </div>
                                        </div>
                                        <hr />

                                        <div class = "row">
                                          <div class="form-group">
                                              <label class="col-md-3 control-label">Tags: </label>
                                              <div class="col-md-9">
                                              <div><?php foreach($task->get_tags() as $aTag){
                                                echo '<h4><span class="label label-primary">'.$aTag->get_name() .'</span></h4> ';
                                              }  ?></div>
                                            </div>
                                          </div>
                                        </div>
                                        <hr />

                                        <div class = "row">
                                          <div class="form-group">
                                              <label class="col-md-3 control-label">Claim By Date: </label>
                                              <div class="col-md-9">
                                              <div><?php echo $task->get_claim_deadline()->format('D d/m/y'); ?></div>
                                            </div>
                                          </div>
                                        </div>
                                        <hr />

                                        <div class = "row">
                                          <div class="form-group">
                                            <label class="col-md-3 control-label">Due Date: </label>
                                                <div class="col-md-9">
                                                  <div><?php echo $task->get_completion_deadline()->format('D d/m/y'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class = "row">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Number of Pages: </label>
                                                  <div class="col-md-9">
                                                    <div><?php echo $task->get_no_pages(); ?></div>
                                                  </div>
                                              </div>
                                            </div>
                                            <hr />

                                              <div class = "row">
                                              <div class="form-group">
                                                  <label class="col-md-3 control-label">Number of Words: </label>
                                                  <div class="col-md-9">
                                                    <div><?php echo $task->get_no_words(); ?></div>
                                                  </div>
                                              </div>
                                            </div>
                                            <hr />

                                            <div class = "row">
                                              <div class="form-group">
                                                  <label class="col-md-3 control-label">Document Type: </label>
                                                    <div class="col-md-9">
                                                      <div><?php echo $task->get_format(); ?></div>
                                                    </div>
                                              </div>
                                            </div>
                                            <hr />

                                            <div class = "row">
                                              <div class="form-group">
                                                <form method="post">
                                                  <label class="col-md-3 control-label">Preview: </label>
                                                    <div class="col-md-9">
                                                      <div><button name="download" class="btn btn-primary"> Click Here For Preview</button></div>
                                                    </div>
                                                  </form>
                                              </div>
                                          </div>

<!--
                                      </tbody>
                                  </table> -->

                              </div>

<?php


                if($user->get_id() == $task->get_creator_id()){  // A TASK CREATOR IS LOOKING AT A DETAILED VIEW OF THEIR OWN TASK
                  ?>
                  <div class="panel-footer">
                    <span class="pull-right">

                    <?php switch($task->get_status()->get_name()){
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
                    } ?>
                  </span>
              <br/><br>
            </div>
<?php
                } //END OF CREATOR VIEWING THEIR OWN TASK

                else if(UserDAO::find_user_in_banned($task->get_creator_id())){

                    echo '<div class="panel-footer">
                    <h3 class="text-danger text-center"> <i class="glyphicon glyphicon-flag"> </i>This user has been banned. This is task is no longer valid. </h3>
                    </div>';
                }
                else if(is_null($task->get_claimer_id())){ // CLAIMER IS NULL - TWO POSSIBILITIES - MODERATOR LOOKING AT FLAGGED TASK OR POTENTIAL CLAIMER

                  if(!is_null(TASKDAO::find_task_in_flagged($task->get_id())) && $user->get_reputation() >=40){ //MODERATOR LOOKING AT FLAGGED TASK
                    echo '<div class="panel-footer">
                                    <span class="pull-right">
                                    <form method="post">
                                      <button  type="submit" name="removeFlag" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-check"></i>Remove from Flagged Tasks</button>
                                      <button  type="submit" name="banUser" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-flag"></i> Ban User</button>
                                    </form>
                                  </span>
                              <br/><br>
                            </div>';
                  }else if($task->get_status()->get_name()=='unclaimed'){ //POTENTIAL CLAIMER
                    echo '<div class="panel-footer">
                                    <span class="pull-right">
                                    <form method="post" role="form">
                                      <button type="submit" name="claimTask" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-check"></i>Claim Task</button>
                                      <button type="submit" name="flagTask" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-flag"></i> Flag Task</button>
                                    </form>
                                  </span>
                              <br/><br>
                            </div>';
                          }

                        } //END OF CLAIMER IS NULL

                else if($task->get_claimer_id() == $user->get_id()){  //CURRENT VIEWER IS THE CLAIMER OF THE TASK

                  echo '<div class="panel-footer">
                  <form method="post">
                  <div class="row">
                    <div class="col-sm-12 pull-left">
                      <button  type="submit" name="taskComplete" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-check"></i>Mark Task as Complete</button>
                      <button  type="submit" name="taskCancelled" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i> Mark Task as Cancelled</button>
                      </div>
                    </div>
                  </form>

                        </div>';
                }


                        else{ // THE USER IS NOT THE CREATOR OR THE CLAIMER - NO ACCESS
                          ?>
                          <div class="col-xs-12"> <h2 class="text-danger text-center"> <i class= "glyphicon glyphicon-exclamation-sign"></i> Task Not Found </h2>
                            <p class="small text-center"> This task is not available. Please find another task.</p>
                          </div>
                          <?php
                        }
                        ?>


                      </div>
                      <?php }else{
                      ?>
                      <div class="col-xs-12"> <h2 class="text-danger text-center"> <i class= "glyphicon glyphicon-exclamation-sign"></i> Task Not Found </h2>
                        <p class="small text-center"> This task is not available. Please find another task.</p>
                      </div>
                      <?php }
                    } // ID Is not NULL


                      else{ ?>
                        <div class="col-xs-12"> <h2 class="text-danger text-center"> <i class= "glyphicon glyphicon-exclamation-sign"></i> Task Not Found </h2>
                          <p class="small text-center"> This task is not available. Please find another task.</p>
                        </div>
                      </div>
                    </div></div>
                        <?php } ?>
                      </div>

                  </div>
              </div>
          </div>


      <?php
      require_once __DIR__.'/templates/footer.php';
      ?>

    </body>
    </html>
