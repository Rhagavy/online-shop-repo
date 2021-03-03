<?php
/**
 * Code will allow the user to be verified based on their input and the information
 * in the user table
 * I, Rhagavy Rakulan, 000802106 certify that this material is my original work.  
* No other person's work has been used without due acknowledgement. 

* Name: Rhagavy Rakulan, Student#: 000802106
* Date created: Sunday, December 6, 2020
*/

session_start();
include 'connect.php';
//user's input for user name
$username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
//user's input for password
$password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);

if($username!==""||$password!==""){
    //check database to see if this user exists
    $command = "SELECT userName FROM islandrep WHERE userName = ? AND userPassword = ?";
    $stmt = $dbh->prepare($command);
    $params = [$username,$password];
    $success = $stmt->execute($params);

    //if check is successful then  check if password matches and set: $_SESSION["username]= $username
    if ($stmt->rowCount()=== 1){
        $_SESSION["userId"] = $username;
        header("location: ../index.php");
    }else{
        // else send user to sign-up page with error message
        header("location: ../login.php?error=logininfoincorrect");
    }
    // else send user to sign-up page with error message
    //header("location: ../login.php?error=userdoesntexist")
}else{
    //send back user to sign-up page-fields are empty
    header("location: ../login.php?error=emptyuserinput");
}
