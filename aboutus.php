    <?php
      session_start();
      $feedback = "";
        require_once __DIR__.'/models/User.class.php';
        require_once __DIR__.'/daos/UserDAO.class.php';
        require_once __DIR__."/utils/Settings.class.php";
        require_once __DIR__."/utils/PDOAccess.class.php";
        require_once __DIR__."/scripts/phpvalidation.php";
        ?>
        <!DOCTYPE html>
        <html lang="en">
          <head>
            <title>ReviUL-About Us
            </title>

              <?php


       if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
          $id = $_SESSION["user_id"];
          $user = new User();
          $user = UserDAO::getUserByID($id);
          require_once __DIR__.'/templates/loggedinuser.php';
       }else{
         require_once __DIR__.'/templates/header.template.php';
       }
        ?>

    <div class="container-fluid">
      <?php
      if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
         $id = $_SESSION["user_id"];
         echo '<div class="col-xs-12 well">';
         require_once __DIR__.'/templates/usersidebar.php';
         echo '<div class="col-md-9 profile-content">';
       }else{
         echo '<div class="col-xs-11 col-sm-8 well">
                <div class="profile-content">';

       }
        echo $feedback; ?>
                <h1><div class="glyphicon glyphicon-user"></div>About Us</h1><br>
                <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                            <div>
                              <img class="img-circle img-responsive" style="width:150px; height:150px;" src="images/kate_h.jpg" alt="">
                            </div>
                            <div>
                              <div>
                                <h4>Kate Hennessy</h4>
                              </div>
                              <div >
                                <p class="text-muted" align = "justify">
                                    Kate is currently studying for her Higher Diploma in Software Development at the Unviversity of Limerick.
                                    She attained a Bachelor of Science in Music Media and Performance Technology in 2015 at the University of Limerick.
                                </p>
                              </div>
                            </div>

                            <div class="col-md-offset-4">
                              <img class="img-circle img-responsive"  style="width:150px; height:150px;" src="images/orla_b2.jpg" alt="">
                            </div>
                            <div>
                              <div>
                                <h4>Orla Bonar</h4>
                              </div>
                              <div>
                                <p class="text-muted" align = "justify">
                                  Orla is currently studying for her Higher Diploma in Software Development at the Unviversity of Limerick.
                                  She has a Bachelor of Arts Degree from the National University of Ireland, Galway and a masters in Psychology
                                  from the University of Limerick.
                                </p>
                              </div>
                            </div>

                            <div class="col-md-offset-8">
                              <img class="img-circle img-responsive" style="width:150px; height:150px;" src="images/annie_ashok.jpg" alt="">
                            </div>
                            <div>
                              <div>
                                <h4>Mary Annie Vijula Ashok Kumar</h4>
                              </div>
                              <div>
                                <p class="text-muted" align = "justify">
                                    Annie is currently studying for her Higher Diploma in Software Development at the Unviversity of Limerick.
                                </p>
                              </div>
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
