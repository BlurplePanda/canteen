<?php
$con = mysqli_connect("localhost", "bootham", "richpatch76", "bootham_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

$all_items_query = "SELECT itemID, itemName FROM items";
$all_items_result = mysqli_query($con, $all_items_query);

?><!DOCTYPE html>

<html lang='en'>

<head>
    <title> Wellington Girls' College Canteen </title>
    <meta charset='utf-8'>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>

<header>
    <img src='images/wgclogotext.png' class='center'>
    <nav>
        <a href='index.php' class='button'> Home </a></li>
        <a href='menu.php' class='button' id='current'> Menu </a></li>
        <a href='specials.php' class='button'> Specials </a></li>

    </nav>
</header>

<main>
    <h2> All Items</h2>
    <form name='sort_form' id='sortby' method='post'>
        <label for='sortby'> Sort by: </label>
        <select id='sortby' name='sortby'>
            <!--options-->
            <option value='itemName'>Name</option>
            <option value='itemPrice'>Price</option>
        </select>

        <input type='submit' value='Sort'>
    </form>
    <?php

    if(isset($_POST['sortby'])){
        $sort_by = $_POST['sortby'];
    }
    else{
        $sort_by = 'itemName';
    }

    $sort_items_query = "SELECT itemID, itemName, itemPrice FROM items ORDER BY ".$sort_by;
    $sort_items_result = mysqli_query($con, $sort_items_query);

    while($sort_items_record = mysqli_fetch_assoc($sort_items_result)) {
        echo "<p><a href='item.php?id=".$sort_items_record['itemID']."'>" . $sort_items_record['itemName'] . " ";
        echo $sort_items_record['itemPrice'];
        echo "</a>";
    }
    ?>



    <!--search-->
    <h2> Search an item </h2>
    <form action='' method='post'>
        <input type='text' name='search'>
        <input type='submit' name='submit' value='Search'>
    </form>

    <?php
    if(isset($_POST['search'])) {
        $search = $_POST['search'];
        $query1 = "SELECT * FROM items WHERE itemName LIKE '%$search%'";
        $query = mysqli_query($con, $query1);
        $count = mysqli_num_rows($query);

        if($count==0) {
            echo "There were no search results!";
        }
        else {
            while($row = mysqli_fetch_array($query)) {
                echo $row ['itemName'];
                echo "<br>";
            }
        }
    }
    ?>

</main>
</body>
</html>
