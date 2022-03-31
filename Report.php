<?php 
session_start();
if(isset($_SESSION['TypeID'])){
    if($_SESSION['TypeID'] != 1){
        header("location: index.php");
    }
}
else{
    header("location: index.php");
}

include 'connection.php';

?>
<!DOCTYPE html>
<head>
<html lang="en">
<title>Report Page</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>


<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">

   <img class="Logo" src="Photos/KFUPM-logo.png"></img> <span class="logoText"><b>KFUPM Library</b></span>
  
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="index.php#" class="w3-bar-item w3-button">Home</a>
      <a href="report.php" class="w3-bar-item w3-button">Report</a>
      <a href="index.php#menu" class="w3-bar-item w3-button">Books</a>
      <a href="signin.php" class="w3-bar-item w3-button">Sign out</a>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

<div class="w3-row " id="LibrarianButtons">
<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary active">
  <a onClick="addBookClick()"><input type="radio" name="options" id="option1" autocomplete="off" checked > New members report
  </label></a>
  <label class="btn btn-secondary">
  <a onClick="removeBookClick()"><input type="radio" name="options" id="option2" autocomplete="off"> Member penalty report
  </label></a>
  <label class="btn btn-secondary">
  <a onClick="editBookClick()"><input type="radio" name="options" id="option3" autocomplete="off"> Members overdue report 
  </label></a>

  <label class="btn btn-secondary">
  <a onClick="addMemberClick()"><input type="radio" name="options" id="option2" autocomplete="off"> Members Due report
  </label></a>

</div>
</div>
<script>
function addBookClick(){
  document.getElementById('addBook').style.display = "Block";
  document.getElementById('removeBook').style.display = "None";
  document.getElementById('editBook').style.display = "None";
  document.getElementById('addMember').style.display = "None";

}
function removeBookClick(){
  document.getElementById('removeBook').style.display = "Block";
  document.getElementById('addBook').style.display = "None";
  document.getElementById('editBook').style.display = "None";
  document.getElementById('addMember').style.display = "None";

}
function editBookClick(){
  document.getElementById('editBook').style.display = "Block";
  document.getElementById('addBook').style.display = "None";
  document.getElementById('removeBook').style.display = "None";
  document.getElementById('addMember').style.display = "None";
}
function addMemberClick(){
  document.getElementById('editBook').style.display = "None";
  document.getElementById('addBook').style.display = "None";
  document.getElementById('removeBook').style.display = "None";
  document.getElementById('addMember').style.display = "Block";
}


</script>

<!-- Add book -->
<div class="w3-row " id="addBook">
<?php
      $sql = "SELECT First_Name,Last_Name FROM Library_People WHERE People_ID NOT IN(SELECT Borrower_ID FROM Book_Loan) AND People_Type <> 4";
      $result = mysqli_query($db,$sql);
      echo'
      <h6 style="font-family: sans-serif">New members who were added this year but did not check out any book</h6>
      <h5 style="font-family: sans-serif">Names:<h5> 
      <hr>';
      if(mysqli_num_rows($result) == 0){
        echo'
        <br><br>
        <h5 style="font-family: sans-serif">This list is empty</h5>';
    
      }
      else{
      while($row = mysqli_fetch_array($result)){
          echo'<h5 style="font-family: sans-serif">- '.$row['First_Name'].' '.$row['Last_Name'].'</h5>
          <hr>';
      }
    }
?>
</div>

<!-- Remove book -->
<div class="w3-row " id="removeBook" style="display:none" >
<?php
      $sql = "SELECT First_Name,Last_Name FROM Library_People WHERE People_Type <> 4";
      $result = mysqli_query($db,$sql);
      echo'
      <h6 style="font-family: sans-serif">all members and their penalty amounts</h6>
      <h5 style="font-family: sans-serif">Names:<h5> 
      <hr>';
      if(mysqli_num_rows($result) == 0){
        echo'
        <br><br>
        <h5 style="font-family: sans-serif">This list is empty</h5>';
    
      }
      else{
      while($row = mysqli_fetch_array($result)){
          echo'<h5 style="font-family: sans-serif">- '.$row['First_Name'].' '.$row['Last_Name'].'</h5>
          <hr>';
      }
    }
?>


</div>
<!-- Edit book -->
<div class="w3-row " id="editBook" style="display:none" >
<?php
      $sql = "SELECT First_Name,Last_Name FROM Library_People WHERE People_ID IN (SELECT Borrower_ID FROM Book_Loan GROUP BY Borrower_ID HAVING COUNT(Borrower_ID) > 3)";
      $result = mysqli_query($db,$sql);
      echo'
      <h6 style="font-family: sans-serif">members who borrowed more than 3 books</h6>
      <h5 style="font-family: sans-serif">Names:<h5> 
      <hr>';
      if(mysqli_num_rows($result) == 0){
        echo'
        <br><br>
        <h5 style="font-family: sans-serif">This list is empty</h5>';
    
      }
      else{
      while($row = mysqli_fetch_array($result)){
          echo'<h5 style="font-family: sans-serif">- '.$row['First_Name'].' '.$row['Last_Name'].'</h5>
          <hr>';
      }
    }
?>
</div>

<!-- Add Member -->
<div class="w3-row " id="addMember" style="display:None">
<?php
      $sql = "SELECT First_Name,Last_Name FROM Library_People WHERE People_ID IN (SELECT Borrower_ID FROM Book_Loan WHERE Actual_Return IS NOT NULL AND Actual_Return BETWEEN Borrowed_From AND Borrowed_To)";
      $result = mysqli_query($db,$sql);
      echo'
      <h6 style="font-family: sans-serif">members who check out books but return them at least one day before due date.</h6>
      <h5 style="font-family: sans-serif">Names:<h5> 
      <hr>';
      if(mysqli_num_rows($result) == 0){
        echo'
        <br><br>
        <h5 style="font-family: sans-serif">This list is empty</h5>';
    
      }
      else{
      while($row = mysqli_fetch_array($result)){
          echo'<h5 style="font-family: sans-serif">- '.$row['First_Name'].' '.$row['Last_Name'].'</h5>
          <hr>';
      }
    }
?>



</div>



</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Copyright KFUPM library system </p>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
