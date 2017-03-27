<?php
    session_start();
    require_once __DIR__."/models/User.class.php";
    require_once __DIR__."/daos/UserDAO.class.php";
    require_once __DIR__."/daos/TaskDAO.class.php";



            if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
              $id = $_SESSION["user_id"];
              $user = new User();
              $userDao = new UserDAO();
              $user = $userDao->getUserByID($id);
              $uploadedTasks = TaskDAO::find_user_uploaded_tasks($user);
              // print_r($uploadedTasks);

            } else {
              // echo("In else " .$_SESSION["user_id"]);
                header("location:./register.php");
            }
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
                        <div class="col-sm-6 col-md-12">
                            <h2> My  Claimed Tasks </h2>
                            <p>Tasks I have claimed</p>
                        </div>
                    </div>
                    <br />

                    <!-- Begin Task1-->
                    <div class="col-sm-6 col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading fixed">
                                <div class="row">
                                    <div class="col-sm-8 col-xs-12">
                                        <a class="pull-left" href="<?php echo 'detailedtask.php'; ?>" target="_parent">

                                            <!-- </a> -->
                                            <h4><div class="glyphicon glyphicon-edit"></div>The Study of Pineapples</h4></a>
                                    </div>
                                    <div class="pull-right hidden-xs col-sm-4">
                                        <h4><small class="pull-right">Assignment</small></h4>
                                    </div>
                                </div>
                                <ul class="list-inline">
                                    <li>PDF</li>
                                    <li style="list-style: none">|</li>
                                    <li>10 Pages</li>
                                    <li style="list-style: none">|</li>
                                    <li>7000 Words</li>
                                </ul>
                                <p class="hidden-xs fixedBody">A study on the growing habitats of pineapples </p>
                                <div><label for="Success" class="btn btn-success">Completed</label></div>
                            </div>
                        </div>
                    </div>
                    <!-- End Task1-->

                    <!-- Begin Task2-->
                    <div class="col-sm-6 col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading fixed">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8">
                                        <a class="pull-left" href="<?php echo 'detailedtask.php'; ?>" target="_parent">
                                            <h4><div class="glyphicon glyphicon-edit"></div>Are Video Games Bad?</h4>
                                        </a>
                                    </div>
                                    <div class="pull-right hidden-xs col-sm-4">
                                        <h4><small class="pull-right">PhD Thesis</small></h4>
                                    </div>
                                </div>
                                <ul class="list-inline">
                                    <li>Docx</li>
                                    <li style="list-style: none">|</li>
                                    <li>35000 Words</li>
                                    <li style="list-style: none">|</li>
                                    <li>100 Pages</li>
                                </ul>
                                <p class="hidden-xs fixedBody"> A study investigating the side effects of violent video games on children</p>
                                <div><label for="Warning" class="btn btn-warning">In Progress</label></div>
                                <br />
                            </div>
                        </div>
                    </div>

                    <!-- End Task2-->
                  </div>
                </div>
              </div>
            </div>
          </div>

                    <!--End Claimed Tasks-->

                    <?php
                    require_once __DIR__.'/templates/footer.php';
                    ?>

                </body>

                </html>
