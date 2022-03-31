<?php 
session_start();
if(isset($_SESSION['TypeID'])){
    if($_SESSION['TypeID'] != 2){
        header("location: index.php");
    }
    if(!($_SERVER["REQUEST_METHOD"] == "POST")){
        header("location: Member.php");
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
<title>Member Page</title>
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

</div>


<!-- Search -->
<h2><b>Return Book</b></h2>
<br>
<br>
<div class="w3-row " id="return">
  
<form id="" action="member-handler.php" method="post">
<input type="hidden" name="functionality" value="5">

<?php
      $sql = "SELECT Bar_Code FROM Book_Loan WHERE Borrower_ID='".$_POST['BID']."' AND Actual_Return IS NULL";
      $result = mysqli_query($db,$sql);
      if((mysqli_num_rows($result)) == 0){
        echo '<h4>You have no borrowed books</h4>';
      }
      else{
        echo'
        <label>Borrower ID </label>
        <input type="text" value="'.$_POST['BID'].'" disabled>
        <input type="hidden" name="BID" value="'.$_POST['BID'].'">
        <br>
        <br>
        <select name="reservedBook">';
      while($row = mysqli_fetch_array($result)){
        echo'
        <option name="reservedBook" value="'.$row['Bar_Code'].'">'.$row['Bar_Code'].'</option>
        ';
      }
echo'</select>
<br>
<br>';
    }
?>
       <a href="member.php"><button type="button" class="btn btn-primary">Back</button></a>
       <button type="submit" class="btn btn-primary">Return</button> 

</form>


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
