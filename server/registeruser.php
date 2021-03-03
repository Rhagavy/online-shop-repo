<?php
/**
 * Code will allow the user to create and account if the username doesn't already
 * exist
 * I, Rhagavy Rakulan, 000802106 certify that this material is my original work.  
* No other person's work has been used without due acknowledgement. 

* Name: Rhagavy Rakulan, Student#: 000802106
* Date created: Sunday, December 6, 2020
*/
//session_start();
include "connect.php";
//username
$username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
//stores password
$password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
//stores user's name
$repname = filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);

if($username!==""||$password!==""||$repname!==""){
    //check if username  doesn't exisit in database
    $command = "SELECT userName FROM islandrep WHERE userName = ?";
    $stmt = $dbh->prepare($command);
    $params = [$username];
    $success = $stmt->execute($params);
    //if username isn't in database then create user
    if ($stmt->rowCount()=== 0){
        $command2 = "INSERT into islandrep (repName, userName, userPassword) VALUES (?, ?, ?)";
        $stmt2 = $dbh->prepare($command2);
        $params2 = [$repname,$username,$password];
        $success2 = $stmt2->execute($params2);

        if($stmt2 -> rowCount()=== 1){
            //send back to register page with no error
            header("location: ../register.php?error=none");
        }else{
            //send back to register page with error
            header("location: ../register.php?error=tryagain");
        }

    }else{
        // else  user already exsist send user to sign-up page with error message
        header("location: ../register.php?error=usernameexist");
    }
    //header("location: ../login.php?error=none")
}else{
    //form field empty, send back user to sign-up page
    header("location: ../register.php?error=emptyuserinput");
}