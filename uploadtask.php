<?php
session_start();
    require_once __DIR__."/models/User.class.php";
    require_once __DIR__."/daos/UserDAO.class.php";
    require_once __DIR__ . '/models/Tag.class.php';
    require_once __DIR__.'/daos/TagDAO.class.php';
    require_once __DIR__."/models/Task.class.php";
    require_once __DIR__."/daos/TaskDAO.class.php";
    require_once __DIR__."/models/Discipline.class.php";
    require_once __DIR__."/daos/DisciplineDAO.class.php";
    require_once __DIR__. '/scripts/phpvalidation.php';

class UploadVal{
    public static function fileUploaded()
  {
      if(empty($_FILES)) {
          return false;
      }
      $file = $_FILES['uploaded_document'];
      if(!file_exists($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])){
          return false;
      }
      return true;
  }
}

$feedback = "";
if (isset($_SESSION[ "user_id"]) &&
$_SESSION[ "user_id"] !='' ){
   $id = $_SESSION[ "user_id"];
   $user = new User();
   $user = UserDAO::getUserByID($id);
   $uploadFormOK = true;
   if(isset($_POST["uploadsubmit"])) {
     $creator_id = $id;
     $title = htmlspecialchars(ucfirst($_POST["task_title"]));
     $type =  htmlspecialchars(ucfirst($_POST["task_type"]));
     $description = htmlspecialchars(ucfirst($_POST["description"]));
     $no_pages = htmlspecialchars(ucfirst(trim($_POST["no_pages"])));
     $no_words = htmlspecialchars(ucfirst(trim($_POST["no_words"])));
     $tags = array();
     if(isset($_POST["tags"])){
         $tags = $_POST["tags"];
         if(count($tags) < 1){
           $feedback .=phpvalidation::displayFailure("No tags selected. Please select between 1 and 4 Tags for your task");
           $uploadFormOK = false;
         }else if(count($tags) > 4){
           $feedback .=phpvalidation::displayFailure("Too many tags selected. Please select between 1 and 4 Tags for your task");
           $uploadFormOK = false;
         }
     }else{
       $feedback .=phpvalidation::displayFailure("Please select between 1 and 4 Tags for your task");
       $uploadFormOK = false;
     }

     if(!is_null(TaskDAO::find_task($creator_id, $title)->get_id())){
       $feedback .= phpvalidation::displayFailure("You have already created a task with this title");
       $uploadFormOK = false;
     }
     if(!phpvalidation::isValidDate($_POST["claim_deadline"]) || !phpvalidation::isValidDate($_POST["completion_deadline"])){
       $feedback.= phpvalidation::displayFailure('Date entered in invalid format.');
       $uploadFormOK = false;
     }
     if(!is_numeric($no_pages)){
       $feedback.= phpvalidation::displayFailure('Please enter a number for Number of Pages.');
       $uploadFormOK = false;
     }
     $claim_deadline = date('Y-m-d H:i:s',strtotime($_POST["claim_deadline"]." 23:59:00"));
     $completion_deadline = date('Y-m-d H:i:s',strtotime($_POST["completion_deadline"]." 23:59:00"));
     if($claim_deadline < date('Y-m-d H:i:s', time())){
       $uploadFormOK = false;
       $feedback.= phpvalidation::displayFailure('You have entered a past date for your Claim Deadline.');
     }
     if($completion_deadline < $claim_deadline){
       $uploadFormOK = false;
       $feedback.= phpvalidation::displayFailure('You have entered a Due Date that is closer than your Claim Deadline.');
     }
  if(strlen($title) < 1){
       $feedback.= phpvalidation::displayFailure('Please enter the task title.');
       $uploadFormOK = false;
     }
     if(strlen($title) > 128){
         $feedback.= phpvalidation::displayFailure('Task title is too long.');
         $uploadFormOK = false;
       }
   if(strlen($type) < 1){
       $feedback.= phpvalidation::displayFailure('Please enter the task type.');
       $uploadFormOK = false;
     }
     if(strlen($type) > 128){
        $feedback.= phpvalidation::displayFailure('Task Type is too long.');
        $uploadFormOK = false;
      }
  if(strlen($description) < 1){
       $feedback.= phpvalidation::displayFailure('Please enter the description.');
       $uploadFormOK = false;
     }
     if(strlen($description)> 600){
         $feedback.= phpvalidation::displayFailure('Description is too long.');
         $uploadFormOK = false;
       }
   if(!is_numeric($no_pages)){
       $feedback.= phpvalidation::displayFailure('Please enter the number of pages.');
       $uploadFormOK = false;
     }
  if(!is_numeric($no_words)){
       $feedback.= phpvalidation::displayFailure('Please enter the number of words.');
       $uploadFormOK = false;
     }
      if($uploadFormOK){            // first checking if file uploaded is ok before progressing with rest of task upload
        if(UploadVal::fileUploaded()){
         require_once __DIR__.'/scripts/upload_file.php';
        //  if($uploadOk == 1){
          if($uploadOk != 1){   //uploadOk is a variable in upload_file - which returns 1 if uploading file was successful
            $uploadFormOK = false;
          }
        }else{
          phpvalidation::displayFailure('Please upload a sample file');
          $uploadFormOK = false;
        }
     }
      if($uploadFormOK){        //extension and target file coming from upload_File
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
        header("Location: uploadtask.php?uploadedOK=1");


      }
    }
 }
 if(isset($_GET["uploadedOK"])){
   if($_GET["uploadedOK"] == 1){
     $feedback = phpvalidation::displaySuccess('Task Uploaded Successfully');
   }else{
      $feedback = phpvalidation::displayFailureSubtext('There was an error uploading your task', 'If the issue persists please contact the system administrator');
   }
 }
 }else {
   header( "location:./register.php");
    }
  ?>
  <!DOCTYPE html>
  <html lang="en">
     <head>
        <title>ReviUL-Upload Task
        </title>
        <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css" />
   <?php
    require_once __DIR__ . '/templates/loggedinuser.php';
   ?>
   <!-- CONTAINER START -->
          <div class="container-fluid">
             <div class="col-xs-12 well">
               <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

         <?php
   require_once __DIR__. '/templates/usersidebar.php';
   ?>
      <script src="js/jquery.datetimepicker.full.js"></script>
        <div class="col-md-9 profile-content">
            <div class="" id="overview">
                <div class="">
                    <div class="container">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2><strong>Upload</strong><i> your task</i></h2>

                            </div>
                            <div class="panel-body">
                              <noscript> <div class="alert alert-warning">

                            <p>  <i class="glyphicon glyphicon-alert"></i> Please enable javascript for best user experience</p></div></noscript>
                                <?php echo($feedback);
                                    ?>
                                <br>
                                <br>
                                <legend>Fill in the form:</legend>
                <form  method="post" id="uploadForm"  enctype="multipart/form-data">

                      <div class="form-group has-feedback">
                        <label class="col-md-4 control-label" for="File Type">Task Name
                                        <button id="tooltip1" type="button" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="Please note, this name must be unique and you must have not previously uploaded a task of the same name."> ?</span>
                                        </button>
                        </label>
                          <div class="input-group">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                              <input id="task_title" required name="task_title" type="text" maxlength="128"  placeholder="" class="form-control input-md">
              								<span class="glyphicon form-control-feedback"></span>
              					 </div>
              							<span class="help-block with-errors"></span>
                    </div>

        						<div class="form-group has-feedback">
        							<label class="col-md-4 control-label" for="">Task Type
                                    <button id="tooltip1" type="button" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="This is the type of document you are putting up for review. Examples include Master's Assignment, Undergraduate Project, PHD Thesis, etc."> ?</span>
                                    </button>
        							</label>
        							<div class="col-md-8 input-group">
        								<span class="input-group-addon"><span class="glyphicon glyphicon-book"></span></span>
        								<input id="task_type" name="task_type" type="text" required maxlength="128" class="form-control input-md">
        								<span class="glyphicon form-control-feedback"></span>
        							</div>
        							<div>
        								<span class="help-block with-errors"></span>
        							</div>
        						</div>


                    <div class="row has-feedback">
                    <div class="form-group has-feedback">
                        <label class="col-md-4 control-label" for="Task Description">Brief Description Of The Task</label>
                        <div class="col-md-8">
                            <textarea id="description"  name="description" maxlength="599" required placeholder="Give a brief description of your task.." style="height:200px" style="overflow:scroll; padding-box"></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                        </div>
                        <span class="help-block with-errors"></span>
                  </div>

        			</div>

              <!-- <div class="row"> -->
        						<div class="form-group has-feedback">
              								<label class="col-md-4 control-label">Tags <em class="text-danger"> *</em>
                                  <button id="tooltip2" type="button" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="These tags will help people find your tasks. Please use tags close to your task's area.">
                                      <span class="text-white"> ?</span>
                                  </button>
              								</label>
                          <div class="input-group" id="tags">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span></span>
                                <select class="selectpicker" id="tagsSelect" name="tags[]" data-width="fit" multiple data-selected-text-format="count > 1" data-max-options="4" name="tags">
                                  <?php
                                  //$allDisciplines = array();
                                  $allDisciplines = DisciplineDAO::find_all_disciplines();

                                  foreach($allDisciplines as $aDisc){
                                    echo '<optgroup label = "' .$aDisc->get_name() .'">';
                                    // echo ('<optgroup label="Computer Science">');
                                      $availTags = array();
                                      $availTags = TagDAO::find_all_tags_in_discipline($aDisc->get_id());
                                      foreach($availTags as $aTag){
                                        echo'<option>' .$aTag->get_name() .'</option>';
                                        // echo '  <option>Graphics</option>';
                                      }
                                    echo '</optgroup>';
                                  }  ?>

              							 </select>
                        </div>

              				  <noscript>
              				    <div class="input-group" style="min-width:65%">
                  				  <select class="custom-select" name="tags[]" required multiple>
                  						  <?php
                                      $allDisciplines = DisciplineDAO::find_all_disciplines();
                                      foreach($allDisciplines as $aDisc){
                                        echo '<optgroup label = "' .$aDisc->get_name() .'">';
                                          $availTags = array();
                                          $availTags = TagDAO::find_all_tags_in_discipline($aDisc->get_id());
                                          foreach($availTags as $aTag){
                                            echo'<option>' .$aTag->get_name() .'</option>';
                                          }
                                        echo '</optgroup>';
                                      }  ?>
                  						</select>
                						</div>
              						</noscript>
                  </div>

                  <div class="form-group has-feedback">
                      <label class="col-md-4 control-label" for=" ">Claim Deadline</label>
                      <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          <input type="text" required  id="datetimepicker1" name="claim_deadline" placeholder="yyyy-mm-dd" data-dateCheck="1" class="form-control input-md" />
                      </div>
                        <span class="help-block with-errors"></span>
                  </div>
        	 <!-- </div> -->

           <!-- <div class="row"> -->
        						<div class="form-group has-feedback">
                        <label class="col-md-4 control-label" for=" ">Due Date</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <input type="text" required id="datetimepicker2" name="completion_deadline"  placeholder="yyyy-mm-dd" data-dateCheck="1" class="form-control input-md" />
                        </div>
                          <span class="help-block with-errors"></span>
                    </div>


        						  <div class="form-group has-feedback">
                          <label class="col-md-4 control-label" for=" ">Page Count</label>
                          <div class="input-group">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-duplicate"></span></span>
                              <input id="no_pages"  required name="no_pages" type="text" maxlength="15" class="form-control input-md">
              								<span class="glyphicon form-control-feedback"></span>
              					</div>
              							<span class="help-block with-errors"></span>
                    </div>

        						<div class="form-group has-feedback">
                          <label class="col-md-4 control-label" for="no_words">Word Count</label>
                          <div class="input-group">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-stats"></span></span>
                              <input id="no_words"  required name="no_words" type="text" maxlength="15"  placeholder="" class="form-control input-md">
          				            <span class="glyphicon form-control-feedback"></span>
          							</div>
          							<span class="help-block with-errors"></span>
                  </div>


                  <div class="form-group has-feedback" style="width:100%" id="document">
                        <label class="col-md-4 control-label">Preview Document</label>
                        <div class="col-md-8 input-group" >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
                            <!-- <input id="no_words"  required name="no_words" type="text" maxlength="15"  placeholder="" class="form-control input-md"> -->
                            <label class="input-group-btn" value="">
                                <span class="btn btn-primary input-md" style="z-index:3; margin-right:-5px;">
                                    Browse
                                    <input id="uploaded_document" value=""
                                      style="display:none"  name="uploaded_document" data-filecheck type="file" minLength=1 class="form-control input-md">
                                </span>
                            </label>
                            <label type="text" class="form-control has-feedback" style="overflow:auto; ">
                              <span id="fileName" style=""></span>
                              <span class="glyphicon form-control-feedback"  style="z-index:3; background-color:white;"></span>
                            </label>
                      </div>

                      <span class="help-block with-errors"></span>

                </div>
                <noscript>
                  <div class="form-group has-feedback" >
                        <label class="col-md-4 control-label">Preview Document</label>
                  <div class="input-group">
                    <label class="">
                      <input type="file"  name="uploaded_document" id="file" required class="">
                      <span class="custom-file-control"></span>
                  </label>
                </div>
              </label>
            </div>
              </noscript>


                        <div class="row">
                            <div class="col-xs-2">

                                <input type="submit" id="uploadsubmit"  name="uploadsubmit" class="btn btn-lg btn-success"></input>
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
              </div>
          </div>
       </div>
     </div>
   </div>
