<?php

session_start();

if(isset($_SESSION['s_email'])){
    
    if(isset($_GET['logout'])){       
        include_once('../operations/sinsupop.php');
        logout();
    }
    $id= $_GET['user'];
    $exam = $_GET['exam'];
    
$h ="hidden";
$s = "";
$grade = 0;
$note =0;

?>
<!DOCTYPE html>
<html>
<head>
  <title >Online Exams - My Exams</title>
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
<body style=" background-image: linear-gradient(to bottom left, rgb(70,130,180) 15%, rgb(173, 173, 173) ); ">

<header class="sticky-top navbar-nav-scroll">
<!-- <div class="container px-0 mx-0">
  <div  class="content px-0 mx-0"> -->
    <div class="row px-0 mx-0" >
        <div class="col-12" >
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
        </div>
  </div>

        <div class="row mx-0 px-0 " dir="rtl" <?php echo $s ?>>
            <div class="col-2 text-center mr-3 mt-2" style="border-radius: 5px; background-color: rgba(211,211,211, 0.9); ">
                <div class='form-group text-center py-0 mt-2 mb-2 '>
                    <h4 class='text-success countdown' id="countdown"></h4>
                </div>
            </div>
        </div>
      <!-- </div>
</div> -->
      </header>
      <?php 
                    if(isset($_POST['submit'])){
                       $s = "hidden";
                       $h= "";
                       include_once('../operations/exnotes.php');
                       $questions = getquestions($exam);
                        $q = count($questions);
                        for($i=1; $i<= $q; $i++){
                          $choices = json_decode(($questions[$i-1]->choices));
                          $point = $questions[$i-1]->points;
                          $true = 0;
                          $ntrue = 0;
                          for($j=1; $j<=4; $j++){
                            $state = isset($_POST['choice'.$i.'-'.$j]) ? "true" : "false";
                            $choicest =  $choices[$j-1]->state;
                            if($choicest == "true"){
                              $true ++;
                            }
                            if(($choicest == $state) && ($state=="true")){
                              $ntrue ++;
                            }
                          }
                          $grade += ($ntrue/$true)*$point;
                          $note+= $point;
                        }
                        include_once('../operations/exnotes.php');
                        creategrade($id, $exam, $grade, $note);
                    }
                    
                    ?>
  <!-- Content -->
  <div class=" container ">
  <div  class="content ">
    <div class="row " <?php echo $h ?>>
        <div class='col mt-5 mx-5 px-5'>
          <div class="jumbotron m-5 p-5 text-center">
            <h4 class='text-success' >Exam Submited successfully !</h4>
            <h4 class='text-success' >note: <?php echo" $grade / $note"; ?> </h4>
            <a href='../Student/home.php?user=<?=$id?>'  class='btn btn-primary btn-block mt-5'>Go Back</a>
          </div>
         </div>
          
    </div>
        </div>
        <div class="row" <?php echo $s ?>>
            <div class=" col mt-5 mx-5 px-5">
                    <div class="jumbotron mx-5 px-5">
                        <form action="" method="post">
                            <?php 
                                include_once('../operations/exnotes.php');
                                $exam_id = $_GET['exam'];
                                $exam = getexambyid($exam_id);
                                $duration = $exam->duration ;
                                $questions = getquestions($exam_id);
                                $j=1;
                                foreach ($questions as $question ) {  $i = 1; ?>
                                <div id="questionsContainer">
                                    <h3>Question <?php echo $question->qn; ?></h3>
                                    <h2><?php echo $question->question; ?></h2>
                                    <?php 
                                    $choices= json_decode(($question->choices), true);
                                    
                                    foreach ($choices as $choix) { 
                                        $choice = $choix['state']; ?>
                                        <div class="choice">
                                            <input type="checkbox" name="choice<?php echo"$j-$i" ?>" value="<?php echo $choice ?>" >
                                            <label for="choice<?php ?>"><?php echo $choix['choice']  ?></label>
                                        </div>
                                <?php $i++; } $j++; ?>
                                </div>
                                <hr></hr>
                            <?php  } ?>
                            <button type="submit" name="submit" class="btn btn-primary">Submit Exam</button>
                        </form>
                    </div>
            </div>
        </div>
     </div>
  </div>
  <script>
    function countdown() {
      var minutes = Math.floor(duration / 60);
      var seconds = duration % 60;
      countdownElement.textContent = minutes + 'm ' + seconds + 's';
      duration--;
      if (duration < 0) {
        clearInterval(countdownInterval);
        countdownElement.textContent = 'Time is up!';
        document.querySelector('form').submit();
      }
    }
    var duration = <?php echo $duration; ?> * 60; 
    var countdownElement = document.getElementById('countdown');
    var countdownInterval = setInterval(countdown, 1000);
  </script>
  </div>




</body>
</html>
<?php    }   else
 header('location:../signin/');


?>