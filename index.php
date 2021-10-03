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
              <a href='index.php' class='button' id='current'> Home </a>
              <a href='menu.php' class='button'> Menu </a>
              <a href='specials.php' class='button'> Specials </a>

          </nav>
      </header>

      <main>
          <h1>Welcome to Wellington Girls' College Canteen!</h1>
          <p>Here at Wellington Girls' College we strive to provide healthy yet tasty food for all the students.
              We offer a variety of food and drinks all for reasonable prices. Head to our <a href='menu.php'>menu page</a> to check out
              the products!</p>
          <img id='home-page-image' src='images/canteentuckshopimage.jpg' alt='Students queuing at a school canteen'>



      </main>
   </body>

</html>