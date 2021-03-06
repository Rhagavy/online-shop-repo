<?php
/**
 * Code will allow cart item's quntity to be decreased and will updated in 
 * the database
 * I, Rhagavy Rakulan, 000802106 certify that this material is my original work.  
* No other person's work has been used without due acknowledgement. 

* Name: Rhagavy Rakulan, Student#: 000802106
* Date created: Sunday, December 6, 2020
*/

include "connect.php";

//item's id is stored here
$item = filter_input(INPUT_GET,"item", FILTER_SANITIZE_STRING);
//user name stored
$userName = filter_input(INPUT_GET,"userName", FILTER_SANITIZE_STRING);

//param check
//$paramsok = false;
if($item!==null && $userName!==null) {
    //decrease quantity only until item reaches a quantity of one
    $command = "UPDATE shoppingcart  SET quantity = IF (quantity>1,quantity-1,quantity) WHERE itemId = ? AND userName = ?";
    $stmt = $dbh->prepare($command);
    $params = [$item,$userName];
    $success = $stmt->execute($params);
}else{
    echo "item and username are null!";
}