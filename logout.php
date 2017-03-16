<?php
	require_once __DIR__.'/daos/UserDAO.class.php';
	$title = "Logout";
 ?>

<?php
                    $userDao = new UserDAO();
                    $userDao->logout();
										header("location:./register.php");
                ?>

<?php include(__DIR__."/templates/footer.template.php"); ?>
