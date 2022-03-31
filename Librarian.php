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
<title>Librarian Page</title>
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
  <a onClick="addBookClick()"><input type="radio" name="options" id="option1" autocomplete="off" checked > Add book
  </label></a>
  <label class="btn btn-secondary">
  <a onClick="removeBookClick()"><input type="radio" name="options" id="option2" autocomplete="off"> Remove book
  </label></a>
  <label class="btn btn-secondary">
  <a onClick="editBookClick()"><input type="radio" name="options" id="option3" autocomplete="off"> edit book
  </label></a>

  <label class="btn btn-secondary">
  <a onClick="addMemberClick()"><input type="radio" name="options" id="option2" autocomplete="off"> Add Member
  </label></a>
  <label class="btn btn-secondary">
  <a onClick="cancelMemberClick()"><input type="radio" name="options" id="option2" autocomplete="off"> Cancel Membership
  </label></a>

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
function addBookClick(){
  document.getElementById('addBook').style.display = "Block";
  document.getElementById('removeBook').style.display = "None";
  document.getElementById('editBook').style.display = "None";
  document.getElementById('addMember').style.display = "None";
  document.getElementById('cancelMember').style.display = "None";

}
function removeBookClick(){
  document.getElementById('removeBook').style.display = "Block";
  document.getElementById('addBook').style.display = "None";
  document.getElementById('editBook').style.display = "None";
  document.getElementById('addMember').style.display = "None";
  document.getElementById('cancelMember').style.display = "None";

}
function editBookClick(){
  document.getElementById('editBook').style.display = "Block";
  document.getElementById('addBook').style.display = "None";
  document.getElementById('removeBook').style.display = "None";
  document.getElementById('addMember').style.display = "None";
  document.getElementById('cancelMember').style.display = "None";
}
function addMemberClick(){
  document.getElementById('editBook').style.display = "None";
  document.getElementById('addBook').style.display = "None";
  document.getElementById('removeBook').style.display = "None";
  document.getElementById('addMember').style.display = "Block";
  document.getElementById('cancelMember').style.display = "None";
}
function cancelMemberClick(){
  document.getElementById('editBook').style.display = "None";
  document.getElementById('addBook').style.display = "None";
  document.getElementById('removeBook').style.display = "None";
  document.getElementById('addMember').style.display = "None";
  document.getElementById('cancelMember').style.display = "Block";
}

</script>

<!-- Add book -->
<div class="w3-row " id="addBook">
<form id="" action="librarian-handler.php" method="post">
<input type="hidden" name="functionality" value="1">
  <div class="form-group">
    <label >ISBN</label>
    <input type="number" class="form-control"  placeholder="Enter ISBN .." name="ISBN" >
  </div>
  <div class="form-group">
    <label >Book Title</label>
    <input type="text" class="form-control" placeholder="Enter Title .. " name="title">
  </div>
  <div class="form-group">
    <label >Publication Year</label>
    <input type="number" class="form-control" placeholder="Enter year .. " name="year">
  </div>
  <div class="form-group">
    <label >Subject Name</label>
    <input type="text" class="form-control" placeholder="Enter subject name .. " name="subjectName">
  </div>
  <div class="form-group">
    <label >Subject ID</label>
    <input type="number" class="form-control" placeholder="Enter ID .. " name="subjectID">
  </div>
  <div class="form-group">
    <label >Barcode</label>
    <input type="number" class="form-control" placeholder="Enter barcode .. " name="barcode">
  </div>
  <div class="form-group">
    <label >Copies</label>
    <input type="number" class="form-control" placeholder="Enter number of copies .. " name="copies">
  </div>
  <div class="form-group">
    <label >Shelf</label>
    <input type="text" class="form-control" placeholder="Enter shelf  .. " name="shelf">
  </div>
  <div class="form-group">
    <label >Language</label>
    <input type="text" class="form-control" placeholder="Enter language .. " name="language">
  </div>

  <div class="form-group">
  <label for="authors">Choose an author:</label>
  <?php
  echo'
  <select name="authors[]" id="authors" multiple>';
      $sql = "SELECT First_Name,Last_Name,People_ID FROM Library_People WHERE People_Type = 3";
      $result = mysqli_query($db,$sql);
      while($row = mysqli_fetch_array($result)){
        echo' <option name="authors[]" value="'.$row['People_ID'].'">'.$row['First_Name'].' '.$row['Last_Name'].'</option>';
      }

    ?>
  </select>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<!-- Remove book -->
