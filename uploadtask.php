

<?php
require_once __DIR__ . '/templates/header.template.php';
require_once __DIR__ . '/models/User.class.php';
require_once __DIR__ . '/models/Tag.class.php';
?>

  <!-- User Side Bar -->
  <div class="container-fluid">
      <div class="col-xs-12 well">
          <!-- <div class="row profile"> -->
              <div class="col-md-3 adapt">
                  <div class="profile-sidebar">

                      <!-- SIDEBAR USER TITLE -->
                      <div class="profile-usertitle">
                          <div class="profile-usertitle-name">Marcus Doe</div>
                          <div class="profile-usertitle-job">General User</div>
                      </div>

                      <!-- END SIDEBAR USER TITLE -->

                      <!-- USER REPUTATION -->

                      <div class="text text-center">
                          <label class="text-muted"><i class="glyphicon glyphicon-star"></i><var>21</var> Reputation Score</label>
                      </div>

                      <!-- END USER REPUTATION -->

                      <!-- Start User Tags -->


                      <div class="text text-center">

                          <label class="text-muted">  <i class="glyphicon glyphicon-tags"></i>  <var>4</var> Total Number of Tasks Uploaded</label>
                      </div>


                      <!-- SIDEBAR MENU -->
                      <div class="profile-usermenu">
                          <ul class="nav">
                              <li><a href="<?php
echo 'profilepage.php';
?>"><i class="glyphicon glyphicon-home"></i> Overview </a></li>
                              <li><a href="<?php
echo 'changepassword.php';
?>"><i class="glyphicon glyphicon-user"></i> Account Settings </a></li>
                              <li class="active"><a href="<?php
echo 'uploadedtask.php';
?>"><i class="glyphicon glyphicon-share"></i> Upload a Task</a> </li>
                              <li><a href="<?php
echo 'availabletasks.php';
?>"><i class="glyphicon glyphicon-search"></i>Available Tasks </a> </li>
                              <li><a href="<?php
echo 'information.php';
?>"><i class="glyphicon glyphicon-flag"></i> Information </a></li>
                          </ul>
                      </div>

                      <!-- END MENU -->
                    </div>
                    </div>
                    <!-- </div> -->

                    <div class="col-md-9 profile-content">
                        <div class="" id="overview">
                            <div class="">


<!-- upload -->
                <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading"><h2><strong>Upload</strong><i> your task</i></h2></div>
        <div class="panel-body">


    <!-- JS-->



   <br><br>
<!-- Form Name -->
<legend>Fill in the form:</legend>


<div class="form-group">
  <label class="col-md-4 control-label" for="File Type">Task Name</label>
  <div class="col-md-8">
  <input id="task_name" name="task_name" type="text" placeholder="" class="form-control input-md">

</div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Task Type">Task Type  <button id="tooltip1" type="button" class="btn btn-primary btn-circle"
    data-toggle="tooltip" data-placement="bottom"
    data-original-title="This is the type of document you are putting up for review. Examples include Master's Assignment, Undergraduate Project, PHD Thesis, etc."> ?</span>
    </button></label>

  <div class="col-md-8">
  <input id="Task Type" name="Task Type" type="text" placeholder="" class="form-control input-md">

  </div>
</div>

<!-- Select Multiple -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Task Description">Brief Description Of The Task</label>
  <div class="col-md-8">
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px" style="overflow:scroll"></textarea>
</textarea>
  </div>
</div>

<!-- Select Basic -->
<div class="row">
  <div class="form-group">
    <label class="col-md-4">Tags <em class="text-danger"> *</em>
      <button id="tooltip2" type="button" class="btn btn-primary btn-circle"
      data-toggle="tooltip" data-placement="bottom"
      data-original-title="These tags will help people find your tasks. Please use tags close to your task's area.">
        <span class="text-white"> ?</span>
      </button></label>

    <!-- <input class="form-control autocomplete" placeholder="Tag 1" /> -->
    <div class="col-md-8">
      <!-- <input class="form-control" name="tag1" id="tag1" placeholder="Enter 1st Tag..." type="text"> -->
      <select class="selectpicker" data-width="95%" id="bootstrap-select" name="tags[]" data-width="fit" multiple
      data-selected-text-format="count > 1" data-max-options="4"
      required="required" name="tags">
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