</div>



<br />

<!--JS-->

<script>
    $(document).ready(function() {
		 $("#tags").show();
     $("#tagsSelect").attr('required','');      //adding this as chrome having issues with these hidden elements when js disabled if required set in above html

		 $("#discipline").show();
     $("#disciplineSelect").attr('required','');


    $("#document").css('display', 'table');
    // $("#document").find('label').addClass('col-md-4');
    //  $("#document").find('.form-control').css('float','none');      //float left being applied by .less on displaying

     $("#uploaded_document").attr('required','');

     $("#uploadForm").validator({
          custom: {
            filecheck: function ($el){
              var maxKilobytes = 8 * 1024 * 1024;
              var acceptableTypes = "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document".split(',');
              if($el[0].files.length > 0){
                if ($.inArray($el[0].files[0].type, acceptableTypes) == -1) {
                  return "Invalid File Type"
                }
                if($el[0].files[0].size > maxKilobytes){
                  return "Please upload a file smaller than 8MB."
                }
                }else{
              }
            },
            dateCheck: function($el){
              // Checking datetimepickers to make sure selected dates are not past dates
              var today = new Date();
              var inputed = $el.val();
              var parts =inputed.split('-');
              var mydate =  new Date(parts[0],parts[1]-1,parts[2], 23,59);
              if(mydate < today){
                return "Cannot enter past date"
              }
              // If we are in the due date input, check if the due date is after the claim deadline
              if($el[0].id == "datetimepicker2"){
                var firstparts =  $("#datetimepicker1").val().split('-');
                var firstdate =  new Date(firstparts[0],firstparts[1]-1,firstparts[2], 23,59);
                if(mydate <= firstdate){
                  return "Due date must be after Claim Deadline";
                }
              }
            }
          }
        });

          //bootstrap input-group button modified from https://www.abeautifulsite.net/whipping-file-inputs-into-shape-with-bootstrap-3
      //We can attach the `fileselect` event to all file inputs on the page
       $(document).on('change', ':file', function() {
         var input = $(this),
             numFiles = input.get(0).files ? input.get(0).files.length : 1,
             label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
         input.trigger('fileselect', [numFiles, label]);
       });
       // We can watch for our custom `fileselect` event like this
       $(':file').on('fileselect', function(event, numFiles, label) {
                $("#fileName").text(label);
       });
      $("[id^='datetimepicker']").datetimepicker({
          timepicker:false,
          format:'Y-m-d'
        });



        // Tooltip function
        $("[id^='tooltip']").tooltip();
    });
</script>
<br>
<br>

<?php require_once __DIR__. '/templates/footer.php'; ?>

</body>

</html>
