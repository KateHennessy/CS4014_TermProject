<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- JAVASCRIPT FOR AUTOCOMPLETE -->
    <!-- <script src="https://raw.githubusercontent.com/bassjobsen/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.min.js" /></script> -->
    <script src="js/typeahead.js"> </script>
    <!-- JQUERY UI FOR TAGS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>

    <!-- ONLINE BOOTSTRAP FILES -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <!-- LOCAL BOOTSTRAP FILES  -->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <script src="bootstrap/bootstrap.js"></script>

    <!-- Custom CSS FILES -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/typeahead.css">
</head>

<body>
    <!-- NAV BAR -->
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
        <div class="container-fluid background-image">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
                <a class="navbar-brand" href="#">RevIUL</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!--   <li class="active"> - used to highlight current tab in menu bar -->
                    <li><a href="<?php echo 'aboutus.php'; ?>">About Us</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form> -->
                <form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Menu</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                              <li><a href="<?php echo 'profilepage.php'; ?>">My Profile</a></li>
                              <li><a href="<?php echo 'information.php'; ?>">Information</a></li>
                              <li><a href="<?php echo 'changepassword.php'; ?>">Account Settings</a></li>
                                <div class="form-group">
                                    <!-- <input type="button" value="Log Out" class="btn-primary btn-block btn" onclick="window.location.href="<?php echo 'information.php'; ?>"> -->
                                    <button type="submit" class="btn btn-primary btn-block">Log Out</button>
                                </div>
                              </div>
                          </ul>
                      </li>
                  </ul>
              </form>
          </div>
      </div>
      <!-- /.navbar-collapse -->

      <!-- /.container-fluid -->
  </nav>

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
        <div class="panel-heading"><h2><strong>Analyze</strong><i> your paper</i></h2></div>
        <div class="panel-body">

          <!-- Standar Form -->
          <h4>Select files from your computer</h4>
          <form action="" method="post" enctype="multipart/form-data" id="js-upload-form">
            <div class="form-inline">
              <div class="form-group">
                <input type="file" name="files[]" id="js-upload-files" multiple>
              </div>
              <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button>
            </div>
          </form>

          <!-- Drop Zone -->
          <h4>Or drag and drop files below</h4>
          <div class="upload-drop-zone" id="drop-zone">
            Just drag and drop files here
          </div>

		   <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
              <span class="sr-only">60% Complete</span>
            </div>
          </div>

          <!-- Upload Finished -->
          <div class="js-upload-finished">
            <h3>Processed files</h3>
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>Task-1</a>
              <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>Task-2</a>
            </div>
          </div>

		  <!--upload form-->

		  <div class="container">
	<div class="row">
		<form class="form-horizontal">
<fieldset>

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
    <select id="Task description" name="Task description" class="form-control" multiple="multiple">
      <option value="1"></option>
      <option value="2"></option>
      <option value="3"></option>
      <option value="4"></option>
      <option value="5"></option>
      <option value=""></option>
    </select>
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
    <select id="Decision Timeframe" name="Decision Timeframe" class="form-control">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="">5</option>
    </select>
  </div>
</div>
<!--number input2-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Decision Timeframe">Word Count</label>
  <div class="col-md-5">
    <select id="Decision Timeframe" name="Decision Timeframe" class="form-control">
      <option value="1">50-100</option>
      <option value="2">100-200</option>
      <option value="3">200-300</option>
      <option value="4">300-400</option>
      <option value="">400-500</option>
    </select>
  </div>
</div>



<!-- Text input-->


<div class="row">

        <div class="form-group">
    		<label for="happy" class="col-sm-4 col-md-4 control-label text-right">Sample Of The Document Uploaded?</label>
    		<div class="col-sm-7 col-md-7">
    			<div class="input-group">
    				<div id="radioBtn" class="btn-group">
    					<a class="btn btn-primary btn-sm active" data-toggle="happy" data-title="Y">YES</a>
    					<a class="btn btn-primary btn-sm notActive" data-toggle="happy" data-title="N">NO</a>
    				</div>
					</div>
					<br>

<!-- Button -->


  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Submit</button>
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
