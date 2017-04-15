<?php
 if(!is_null($user)){
   require_once __DIR__."/../models/User.class.php";
   require_once __DIR__."/../daos/UserDAO.class.php";
   require_once __DIR__.'/../models/Tag.class.php';
   require_once __DIR__."/../daos/TaskDAO.class.php";
   ?>
<!-- User Side Bar -->
      <div class="col-md-3 adapt">
          <div class="profile-sidebar">

              <!-- SIDEBAR USER TITLE -->
              <div class="profile-usertitle">

                <!--Output User Name -->
                <label class="text-muted"><?php echo $user->get_first_name() ?>
                <?php echo $user->get_last_name() ?> </label>
                <br />
                <?php
                if($user->get_reputation() >= '40') {
                    echo("<label class=\"text-muted\">Moderator</label>");
                  } else {
                    echo("<label class=\"text-muted\">General User</label>");
                  }
                ?>

              </div>

              <!-- END SIDEBAR USER TITLE -->

              <!-- USER REPUTATION -->

              <div class="text text-center">
                  <label class="text-muted"><i class="glyphicon glyphicon-star"></i><!--<var>21</var> Reputation Score</label> -->

                  <!--PHP to bring reputation score from database -->

                  <label class="text-muted"><?php echo $user->get_reputation() ?> Reputation Score </label>



              </div>

              <!-- END USER REPUTATION -->

              <!-- Start User Tasks -->


              <div class="text text-center">
                  <label class="text-muted">  <i class="glyphicon glyphicon-tags"></i>  <!-- <var>4</var> Total Number of Tasks Uploaded</label> -->
                  <!--php for counting number of tasks the user has uploaded -->
                  <label class="text-muted"><?php
									echo TaskDAO::count_tasks($user->get_id()) ?> Tasks Uploaded </label>
              </div>




              <!-- SIDEBAR MENU -->
              <div class="profile-usermenu" id="profile">
                  <ul class="nav">
                      <li id="profile_overview"><a href="<?php echo 'profilepage.php'; ?>"><i class="glyphicon glyphicon-home"></i> Overview </a></li>
                      <li id="my_tasks"><a href="<?php echo 'mytasks.php'; ?>"><i class="glyphicon glyphicon-tasks"></i>My Tasks </a> </li>
                      <li id="my_claimed_tasks"><a href="<?php echo 'myclaimedtasks.php'; ?>"><i class="glyphicon glyphicon-tasks"></i>My Claimed Tasks </a> </li>
                      <li id="available_tasks"><a href="<?php echo 'availabletasks.php'; ?>"><i class="glyphicon glyphicon-search"></i>Available Tasks </a> </li>
                      <li id="upload_task"><a href="<?php echo 'uploadtask.php'; ?>"><i class="glyphicon glyphicon-share"></i> Upload a Task</a> </li>
                      <?php
                        if($user->get_reputation() >= '40') {
                        echo '<li id="flagged_tasks"><a href="flaggedtasks.php"><i class="glyphicon glyphicon-flag"></i> Flagged Tasks</a> </li>';
                      }
                      ?>
                      <li  id="accountsettings"><a href="<?php echo 'accountsettings.php'; ?>"><i class="glyphicon glyphicon-user"></i> Account Settings </a></li>

                  </ul>
              </div>


          </div>
      </div>

      <script>
      $(document).ready(function(){

      var pathname = document.location.href.match(/[^\/]+$/)[0];
        switch(pathname){
          case "profilepage.php":
          id = $('#profile_overview');
          break;
          case "mytasks.php":
          id = $('#my_tasks');
          break;
          case "myclaimedtasks.php":
          id = $('#my_claimed_tasks');
          break;
          case "availabletasks.php":
          id = $('#available_tasks');
          break;
          case "uploadtask.php":
          id = $('#upload_task');
          break;
          case "flaggedtasks.php":
          id = $('#flagged_tasks');
          break;
          case "accountsettings.php":
          id = $('#accountsettings');
          break;
        }
         id.addClass("active");
        });


      </script>

    <!-- <center>
        <strong>Powered by <a href="http://j.mp/metronictheme" target="_blank">KeenThemes</a></strong>
    </center> -->

    <!--User Profile Sidebar by @keenthemes
    A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
    Licensed under MIT
    -->
<!-- Contact GitHub API Training Shop Blog About
© 2017 GitHub, Inc. Terms Privacy Security
 Download Formatting took: 157 ms PHP Formatter made by Spark Labs
Copyright Gerben van Veenendaal -->

<?php
}
?>
