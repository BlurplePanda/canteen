<?php
$con = mysqli_connect("localhost", "bootham", "richpatch76", "bootham_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

?><!DOCTYPE html>

<html lang='en'>

<head>
    <title> Wellington Girls' College Canteen </title>
    <meta charset='utf-8'>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
<header>
    <img src='images/wgclogotext.png' alt='WGC logo' class='center'>
    <nav>
        <a href='index.php' class='button'> Home </a>
        <a href='menu.php' class='button'> Menu </a>
        <a href='specials.php' class='button'> Specials </a>

    </nav>
</header>

<main>
    <h1> Item Information </h1>

    <?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $this_item_query = "SELECT items.*, typeName FROM items, itemtypes WHERE itemID = '".$id."' AND items.typeID = itemtypes.typeID";
        $this_item_result = mysqli_query($con, $this_item_query);
        $this_item_record = mysqli_fetch_assoc($this_item_result);
        echo "<p>Item Name: ".$this_item_record['itemName'];
        echo "<p>Item description: ".$this_item_record['itemDescription'];
        echo "<p>Type: ".$this_item_record['typeName'];
        echo "<p>Cost: $".$this_item_record['itemPrice'];
        echo "<p>Availability: ";
        if($this_item_record['itemInStock']==1){
            echo "In stock!";
        }
        else{
            echo "Not in stock, sorry :(";
        }

    }

    else {
        echo "<p>You have to choose an item!";
    }


    ?>

    <p><a href="menu.php">Back to menu</a>


</main>
</body>
</html>
