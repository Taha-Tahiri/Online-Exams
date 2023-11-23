<?php

session_start();

if(isset($_SESSION['s_email'])){
    
    if(isset($_GET['logout'])){
        
        include('../operations/sinsupop.php');
        logout();
    }
    include('../operations/sinsupop.php');
    $id= $_GET['user'];


?>

<!DOCTYPE html>
<html>
<head>
  <title>Online Exams</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .vertical-center {
      display: flex;
      align-items: center;
      min-height: 100vh;
    }
  </style>
</head>
<body  style=" background-image: linear-gradient(to bottom left, rgb(70,130,180) 15%, rgb(173, 173, 173) );">
    <header class="sticky-top navbar-nav-scroll">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(211,211,211, 0.5);">
          <a class="navbar-brand" href="#">Online Exams</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
    
              <li class="nav-item">
                <a class="nav-link" href="#">Exams</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Results</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="home.php?logout=true">Logout</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
  
  <main class="container vertical-center">
    <div class="row">
      <div class="col">
        <div class="card bg-secondary text-white text-center p-4 mb-4">
          <h2>Take Exams Online</h2>
          <p>Prepare for your exams and take them online in a convenient way.</p>
          <a href="exams.php?user=<?=$id?>" class="btn btn-primary">Get Started</a>
        </div>
      </div>
    </div>
    
    <div class="row mx-1">
      <div class="col">
        <div class="card bg-secondary text-white text-center p-4 mb-4">
          <h2>Track Your Progress</h2>
          <p>View your exam results and track your progress over time.</p>
          <a href="results.php?user=<?=$id?>" class="btn btn-primary">View Results</a>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col">
        <div class="card bg-secondary text-white text-center p-4 mb-4">
          <h2>Edit profile</h2>
          <p>You can change or edit your personal information that you enterd when signing up.</p>
          <a href="edit.php?user=<?= $id ?>" class="btn btn-primary">Edit Profile</a>
        </div>
      </div>
    </div>
  </main>



  <footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2023 Online Exams. All rights reserved.</p>
  </footer>

</body>
</html>
<?php    }   else
 header('location:../signin/');


?>