
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="images/icon.ico">

   

    <!-- STYLESHEETS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!-- ONLINE BOOTSTRAP SELECT FILES (FOR TAGS SELECTION) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <!-- Custom CSS FILES -->
    <link rel="stylesheet" href="css/style.css">
    
	
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
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
          </button>
          <a class="navbar-brand" href="index.php">RevIUL
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">





          <ul class="nav navbar-nav navbar-right">
            <li>
              <p class="navbar-text">Already have an account?
              </p>
            </li>

            <?php

              // if (isset($_POST["e"]) && isset($_POST["p"])
              //   && trim($_POST["e"]) !='' && trim($_POST["p"]) != ''  ){
              //       try {
              //           $email = trim(strtolower($_POST["e"]));
              //           $password = $_POST["p"];
              //           $userDao = new UserDAO();
              //           $user = $userDao->login($email, $password);
              //
              //           if (!is_null($user)) {
              //               $_SESSION['user_id'] = $user->get_id();
              //               header("Location:./index.php");
              //           } else {
              //               printf("<h2> Password incorrect or account not found. </h2>");
              //           }
              //       } catch (Exception $exception) {
              //           printf("Connection error: %s", $exception->getMessage());
              //       }
              //   }
              ?>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <b>Login
                </b>
                <span class="caret">
                </span>
              </a>
              <ul id="login-dp" class="dropdown-menu">
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
                          <input type="password" name="password" class="form-control" id="passwordLogin" placeholder="Password" required>
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
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"> keep me logged-in
                          </label>
                        </div>
                      </form>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
