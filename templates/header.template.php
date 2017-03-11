<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ReviUL
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="images/icon.ico">

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>


    <!-- ONLINE BOOTSTRAP FILES -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>

    <!-- ONLINE BOOTSTRAP SELECT FILES (FOR TAGS SELECTION) -->
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>




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
            <span class="sr-only">Toggle navigation
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
          </button>
          <a class="navbar-brand" href="#">RevIUL
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <!--   <li class="active"> - used to highlight current tab in menu bar -->
            <li><a href="<?php echo 'aboutus.php'; ?>">About Us</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <p class="navbar-text">Already have an account?
              </p>
            </li>
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
                      <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputEmail2">Email address
                          </label>
                          <input type="email" class="form-control" id="emailLogin" placeholder="Email address" required>
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2">Password
                          </label>
                          <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                          <div class="help-block text-right">
                            <a href="<?php echo 'profilepage.php'; ?>">Forget your password ?</a>
                          </div>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block">Sign in
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
