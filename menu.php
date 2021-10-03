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
    <h1>Menu</h1>
    <h2> Search </h2>
    <div class='searches'>
    <div class='search'>
    <!--name/phrase search-->
    <form action='menu.php' method='post'>
        <label for='search'> Search by name </label><br>
        <input type='text' name='search' id='search'>
        <input type='submit' name='submit' value='Search'>
    </form>
    <br>
    <?php
    if(isset($_POST['search'])) {
        $search = $_POST['search'];
        $search_query = "SELECT * FROM items WHERE itemName LIKE '%$search%' ORDER BY itemName";
        $search_result = mysqli_query($con, $search_query);
        $count = mysqli_num_rows($search_result);

        if($count==0) {
            echo "There were no search results!<br>";
        }
        else {
            while($row = mysqli_fetch_array($search_result)) {
                echo "<a href='item.php?id=".$row['itemID']."'><img src='images/".$row['itemImageName']."' alt='' class='searchitemimage'>" .$row ['itemName']."</a>";
                echo "<br>";
            }
        }
    }
    ?></div>
    <div class='search'>
    <!--item type search-->
    <form name='category_form' id='category_form' method='post'>
        <label for='category'> Search by category </label><br>
        <select id='category' name='category'>
            <!--options-->
            <option <?php if(isset($_POST['category']) && $_POST['category']=='SV'){echo "selected ";}?>value='SV'>Savoury</option>
            <option <?php if(isset($_POST['category']) && $_POST['category']=='SW'){echo "selected ";}?>value='SW'>Sweet</option>
            <option <?php if(isset($_POST['category']) && $_POST['category']=='CD'){echo "selected ";}?>value='CD'>Cold drinks</option>
            <option <?php if(isset($_POST['category']) && $_POST['category']=='HD'){echo "selected ";}?>value='HD'>Hot drinks</option>
            <option <?php if(isset($_POST['category']) && $_POST['category']=='FT'){echo "selected ";}?>value='FT'>Fruit</option>
        </select>

        <input type='submit' value='View category'>
    </form>
    <br>
    <?php
    if(isset($_POST['category'])) {
        $type_query = "SELECT * FROM items WHERE typeID = '".$_POST['category']."' ORDER BY itemName";
        $type_result = mysqli_query($con, $type_query);
        $type_item_count = mysqli_num_rows($type_result);
        if($type_item_count==0) {
            echo "There were no search results!";
        }
        else {
            while($type_record = mysqli_fetch_array($type_result)) {
                echo "<a href='item.php?id=".$type_record['itemID']."'><img src='images/".$type_record['itemImageName']."' alt='' class='searchitemimage'>" .$type_record ['itemName']."</a>";
                echo "<br>";
            }
        }

    }
    ?></div></div>

    <h2> All Items</h2>
    <form name='sort_form' id='sort_form' method='post'>
        <label for='sortby'> Sort by: </label>
        <select id='sortby' name='sortby'>
            <!--options-->
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='itemName ASC'){echo "selected ";}?>value='itemName ASC'>Name (A-Z)</option>
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='itemName DESC'){echo "selected ";}?>value='itemName DESC'>Name (Z-A)</option>
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='itemPrice ASC'){echo "selected ";}?>value='itemPrice ASC'>Price (low to high)</option>
            <option <?php if(isset($_POST['sortby']) && $_POST['sortby']=='itemPrice DESC'){echo "selected ";}?>value='itemPrice DESC'>Price (high to low)</option>
        </select>

        <input type='submit' value='Click to sort'>
    </form>
    <div class='all-items-container'>
    <?php

    if(isset($_POST['sortby'])){
        $sort_by = $_POST['sortby'];
    }
    else{
        $sort_by = 'itemName ASC';
    }

    $sort_items_query = "SELECT * FROM items ORDER BY ".$sort_by;
    $sort_items_result = mysqli_query($con, $sort_items_query);

    while($sort_items_record = mysqli_fetch_assoc($sort_items_result)) {
        echo "<div class='item'>";
        echo "<p><a href='item.php?id=".$sort_items_record['itemID']."&fromurl=".$_SERVER['REQUEST_URI']."'><img src='images/".$sort_items_record['itemImageName']."' alt='' class='allitemsimage'><br>" . $sort_items_record['itemName'] . " ";
        echo $sort_items_record['itemPrice'];
        echo "</a></div>\n";
    }
    ?></div>


</main>
</body>
</html>
