<?php
if (!isset ($_SESSION)) {
session_start();
$_SESSION[“user_id”] = $id;
}
if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
  header('Location: loggedinuser.php');
}
?>
