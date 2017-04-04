<?php
    session_start();

    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__.'/models/Task.class.php';
    require_once __DIR__.'/daos/UserDAO.class.php';
    require_once __DIR__.'/daos/TaskDAO.class.php';

      $feedback = "";  //This will be used to add php feedback.

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
      if(!is_null($task->get_id())){
        foreach($task->get_tags() as $taskTag){
        foreach($user->get_tags() as $userTag){
          if($taskTag->get_id() == $userTag->get_id()){
             TagDAO::incrementUserTag($userTag, $user->get_id());
          }
        }
      }
    }
    

    }
    } else {
        header("location:./register.php");
    }

    if(isset($_POST["claimTask"])){
      if(TaskDAO::claim_task($user->get_id(), $task->get_id())){
        $task = TaskDAO::find_task_by_id($task_id);
        UserDAO::change_user_reputation($user, 10);
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
        UserDAO::change_user_reputation($user, 2);

        $feedback = '<h3 class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> Task Has Been Flagged</h3>';
      }else{
        $feedback = '<h3 class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> There was an issue flagging this task. If the problem persists please contact the site administrator.</h3>';
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
        <i class="glyphicon glyphicon-ok"></i> There was an issue deflagging this task. If the problem persists please contact the site administrator. </h3>';
      }
    }

    if(isset($_POST["banUser"])){
      if(UserDAO::ban_user($task->get_creator_id())){
          TaskDAO::remove_all_user_tasks($task->get_creator_id());
        $feedback = '<h3 class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> User has been banned.</h3>';
      }else{
        $feedback = '<h3 class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> PROBLEMS</h3>';
      }
    }
    if(isset($_POST["taskComplete"])){
      STATUSDAO::update_task_status("complete", $task->get_id());
      $task = TASKDAO:: find_task_by_id($task->get_id());
      $feedback = '<h3 class="alert alert-success alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      <i class="glyphicon glyphicon-ok"></i>Task has been set as Completed.</h3>';
    }
    if(isset($_POST["reviewHappy"])){
      if(TaskDAO::set_score_for_task(5, $task->get_id())){
        $creator = UserDAO::getUserByID($task->get_claimer_id());
        UserDAO::change_user_reputation($creator, 5);
        $feedback = '<h3 class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i>You have given this task a happy score ☺ </h3>';
      }else{
        $feedback = '<h3 class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i>There was an error updating </h3>';
      }
    }

    if(isset($_POST["taskCancelled"])){
      if(STATUSDAO::update_task_status("cancelled", $task->get_id())){
        $task = TASKDAO:: find_task_by_id($task->get_id());
        UserDAO::change_user_reputation($user, -15);
        $feedback = '<h3 class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i>You have marked this task as cancelled. 15 points have been removed from your reputation score.</h3>';

      }else{
        $feedback = '<h3 class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i>There was an error updating </h3>';
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
                    <!-- <span class="pull-right"> -->

                    <?php switch($task->get_status()->get_name()){
                      case "unclaimed":
                      echo '<span class="pull-right"><div><label for="primary" class="btn btn-info">Not Claimed</label></div>';
                      break;

                      case "in progress":
                      echo '<span class="pull-right"><div class="row"><label for="warning" class="btn btn-warning">In Progress</label></div>
                            <div class="row">Contact the claimer at: <span class="text-info">'.UserDAO::getUserByID($task->get_claimer_id())->get_email() .' </span></div>';
                      break;
                      case "expired":
                      echo '<span class="pull-right"><div><label for="danger" class="btn btn-danger">Expired</label></div>';
                      break;
                      case "cancelled":
                      echo '<span class="pull-right"><div><label for="danger" class="btn btn-danger">Cancelled</label></div>';
                      break;
                      case "unfinished":
                      echo '<span class="pull-right"><div><label for="danger" class="btn btn-danger">Unfinished</label></div>';
                      break;
                      case "complete":
                        echo '<div class="row">';
                        echo '<span class=""><div class="col-sm-6"><br><label class="btn btn-success">Complete</label></div></span>';
                      if($task->get_score() == 0){
                        echo '<div class="col-sm-6">
                               <form method="post">
                                  <span class="">
                                    <div class="">Review the task claimer</div>
                                      <button  type="submit" name="reviewHappy" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-thumbs-up"></i>Happy</button>
                                      <button  type="submit" name="reviewNotHappy" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-thumbs-down"></i> Not Happy</button>
                                    </div>
                                    </form>';
                      }
                      echo '</div>';


                      break;
                      default:
                      echo '';
                      break;
                    } ?>
                  </span>
              <br/><br><br>
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
                    echo '<div class="panel-footer col-sm-12">

                                <span class="pull-left">
                                   <a class="btn btn-default" href="availabletasks.php"><span class="small">Back </span> <span class="small hidden-xs"> to Available Tasks</span></a>
                                 </span>

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

                  if($task->get_status()->get_name() == "complete"){
                    echo '<div class="panel-footer">
                    <form method="post">
                    <div class="row">
                        <div class="col-sm-6 pull-left">
                            <div><label class="btn btn-success">Complete</label></div>
                       </div>
                        <div class="col-sm-6 pull-right">
                           <div><label class="btn btn-primary">Review: ';
                           if($task->get_score()==0){
                             echo ("Not Yet Reviewed");
                           }else if ($task->get_score()==-5){
                              echo "Not Happy";
                            }else if($task->get_score()==5){
                              echo "Happy";
                            } else{
                              echo "UNKNOWN";
                            }
                            echo '</label></div>
                      </div>
                  </div>
                    </form>

                          </div>';
                  }else{
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
