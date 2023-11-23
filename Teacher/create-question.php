<?php

session_start();

if(isset($_SESSION['s_email'])){
    
    if(isset($_GET['logout'])){
        
        include('../operations/sinsupop.php');
        logout();
    }
    include('../operations/sinsupop.php');
    $id= $_GET['user'];
    $exam_id = $_GET['exam'];

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
        <?php 
            $h="hidden";
            $s="";
               if(isset($_POST['submit']) && (($_POST['submit']) == 'finish' )){
                $h="";
                $s="hidden";
               }
        ?>
      <div class="container mt-5" <?=$s ?>>
        <div class="jumbotron">
            <?php  
                    $qn = $_GET['qn']; 
            ?>
            <div id="questionsContainer">
                <h2>Questions</h2>
                <form method="POST" action="">
                    <div class="question">
                        <div class="form-group">
                            <label for="question1">Question <?=$qn?></label>
                            <input type="text" class="form-control" id="question1" name="question" placeholder="Enter question" required>
                        </div>                   
                            <?php
                            $choices = [];

                                  if ((isset($_POST['submit'])) && (($_POST['submit'])=='next')) {
                                      $qn = $_GET['qn'];
                                      for ($i = 1; $i <= 4; $i++) {
                                          $choice = $_POST['choice'.$i];
                                          $state = isset($_POST['correct'.$i]) ? "true" : "false";
                                          $choices[] = [
                                              'choice' => $choice,
                                              'state' => $state,

                                          ];
                                      }
                                      $choices= json_encode($choices);
                                      include_once('../operations/exnotes.php');
                                      createquestions($exam_id, $choices, $qn);
                                      $qn +=1;
                                      header("location:create-question.php?user=$id&exam=$exam_id&qn=$qn");
                                  }
                                  elseif(isset($_POST['submit']) && (($_POST['submit']) == 'finish' )){
                                        for ($i = 1; $i <= 4; $i++) {
                                            $choice = $_POST['choice'.$i];
                                            $state = isset($_POST['correct'.$i]) ? "true" : "false";
                                            $choices[] = [
                                                'choice' => $choice,
                                                'state' => $state
                                            ];
                                        }
                                        $qn = $_GET['qn'];
                                        $choices= json_encode($choices);
                                        include_once('../operations/exnotes.php');
                                        createquestions($exam_id, $choices, $qn);

                                  }
                            ?>

                        <div class="form-group" id="choicesContainer1">
                            <label for="choices1">Choices :</label>

                                <div id="choices-container">
                                        <div class="form-check">
                                            <input type="text" class="form-control" name="choice1" placeholder="Enter choice" required>
                                            <input type="checkbox" class="form-check-input" name="correct1" value="true">
                                            <label class="form-check-label" for="correct1">Correct</label>
                                        </div>

                                        <div class="form-check">
                                            <input type="text" class="form-control" name="choice2" placeholder="Enter choice" required>
                                            <input type="checkbox" class="form-check-input" name="correct2" value="true">
                                            <label class="form-check-label" for="correct2">Correct</label>
                                        </div>

                                        <div class="form-check">
                                            <input type="text" class="form-control" name="choice3" placeholder="Enter choice" required>
                                            <input type="checkbox" class="form-check-input" name="correct3" value="true">
                                            <label class="form-check-label" for="correct3">Correct</label>
                                        </div>

                                        <div class="form-check">
                                            <input type="text" class="form-control" name="choice4" placeholder="Enter choice" required>
                                            <input type="checkbox" class="form-check-input" name="correct4" value="true">
                                            <label class="form-check-label" for="correct3">Correct</label>
                                        </div>
                                </div>
                        
                            <div class="form-group">
                                <label for="points1">Points</label>
                                <input type="number" class="form-control" name="points" placeholder="Enter points" required>
                            </div>
                        </div>   
                    </div> 
                    
                    

                    <button type="submit" class="btn btn-primary mt-3" name="submit" value="next"><a class="text-white">Add Question</a></button>
                    <button  type="submit" name="submit" value="finish" class="btn btn-success mt-3">Submit Exam</button>
                </form>
            </div>
      </div>    
    </div>
    <div class="container mx-5 my-5 p-5" <?=$h ?>>
    <div class="jumbotron mt-5 mb-5">
      <div class="questionsContainer">
        <div class="card"  style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <div class="card-body">
                <div class='form-group text-center py-4'>
                    <h4 class='text-success' >Exam Was Created successfully !</h4>
                </div>
                <a href='../Teacher/home.php?user=<?=$id?>'  class='btn btn-primary btn-block'>Go Back</a> 
                
            </div>
        </div>
      </div>
    </div>
    </div>


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