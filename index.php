<?php
            if (!isset ($_SESSION)) {
                session_start();
            }

            if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
                printf("<li><a href=\"./sell.php\" class=\"\">Sell</a></li>");
                printf("<li><a href=\"./logout.php\" class=\"\">Logout</a></li>");
            } else {
                if (isset($no_access)) { // need to set this up for moderators
                    header("location:./signup.php");
                } else {
                    header("location:./signup.php");
                }

            }
		  ?>
