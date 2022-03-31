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
<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary active">
  <a href="Member.php"><input type="radio" name="options" id="option1" autocomplete="off" checked > Search
  </label></a>
  <label class="btn btn-secondary">
  <a href="Member.php"><input type="radio" name="options" id="option2" autocomplete="off"> Checkout Book
  </label></a>
  <label class="btn btn-secondary">
  <a href="Member.php"><input type="radio" name="options" id="option3" autocomplete="off"> Reserve Book
  </label></a>

  <label class="btn btn-secondary">
  <a href="Member.php"><input type="radio" name="options" id="option2" autocomplete="off"> Renew Book
  </label></a>

  <label class="btn btn-secondary">
  <a href="Member.php"><input type="radio" name="options" id="option2" autocomplete="off"> Return Book</label></a>
</div>
</div>


<!-- Search -->
<div class="w3-row " id="search">
  
<h2><b>Search</b></h2>
<br>
<br>

    <?php 
          $method = $_POST['searchMethod'];
          $term = mysqli_real_escape_string($db,$_POST['searchTerm']);
    
          if($method == 1){
            $sql = "SELECT Book_Title,Subject_ID,Publication_Year FROM Book WHERE Book_Title = '".$term."'";
            $result = mysqli_query($db,$sql);
            if((mysqli_num_rows($result)) == 0){
                echo'<h4>No results found..</h4>';
            }else{
            while($row = mysqli_fetch_array($result)){
              echo'<h4><b>Book Title:</b>   '.$row['Book_Title'].'        |       <b>Subject ID:</b> '.$row['Subject_ID'].'        |       <b>Year:</b> '.$row['Publication_Year'].'</h4>';
            }
        }
          }
          else if($method ==2 ){
              $fullName = explode(" ",$_POST['searchTerm']);
              if(isset($fullName[0]) && isset($fullName[1])){
            $sql = "SELECT b.Book_Title,b.Subject_ID,b.Publication_Year FROM Book b NATURAL JOIN Book_Author a  WHERE  a.Author_ID IN (
                SELECT People_ID FROM Library_People WHERE People_Type =3 AND First_Name='".$fullName[0]."' AND Last_Name='".$fullName[1]."'
                )";
                $result = mysqli_query($db,$sql);
                if((mysqli_num_rows($result)) == 0){
                    echo'<h4>No results found..</h4>';
                }else{
                while($row = mysqli_fetch_array($result)){
                  echo'<h4><b>Book Title:</b>   '.$row['Book_Title'].'        |       <b>Subject ID:</b> '.$row['Subject_ID'].'        |       <b>Year:</b> '.$row['Publication_Year'].'</h4>';
                }
            }
            }
                else if(isset($fullName[0])){
                    $sql = "SELECT b.Book_Title,b.Subject_ID,b.Publication_Year FROM Book b NATURAL JOIN Book_Author a  WHERE  a.Author_ID IN (
                        SELECT People_ID FROM Library_People WHERE People_Type =3 AND First_Name='".$fullName[0]."'
                        )";
                        $result = mysqli_query($db,$sql);
                        if((mysqli_num_rows($result)) == 0){
                            echo'<h4>No results found..</h4>';
                        }else{
                        while($row = mysqli_fetch_array($result)){
                          echo'<h4><b>Book Title:</b>   '.$row['Book_Title'].'        |       <b>Subject ID:</b> '.$row['Subject_ID'].'        |       <b>Year:</b> '.$row['Publication_Year'].'</h4>';
                        }
                    }
                }
                else{
                    echo'<h4>No results found..</h4>';
                }
          }
          else if($method ==3){
            $term = $_POST['searchTerm'];
            $sql = "SELECT b.Book_Title,b.Subject_ID,b.Publication_Year FROM Book b NATURAL JOIN Subject a  WHERE a.Subject_Name = '".$term."'";
            $result = mysqli_query($db,$sql);
            if((mysqli_num_rows($result)) == 0){
                echo'<h4>No results found..</h4>';
            }else{
            while($row = mysqli_fetch_array($result)){
              echo'<h4><b>Book Title:</b>   '.$row['Book_Title'].'        |       <b>Subject ID:</b> '.$row['Subject_ID'].'        |       <b>Year:</b> '.$row['Publication_Year'].'</h4>';
            }
        }

          }
          else if($method ==4){
            $sql = "SELECT Book_Title,Subject_ID, Publication_Year FROM Book WHERE Publication_Year = '".$term."'";
            $result = mysqli_query($db,$sql);
            if((mysqli_num_rows($result)) == 0){
                echo'<h4>No results found..</h4>';
            }else{
            while($row = mysqli_fetch_array($result)){
              echo'<h4><b>Book Title:</b>   '.$row['Book_Title'].'        |       <b>Subject ID:</b> '.$row['Subject_ID'].'        |       <b>Year:</b> '.$row['Publication_Year'].'</h4>';
            }
        }
          }
          
    ?>
<a href="member.php"><button type="button" class="btn btn-primary">Back</button></a>
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
