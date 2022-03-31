<!DOCTYPE html>
<head>
<html lang="en">
<title>KFUPM Library System</title>
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
      <a href="#" class="w3-bar-item w3-button">Home</a>
      <a href="#menu" class="w3-bar-item w3-button">Books</a>
      <?php
      session_start();
      if(isset($_SESSION['TypeID'])){
          if($_SESSION['TypeID'] == 1){
            echo'<a href="Librarian.php" class="w3-bar-item w3-button">Librarian</a>';
          }else if($_SESSION['TypeID'] == 2){
            echo'<a href="Member.php" class="w3-bar-item w3-button">Member</a>';
          }
          else if($_SESSION['TypeID'] == 3){
            echo'<a href="Author.php" class="w3-bar-item w3-button">Author</a>';
          }
      echo'<a href="signin.php" class="w3-bar-item w3-button">Sign out</a>';}
      else{
          echo'<a href="signin.php" class="w3-bar-item w3-button">Sign in</a>';
      }
      ?>
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
  <img class="w3-image" src="Photos/Library3.jpeg" alt="Hamburger Catering" width="1600" height="800">
  <div class="w3-display-bottomleft w3-padding-large w3-opacity">
    <h1 class="w3-xxlarge">KFUPM Library</h1>
  </div>
</header>

<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

<!-- Slideshow-->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="Photos/Library1.jpeg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="Photos/Library2.jpeg" alt="Second slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  <!-- About Section -->
  <div class="w3-row w3-padding-64" id="about">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
     <img src="Photos/Library1.jpeg" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="500" height="650">
    </div>

    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">About KFUPM Library</h1><br>
      <h5 class="w3-center">Tradition since 1963</h5>
      <p class="w3-large">lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute iruredolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </span></p>
      <p class="w3-large w3-text-grey w3-hide-medium">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod temporincididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
  
  <hr>
  
  <!-- Menu Section -->
  <div class="w3-row w3-padding-64" id="menu">
    <div class="w3-col l6 w3-padding-large">
      <h1 class="w3-center">Some Books</h1><br>
      <h4>Programming Concepts</h4>
      <p class="w3-text-grey">lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit</p><br>
    
      <h4>Database Concepts</h4>
      <p class="w3-text-grey">lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit</p><br>
    
      <h4>Data Science Today</h4>
      <p class="w3-text-grey">lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit</p><br>
    </div>
    
    <div class="w3-col l6 w3-padding-large">
      <img src="Photos/library-Logo.png" class="w3-round w3-image w3-opacity-min" alt="Menu" style="width:50%">
    </div>
  </div>

  <hr>

  <!-- Contact Section -->
  <div class="w3-container w3-padding-64" id="contact">
    <h1>Contact</h1><br>
    <p>We offer full-service. We understand your needs. Do not hesitate to contact us.</p>
    <p class="w3-text-blue-grey w3-large"><b>Library Service, 42nd Living St, 43043 New York, NY</b></p>
    <p>You can also contact us by phone 00553123-2323 or email Library@kfupm.edu.sa, or you can send us a message here:</p>
    <form action="/action_page.php" target="_blank">
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Name" required name="Name"></p>
      <p><input class="w3-input w3-padding-16" type="number" placeholder="How many people" required name="People"></p>
      <p><input class="w3-input w3-padding-16" type="datetime-local" placeholder="Date and time" required name="date" value="2020-11-16T20:00"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Message \ Special requirements" required name="Message"></p>
      <p><button class="w3-button w3-light-grey w3-section" type="submit">SEND MESSAGE</button></p>
    </form>
  </div>
  
<!-- End page content -->
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
