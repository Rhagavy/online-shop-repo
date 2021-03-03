<?php
/**
 * Include this to connect. Change the dbname to match your database,
 * and make sure your login information is correct after you upload 
 * to csunix or your app will stop working.
 * 
 * Name: Rhagavy Rakulan, Student#: 000802106
 * Date created: Monday, November 30, 2020
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=000802106",
        "root",
        ""
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}