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
  <title>Create Exam</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .navbar {
      background-color: #343a40;
      color: #ffffff;
    }

    .footer {
      background-color: #343a40;
      color: #ffffff;
      padding: 10px;
    }
  </style>
</head>
<body style=" background-image: linear-gradient(to bottom left, rgb(70,130,180) 15%, rgb(173, 173, 173) );">
  <!-- Navbar -->
  <header class="sticky-top navbar-nav-scroll">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(211,211,211, 0.9);">
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

  <!-- Page Content -->
  <div class="container mt-5">
    <div class="jumbotron">
      <h1 class="display-4">Create Exam</h1>
      <?php 
             $user = getuserbyid($id);
             $sh=$user->school;
             $data = getdata();
             $classes=$data["$sh"];
         
             if(isset($_POST['submit'])){
                 include('../operations/exnotes.php');
                 $e_class=$_POST['e_class'];
                 $exam_id= random_int(000000, 999999);
                 foreach($e_class as $class){
                         createxam($user, $class, $exam_id);
                     }
                header("location:create-question.php?user=$id&exam=$exam_id&qn=1");
             }
      ?>
        <form method="POST" action="">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="examName">Exam Name</label>
                                <input type="text" class="form-control"name="name_" placeholder="Enter exam name" required>
                            </div>
                        </div>
                        <div class="col">
                                <div class="form-group">
                                    <label for="duration">Duration (in minutes)</label>
                                    <input type="number" class="form-control"name="duration" required>
                                </div>
                        </div>
                    </div>   

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="startDate">Start Date</label>
                                <input type="datetime-local" class="form-control" name="start_d" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="endDate">End Date</label>
                                <input type="datetime-local" class="form-control" name="finish_d" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="duration">Class</label>
                        <select name="e_class[]" id="" class="form-control" required multiple size="<?php $c =count($classes) ; echo $c?>">
                        <?php
            
                        foreach ($classes as $class): ?>
                        <option value="<?php echo $class; ?>"><?php  echo $class; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                
            <button type="submit" name="submit" class="btn btn-success">Create Questions</button>
        </form>

    </div>
  </div>

  <!-- Footer -->
  <footer class="footer mt-5">
    <div class="container">
      <p class="text-center">© 2023 Online Exams. All rights reserved.</p>
    </div>
  </footer>



  
</body>
</html>
<?php    }   else
 header('location:../signin/');


?>