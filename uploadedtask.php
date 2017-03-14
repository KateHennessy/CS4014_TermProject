<?php
    require_once __DIR__.'/templates/header.template.php';
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
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
                              <li><a href="<?php echo 'profilepage.php'; ?>"><i class="glyphicon glyphicon-home"></i> Overview </a></li>
                              <li><a href="<?php echo 'changepassword.php'; ?>"><i class="glyphicon glyphicon-user"></i> Account Settings </a></li>
                              <li class="active"><a href="<?php echo 'uploadedtask.php'; ?>"><i class="glyphicon glyphicon-share"></i> Upload a Task</a> </li>
                              <li><a href="<?php echo 'availabletasks.php'; ?>"><i class="glyphicon glyphicon-search"></i>Available Tasks </a> </li>
                              <li><a href="<?php echo 'information.php'; ?>"><i class="glyphicon glyphicon-flag"></i> Information </a></li>
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
        <div class="panel-heading"><h2><strong>Upload</strong><i> your paper</i></h2></div>
        <div class="panel-body">

          <!-- multiple upload -->
         <div class="col-md-12">
      <div class="row">
      <div class="control-group" id="fields">
          <label class="control-label" for="field1">
            Select a sample file from your computer
          </label> <br>
          <div class="controls">

              <div class="entry input-group col-xs-3">


                <input class="btn btn-primary" name="fields[]" type="file">
                <span class="input-group-btn">
              <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                </button>
                </span>
              </div>

          </div>

        </div>
      </div>
    </div>


    <!-- JS-->



   <br><br>
<!-- Form Name -->
<legend>Fill in the form:</legend>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="File Type">File Type</label>
  <div class="col-md-5">
  <input id="File Type" name="File Type" type="text" placeholder="" class="form-control input-md">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Task Type">Task Type</label>
  <div class="col-md-5">
  <input id="Task Type" name="Task Type" type="text" placeholder="" class="form-control input-md">

  </div>
</div>

<!-- Select Multiple -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Task Description">Brief Description Of The Task</label>
  <div class="col-md-5">
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px" style="overflow:scroll"></textarea>
</textarea>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Decision Timeframe">Tags To Describe The Task</label>
  <div class="col-md-5">
    <select id="Decision Timeframe" name="Decision Timeframe" class="form-control">
      <option value="1">Select One</option>
      <option value="2">As soon as possible</option>
      <option value="3">1 to 3 months</option>
      <option value="4">3 to 6 months</option>
      <option value="">6+ months</option>
    </select>
  </div>
</div>


<!--number input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Decision Timeframe">Page Count</label>
  <div class="col-md-5">
  <input id="Task Type" name="Task Type" type="text" placeholder="" class="form-control input-md">
  </div>
</div>
<!--number input2-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Decision Timeframe">Word Count</label>
  <div class="col-md-5">
  <input id="Task Type" name="Task Type" type="text" placeholder="" class="form-control input-md">
</div>
</div>



</form> <br><br>
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Submit</button>
    <div class="col-md-7"></div>
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
        $(function()
{
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
Contact GitHub API Training Shop Blog About
© 2017 GitHub, Inc. Terms Privacy Security
