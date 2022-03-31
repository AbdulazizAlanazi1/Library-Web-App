<?php
include "connection.php";
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

   $myEmail = mysqli_real_escape_string($db,$_POST['email']);
   $sql = "SELECT People_Type FROM library_people WHERE Email = '$myEmail'";

   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result);
   $People_Type = $row['People_Type'];
   
   $count = mysqli_num_rows($result);
   
     
   if($count == 0) {
      header("location: index.php");
   }else {
       if($row['People_Type'] == 1){
        $_SESSION['TypeID'] = 1;
        header("location: Librarian.php");
       }
       else if($row['People_Type'] == 2){
        $_SESSION['TypeID'] = 2;
        header("location: Member.php");
       }
       else if($row['People_Type'] == 3){
        $_SESSION['TypeID'] = 3;
        header("location: Author.php");
       }
}
}

?>
