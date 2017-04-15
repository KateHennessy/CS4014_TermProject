    <base href="http://localhost/CS4014_TermProject/" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="images/icon.ico">

    <!--  CSS FILES -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">                            <!-- ONLINE BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">  <!-- ONLINE BOOTSTRAP SELECT FILES (FOR TAGS SELECTION) -->
    <link rel="stylesheet" href="css/style.css">                                                                                 <!-- LOCAL CUSTOM CSS SHEET-->


    <!-- JAVASCRIPT FILES -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>                                <!-- ONLINE JQUERY -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>                               <!-- ONLINE BOOTSTRAP JS FILES -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>           <!-- ONLINE BOOTSTRAP SELECT FILES -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

  </head>
  <body>
    <!-- NAV BAR -->
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
      <div class="container-fluid background-image">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

          <label type="button" class="navbar-toggle collapsed" for="menuToggle" data-toggle="collapse" data-target="#userMenu">
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
          </label>

          <a class="navbar-brand" href="index.php">RevIUL
          </a>
        </div>  <input type="checkbox" id="menuToggle" style="display:none"/>

            <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="userMenu">
          <form method="post" action="./logout.php">
                 <!--Menu bar on right hand side of nav bar -->
             <ul class="nav navbar-nav navbar-custom">
				<li><a href="<?php echo 'profilepage.php'; ?>">My Profile</a></li>

				<li><a href="<?php echo 'accountsettings.php'; ?>">Account Settings</a></li>
				<li><button type="submit" class="btn btn-primary btn-lg btn-block">Log Out</button>

         </form>
         </div>
        </div>
    </nav>
