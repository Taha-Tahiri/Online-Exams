<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Online Exams - Sign In</title>
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
    <div class="row justify-content-center" >
      <div class="col-lg-4 col-md-6 ">
        <div class="card" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
          <div class="card-header bg-light text-center">
            <h4 class="">Sign In</h4>
          </div>
          <div class="card-body">
            <?php
            include('../operations/db.php');
            include('../operations/sinsupop.php');
            $message="";
            if(isset($_POST['submit'])){
              $email=$_POST['email'];
              $password_=$_POST['password_'];
              $user=signin($email, $password_);
              if($user!="0"){
                $_SESSION['s_email'] = $user->email;
                $_SESSION['s_password_'] = $user->password_;
                $id=$user->user_id;
                $message= 'login successfully';
                if($user->type_=="student"){
                    header("location:../Student/home.php?user=$id");
                }else{
                    header("location:../Teacher/home.php?user=$id");
                }
                
             }else{
                $message = "Email ou mot de passe incorrectes!!!";
             }
              }

            
            ?>
            <form action="../signin/index.php" method="post">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password_" required>
              </div>
              <p class="text-danger"><?= $message ?></p>
              <button type="submit" class="btn btn-primary btn-block" name="submit">Sign In</button>
            </form>

            <p class="text-center mt-3 mb-0 text-muted">Don't have an account? <a href="../index.html">Sign up</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
