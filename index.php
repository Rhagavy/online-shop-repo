<!--
  Code contains html for the home page and the nav bar that uses php to check whether user is logged in
  and change the nav bar accordingly.
  
  I, Rhagavy Rakulan, 000802106 certify that this material is my original work.  
  No other person's work has been used without due acknowledgement. 

  Name: Rhagavy Rakulan, Student#: 000802106
  Date created: Sunday, December 6, 2020
-->
<?php

session_start();
?><!DOCTYPE html>
<html>
    <head>

    </head>
        <title>Nook's Cranny Express</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/onlineshop.css">
        <!--<script src="js/nookcranny.js"></script>-->
    <body>
        <nav>
            <div class="logo">
            <h1>Nook's Cranny Express</h1>
            </div>
            <!--<div>-->
            <ul class="navitems">
                <li id="home"><a href="index.php">Home</a></li>
                <li id="about"><a href="about.php">About Us</a></li>
                <?php
                    if(isset($_SESSION["userId"])){
                        echo "<li id='shop'><a href='shop.php'>Shop</a></li>";
                        echo "<li id='logout'><a href='server/logout.php'>Log out</a></li>";

                    }else{
                        echo "<li id='login'><a href='login.php'>Login</a></li>";
                        echo "<li id='register'><a href='register.php'>Register</a></li>";
                    }
                ?>
            </ul>
            <!--</div>-->
        </nav>
        <main>
            <div id="box1">
                <h1></h1>
            </div>
            <div id="box2">
                <h1>Welcome to Nook's Cranny Online Shop!!</h1>
            </div>
            <div id="box3">
                <h1></h1>
            </div>
        </main>
    </body>
</html>