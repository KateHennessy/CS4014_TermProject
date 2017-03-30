

    <?php
      session_start();
        require_once __DIR__.'/models/User.class.php';
        require_once __DIR__.'/daos/UserDAO.class.php';
        require_once __DIR__."/utils/Settings.class.php";
        require_once __DIR__."/database/DatabaseQueries.php";
        require_once __DIR__."/utils/PDOAccess.class.php";

        if(isset($_POST["login_button"])){
         $email = trim(strtolower($_POST["email"]));
         $password = $_POST["password"];
         $user = new User();
         $user = UserDAO::login($email, $password);

         if(!is_null($user)){
           $_SESSION["user_id"] = $user->get_id();
          header("location:./profilepage.php");
         }else{
           header("location:./register.php");
         }
       }

       if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
         $id = $_SESSION["user_id"];
         ?>
          <!-- <div class="container-fluid">
         <div class="col-xs-12 well"> -->
         <!DOCTYPE html>
         <html lang="en">
           <head>
             <title>ReviUL-About Us
             </title>

               <?php
        require_once __DIR__.'/templates/loggedinuser.php';
         // echo("ID: " .$id);
       } else {
         // echo("In else " .$_SESSION["user_id"]);
         ?>

               <?php
            require_once __DIR__.'/templates/header.template.php';
       }
        ?>

    <div class="container-fluid">
        <div class="col-xs-11 col-sm-8 well">
            <div class="profile-content">
                <h1><div class="glyphicon glyphicon-user"></div>About Us</h1><br>

                <div class="container">
                    <div class="row">
                      <div class="col-lg-12">



                            <div>
                              <img class="img-circle img-responsive" src="images/help.jpg" alt="">
                            </div>
                            <div>
                              <div>
                                <h4>Orla Bonar</h4>
                              </div>
                              <div>
                                <p class="text-muted">
                                  Orla is currently studying for her Higher Diploma in Software Development at the Unviversity of Limerick.
                                  She has a Bachelor of Arts Degree from the National University of Ireland, Galway and a masters in Psychology
                                  from the University of Limerick.
                                </p>
                              </div>
                            </div>

                            <div>
                              <img class="img-circle img-responsive" src="images/kate_h.jpg" alt="">
                            </div>
                            <div>
                              <div>
                                <h4>Kate Hennessy</h4>
                              </div>
                              <div>
                                <p class="text-muted">
                                    Kate is currently studying for her Higher Diploma in Software Development at the Unviversity of Limerick.
                                </p>
                              </div>
                            </div>

                            <div>
                              <img class="img-circle img-responsive" src="images/annie_ashok.jpg" alt="">
                            </div>
                            <div>
                              <div>
                                <h4>Mary Annie Vijula Ashok Kumar</h4>
                              </div>
                              <div>
                                <p class="text-muted">
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
