<?php
    session_start();

    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
      $id = $_SESSION["user_id"];
      // echo("ID: " .$id);
    } else {
      // echo("In else " .$_SESSION["user_id"]);
        header("location:./register.php");
    }
?>

<?php
    require_once __DIR__.'/templates/header.template.php';
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__.'/templates/usersidebar.php';
    ?>



        <div class="col-md-9 profile-content">
            <div class="" id="overview">
                <div class="">
        <!--<div class="col-md-9">
        <div class="profile-content">
        <div class="container-fluid" style="background-color:#e8e8e8">
        <div class="col-xs-12" id="property-listings">-->

        <div class="row">
        <div class="col-sm-6 col-md-12">
                <h2>Information</h2>
                <h3>User Information</h3>
                  <p>
                    Students and staff at the University of Limerick can join ReviUL to avail of a free and easy proof reading service. User's must be a member of the University of Limerick with a valid UL email.
                  </p>
                  <p>
                    Once a user has registered, they can upload tasks for other people to proof read. They also have the ability to proof read other members tasks.
                  </p>
                <h3>Reputation Points</h3>
                  <p>
                    Members of the website can gain reputation points by claiming a task to proof read and also flagging any task as inappropriate. However, user's can also lose reputation points if they cancel a task or also if they fail to submit a task.
                  </p>
                  <p>
                    Once a user has obtained enough reputation points, they will be afforded the ability to review flagged tasks by other users. However, if points are deducted from the user in future, their ability to review tasks may be taken away until they have omce again reached enough reputation points.
                  </p>
                <h3>Task Information</h3>
                  <p>
                    User's can upload tasks they wish to have proof read by another user. These tasks can include a thesis or assignment. These tasks can also be across a range of disciplines.
                  </p>
                  <p>
                    When uploading a task, users must provide relevant information on their task. This information can include document type, word count, page count, title of task and a snippet of the content in the task.s
                  </p>
                  <p>
                    Users can search for tasks they wish to claim to proof read for other user. Once a user has found a task they wish to proof read, they can message the user who uploaded that task on their profile page. In this message, a user can sttae what task they wish to claim and also include their email address so the user can reply backw with the tassk in question.
                  </p>
                <h3>Banning of Users</h3>
                  <p>
                    If a user uploads content which is deemed inappropriate by another user, other users have the option to flag that task.
                  </p>
                  <p>
                    Once a task is flagged, it will be reviewed. After the reviewal, if the result is that it is inappropriate, the task will be taken down, the users account will be deactivated and the user will be banned from registering from ReviUL in future.
                  </p>
        </div>
        </div>

</body>
</html>
