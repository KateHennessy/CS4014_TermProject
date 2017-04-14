<?php
require_once __DIR__."/../daos/TaskDAO.class.php";

if(isset($_POST["login_button"])){
  $email = trim(strtolower($_POST["email"]));
  $password = $_POST["password"];
  $user = new User();
  $user = UserDAO::login($email, $password);

  if(!is_null($user)){
    $banned = UserDAO::find_user_in_banned($user -> get_id());
        if($banned){
          $feedback = ' <h3 class="alert alert-danger alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <img class="center-block" src= "http://i3.kym-cdn.com/entries/icons/facebook/000/006/725/desk_flip.jpg" style = "width: 180px; height: 180px;" /><br /> <br />
          <i class="glyphicon glyphicon-alert"></i> You have been banned for inappropriate content.
          Contact administration with any issues. </h3> <br /><br />';
        }else{
          TaskDAO::update_all_task_statuses();
          $_SESSION["user_id"] = $user->get_id();

         header("location:./profilepage.php");
       }
  }else{
   //  header("location:./register.php");
   $feedback = ' <h3 class="alert alert-danger alert-dismissable">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
   <i class="glyphicon glyphicon-alert"></i> Incorrect email or password. </h3> <br /><br />';
  }

}?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="images/icon.ico">

    <!-- ONLINE BOOTSTRAP FILES -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <!-- ONLINE BOOTSTRAP SELECT FILES (FOR TAGS SELECTION) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">




    <!-- Custom CSS FILES -->
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/typeahead.css"> -->

	 <!-- SCRIPTS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

  </head>


  <body>

    <!-- NAV BAR -->
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
        <div class="container-fluid background-image">


          <a href="index.php" class="navbar-brand">ReviUL </a>

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-right">

                <p class="navbar-text hidden-xs">Already have an account?
                </p>

                  <label for="openLogin" class="navbar-text">
                    <b>Login</b>
                    <span class="caret">
                    </span>
                  </label>

                <input type="checkbox" id="openLogin" style="display:none;"/>

                <ul class="dropdown-menu" id="login-dp" style="">
                  <li>
                    <div class="row">
                      <div class="col-md-12">
                        <form class="form" role="form" method="post" data-toggle="validator" accept-charset="UTF-8" id="login-nav">
                          <div class="form-group has-feedback">
                            <label class="sr-only" for="email">Email address
                            </label>
                            <input type="email" name ="email" class="form-control" pattern="^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$" id="emailLogin" placeholder="Email address" required>
                            <span class="glyphicon form-control-feedback"></span>
                            <span class="help-block with-errors"></span>
                          </div>

                          <div class="form-group has-feedback">
                              <label class="sr-only" for="password">Password
                              </label>
                              <input type="password" name="password" class="form-control" id="passwordLogin" placeholder="Password" data-minLength="5" required>
                              <span class="glyphicon form-control-feedback"></span>
                              <span class="help-block with-errors"></span>

                              <div class="small text-right">
                                <a href="<?php echo 'forgottenpassword.php'; ?>">Forget your password ?</a>
                              </div>
                              <div class="small text-right">
                                <a href="<?php echo 'register.php'; ?>">Sign Up</a>
                              </div>
                          </div>
                          <div class="form-group">
                            <button type="submit" name="login_button" class="btn btn-primary btn-block">Sign in
                            </button>
                          </div>
                        </form>
                      </div>
                  </div>
                 </li>
               </ul>
      </div>
    </div>
  <!-- </div> -->


      <!-- /.container-fluid -->
    </nav>
