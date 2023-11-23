<?php

session_start();

if(isset($_SESSION['s_email'])){
    
    if(isset($_GET['logout'])){       
        include_once('../operations/sinsupop.php');
        logout();
    }
    $id= $_GET['user'];


?>
<!DOCTYPE html>
<html>
<head>
  <title>Online Exams - My Exams</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Custom CSS styles for the page */
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .container {
      flex-grow: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 30px;
      margin-bottom: 30px;
    }
    .content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
  </style>
  </style>
</head>
<body style="background-color: rgba(211,211,211, 0.5);">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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

  <!-- Content -->
  <div class="container">
    <div  class="content">
    <div class="row"> 
         <div class="col text-center mb-4">
        <h2 class="">Your Exams:</h2>
        </div> 
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <table class="table table-bordered bg-light">
            <thead >
                <tr>
                <th>Exam Name</th>
                <th>Class name</th>
                <th>Start Date</th>
                <th>Finish Date</th>
                <th>Duration</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include('../operations/exnotes.php');
                $exams = getexamsforteacher($id);
                $exams = json_decode(json_encode($exams), true);
                foreach($exams as $exam){
                ?>
                <tr>
                <td><?php echo $exam['name_' ]?></td>
                <td><?php echo $exam['class_n']?></td>
                <td><?php $start_d = date('Y-m-d H:i', strtotime($exam['start_d'])); echo $start_d ?></td>
                <td><?php $finish_d = date('Y-m-d H:i', strtotime($exam['finish_d'])); echo $start_d?></td>
                <td class="text-center"><?php echo $exam['duration']; echo " min"?></td>
                <td class="text-center">
                <a href="results.php?user=<?=$id?>&exam=<?php echo $exam['exam_id']?>&class=<?php echo $exam['class_n']?>" class="btn btn-primary">See Results</a>
                </td>
                <?php  }?>
            </tbody>
            </table>
        </div>
    </div>
    <div class="row ">
        <div class="col_2">
        <!-- <button class="btn">chart view</button>
        </div>
        <div class="col-10">
          <nav class="">
            <ul class="pagination justify-content-center ">
              <li class="page-item"><a class="page-link" href="#"><</a></li>
              <li class="page-item" hiden="true"><a class="" href="#" ></a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item" hiden="true"><a class="" href="#" ></a></li>
              <li class="page-item"><a class="page-link" href="#">></a></li>
            </ul>
          </nav> -->
        </div>
      </div>
    </div>
  </div>


  <footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2023 Online Exams. All rights reserved.</p>
  </footer>

</body>
</html>
<?php    }   else
 header('location:../signin/');


?>