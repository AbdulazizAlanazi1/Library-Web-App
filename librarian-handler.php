<?php
include "connection.php";
session_start();

if(isset($_SESSION['TypeID'])){
   if($_SESSION['TypeID'] != 1){
       header("location: index.php");
   }
}
else{
   header("location: index.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
   // Handling adding book
   if($_POST['functionality'] == 1){
      $ISBN = mysqli_real_escape_string($db,$_POST['ISBN']);
      $title = mysqli_real_escape_string($db,$_POST['title']);
      $year = mysqli_real_escape_string($db,$_POST['year']);
      $subjectName = mysqli_real_escape_string($db,$_POST['subjectName']);
      $subjectID = mysqli_real_escape_string($db,$_POST['subjectID']);
      $barcode = mysqli_real_escape_string($db,$_POST['barcode']);
      $copies = mysqli_real_escape_string($db,$_POST['copies']);
      $shelf = mysqli_real_escape_string($db,$_POST['shelf']);
      $language = mysqli_real_escape_string($db,$_POST['language']);
      $authors = $_POST['authors'];

      $sql = "INSERT INTO Subject VALUES (".$subjectID.", '".$subjectName."')";
      if (mysqli_query($db,$sql) === TRUE) {
        $_SESSION['err']=0;
       } else {
        $_SESSION['err']=1;
         echo "Error: " . $sql . "<br>" . $db->error;
       }
       $sql = "INSERT INTO Book VALUES ('".$ISBN."','".$title."','".$language."',".$copies.",".$subjectID.",'Y',".$year.")";
       if (mysqli_query($db,$sql) === TRUE) {
        $_SESSION['err']=0;
       } else {
        $_SESSION['err']=1;
         echo "Error: " . $sql . "<br>" . $db->error;
       }

       $sql = "INSERT INTO Book_Item VALUES ('".$barcode."','".$ISBN."',".$copies.",'Y','".$shelf."')";
       if (mysqli_query($db,$sql) === TRUE) {
        $_SESSION['err']=0;
         echo "New record created successfully";
       } else {
        $_SESSION['err']=1;
         echo "Error: " . $sql . "<br>" . $db->error;
       }

       $N = count($authors);
       for($i=0; $i < $N; $i++){
         $sql = "INSERT INTO Book_Author VALUES ('".$ISBN."','".$authors[$i]."')";
         mysqli_query($db,$sql);
    }
         header("location: Librarian.php");
 
}

   // Handling remove book
   if($_POST['functionality'] == 2){
      $remove = $_POST['removeDD'];
      $N = count($remove);
      for($i=0; $i < $N; $i++){
        $sql = "DELETE FROM Book_Author WHERE ISBN_Code='".$remove[$i]."'";
        mysqli_query($db,$sql);
        $sql = "DELETE FROM Book_Item WHERE ISBN_Code='".$remove[$i]."'";
        mysqli_query($db,$sql);
        $sql = "DELETE FROM Book WHERE ISBN_Code='".$remove[$i]."'";        
        if (mysqli_query($db,$sql) === TRUE) {
          $_SESSION['err']=0;
         } else {
          $_SESSION['err']=1;
           echo "Error: " . $sql . "<br>" . $db->error;
         }
   }
   header("location: Librarian.php");
  
   }

   // Edit book
   if($_POST['functionality'] == 3){
    $ISBN = mysqli_real_escape_string($db,$_POST['ISBN']);
    $title = mysqli_real_escape_string($db,$_POST['title']);
    $year = mysqli_real_escape_string($db,$_POST['year']);
    $subjectID = mysqli_real_escape_string($db,$_POST['subjectID']);
    $copies = mysqli_real_escape_string($db,$_POST['copies']);
    $language = mysqli_real_escape_string($db,$_POST['language']);
    $isAvailable = mysqli_real_escape_string($db,$_POST['isAvailable']);

    $sql = "UPDATE Book SET Book_Title='".$title."', Publication_Year=".$year.",No_of_Copies=".$copies.",Book_Language='".$language."' ,Is_Available='".$isAvailable."' WHERE ISBN_Code='".$ISBN."'";

    if (mysqli_query($db,$sql) === TRUE) {
      $_SESSION['err']=0;
      echo "Record edited successfully";
    } else {
      $_SESSION['err']=1;
      echo "Error: " . $sql . "<br>" . $db->error;
    }
    header("location: Librarian.php");
   }

   // Add member
   if($_POST['functionality'] == 4){
    $PeopleID = mysqli_real_escape_string($db,$_POST['PeopleID']);
    $FName = mysqli_real_escape_string($db,$_POST['FName']);
    $LName = mysqli_real_escape_string($db,$_POST['LName']);
    $BirthDate = mysqli_real_escape_string($db,$_POST['BirthDate']);
    $Department = mysqli_real_escape_string($db,$_POST['Department']);
    $Number = mysqli_real_escape_string($db,$_POST['Number']);
    $Email = mysqli_real_escape_string($db,$_POST['Email']);
    $sex = $_POST['sex'];
    $PeopleType = $_POST['PeopleType'];

    $sql = "INSERT INTO Library_People VALUES ('".$PeopleID."','".$FName."','".$LName."',".$PeopleType.",'".$BirthDate."','".$sex."','".$Department."','".$Number."','".$Email."')";
    if (mysqli_query($db,$sql) === TRUE) {
      $_SESSION['err']=0;
     } else {
      $_SESSION['err']=1;
       echo "Error: " . $sql . "<br>" . $db->error;
     }
     header("location: Librarian.php");
   }

  // cancel member
   if($_POST['functionality'] == 5){
    $PeopleID = mysqli_real_escape_string($db,$_POST['member']);

    $sql = "UPDATE Library_People SET People_Type='5' WHERE People_ID='".$PeopleID."'";
    if (mysqli_query($db,$sql) === TRUE) {
      $_SESSION['err']=0;
     } else {
      $_SESSION['err']=1;
       echo "Error: " . $sql . "<br>" . $db->error;
     }
     header("location: Librarian.php");
   }
  }
?>
