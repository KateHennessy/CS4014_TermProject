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
        <title>ReviUL-Information/FAQs
        </title>

    <?php
   if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
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

         } echo $feedback; ?>
                <h1><div class="glyphicon glyphicon-info-sign"></div>Frequently Asked Questions</h1><br>

                <button class ="accordion">Who can join this website?</button>
                <div class ="panel">
                  <p align = "justify">
                    Students and staff at the University of Limerick can join ReviUL to avail of a free and easy proof reading service. User's must be a member of the University of Limerick with a valid UL email.
                  </p>
                  <p align = "justify">
                    Once a user has registered, they can upload tasks for other people to proof read. They also have the ability to proof read other members tasks.
                  </p>
                  </div>

                <button class ="accordion">What are reputation points?</button>
                <div class ="panel">
                  <p align = "justify">
                    Members of the website can gain reputation points by claiming a task to proof read and also flagging any task as inappropriate. However, user's can also lose reputation points if they cancel a task or also if they fail to submit a task before the due date.
                  </p>
                  <p align = "justify">
                    Once a user has obtained enough reputation points, they will be afforded the ability to review flagged tasks by other users. However, if points are deducted from the user in future, their ability to review tasks may be taken away until they have once again reached enough reputation points.
                  </p>
                </div>

                <button class ="accordion">Why do I need to upload tasks?</button>
                <div class ="panel">
                  <p align = "justify">
                    User's can upload tasks they wish to have proof read by another user. These tasks can include a thesis or assignment. These tasks can also be across a range of disciplines. The file uploaded must also be a PDF, a doc or a docx.
                  </p>
                  <p align = "justify">
                    Your profile page will contain a snippet of information on tasks you have uploaded. It will not show every task you have ever uploaded or claimed. To see such tasks please go ton the "My Tasks" or "My Claimed Tasks" in the side bar.
                  </p>
                </div>


                <button class ="accordion">What type of task can I upload?</button>
                <div class ="panel">
                  <p align = "justify">
                    You can upload an assignment, thesis etc to ReviUL. The file uploaded must also be a PDF, a doc or a docx.
                  </p>
                  <p align = "justify">
                    When uploading a task, users must provide relevant information on their task. This information can include document type, word count, page count, title of task and a snippet of the content in the task.
                  </p>
                </div>

                <button class ="accordion">What information do I need to provide with my uploaded task?</button>
                <div class ="panel">
                  <p align = "justify">
                    When uploading a sample of your task, please ensure it is not the entire document. There are file size resitrictions in place.
                  </p>
                </div>

                <button class ="accordion">How can I find unclaimed tasks in order to claim one?</button>
                <div class ="panel">
                  <p align = "justify">
                    Users can find available tasks in the available tasks stream on their profile menu.
                    These available tasks are ordered according to browsing habits relating to your selected tags.
                    You can get a more detailed view of the task by clicking on a task title in this stream.
                  </p>
                  </div>


                <button class ="accordion">How can I claim a task to proof read it?</button>
                <div class ="panel">
                  <p align = "justify">
                     Once you are on the detailed view of the task, there will be a claim button on the bottom of the screen.
                  </p>
                  <p align = "justify">
                    Once the claim button has been clicked you have claimed the task. The user who uploaded the task will be given your email address to send you a full copy of their document. This email address will appear in the detailed task view once the task is marked as in progress.
                  </p>
                  <p align = "justify">
                    The date the task in question must be completed by is in the detailed task view. You can see this date before claiming the task. Therefore, all users are aware of the timeline in which the task must be proof read by.
                  </p>
                </div>


                <button class ="accordion">How will I know if my task has been claimed?</button>
                <div class ="panel">
                  <p>
                    The task will appear as claimed both in your Profile Page and you My Task page.
                    When you enter the detailed view of your task, the individual's email address who has claimed your task will appear.
                    You will then email your full document to the individual for them to proof read.
                  </p>
                </div>


                <button class ="accordion">How can I update task information(task status)?</button>
                <div class ="panel">
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


                <button class ="accordion">Why are some users banned?</button>
                <div class ="panel">
                  <p align = "justify">
                    If a user uploads content is deemed inappropriate by another user, they have the option to flag that task.
                  </p>
                  <p align = "justify">
                    Once a task is flagged, it will be reviewed. After the reviewal, if the result is that it is inappropriate, the task will be taken down, the users account will be deactivated and the user will be banned from registering from ReviUL in future.
                  </p>
                  <p align = "justify">
                    Once a user has been banned, they cannot use the website. They will be unable to log in or register for the website.
                  </p>
                  <p align = "justify">
                    If a user that has been working on your task has been banned, your task's status will be updated to cancelled.
                  </p>
                  <p align = "justify">
                    If you are working on a task for a user that has been banned, you will be notified when you next view this task, and then have the option to remove this from your claimed tasks.
                  </p>
                </div>


        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$("[class='panel']").hide();
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");
        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    }
}
</script>


        <?php
        require_once __DIR__.'/templates/footer.php';
        ?>

</body>
</html>
