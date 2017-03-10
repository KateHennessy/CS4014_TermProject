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
                              <li><a href="<?php echo 'detailedtask.php'; ?>">My Tasks</a></li>
                              <li><a href="<?php echo 'information.php'; ?>">Information</a></li>
                              <li><a href="<?php echo 'changepassword.php'; ?>">Account Settings</a></li>
                                <div class="form-group">
                                    <input type="button" value="Log Out" class="btn-primary btn-block btn" onclick="window.location.href="<?php echo 'information.php'; ?>">
                                </div>
                  </form>

            <!-- <div class="bottom text-center">
                                        New here ? <a href="#"><b>Join Us</b></a>
                                    </div> Not neccessary here-->
        <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


<!-- User Side Bar -->
    <div class="container-fluid">
    <div class="col-xs-12 well">
  <!--   <div class="row profile"> -->
    <div class="col-md-3 adapt">
    <div class="profile-sidebar">

<!-- SIDEBAR USER TITLE -->
    <div class="profile-usertitle">
    <div class="profile-usertitle-name">Marcus Doe</div>
    <div class="profile-usertitle-job">General User</div>
    </div>

<!-- END SIDEBAR USER TITLE -->

<!-- SIDEBAR BUTTONS -->
    <div class="profile-userbuttons">
        <!--<button type="button" class="btn btn-success btn-sm">Follow</button> -->
        <button type="button" class="btn btn-danger btn-sm">Message</button>
    </div>

<!-- END SIDEBAR BUTTONS -->

<!-- SIDEBAR MENU -->
    <div class="profile-usermenu">
        <ul class="nav">
            <li><a href="<?php echo 'profilepage.php'; ?>"><i class="glyphicon glyphicon-home"></i> Overview </a></li>
            <li><a href="<?php echo 'changepassword.php'; ?>"><i class="glyphicon glyphicon-user"></i> Account Settings</a></li>
            <li><a href="<?php echo 'detailedtask.php'; ?>"><i class="glyphicon glyphicon-check"></i> Tasks </a></li>
            <li><a href="<?php echo 'detailedtask.php'; ?>"><i class="glyphicon glyphicon-ok"></i> Claimed Tasks </a> </li>
            <li><a href="<?php echo 'uploadedtask.php'; ?>"><i class="glyphicon glyphicon-share"></i> Upload a Task</a> </li>
            <li><a href="<?php echo 'availabletasks.php'; ?>"><i class="glyphicon glyphicon-search"></i>Available Tasks </a> </li>
            <li class="active"><a href="<?php echo 'information'; ?>"><i class="glyphicon glyphicon-flag"></i> Information </a></li>
        </ul>
    </div>

<!-- END MENU -->
        </div>
        </div>
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
