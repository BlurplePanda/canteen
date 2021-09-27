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
    <img src='images/wgclogotext.png' alt='WGC logo' class='center'>
    <nav>
        <a href='index.php' class='button'> Home </a>
        <a href='menu.php' class='button' id='current'> Menu </a>
        <a href='specials.php' class='button'> Specials </a>

    </nav>
</header>

<main>
    <!--search-->
    <h2> Search an item </h2>
    <form action='menu.php' method='post'>
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

    <h2> All Items</h2>
    <form name='sort_form' id='sort_form' method='post'>
        <label for='sortby'> Sort by: </label>
        <select id='sortby' name='sortby'>
            <!--options-->
            <option value='itemName ASC'>Name (A-Z)</option>
            <option value='itemName DESC'>Name (Z-A)</option>
            <option value='itemPrice ASC'>Price (low to high)</option>
            <option value='itemPrice DESC'>Price (high to low)</option>
        </select>

        <input type='submit' value='Click to sort'>
    </form>
    <?php

    if(isset($_POST['sortby'])){
        $sort_by = $_POST['sortby'];
    }
    else{
        $sort_by = 'itemName ASC';
    }

    $sort_items_query = "SELECT itemID, itemName, itemPrice FROM items ORDER BY ".$sort_by;
    $sort_items_result = mysqli_query($con, $sort_items_query);

    while($sort_items_record = mysqli_fetch_assoc($sort_items_result)) {
        echo "<p><a href='item.php?id=".$sort_items_record['itemID']."'>" . $sort_items_record['itemName'] . " ";
        echo $sort_items_record['itemPrice'];
        echo "</a>";
    }
    ?>


</main>
</body>
</html>
