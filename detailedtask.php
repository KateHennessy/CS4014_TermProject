<?php
    session_start();

    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__.'/models/Task.class.php';
    require_once __DIR__.'/daos/UserDAO.class.php';
    require_once __DIR__.'/daos/TaskDAO.class.php';
    require_once __DIR__.'/scripts/phpvalidation.php';
    require_once __DIR__.'/scripts/detailedtaskviews.php';


      $feedback = "";  //This will be used to add php feedback.

    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
      $id = $_SESSION["user_id"];
      $user = new User();
      $userDao = new UserDAO();
      $user = $userDao->getUserByID($id);
      $task = new Task();
      if(isset($_GET["id"]) && is_numeric($_GET["id"])){
        $task_id = $_GET["id"];
        $task = new Task();
        $task = TaskDAO::find_task_by_id($task_id);
        $flagged = TaskDAO::find_Task_in_flagged($task_id);
        if(!is_null($task->get_id())){
          foreach($task->get_tags() as $taskTag){
            foreach($user->get_tags() as $userTag){
              if($taskTag->get_id() == $userTag->get_id()){
                 TagDAO::incrementUserTag($userTag, $user->get_id());
              }
            }
          }
        }
      }else{

      }
    }
    else {
        header("location:./register.php");
    }

    if(isset($_POST["claimTask"])){
        $url = 'detailedtask.php?id=' .$task->get_id() .'&claimTaskOK=';
      if(TaskDAO::claim_task($user->get_id(), $task->get_id())){
        $task = TaskDAO::find_task_by_id($task_id);
        UserDAO::change_user_reputation($user, 10);
        $feedback .= phpvalidation::displaySuccess("Task Claimed Successfully");
        $url .='1';
      }else{
        $url .='0';
      }
      header("Location: " .$url);
    }


    if(isset($_GET['claimTaskOK'])){
      if($_GET['claimTaskOK'] == 1){
        $feedback = phpvalidation::displaySuccess("Task Has Been Claimed");
      }
        else{
          $feedback = phpvalidation::displayFailureSubtext("There was an issue claiming this task.", "If the problem persists please contact the site administrator.");
        }
    }

    if(isset($_POST["download"])){
      require __DIR__.'/scripts/download_file.php';
      exit;
    }

    if(isset($_POST["flagTask"])){
        $url = 'detailedtask.php?id=' .$task->get_id() .'&flagOK=';
        if(!is_null($flagged)){
          $url .='2';
        }else if(TaskDAO::flag_task($task->get_id(), $user->get_id())){
          UserDAO::change_user_reputation($user, 2);
          $url .= '1';
        }else{
            $url.= '0';
        }
         header("Location: " .$url);
    }

    if(isset($_GET['flagOK'])){
      if($_GET['flagOK'] == 2){
        $feedback = phpvalidation::displayWarning("Task Has Already Been Flagged");
      }
      	else if($_GET['flagOK'] == 1){
          $feedback = phpvalidation::displaySuccess("Task Has Been Flagged");
        }else{
          $feedback = phpvalidation::displayFailureSubtext("There was an issue flagging this task.", "If the problem persists please contact the site administrator.");
        }
    }

    if(isset($_POST["removeFlag"])){
      $url = 'detailedtask.php?id=' .$task->get_id() .'&removeflagOK=';
      if(TaskDAO::deflag_task($task->get_id())){
        $url .="1";
      }else{
        $url .="0";
      }
      header("Location: " .$url);
    }

    if(isset($_GET['removeflagOK'])){
      if($_GET['removeflagOK'] == 1){
          $feedback = phpvalidation::displaySuccess("Task Has Been De-Flagged");
      }else{
        $feedback = phpvalidation::displayFailureSubtext("There was an issue deflagging this task. "," If the problem persists please contact the site administrator.");
      }
    }

    if(isset($_POST["banUser"])){
        $url = 'detailedtask.php?id=' .$task->get_id() .'&banOK=';
      if(UserDAO::ban_user($task->get_creator_id())){
          // TaskDAO::remove_all_user_tasks($task->get_creator_id());
            $url .="1";
      }else{
        $url .= "0";
      }
       header("Location: " .$url);
    }

    if(isset($_GET['banOK'])){
      if($_GET['banOK'] == 1){
          $feedback = phpvalidation::displaySuccess("User has been banned.");
      }else{
        $feedback = phpvalidation::displayFailureSubtext("There was an issue banning this user. "," If the problem persists please contact the site administrator.");
      }
    }

    if(isset($_POST["taskComplete"])){
      $url = 'detailedtask.php?id=' .$task->get_id() .'&completeOK=';
      STATUSDAO::update_task_status("complete", $task->get_id());
      $task = TASKDAO:: find_task_by_id($task->get_id());
      $url .="1";
       header("Location: " .$url);
    }

    if(isset($_GET["completeOK"])){
      if($_GET["completeOK"] == 1){
        $feedback = phpvalidation::displaySuccess("Task has been set as Completed.");
      }else{
        $feedback = phpvalidation::displayFailureSubtext("There was an issue marking this task as complete.", "If the problem persists please contac the site administrator");
      }
    }

    if(isset($_POST["reviewHappy"])){
        $url = 'detailedtask.php?id=' .$task->get_id() .'&happyOK=';
      if(TaskDAO::set_score_for_task(5, $task->get_id())){
        $creator = UserDAO::getUserByID($task->get_claimer_id());
        UserDAO::change_user_reputation($creator, 5);
        $url .= "1";
      }else{
        $url .= "2";
      }
       header("Location: " .$url);
    }

    if(isset($_GET["happyOK"])){
      if($_GET["happyOK"] == 1){
        $feedback = phpvalidation::displaySuccess("You have given this task a happy score ☺");
      }else{
        $feedback = phpvalidation::displayFailureSubtext("There was an issue reviewing this task." , "If the problem persists please contact the site administrator");
      }
    }

    if(isset($_POST["reviewUnHappy"])){
        $url = 'detailedtask.php?id=' .$task->get_id() .'&unhappyOK=';
      if(TaskDAO::set_score_for_task(-5, $task->get_id())){
        $creator = UserDAO::getUserByID($task->get_claimer_id());
        UserDAO::change_user_reputation($creator, -5);
        $url .= "1";
      }else{
        $url .= "2";
      }
       header("Location: " .$url);
    }

    if(isset($_GET["unhappyOK"])){
      if($_GET["unhappyOK"] == 1){
        $feedback = phpvalidation::displaySuccess("You have given this task an unhappy score");
      }else{
        $feedback = phpvalidation::displayFailureSubtext("There was an issue reviewing this task." , "If the problem persists please contact the site administrator");
      }
    }

    if(isset($_POST["taskCancelled"])){
      $url = 'detailedtask.php?id=' .$task->get_id() .'&taskcancelledOK=';
      if(STATUSDAO::update_task_status("cancelled", $task->get_id())){
        $task = TASKDAO:: find_task_by_id($task->get_id());
        UserDAO::change_user_reputation($user, -15);
          $url .= "1";
      }else{
        $url .= "0";
      }
       header("Location: " .$url);
    }

    if(isset($_GET["taskcancelledOK"])){
      if($_GET["taskcancelledOK"] == 1){
        $feedback = phpvalidation::displayWarning("You have marked this task as cancelled. 15 points have been removed from your reputation score.");
      }else{
        $feedback = phpvalidation::displayFailureSubtext("There was an error updating the task status", "If the problem persists please contact the site administrator");
      }
    }

    if(isset($_POST["removeBannedTask"])){
      $url = 'detailedtask.php?id=' .$task->get_id() .'&removebannedOK=';
      if(TaskDAO::delete_task($task->get_id())){
        $url .="1";
      }else{
        $url .= "0";
      }
      header("Location: " .$url);
    }

    if(isset($_GET["removebannedOK"])){
      if($_GET["removebannedOK"] == 1){
        $feedback = phpvalidation::displaySuccess("This task has been removed from our system.");
      }else{
        $feedback = phpvalidation::displayFailureSubtext("There was an error removing this task",  "If the problem persists please contact the site administrator");
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
          echo $feedback;
            // if(!is_null($task)){
              if(!is_null($task->get_id())){
                  if($user->get_id() == $task->get_creator_id()){  // A TASK CREATOR IS LOOKING AT A DETAILED VIEW OF THEIR OWN TASK
                      echo detailedTaskView::createTaskHTML($task);
                      echo detailedTaskView::createView("Creator", $task);
                  } //END OF CREATOR VIEWING THEIR OWN TASK

                  else if(UserDAO::find_user_in_banned($task->get_creator_id())){   //Task Is Banned
                      echo detailedTaskView::createView("BannedTask", $task);
                  }
                  else if(is_null($task->get_claimer_id())){ // CLAIMER IS NULL - TWO POSSIBILITIES - MODERATOR LOOKING AT FLAGGED TASK OR POTENTIAL CLAIMER
                      if(!is_null(TASKDAO::find_task_in_flagged($task->get_id())) && $user->get_reputation() >=40){ //MODERATOR LOOKING AT FLAGGED TASK
                        echo detailedTaskView::createTaskHTML($task);
                        echo detailedTaskView::createView("Flagged", $task);

                      }else if($task->get_status()->get_name()=='unclaimed'){ //POTENTIAL CLAIMER
                        echo detailedTaskView::createTaskHTML($task);
                        echo detailedTaskView::createView("PotentialClaimer", $task);
                      } //END OF CLAIMER IS NULL

                  }
                  else if($task->get_claimer_id() == $user->get_id()){  //CURRENT VIEWER IS THE CLAIMER OF THE TASK
                    echo detailedTaskView::createTaskHTML($task);
                    echo detailedTaskView::CreateView("Claimer", $task);
                  }else{      // THE USER IS NOT THE CREATOR OR THE CLAIMER - NO ACCESS
                    echo(detailedTaskView::createNotFOundTaskHTML());
                  }
            }else{  //TASK ID IS NULL - Task doesn't exist
                    echo detailedTaskView::createNotFoundTaskHTML();

                        }
                        ?>


                      </div>


                    <!-- // ID Is not NULL -->

                        <!-- //Task id found was null -->
                      <!-- else{ ?> -->
                        <!-- <div class="col-xs-12"> <h2 class="text-danger text-center"> <i class= "glyphicon glyphicon-exclamation-sign"></i> Task Not Found </h2>
                          <p class="small text-center"> This task is not available. Please find another task.</p>
                        </div> -->
                      </div>
                    </div></div>


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
