<!--
  Code contains html for the items users can buy and the nav bar that uses php to check whether user is logged in
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
        <link rel="stylesheet" href="css/storepage.css">
        <script src="js/nookcranny.js"></script>
    <body>
        <nav>
            <div class="logo">
            <h1>Nook's Cranny Express</h1>
            </div>
            <!--<div>-->
            <ul class="navitems">
                <li id="home"><a href="index.php">Home</a></li>
                <li id="about"><a href="about.php">About Us</a></li>
                <li id="shop"><a href="shop.php">Shop</a></li>
                <li id="logout"><a href="server/logout.php">Logout</a></li>
            </ul>
            <!--</div>-->
        </nav>
        <main>
            <div id="box1">
                <?php
                //check to see if user is logged in and change nav items accordingly 
                if(isset($_SESSION["userId"])){ 
                    ?>
                    <h1>Welcome,</h1>
                    <h1 id="username"><?=$_SESSION["userId"]?></h1>
                <?php
                }else{
                    ?>
                    <h1>You are not logged in!</h1>
                    <?php
                }
                ?>
            </div>
            <div id="box2">
                <div id="product">
                    <div class="item">
                    <img src="images/apple2.png" alt="apple">
                    <p>Apple - 100 bells</p>
                    <button id="apple" class="button">Add To Cart</button>
                    </div>

                    <div class="item">
                    <img src="images/pumpkin4.png" alt="pumpkin">
                    <p>Pumpkin - 120 bells</p>
                    <button id="pumpkin" class="button">Add To Cart</button>
                    </div>

                    <div class="item">
                    <img src="images/grass1.png" alt="grass">
                    <p>Grass - 140 bells</p>
                    <button id="grass" class="button">Add To Cart</button>
                    </div>

                    <div class="item">
                    <img src="images/shovel1.png" alt="shovel">
                    <p>Shovel - 140 bells</p>
                    <button id="shovel" class="button">Add To Cart</button>
                    </div>

                    <div class="item">
                    <img src="images/pear2.png" alt="pear">
                    <p>Pear - 160 bells</p>
                    <button id="pear" class="button" >Add To Cart</button>
                    </div>

                    <div class="item">
                    <img src="images/umbrella1.png" alt="umbrella">
                    <p>Umbrella - 180 bells</p>
                    <button id="umbrella" class="button">Add To Cart</button>
                    </div>
                </div>
            </div>
            <div id="cart">
                <h1>Your Cart...</h1>
                <!--<h3 id="cartisempty"></h3>-->
                <div id="cartofuser"></div>

                <div id="costinfo">
                    <h3 id="total"></h3>
                    <button id="buycart">Buy items!</button>

                </div>
            </div>
        </main>
    </body>
</html>