<!DOCTYPE html>
<html>
<head>
  <title>Online Exams - Sign Up</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>

</head>
<body style=" background-image: linear-gradient(to bottom left, rgb(70,130,180) 15%, rgb(173, 173, 173) );">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card"  style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
          <div class="card-header bg-light text-center">
            <h4 class="">Sign Up as a Teacher</h4>
          </div>
          <?php 
              include_once('../operations/db.php');
              include('../operations/sinsupop.php');
              $h="hidden";
              $s="";
              if(isset($_POST['submit'])){
                  $r= signup();
                  $h="";
                  $s="hidden";
              }
              $schools= getdata();                       
          ?>
          <div class="card-body" <?= $s ?>>
            <form action="Teacher.php" method="post" >
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" class="form-control" name="first_name" required>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="school">Last Name</label>
                    <input type="text" class="form-control" name="last_name" required>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="email">School</label>
                    <select id="school" class="form-control" name="school" required>
                        <option value=""></option>
                        <?php foreach ($schools as $school=> $classes): ?>
                        <option value="<?php echo $school; ?>"><?php  echo $school; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="major">email</label>
                    <input type="email" class="form-control" name="email" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password_" required>
                <input hidden type="text" value="teacher" name="type_">
              </div>
              <button type="submit" class="btn btn-primary btn-block" name="submit">Sign Up</button>
            </form>
            <p class="text-center mt-3 mb-0 text-muted">Already have an account? <a href="../signin/">Sign in</a></p>
          </div>
          <div class="card-body" <?= $h ?>>
              
                <?php 
                if($r==1){
                  echo  "  <div class='form-group text-center py-4'>
                              <h4 class='text-success' >User Created successfully !</h4>
                            </div>
                            <a href='../signin' class='btn btn-primary btn-block'>Sign in</a> ";
                }else{
                  echo  "  <div class='form-group text-center'>
                              <h4 class='text-danger' >Error Creating User! </h4>
                            </div> ";
                            if($_POST['type_']=="teacher"){
                              echo "<a href='../signup/teacher.php' class='btn btn-primary btn-block'>Try Again</a> ";
                            }else{
                              echo "<a href='../signup/student.php' class='btn btn-primary btn-block'>Try Again</a>  ";
                            
                            }
                }
                ?>         
              
          </div>

        </div>
      </div>
    </div>
  </div>
</body>
</html>
