<?php
	require_once __DIR__.'/daos/UserDAO.class.php';
	$title = "Logout";
  $userDao = new UserDAO();
  $userDao->logout();
  header("location:./register.php");

	?>
