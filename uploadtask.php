<!DOCTYPE html>
<html lang="en">
<head>
 <title>ReviUL-Upload Task
 </title>
 <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css" />

<?php session_start();
$feedback = "";

if (isset($_SESSION[ "user_id"]) &&
$_SESSION[ "user_id"] !='' ){
   $id = $_SESSION[ "user_id"];

  ?>



   <?php
    require_once __DIR__ . '/templates/loggedinuser.php'; require_once __DIR__ . '/models/User.class.php';
   require_once __DIR__ . '/models/Tag.class.php';
   ?>
   <!-- CONTAINER START -->
    <div class="container-fluid">
   <div class="col-xs-12 well">

         <?php
   require_once __DIR__. '/templates/usersidebar.php';
   require_once __DIR__. '/scripts/phpvalidation.php';

   $uploadFormOK = true;
   if(isset($_POST["uploadsubmit"])) {
     $creator_id = $id;
     $title = htmlspecialchars(ucfirst($_POST["task_title"]));
     $type =  htmlspecialchars(ucfirst($_POST["task_type"]));
     $description = htmlspecialchars(ucfirst($_POST["description"]));
     $no_pages = htmlspecialchars(ucfirst(trim($_POST["no_pages"])));
     $no_words = htmlspecialchars(ucfirst(trim($_POST["no_words"])));
     $tags = $_POST["tags"];
     if(!phpvalidation::isValidDate($_POST["claim_deadline"]) || !phpvalidation::isValidDate($_POST["completion_deadline"])){
       $feedback.= '<h3 class="alert alert-warning alert-dismissable">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
       <i class="glyphicon glyphicon-remove"></i>
       Date entered in invalid format.</h3>';
       $uploadFormOK = false;
     }
     if(!is_numeric($no_pages)){
       $feedback.= '<h3 class="alert alert-warning alert-dismissable">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
       <i class="glyphicon glyphicon-remove"></i>
       Please enter a number for Number of Pages.</h3>';
       $uploadFormOK = false;
     }

     $claim_deadline = date('Y-m-d H:i:s',strtotime($_POST["claim_deadline"]." 23:59:00"));
     $completion_deadline = date('Y-m-d H:i:s',strtotime($_POST["completion_deadline"]." 23:59:00"));

     if($claim_deadline < date('Y-m-d H:i:s', time())){
       $uploadFormOK = false;
       $feedback.= '<h3 class="alert alert-warning alert-dismissable">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
       <i class="glyphicon glyphicon-remove"></i>
       You have entered a past date for your Claim Deadline.</h3>';
       $claim_deadline = "";
     }
     if($completion_deadline < $claim_deadline){
       $uploadFormOK = false;
       $feedback.= '<h3 class="alert alert-warning alert-dismissable">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
       <i class="glyphicon glyphicon-remove"></i>
       You have entered a Due Date that is closer than your Claim Deadline.</h3>';
     }

     require_once __DIR__.'/scripts/upload_file.php'; // first checking if file uploaded is ok before progressing with rest of task upload
    //  if($uploadOk == 1){
      if($uploadOk != 1){
        $uploadFormOK = false;
      }
      if($uploadFormOK){

       require_once __DIR__."/models/Task.class.php";
       require_once __DIR__."/daos/TaskDAO.class.php";
        $format = $extension;
        $storage_address = $target_file;


      //  task_id

      $task = new Task();
      $task->set_creator_id($creator_id);
      $task->set_title($title);
      $task->set_type($type);
      $task->set_description($description);
      $task->set_claim_deadline($claim_deadline);
      $task->set_completion_deadline($completion_deadline);
      $task->set_no_pages($no_pages);
      $task->set_no_words($no_words);
      $task->set_format($format);
      $task->set_storage_address($storage_address);
      $tagArray = array();
      for($i = 0; $i < count($tags); $i++){
          $tagArray[$i] = TagDAO::find_tag_by_name($tags[$i]);
      }
      $task->set_tags($tagArray);
      $task = TaskDAO::save($task);
      if(!is_null($task->get_id())){
        $feedback = '<h3 class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <i class="glyphicon glyphicon-ok"></i> Task Uploaded Successfully</h3>' .$feedback;
        $title = "";
        $type =  "";
        $description = "";
        $claim_deadline = "";
        $completion_deadline = "";
        $no_pages = "";
        $no_words = "";
      }
    }

  // }


 }else{ //setting these to empty if not submitted - empty form
   $title = "";
   $type =  "";
   $description = "";
   $claim_deadline = "";
   $completion_deadline = "";
   $no_pages = "";
   $no_words = "";

 }
 }/*end of within session id set*/ else {
   header( "location:./register.php");
 } ?>

