<!--
  Code contains html for the register page form and the nav bar that uses php to check whether user is logged in
  and change the nav bar accordingly. The page will show an error message based on user's
  input
  
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
                <li id="home"><a href="home.php">Home</a></li>
                <li id="about"><a href="#">About Us</a></li>
                <?php
                //check to see if user is logged in
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
                <div class="centerit">
                    <h1>Not a member? Register!</h1>
                    <form class="register" action="server/registeruser.php" method="post">
                        <div class="txt_field">
                        <input class="form__input" type="text" name="name" placeholder="Your name...">
                        </div>
                        <div class="txt_field">
                        <input class="form__input" type="text" name="username" placeholder="Your username...">
                        </div>
                        <div class="txt_field">
                        <input class="form__input" type="password" name="password" placeholder="Your password...">
                        </div>
                        <input type="submit" value="Register!">

                    </form>
                    <?php
                    //check to see if there's a error and display appropriate message
                        if (isset($_GET["error"])){
                            if ($_GET["error"]=="emptyuserinput"){
                                echo "<p>All fields must be filled...</p>";
                            }else if ($_GET["error"]=="usernameexist"){
                                echo "<p>Username already taken...</p>";
                            }else if ($_GET["error"]=="tryagain"){
                                echo "<p>Something went wrong! Please try again later...</p>";
                            }else if ($_GET["error"]=="none"){
                                echo "<p>Account was created!</p>";
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="box3">
                <h1></h1>
            </div>
        </main>
    </body>
</html>