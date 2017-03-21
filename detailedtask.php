<?php
    session_start();

    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__.'/models/Task.class.php';
    require_once __DIR__.'/daos/UserDAO.class.php';
    require_once __DIR__.'/daos/TaskDAO.class.php';
    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
      $id = $_SESSION["user_id"];
      $user = new User();
      $userDao = new UserDAO();
      $user = $userDao->getUserByID($id);
      $task = NULL;
      if(!is_null($_GET["id"])){
        $task_id = $_GET["id"];
      $task = new Task();
      $task = TaskDAO::find_task_by_id($task_id);

      }
      // echo("ID: " .$id);
    } else {
      // echo("In else " .$_SESSION["user_id"]);
        header("location:./register.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ReviUL-Detailed Task
    </title>
<?php
    require_once __DIR__.'/templates/loggedinuser.php';
    require_once __DIR__.'/templates/usersidebar.php';

    ?>

          <div class="col-md-9 profile-content">
              <div class="" id="overview">
                  <div class="">
                              <div class="row">
                                <?php   if(!is_null($task->get_id())){ ?>
                                  <div class="col-sm-6 col-md-12">
                                      <h2><?php echo $task->get_title(); ?></h2>
                                  </div>
                              </div>
                              <br />
                              <div class=" col-sm-6 col-md-12 ">
                                  <table class="table table-user-information">
                                      <tbody>
                                          <tr>
                                              <td>Task Type:</td>
                                              <td><?php echo $task->get_type(); ?> .</td>
                                          </tr>
                                          <tr>
                                              <td>Brief Description:</td>
                                              <td><?php echo $task->get_description(); ?>.</td>
                                          </tr>
                                          <tr>
                                              <td>Tags:</td>
                                              <td><?php foreach($task->get_tags() as $aTag){
                                                echo '<span class="label label-primary">'.$aTag->get_name() .'</span> ';
                                              }  ?></td>
                                          </tr>

                                          <tr>
                                              <tr>
                                                  <td>Number of Pages:</td>
                                                  <td><?php echo $task->get_no_pages(); ?></td>
                                              </tr>
                                              <tr>
                                                  <td>Number of Words:</td>
                                                  <td><?php echo $task->get_no_words(); ?></td>
                                              </tr>
                                              <tr>
                                                  <td>Document Type:</td>
                                                  <td><?php echo $task->get_format(); ?></td>
                                              </tr>
                                              <tr>
                                                  <td>Preview</td>
                                                  <td><a href="">Click Here For Preview</a></td>
                                              </tr>
                                          </tr>

                                      </tbody>
                                  </table>

                              </div>
                          </div> <?php }else{ ?>
                            <div class="col-sm-6 col-md-8"> <h3 class="text-danger"> Task Not Found </h3></div>
                            <?php } ?>
                      </div>
                      <div class="panel-footer">
                        <span class="pull-right">
                          <a data-original-title="Claim" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-check"></i>Claim Task</a>
                          <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-flag"></i> Flag Task</a>
                      </span>
                  <br/>
                      </div>


                  </div>
              <!-- </div>
          </div> -->


      <?php
      require_once __DIR__.'/templates/footer.php';
      ?>

    </body>
    </html>
