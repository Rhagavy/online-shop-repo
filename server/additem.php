<?php
/**
 * Code will allow item to be added to database. If the item is already in user's
 * cart the quantity will be increase by one instead of adding the item again.
 * I, Rhagavy Rakulan, 000802106 certify that this material is my original work.  
* No other person's work has been used without due acknowledgement. 

* Name: Rhagavy Rakulan, Student#: 000802106
* Date created: Sunday, December 6, 2020
*/
include "connect.php";
//item's name is stored here
$item = filter_input(INPUT_GET,"item", FILTER_SANITIZE_STRING);
$userName = filter_input(INPUT_GET,"userName", FILTER_SANITIZE_STRING);
//param check
$paramsok = false;
if($item!==null && $userName!==null){
    $paramsok = true;
    // get itemId using the itemName
    $command = "SELECT itemId FROM product WHERE itemName = ?";
    $stmt = $dbh->prepare($command);
    $params = [$item];
    $success = $stmt->execute($params);

    if($success){
        $row = $stmt->fetch();
        $itemId = $row[0];
        echo $itemId;
        //check to see if item is already in cart table
        $command2 = "SELECT cartId FROM shoppingcart WHERE itemId = ? AND userName = ?";
        $stmt2 = $dbh->prepare($command2);
        $params2 = [$itemId,$userName];
        $success2 = $stmt2->execute($params2);

        if($stmt2->rowCount()===1){
            //update quantity
            $command3 = "UPDATE shoppingcart SET quantity = quantity+1 WHERE itemId = ? AND userName = ?";
            $stmt3 = $dbh->prepare($command3);
            $params3 = [$itemId,$userName];
            $success3 = $stmt3->execute($params3);

        }else{
            //INSERT item to cart
            $quantity = 1;
            $command4 = "INSERT into shoppingcart (itemId,userName,quantity) VALUES (?, ?, ?)";
            $stmt4 = $dbh->prepare($command4);
            $params4 = [$itemId,$userName,$quantity];
            $success4 = $stmt4->execute($params4);

            if ($stmt4->rowCount()===1){
                echo "Inserted new item to cart table";
            }else{
                echo "Unable to insert item to cart table";
            }

        }

    }else{
        echo "failed to select item";
    }

}else{
    echo "failed to add item to cart,something is null";
}