<?php
  session_start();
  $feedback = "";
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/daos/UserDAO.class.php';
    require_once __DIR__."/utils/Settings.class.php";
    require_once __DIR__."/utils/PDOAccess.class.php";

?>


<!DOCTYPE html>
<html lang="en">
 <head>
   <title>ReviUL-Information
   </title>

    <?php
      if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
             $id = $_SESSION["user_id"];
             $user = new User();
             $user = UserDAO::getUserByID($id);
        require_once __DIR__.'/templates/loggedinuser.php';
       } else {
        require_once __DIR__.'/templates/header.template.php';
   }
    ?>

    <div class="container-fluid">
      <?php
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
           $id = $_SESSION["user_id"];
           echo '<div class="col-xs-12 well">';
           require_once __DIR__.'/templates/usersidebar.php';
           echo '<div class="col-md-9 profile-content">';
         }else{
           echo '<div class="col-xs-11 col-sm-8 well">
                  <div class="profile-content">';

         }
         echo $feedback;
         ?>
                <h1><div class="glyphicon glyphicon-info-sign"></div>General Information</h1><br>

                <h3 id="HeadinguserInfo"><i></i> User Information</h3>
                  <div id="ContentuserInfo">
                    <p align = "justify">
                      Students and staff at the University of Limerick can join ReviUL to avail of a free and easy proof reading service. User's must be a member of the University of Limerick with a valid UL email.
                    </p>
                    <p align = "justify">
                      Once a user has registered, they can upload tasks for other people to proof read. They also have the ability to proof read other members tasks.
                    </p>
                </div>

                <h3 id="HeadingrepPoints"><i></i> Reputation Points</h3>
                  <div id="ContentrepPoints">
                    <p align = "justify">
                      Members of the website can gain reputation points by claiming a task to proof read and also flagging any task as inappropriate. However, user's can also lose reputation points if they cancel a task or also if they fail to submit a task before the due date.
                    </p>
                    <p align = "justify">
                      Once a user has obtained enough reputation points, they will be afforded the ability to review flagged tasks by other users. However, if points are deducted from the user in future, their ability to review tasks may be taken away until they have once again reached enough reputation points.
                    </p>
                  </div>

                  <h3 id="HeadingtaskInfo"><i></i> Task Information</h3>
                <div id="ContenttaskInfo">
                    <p align = "justify">
                      User's can upload tasks they wish to have proof read by another user. These tasks can include a thesis or assignment. These tasks can also be across a range of disciplines. The file uploaded must also be a PDF or a docx.
                    </p>
                    <p align = "justify">
                      When uploading a task, users must provide relevant information on their task. This information can include document type, word count, page count, title of task and a snippet of the content in the task.
                    </p>
                    <p align = "justify">
                      Users can search for tasks they wish to claim to proof read for other user. Once a user has found a task they wish to proof read, they can message the user who uploaded that task on their profile page. In this message, a user can state what task they wish to claim and also include their email address so the user can reply back with the task in question.
                    </p>
                    <p align = "justify">
                      When uploading a sample of your task, please ensure it is not the entire document. There are file size resitrictions in place.
                    </p>
                    <p align = "justify">
                      Your profile page will contain a snippet of information on tasks you have uploaded. It will not show every task you have ever uploaded or claimed. To see such tasks please go ton the "My Tasks" or "My Claimed Tasks" in the side bar.
                    </p>
                </div>

                <h3 id="HeadingclaimingTask"><i></i> Claiming a Task</h3>
                  <div id="ContentclaimingTask">
                    <p align = "justify">
                      You can claim a task by clicking on the task title. Once you do this you will be brought to a detailed task page with a claim button on the bottom of the screen.
                    </p>
                    <p align = "justify">
                      Once the claim button has been clicked you have claimed the task. The user who upladed the task will be given your email address to send you a full copy of their document. This email address will appear in the detailed task view once the task is marked as completed.
                    </p>
                    <p align = "justify">
                      The date the task in question must be completed by is in the detailed task view. You can see this date before claiming the task. Therefore, all users are aware of the timeline in which the task must be proof read by.
                    </p>
                  </div>

                <h3 id="HeadingupdatingTaskStatus"><i></i> Updating Task Status</h3>
                  <div id="ContentupdatingTaskStatus">
                    <p align = "justify">
                      Updating the status of a task is important once you have claimed it. You can update the status to cancelled or completed.
                    </p>
                    <p align = "justify">
                      Once you have updated the status of the task, the user will be made aware of the changing of the status via their profile page or "My Task" stream. Once you claim a task it will automatically be set to "In Progress". You can then update it to cancelled or completed. Please note the user you uploaded the task will be aware when it is completed as the status will change, and if not done so they can state as such on the rating system.
                    </p>
                    <p align = "justify">
                      It is important to update your status on claimed tasks, as this could affect your reputation score.
                    </p>
                  </div>

                <h3 id="HeadingbanningUser"><i></i> Banning of Users</h3>
                <div id="ContentbanningUser">
                  <p align = "justify">
                    If a user uploads content which is deemed inappropriate by another user, other users have the option to flag that task.
                  </p>
                  <p align = "justify">
                    Once a task is flagged, it will be reviewed. After the reviewal, if the result is that it is inappropriate, the task will be taken down, the users account will be deactivated and the user will be banned from registering from ReviUL in future.
                  </p>
                  <p align = "justify">
                    Once a user has been banned, they cannot use the website. They will be unable to log in or register for the website.
                  </p>
              </div>
           </div>
        </div>
      </div>

      <script>

       $("[id^='Content']").hide();
      $("[id^='Heading']").find('i').addClass('glyphicon glyphicon glyphicon-chevron-down');

       $("[id^='Heading']").click(function(){
           console.log("In toggle Content");
        $(this).next('div').slideToggle();
        if($(this).find('i').hasClass('glyphicon glyphicon-chevron-down')){
          $(this).find('i').removeClass('glyphicon glyphicon-chevron-down');
          $(this).find('i').addClass('glyphicon glyphicon-chevron-up');
        }else{
          $(this).find('i').removeClass('glyphicon glyphicon-chevron-up');
          $(this).find('i').addClass('glyphicon glyphicon-chevron-down');
        }
      });

      </script>

        <?php
        require_once __DIR__.'/templates/footer.php';
        ?>

    </body>
</html>
