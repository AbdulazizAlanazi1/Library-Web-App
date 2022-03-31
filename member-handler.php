<?php
include "connection.php";
session_start();

if(isset($_SESSION['TypeID'])){
   if($_SESSION['TypeID'] != 2){
       header("location: index.php");
   }
}
else{
   header("location: index.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
   // Handling searching
   if($_POST['functionality'] == 1){
}

   // Handling loan book
   if($_POST['functionality'] == 2){
    $BID = mysqli_real_escape_string($db,$_POST['BID']);
    $barcode = explode(' ',$_POST['bookSelect']);
    $todayDate = date("Y-m-d ");
    $returnDate = $_POST['returnDate'];
    $issued = $_POST['issued'];

    $sql = "INSERT INTO Book_Loan VALUES ('".$BID."','".$barcode[0]."','".$todayDate."','".$returnDate."',NULL,'".$issued."')";
    if (mysqli_query($db,$sql) === TRUE) {
      $sql = "UPDATE Book SET No_of_Copies=No_of_Copies-1 WHERE ISBN_Code='".$barcode[1]."'";
      mysqli_query($db,$sql);
      $sql = "SELECT No_of_Copies FROM Book WHERE ISBN_Code='".$barcode[1]."'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result);
      if($row['No_of_Copies'] == 0){
        $sql = "UPDATE Book SET Is_Available ='N' WHERE ISBN_Code='".$barcode[1]."'";
        mysqli_query($db,$sql);
        $_SESSION['err']=0;
      }
    } else {
      $_SESSION['err']=1;
       echo "Error: " . $sql . "<br>" . $db->error;
     }
     header("location: member.php");
   }

   // reserve book
   if($_POST['functionality'] == 3){
    $BID = mysqli_real_escape_string($db,$_POST['BID']);
    $ISBN = mysqli_real_escape_string($db,$_POST['bookSelect']);
    $todayDate = date("Y-m-d ");

    $sql = "INSERT INTO Book_Reserve VALUES ('".$BID."','".$ISBN."','".$todayDate."','N')";
    if (mysqli_query($db,$sql) === TRUE) {
      $_SESSION['err']=0;
    } else {
      $_SESSION['err']=1;
       echo "Error: " . $sql . "<br>" . $db->error;
     }
     header("location: member.php");

  }

   // renew book
   if($_POST['functionality'] == 4){
    $BID = mysqli_real_escape_string($db,$_POST['BID']);
    $NewReturn = mysqli_real_escape_string($db,$_POST['NReturn']);
    $fromReturn = mysqli_real_escape_string($db,$_POST['from']);
    $barcode = mysqli_real_escape_string($db,$_POST['barcode']);

    $sql = "UPDATE Book_Loan SET Borrowed_To = '".$NewReturn."' WHERE Bar_Code = '".$barcode."' AND Borrower_ID = '".$BID."' ";
    if (mysqli_query($db,$sql) === TRUE) {
      $_SESSION['err']=0;
     } else {
      $_SESSION['err']=1;
       echo "Error: " . $sql . "<br>" . $db->error;
     }
     header("location: member.php");
   }

  // return book
   if($_POST['functionality'] == 5){
    $BID = mysqli_real_escape_string($db,$_POST['BID']);
    $barcode = mysqli_real_escape_string($db,$_POST['reservedBook']);

    $sql = "UPDATE Book_Loan SET Actual_Return = '".date("Y-m-d")."' WHERE Bar_Code = '".$barcode."' AND Borrower_ID = '".$BID."' ";

    if (mysqli_query($db,$sql) === TRUE) {
      $_SESSION['err']=0;
     } else {
      $_SESSION['err']=1;
       echo "Error: " . $sql . "<br>" . $db->error;
     }
    header("location: member.php");
   }

  }

?>
