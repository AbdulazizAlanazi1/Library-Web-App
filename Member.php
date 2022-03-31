<?php 
session_start();
if(isset($_SESSION['TypeID'])){
    if($_SESSION['TypeID'] != 2){
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
<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary active">
  <a onClick="SearchClick()"><input type="radio" name="options" id="option1" autocomplete="off" checked > Search
  </label></a>
  <label class="btn btn-secondary">
  <a onClick="CheckoutBookClick()"><input type="radio" name="options" id="option2" autocomplete="off"> Checkout Book
  </label></a>
  <label class="btn btn-secondary">
  <a onClick="ReserveBookClick()"><input type="radio" name="options" id="option3" autocomplete="off"> Reserve Book
  </label></a>

  <label class="btn btn-secondary">
  <a onClick="RenewBookClick()"><input type="radio" name="options" id="option2" autocomplete="off"> Renew Book
  </label></a>

  <label class="btn btn-secondary">
  <a onClick="ReturnBookClick()"><input type="radio" name="options" id="option2" autocomplete="off"> Return Book</label></a>
</div>
</div>

<?php
if(isset($_SESSION['err'])){
if($_SESSION['err']==0){
echo'<h6 style="color:green">Operation successful</h6>';
$_SESSION['err']=NULL;
}else{
  $_SESSION['err']=NULL;
  echo'<h6 style="color:Red">Operation Failed</h6>';
}
}
?>

<script>
function SearchClick(){
  document.getElementById('search').style.display = "Block";
  document.getElementById('checkoutBook').style.display = "None";
  document.getElementById('reserveBook').style.display = "None";
  document.getElementById('renewBook').style.display = "None";
  document.getElementById('returnBook').style.display = "None";
}

function CheckoutBookClick(){
    document.getElementById('search').style.display = "none";
  document.getElementById('checkoutBook').style.display = "Block";
  document.getElementById('reserveBook').style.display = "None";
  document.getElementById('renewBook').style.display = "None";
  document.getElementById('returnBook').style.display = "None";
}
function ReserveBookClick(){
    document.getElementById('search').style.display = "none";
  document.getElementById('checkoutBook').style.display = "None";
  document.getElementById('reserveBook').style.display = "Block";
  document.getElementById('renewBook').style.display = "None";
  document.getElementById('returnBook').style.display = "None";
}
function RenewBookClick(){
    document.getElementById('search').style.display = "none";
  document.getElementById('checkoutBook').style.display = "None";
  document.getElementById('reserveBook').style.display = "None";
  document.getElementById('renewBook').style.display = "Block";
  document.getElementById('returnBook').style.display = "None";
}
function ReturnBookClick(){
    document.getElementById('search').style.display = "none";
  document.getElementById('checkoutBook').style.display = "None";
  document.getElementById('reserveBook').style.display = "None";
  document.getElementById('renewBook').style.display = "None";
  document.getElementById('returnBook').style.display = "Block";
}

</script>

<!-- Search -->
<div class="w3-row " id="search">
<form id="" action="searchResults.php" method="post">
<input type="hidden" name="functionality" value="1">
<div class="form-group">
<label >Select search method</label>
    <select name="searchMethod">
    <option name="searchMethod" value="1">Title</option>
    <option name="searchMethod" value="2">Author</option>
    <option name="searchMethod" value="3">Subject</option>
    <option name="searchMethod" value="4">Publication Date</option>
    </select>
    </div>

    <div class="form-group">
    <label >Search terms</label>
    <input type="text" class="form-control"  placeholder="Enter term to search .." name="searchTerm" >
  </div>

    <button type="submit" class="btn btn-primary">Search</button>
</form>
</div>

<!-- checkoutBook  -->
<div class="w3-row " id="checkoutBook" style="display:none" >
    <form id="" action="Member-handler.php" method="post">
    <input type="hidden" name="functionality" value="2">
    <div class="form-group">
    <label >People ID</label>
    <input type="number" class="form-control"  placeholder="Enter your ID .." name="BID" >
  </div>

    <div class="form-group">
    <label >Select a book</label>
    <select name="bookSelect">
        <?php
              $sql = "SELECT b.Book_Title,b.Subject_ID,b.ISBN_Code ,I.Bar_Code FROM Book b NATURAL JOIN Book_Item I WHERE b.Is_Available = 'Y'";
              $result = mysqli_query($db,$sql);
              while($row = mysqli_fetch_array($result)){
                echo' <option name="bookSelect" value="'.$row['Bar_Code'].' '.$row['ISBN_Code'].'">'.$row['Book_Title'].' | '.$row['Bar_Code'].'</option>';
              }

        ?>
    </select>
            </div>
   
    <div class="form-group">        
    <label >Return date</label>
    <input type="date" class="form-control" name="returnDate" >
    </div>

    <div class="form-group">        
    <label >Issued by</label>
    <select name="issued">
        <?php
              $sql = "SELECT First_Name,Last_Name,People_ID FROM Library_People WHERE People_Type = 1";
              $result = mysqli_query($db,$sql);
              while($row = mysqli_fetch_array($result)){
                echo' <option name="issued" value="'.$row['People_ID'].'">'.$row['First_Name'].' '.$row['Last_Name'].'</option>';
              }
        ?>
    </select>
    </div>
          <button type="submit" class="btn btn-primary">Loan</button>
    </form>
</div>
<!-- reserveBook -->
<div class="w3-row " id="reserveBook" style="display:none" >
    <form id="" action="Member-handler.php" method="post">
    <input type="hidden" name="functionality" value="3">

    <div class="form-group">
    <label >People ID</label>
    <input type="number" class="form-control"  placeholder="Enter your ID .." name="BID" >
  </div>
    <div class="form-group">
    <label >Select a book</label>
    <select name="bookSelect">
        <?php
              $sql = "SELECT ISBN_Code,Book_Title,Subject_ID FROM Book WHERE Is_Available='N'";
              $result = mysqli_query($db,$sql);
              while($row = mysqli_fetch_array($result)){
                echo' <option name="bookSelect" value="'.$row['ISBN_Code'].'">'.$row['Book_Title'].' | '.$row['Subject_ID'].'</option>';
              }
        ?>
    </select>
            </div>
            
    <button type="submit" class="btn btn-primary">Reserve</button>
    </form>
</div>

<!-- renewBook -->
<div class="w3-row " id="renewBook" style="display:None">
<form id="" action="memberRenew.php" method="post">
<input type="hidden" name="functionality" value="4">
<div class="form-group">
    <label >People ID</label>
    <input type="number" class="form-control"  placeholder="Enter your ID .." name="BID" >
  </div>

  <button type="submit" class="btn btn-primary">Check</button>
</form>
</div>
<!-- returnBook -->
<div class="w3-row " id="returnBook" style="display:None">
<form id="" action="memberReturn.php" method="post">
<input type="hidden" name="functionality" value="5">
<div class="form-group">
    <label >People ID</label>
    <input type="number" class="form-control"  placeholder="Enter your ID .." name="BID" >
  </div>

  <button type="submit" class="btn btn-primary">Check</button>
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
