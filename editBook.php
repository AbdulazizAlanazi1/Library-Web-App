<?php
include "connection.php";
session_start();

if(isset($_SESSION['TypeID'])){
   if($_SESSION['TypeID'] != 1){
       header("location: index.php");
   }
   if(!($_SERVER["REQUEST_METHOD"] == "POST")){
    header("location: Librarian.php");
   }
}
else{
   header("location: index.php");
}
?>
<!DOCTYPE html>
<head>
<html lang="en">
<title>Edit Book</title>
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
 <input type="radio" name="options" id="option1" autocomplete="off" checked > <a href="Librarian.php">Add book
  </label></a>
  <label class="btn btn-secondary">
  <input type="radio" name="options" id="option2" autocomplete="off"><a href="Librarian.php"> Remove book
  </label></a>
</div>
</div>

<?php
$book = mysqli_real_escape_string($db,$_POST['editDD']);
$sql = "SELECT * FROM Book WHERE ISBN_Code = ".$book."";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result);

?>


<!-- edit book -->
<div class="w3-row " id="editBook">
<h2><b> Edit Book</b></h2>
<br>
<br>

<form id="" action="librarian-handler.php" method="post">
<input type="hidden" name="functionality" value="3">
  <div class="form-group">
    <label >ISBN</label>
    <?php
    echo'
    <input type="number" class="form-control"  placeholder="Enter ISBN .." name="ISBN" value="'.$row['ISBN_Code'].'" readonly>
  </div>
  <div class="form-group">
    <label >Book Title</label>
    <input type="text" class="form-control" placeholder="Enter Title .. " name="title" value="'.$row['Book_Title'].'">
  </div>
  <div class="form-group">
    <label >Publication Year</label>
    <input type="number" class="form-control" placeholder="Enter year .. " name="year" value="'.$row['Publication_Year'].'">
  </div>

  <div class="form-group">
    <label >Subject ID</label>
    <input type="number" class="form-control" placeholder="Enter ID .. " name="subjectID" value="'.$row['Subject_ID'].'" readonly>
  </div>

  <div class="form-group">
    <label >Copies</label>
    <input type="number" class="form-control" placeholder="Enter number of copies .. " name="copies" value="'.$row['No_of_Copies'].'">
  </div>


  <div class="form-group">
    <label >Language</label>
    <input type="text" class="form-control" placeholder="Enter language .. " name="language" value="'.$row['Book_Language'].'">
  </div>

  <div class="form-group">
  <label >Is Available?</label>
  <select name="isAvailable">
  ';
  if($row['Is_Available'] == 'N'){
      echo'<option name="isAvailable" value="N" selected="selected">No</option>';
      echo'<option name="isAvailable" value="Y" ">Yes</option>';
  }else{
    echo'<option name="isAvailable" value="N" >No</option>';
    echo'<option name="isAvailable" value="Y" selected="selected">Yes</option>';
  }
    echo'
  </select>
</div>

</div>

<a href="librarian.php"><button type="button" class="btn btn-primary">Back</button></a> <button type="submit" class="btn btn-primary">Edit</button> 

</form>  
';
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
