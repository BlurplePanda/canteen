<?php
$con = mysqli_connect("localhost", "bootham", "richpatch76", "bootham_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}

$specials_query = "SELECT weekDay, items.* FROM specials, items WHERE specials.itemID = items.itemID";
$specials_result = mysqli_query($con, $specials_query);

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
        <a href='specials.php' class='button' id='current'> Specials </a>

    </nav>
</header>

<main>
    <h1>Specials</h1>
    <p>Huge deal: half price on the specified item on each day!
    <?php
    while($specials_record = mysqli_fetch_assoc($specials_result)){
        echo "<p>".$specials_record['weekDay'].": ";
        echo "<p><a href='item.php?id=".$specials_record['itemID']."&fromurl=".$_SERVER['REQUEST_URI']."'><img src='images/".$specials_record['itemImageName']."' class='allitemsimage'><p>".$specials_record['itemName']."</a>";
        echo "<p>Discounted price: $".sprintf("%.2f\n", $specials_record['itemPrice']*0.5)." (50% off!)";
    }
    ?>

</main>
</body>
</html>