<div class="w3-row " id="removeBook" style="display:none" >
    <form id="" action="librarian-handler.php" method="post">
    <input type="hidden" name="functionality" value="2">
        <?php 
              $sql = "SELECT ISBN_Code,Book_Title FROM Book";
              $result = mysqli_query($db,$sql);
              echo'<select name="removeDD[]">              ';
              while($row = mysqli_fetch_array($result)){
                echo'<option name="removeDD[]" value="'.$row['ISBN_Code'].'">'.$row['Book_Title'].'</option>';
              }
              echo'</select>';
        ?>
          <button type="submit" class="btn btn-primary">Remove</button>
    </form>

</div>
<!-- Edit book -->
<div class="w3-row " id="editBook" style="display:none" >
    <form id="" action="editBook.php" method="post">
        <?php 
              include 'connection.php';
              $sql = "SELECT * FROM Book";
              $result = mysqli_query($db,$sql);
              echo'<select name="editDD">              ';
              while($row = mysqli_fetch_array($result)){
                echo'<option name="editDD" value="'.$row['ISBN_Code'].'">'.$row['Book_Title'].'</option>';
              }
              echo'</select>';
        ?>
          <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>

<!-- Add Member -->
<div class="w3-row " id="addMember" style="display:None">
<form id="" action="librarian-handler.php" method="post">
<input type="hidden" name="functionality" value="4">
  <div class="form-group">
    <label >People ID</label>
    <input type="number" class="form-control"  placeholder="Enter ID .." name="PeopleID" require>
  </div>
  <div class="form-group">
    <label >First Name</label>
    <input type="text" class="form-control" placeholder="Enter First Name .. " name="FName">
  </div>
  <div class="form-group">
    <label >Last Name</label>
    <input type="text" class="form-control" placeholder="Enter Last Name .. " name="LName">
  </div>
  <div class="form-group">
    <label >People Type</label>
    <select name="PeopleType">
      <option name="PeopleType" value="1">Librarian</option>
      <option name="PeopleType" value="2">Member</option>
      <option name="PeopleType" value="3">Author</option>
    </select>
  </div>

  <div class="form-group">
    <label >Birth Date</label>
    <input type="date" class="form-control" placeholder="Enter Date .. " name="BirthDate">
  </div>
  <div class="form-group">
    <label >Sex</label>
    <select name="sex">
      <option name="sex" value="M">Male</option>
      <option name="sex" value="F">Female</option>
    </select>
  </div>
  <div class="form-group">
    <label >Department</label>
    <input type="text" class="form-control" placeholder="Enter Department .. " name="Department">
  </div>
  <div class="form-group">
    <label >Contact Number</label>
    <input type="number" class="form-control" placeholder="Enter Number  .. " name="Number">
  </div>
  <div class="form-group">
    <label >Email</label>
    <input type="Email" class="form-control" placeholder="Enter Email .. " name="Email" require>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<!-- Cancel Membership -->
<div class="w3-row " id="cancelMember" style="display:None">
<form id="" action="librarian-handler.php" method="post">
<input type="hidden" name="functionality" value="5">

<div class="form-group">
    <label >Choose member to cancel</label>
    <select name="member">
      <?php
            $sql = "SELECT First_Name,Last_Name,People_ID FROM Library_People WHERE People_Type=2";
            $result = mysqli_query($db,$sql);
            while($row = mysqli_fetch_array($result)){
              echo' <option name="member" value="'.$row['People_ID'].'">'.$row['First_Name'].' '.$row['Last_Name'].'</option>';
            }
      ?>
    </select>

  </div>


<button type="submit" class="btn btn-primary">Cancel Membership</button>
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
