<!--
  Code contains html for the login page form and the nav bar that uses php to check whether user is logged in
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
                <li id="home"><a href="index.php">Home</a></li>
                <li id="about"><a href="about.php">About Us</a></li>
                <?php
                //check if user is logged in
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
                    <h1>Log in, to shop!</h1>
                    <form id="login-form" action="server/verifyuser.php" method="post">
                        <div class="txt_field">
                        <input type="text" name="username" placeholder="Your username...">
                        </div>
                        <div class="txt_field">
                        <input type="password" name="password" placeholder="Your password...">
                        </div>
                        <div class="txt_field">
                        <input type="submit" value="Log-in">
                        </div>

                    </form>
                    <?php
                    //check to see if there's a error and display appropriate message
                        if (isset($_GET["error"])){
                            if ($_GET["error"]=="emptyuserinput"){
                                echo "<p>All fields must be filled...</p>";
                            }else if ($_GET["error"]=="logininfoincorrect"){
                                echo "<p>Double check login info...</p>";
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="box3">
                <h1></h1>
            </div>
        </main>
<!-- 
        <script>
            document.getElementById("login-form").addEventListener("submit", function (event) {
                event.preventDefault();

                if (event.target.username.value === "") {
                    // username is empty, do something
                }
            })

        </script> -->
    </body>
</html>