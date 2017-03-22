<!-- User Side Bar -->
<!-- <div class="container-fluid">
    <div class="col-xs-12 well"> -->
      <!--  <div class="row profile"> -->
            <div class="col-md-3 adapt">
                <div class="profile-sidebar">

                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">

                      <!--Output User Name -->
                      <?php
                      $dbquery = new DatabaseQueries();
                      $result = $dbquery -> returnSQLquery ("SELECT f_name, l_name FROM user WHERE user_id = '".$id ."'");
                      $row = $result -> fetch(PDO::FETCH_ASSOC);
                      echo("<label class=\"text-muted\">" .$row ['f_name']." ".$row ['l_name']."</label><br/>");

                      $result = $dbquery -> returnSQLquery ("SELECT reputation FROM user WHERE user_id = '".$id ."'");
                      $result -> execute();
                      $row = $result -> fetch(PDO::FETCH_ASSOC);
                        if($row['reputation'] >= 40) {
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
                        <?php
                        $dbquery = new DatabaseQueries();
                        $result = $dbquery -> returnSQLquery ("SELECT reputation FROM user WHERE user_id = '".$id ."'");
                        $row = $result -> fetch(PDO::FETCH_ASSOC);
                        echo $row ['reputation']." Reputation Score"."<br/>";
                        ?>

                    </div>

                    <!-- END USER REPUTATION -->

                    <!-- Start User Tasks -->


                    <div class="text text-center">
                        <label class="text-muted">  <i class="glyphicon glyphicon-tags"></i>  <!-- <var>4</var> Total Number of Tasks Uploaded</label> -->
                        <!--php for counting number of tasks the user has uploaded -->
                        <?php
                        $dbquery = new DatabaseQueries();
                        $result = $dbquery -> returnSQLquery ("SELECT count(task_id) FROM user JOIN task on user.user_id = task.creator_id WHERE user_id = '".$id ."'");
                        $row = $result -> fetch(PDO::FETCH_ASSOC);
                        echo $row ['count(task_id)']." Tasks Uploaded"."<br/>";
                        ?>
                    </div>




                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active"><a href="<?php echo 'profilepage.php'; ?>"><i class="glyphicon glyphicon-home"></i> Overview </a></li>
                            <li><a href="<?php echo 'accountsettings.php'; ?>"><i class="glyphicon glyphicon-user"></i> Account Settings </a></li>
                            <li><a href="<?php echo 'uploadtask.php'; ?>"><i class="glyphicon glyphicon-share"></i> Upload a Task</a> </li>
                            <li><a href="<?php echo 'availabletasks.php'; ?>"><i class="glyphicon glyphicon-search"></i>Available Tasks </a> </li>

                        </ul>
                    </div>
                    <!-- END MENU -->

                </div>
            </div>
