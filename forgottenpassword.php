<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- ONLINE BOOTSTRAP FILES -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <!-- LOCAL BOOTSTRAP FILES  -->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <script src="bootstrap/bootstrap.js"></script>

    <!-- Custom CSS FILES -->
    <link rel="stylesheet" href="css/style.css">
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

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <p class="navbar-text">Already have an account?</p>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                                <div class="help-block text-right"><a href="<?php echo 'index.php'; ?>">Register</a></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                        											               <input type="checkbox"> keep me logged-in
                        											 </label>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- <div class="bottom text-center">
                                        New here ? <a href="#"><b>Join Us</b></a>
                                    </div> Not neccessary here-->
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

    <!-- Main PAGE -->
    <div class="container-fluid">
        <div class="col-xs-11 col-sm-8 well">
            <div class="row">
                <h1><div class="glyphicon glyphicon-lock"></div> Forgotten Password </h1><br>
                <div class="col-xs-10">
                  <p> We'll send a new password to your email address </p>
                    <form>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Email Address</label>
                                <div><input type="email" onblur="validateEmail()" id="contactEmail" placeholder="Enter Email Address Here.." class="form-control"></div>
                            </div>
						</div>
                    <button type="button" class="btn btn-lg btn-success">Send me a new Password</button>
                </form>
				</div>
                </div>
            </div>
        </div>
    <script>
        // FUNCTION TO PROVIDE AUTO COMPLETE FOR TAGS
        $('[id^=tag]').typeahead({ //[id^=tag] -- anything starting with 'tag'
            // $('tag1').typeahead({
            local: ['Performing Arts', 'Visual Arts', 'Geography', 'History', 'Languages',
                'Literature', 'Philosophy', 'Economics', 'Law', 'Political Science', 'Psychology',
                'Sociology', 'Biology', 'Chemistry', 'Earth and Space Sciences', 'Mathematics',
                'Physics', 'Agricultural Sciences', 'Computer Science', 'Engineering and Technology',
                'Medicine and Health Sciences'
            ]
        });

        $('.tt-query').css('background-color', '#fff');


        function validateEmail() {
            id = "contactEmail";
            // var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
            var email_regex = /^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$/g; //ul.ie domain
            if (!email_regex.test($("#" + id).val())) {

                var div = $("#" + id).closest("div");
                div.removeClass("has-success");
                $("#glypcn" + id).remove();
                div.addClass("has-error has-feedback");
                div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
                return false;
            } else {
                var div = $("#" + id).closest("div");
                div.removeClass("has-error");
                $("#glypcn" + id).remove();
                div.addClass("has-success has-feedback");
                div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
                return true;
            }

        }
    </script>

</body>

</html>