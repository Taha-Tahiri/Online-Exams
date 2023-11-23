<?php

session_start();

if(isset($_SESSION['s_email'])){
    
 
?>

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
            <h4 class="">Update Your profile</h4>
          </div>
          <?php 
              include('../operations/sinsupop.php');
              $h="hidden";
              $s="";
              $id = $_GET['user'];
                $user = getuserbyid($id);
                $first_name1 = $user->first_name;
                $last_name1 = $user->last_name;
                $password1_ = $user->password_;
                $email1 = $user->email;
                $class1 = $user->class;
                $school1 = $user->school;
              if(isset($_POST['submit'])){
                
                 $r = updateUser($id);
                  $h="";
                  $s="hidden";
              };
              $schools=getdata();
           ?>
          <div class="card-body" <?= $s ?>>
            <form action="../Student/edit.php?user=<?=$id?>" method="post">
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" class="form-control" name="first_name" required value="<?= $first_name1?>">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="school">Last Name</label>
                    <input type="text" class="form-control" name="last_name" required value="<?= $last_name1?>">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="email">School</label>
                    <select id="school" class="form-control" name="school" onchange="updateClasses(this.value) <?php $class2 =''?>" required>
                        <option value=""></option>
                        <?php foreach ($schools as $school=> $classes): ?>
                        <option value="<?php echo $school; ?>" <?php if( $school == $school1){echo "selected";} ?>><?php  echo $school; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>  

                <div class="col">
                  <div class="form-group">
                    <label for="major">Class</label>
                    <select id="class"class="form-control" name="class" required>
                    <option value="<?php echo $class1; ?>" <?php if( $class1 != ""){echo "selected";} ?>><?php  echo $class1; ?></option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="password">Email</label>
                <input type="email" class="form-control" name="email" required value="<?= $email1?>">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password_" required value="<?= $password1_?>">
                <input hidden type="text" value="student" name="type_">
              </div>
              <button type="submit" class="btn btn-primary btn-block" name="submit">Update User</button>
            </form>
          </div>
          <div class="card-body" <?= $h ?>>
              
                <?php 
                if($r==1){
                  echo  "  <div class='form-group text-center py-4'>
                              <h4 class='text-success' >User Updated successfully !</h4>
                            </div>
                            <a href='../Student/home.php?user=$id'  class='btn btn-primary btn-block'>Go Back</a> ";
                }else{
                  echo  "  <div class='form-group text-center'>
                              <h4 class='text-danger' >Error Updating User! </h4>
                            </div> ";
                              echo "<a href='../Student/edit.php' class='btn btn-primary btn-block'>Try Again</a> ";
                            
                }
                ?>         
              
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
        function updateClasses(selectedSchool) {
            var classesSelect = document.getElementById("class");
            classesSelect.innerHTML = "";
            var classesArray = <?php echo json_encode($schools); ?>[selectedSchool];

            classesArray.forEach(function (className) {
                var option = document.createElement("option");
                option.value = className;
                option.text = className;
                classesSelect.appendChild(option);
            });
        }
    </script>
</body>
</html>
<?php    }   else
 header('location:../signin/');


?>