<?php
/**
 * Code will allow the user's items in their cart to be pulle from the database
 * I, Rhagavy Rakulan, 000802106 certify that this material is my original work.  
* No other person's work has been used without due acknowledgement. 

* Name: Rhagavy Rakulan, Student#: 000802106
* Date created: Sunday, December 6, 2020
*/
include "connect.php";
//item's name is stored here
//$item = filter_input(INPUT_GET,"item", FILTER_SANITIZE_STRING);
$userName = filter_input(INPUT_GET,"userName", FILTER_SANITIZE_STRING);
//param check
$paramsok = false;
$userItems = [];
//if($item!==null && $userName!==null){
if($userName!==null){
    $paramsok = true;
    $command ="SELECT itemId,quantity FROM shoppingcart WHERE userName = ?";
    $stmt = $dbh->prepare($command);
    $params = [$userName];
    $success = $stmt->execute($params);
    //echo $stmt->rowCount();
    
    if ($success){
        while ($row = $stmt->fetch()){
            $addedItem =[
                "itemId"=> $row["itemId"],
                "quantity" => (int)$row["quantity"]
            ];
            array_push($userItems,$addedItem);
        }
        
        //var_dump(count($userItems));
    }

    // $command = "SELECT itemId, price FROM product WHERE itemName = ?";
    // $stmt = $dbh->prepare($command);
    // $params = [$item];
    // $success = $stmt->execute($params);

    // if($success){
    //     $row = $stmt->fetch();
    //     $itemId = $row[0];
    //     //$itemPrice = $row[1];
    //     //check to see if item is already in cart table
    //     $command2 = "SELECT itemId,quantity FROM shoppingcart WHERE itemId = ? AND userName = ?";
    //     $stmt2 = $dbh->prepare($command2);
    //     $params2 = [$itemId,$userName];
    //     $success2 = $stmt2->execute($params2);
    //     if($stmt2->rowCount()===1){
    //         //store item in array
    //         while ($row = $stmt2->fetch()){
    //             $addedItem = [
    //                 "itemId"=> $row["itemId"],
    //                 "quantity" => (int)$row["quantity"]

    //             ];
    //         }
    //         array_push($selectedItem,$addedItem);
    //     }
        
    // }
}//echo
echo json_encode($userItems);