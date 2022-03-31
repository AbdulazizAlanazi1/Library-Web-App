<?php
$db= mysqli_connect("localhost", "root", "", "librarysystem");
    $error = mysqli_connect_error();
    if($error != null)
      echo"Error: could not connect to database";
?>
