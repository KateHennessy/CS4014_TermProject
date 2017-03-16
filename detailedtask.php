<?php
    session_start();

    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
      $id = $_SESSION["user_id"];
      // echo("ID: " .$id);
    } else {
      // echo("In else " .$_SESSION["user_id"]);
        header("location:./register.php");
    }
?>


<?php
    require_once __DIR__.'/templates/loggedinuser.php';
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    require_once __DIR__.'/templates/usersidebar.php';
    ?>



                <div class="col-md-9 profile-content">
                    <div class="" id="overview">
                        <div class="">
                <!--<div class="col-md-9">
                    <div class="profile-content" id="overview">
                        <div class="profile-content">
                            <div class="container-fluid" style="background-color:#e8e8e8">
                                <div class="col-xs-12"> -->

                                    <div class="row">
                                        <div class="col-sm-6 col-md-12">
                                            <h2>Methods in Empirical Pyschology</h2>
                                        </div>
                                    </div>
                                    <br />

                                    <!--detailed task starts -->
                                    <!--<div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Methods in Empirical Pyschology</h3>
            </div>
            <div class="panel-body">
              <div class="row"> -->


                                    <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                                    <div class=" col-sm-6 col-md-12 ">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <td>Task Type:</td>
                                                    <td>PhD Thesis</td>
                                                </tr>
                                                <tr>
                                                    <td>Brief Description:</td>
                                                    <td>A study investigating the best methods for carrying out psychological research by testing both qualitative and quantative approaches.</td>
                                                </tr>
                                                <tr>
                                                    <td>Tags:</td>
                                                    <td>Empricial Psychology, Research, Experiments</td>
                                                </tr>

                                                <tr>
                                                    <tr>
                                                        <td>Number of Pages:</td>
                                                        <td>35</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Number of Words:</td>
                                                        <td>18000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Document Type:</td>
                                                        <td>.docx</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Preview</td>
                                                        <td><a href="">Click Here For Preview</a></td>
                                                    </tr>
                                                </tr>

                                            </tbody>
                                        </table>

                                        <!--  <a href="#" class="btn btn-primary">My Sales Performance</a>
                  <a href="#" class="btn btn-primary">Team Sales Performance</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <!--<a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i> Message To Claim Task</a> -->
                                <span class="pull-right">
                            <!--<a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a> -->
                            <a data-original-title="Claim" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-check"></i>Claim Task</a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-flag"></i> Flag Task</a>
                        </span>
                        <br />

                                <!--</div> -->
                                <!--End of detailed task section-->

                                <!--</div> -->

                                <!-- Contact Me Section -->
                                <div>
                                    <h2>Message To Claim Task</h2>
                                </div>

                                <!-- <div class="container"> -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="well well-sm">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name" placeholder="Enter name" required="required" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">My Email Address</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                                                <input type="email" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Message</label>
                                                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required" placeholder="Message"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <!--<button type="submit" class="btn  pull-right" id="btnContactUs"> Send Message</button> -->
                                                        <a data-original-title="Submit" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary pull-right"><i class="glyphicon glyphicon-envelope"></i>Send Message</a>
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


            <?php
            require_once __DIR__.'/templates/footer.php';
            ?>

          </body>
          </html>
