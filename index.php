<?php

                session_start();


            if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
                header("location:./profilepage.php");
            } else {
                if (isset($no_access)) { // need to set this up for moderators
                    //header("location:./signup.php");   could change this to "sorry not found page"
                } else {
                    header("location:./register.php");
                }

            }
		  ?>