</div>

<div class="row">
<!--number input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Decision Timeframe">Page Count</label>
  <div class="col-md-8">
  <input id="Task Type" name="Task Type" type="text" placeholder="" class="form-control input-md">
  </div>
</div>
<!--number input2-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Decision Timeframe">Word Count</label>
  <div class="col-md-8">
  <input id="Task Type" name="Task Type" type="text" placeholder="" class="form-control input-md">
</div>
</div>
</div>

<div class="col-md-12">
      <div class="row">
      <div class="control-group" id="fields">
          <label class="control-label" for="field1">
            Select files from your computer
          </label> <br>
          <div class="controls">

              <div class="entry input-group col-xs-3">


                <input class="btn btn-primary" name="fields[]" type="file">
                <span class="input-group-btn">

                </span>
              </div>

          </div>

        </div>
      </div>
    </div>


<!-- <div class="panel panel-default">
  <div class="panel-heading"><strong>Upload Files</strong> <small>Bootstrap files upload</small></div>
  <div class="panel-body">

    Standar Form
    <h4>Select files from your computer</h4>
    <form action="" method="post" enctype="multipart/form-data" id="js-upload-form">
      <div class="form-inline">
        <div class="form-group">
          <input type="file" name="files[]" id="js-upload-files" multiple>
        </div>
        <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button>
      </div>
    </form>

    Drop Zone
    <h4>Or drag and drop files below</h4>
    <div class="upload-drop-zone" id="drop-zone">
      Just drag and drop files here
    </div> -->

    <!-- Progress Bar -->
    <!-- <div class="progress">
      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
        <span class="sr-only">60% Complete</span>
      </div>
    </div> -->

    <!-- Upload Finished -->
    <!-- <div class="js-upload-finished">
      <h3>Processed files</h3>
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-01.jpg</a>
        <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-02.jpg</a>
      </div>
    </div> -->

  </div>
</div>



 <div class="row">
   <div class="col-xs-2">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Submit</button>
  </div>
  </div>

  </div>
  </div>


</fieldset>
</form>

    </div>





          <!-- Progress Bar -->

        </div>
      </div>
    </div> <!-- /container -->

            </div>

        </div>


        <br />

        <!--JS-->
        <script>
        $(document).ready(function(){

// Tooltip function
     $("[id^='tooltip']").tooltip();


// TAG selection function + validation
  $('.selectpicker').on('change', function () {
    var count = $(this).find("option:selected").length;
    if(count > 0 && count <= 4){
      successInput(this);
    }else{
      failInput(this);
    }
  });

  + function($) {
    'use strict';

    // UPLOAD CLASS DEFINITION
    // ======================

    var dropZone = document.getElementById('drop-zone');
    var uploadForm = document.getElementById('js-upload-form');

    var startUpload = function(files) {
        console.log(files)
    }

    uploadForm.addEventListener('submit', function(e) {
        var uploadFiles = document.getElementById('js-upload-files').files;
        e.preventDefault()

        startUpload(uploadFiles)
    })

    dropZone.ondrop = function(e) {
        e.preventDefault();
        this.className = 'upload-drop-zone';

        startUpload(e.dataTransfer.files)
    }

    dropZone.ondragover = function() {
        this.className = 'upload-drop-zone drop';
        return false;
    }

    dropZone.ondragleave = function() {
        this.className = 'upload-drop-zone';
        return false;
    }

}(jQuery);


  function failInput(element){
    id = element.id;
    var div = $("#" + id).closest("div");
    div.removeClass("has-success");
    $("#glypcn" + id).remove();
    div.addClass("has-error has-feedback");
    div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
  }

  function successInput(element){
    id = element.id;
    var div = $("#" + id).closest("div");
    div.removeClass("has-error");
    $("#glypcn" + id).remove();
    div.addClass("has-success has-feedback");
    div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
  }



    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
      $(this).parents('.entry:first').remove();

        e.preventDefault();
        return false;
    });
});
</script>



   <!-- <center>
        <strong>Powered by <a href="http://j.mp/metronictheme" target="_blank">KeenThemes</a></strong>
    </center> -->
    <br>
    <br>
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