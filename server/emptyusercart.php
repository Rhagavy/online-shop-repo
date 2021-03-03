<?php
/**
 * Code will allow user to purchase cart item, which will delete everything
 * from the shopping cart table that belongs to this user
 * I, Rhagavy Rakulan, 000802106 certify that this material is my original work.  
* No other person's work has been used without due acknowledgement. 

* Name: Rhagavy Rakulan, Student#: 000802106
* Date created: Sunday, December 6, 2020
*/

include "connect.php";
//store's username
$userName = filter_input(INPUT_GET,"userName", FILTER_SANITIZE_STRING);

//param check
//$paramsok = false;
if($userName!==null){
    //delete this specific user's cart
    $command = "DELETE FROM shoppingcart WHERE userName = ?";
    $stmt = $dbh->prepare($command);
    $params = [$userName];
    $success = $stmt->execute($params);
    //check
    echo $row = $stmt->rowCount();
}else{
    echo "item and username are null!";
}