<div class="col-md-9 profile-content">
    <div id="overview">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2><strong>Upload</strong><i> your task</i></h2>
                </div>
                <div class="panel-body">
                    <?php echo($feedback); //Any errors found with input in php
                        ?>
                    <br>
                    <br>
                    <!-- Form Start -->
                    <legend>Fill in the form:</legend>
                    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="File Type">Task Name</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                            <input id="task_title" value="<?php echo($title) ?>" required name="task_title" type="text" placeholder="" class="form-control input-md">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Task Type">Task Type
                            <button id="tooltip1" type="button" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="This is the type of document you are putting up for review. Examples include Master's Assignment, Undergraduate Project, PHD Thesis, etc."> ?</span>
                            </button>
                        </label>
                        <div class="col-md-8 input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-book"></span></span>
                            <input id="task_type" value="<?php echo($type) ?>" name="task_type" type="text" required class="form-control input-md">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Brief Description Of The Task</label>
                        <div class="col-md-8">
                            <textarea id="description" value="<?php echo($description) ?>" name="description" required placeholder="Give a brief description of your task.." style="height:200px" style="overflow:scroll"></textarea>
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Tags <em class="text-danger"> *</em>
                            <button id="tooltip2" type="button" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="These tags will help people find your tasks. Please use tags close to your task's area.">
                                <span class="text-white"> ?</span>
                            </button>
                        </label>
                        <div class="col-md-8 input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span></span>
                              <select class="selectpicker" data-width="75%" id="tags" name="tags[]" data-width="fit" multiple data-selected-text-format="count > 1" data-max-options="4" required="required" name="tags">
                                <optgroup label="Computer Science">
                                    <option>Graphics</option>
                                    <option>Artificial Intelligence</option>
                                    <option>Computer Architecture & Engineering</option>
                                    <option>Biosystems & Computational Biology</option>
                                    <option>Human-Computer Interaction</option>
                                    <option>Operating Systems & Networking</option>
                                    <option>Programming Systems</option>
                                    <option>Scientific Computing</option>
                                    <option>Security</option>
                                    <option>Theory</option>
                                </optgroup>
                                <optgroup label="Psychology">
                                    <option>Abnormal Psychology</option>
                                    <option>Behavioral Psychology</option>
                                    <option>Biopsychology</option>
                                    <option>Cognitive Psychology</option>
                                    <option>Comparative Psychology</option>
                                    <option>Cross-Cultural Psychology</option>
                                    <option>Developmental Psychology</option>
                                    <option>Educational Psychology</option>
                                    <option>Experimental Psychology</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Claim Deadline</label>
                        <div class="col-md-8 input-group" >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <input type="text" required value="<?php echo($claim_deadline) ?>" id="datetimepicker1" placeholder="yyyy-mm-dd" name="claim_deadline" class="form-control input-md" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="due_date">Due Date</label>
                        <div class="col-md-8 input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar" ></span></span>
                            <input type="text" value="<?php echo($completion_deadline) ?>" id="datetimepicker2" placeholder="yyyy-mm-dd" name="completion_deadline" class="form-control input-md" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Decision Timeframe">Page Count</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-duplicate"></span></span>
                            <input id="no_pages" value="<?php echo($no_pages) ?>" name="no_pages" type="text" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Decision Timeframe">Word Count</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-stats"></span></span>
                            <input id="no_words" value="<?php echo($no_words) ?>" name="no_words" type="text" placeholder="" class="form-control input-md">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="control-group">
                                <label class="control-label">
                                    Upload a sample
                                </label>
                                <br>
                          </div>
                        </div>
                          <div class="col-md-8">
                              <input class="btn btn-primary"  id="document" value="Upload Image"name="document" type="file">
                              <span class="small">**Maximum file size is 8mb</span>
                          </div>
                    </div><br />

                    <div class="row">
                        <div class="col-xs-2">
                          <!-- Need to validate that file size < 8mb -->
                            <input type="submit" id="uploadsubmit" onclick="" name="uploadsubmit" class="btn btn-primary"></input>
                        </div>
                    </div>
                </form>
              </div>
          </div>
        </div>
      </div>
  </div>
</div>
  <!--^^ CONTAINER END ^^ -->


<!--JS-->
<script src="js/jquery.datetimepicker.full.js"></script>
<script>
    $(document).ready(function() {

        // $('#datetimepicker').datetimepicker();
        $("[id^='datetimepicker']").datetimepicker({
          timepicker:false,
          format:'Y-m-d'
        });

        // Tooltip function
        $("[id^='tooltip']").tooltip();


        // TAG selection function + validation
        $('.selectpicker').on('change', function() {
            var count = $(this).find("option:selected").length;
            if (count > 0 && count <= 4) {
                successInput(this);
            } else {
                failInput(this);
            }
        });

        function failInput(element) {
            id = element.id;
            var div = $("#" + id).closest("div");
            div.removeClass("has-success");
            $("#glypcn" + id).remove();
            div.addClass("has-error has-feedback");
            div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        }

        function successInput(element) {
            id = element.id;
            var div = $("#" + id).closest("div");
            div.removeClass("has-error");
            $("#glypcn" + id).remove();
            div.addClass("has-success has-feedback");
            div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
        }



        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();

            var controlForm = $('.controls:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="glyphicon glyphicon-minus"></span>');
        }).on('click', '.btn-remove', function(e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });
</script>



<!-- <center>
        <strong>Powered by <a href="http://j.mp/metronictheme" target="_blank">KeenThemes</a></strong>
    </center> -->

<?php require_once __DIR__. '/templates/footer.php'; ?>

</body>

</html>

<!--User Profile Sidebar by @keenthemes
    A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
    Licensed under MIT
    -->
<!-- Contact GitHub API Training Shop Blog About
© 2017 GitHub, Inc. Terms Privacy Security
 Download Formatting took: 157 ms PHP Formatter made by Spark Labs
Copyright Gerben van Veenendaal -->
