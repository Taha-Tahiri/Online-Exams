<?php 
function logout(){

    session_start();

    unset($_SESSION['s_nom']);
    unset($_SESSION['s_prenom']);
    
    session_destroy();

    header('location:../signin/');

    
}

function getdata(){
    $schools=[];
    include('db.php');
    $st=$con->prepare('select * from school');
    $st->execute(); 
    $data = $st->fetchAll(pdo::FETCH_OBJ);
    foreach($data as $sch){
        $st=$con->prepare('select * from class where school_id=:i');
        $id= $sch->id;
        $st->execute([':i'=>$id]); 
        $clas = $st->fetchAll(PDO::FETCH_OBJ);
        $hh=[];
        foreach($clas as $c){
                $n = $c->name_ ;
                array_push($hh, "$n");
            }
            $name = $sch->name_;
            $schools[$name]=$hh;
            };
    return $schools;
}
function getuserbyid($id){
    include('db.php');
    $st = $con->prepare('select * from users where user_id=:id');
    $st->execute([':id'=>$id]);
    $users = $st->fetchAll(PDO::FETCH_OBJ);
    $user = $users[0];
    return $user;
}

function updateUser($user_id)
{
    include('db.php');
    $st = $con->prepare("UPDATE users SET first_name=:f, last_name=:l, password_=:p, email=:e, class=:c, school=:s WHERE user_id=:id");
    $r = $st->execute([
        ':f' =>  $_POST['first_name'],
        ':l' =>  $_POST['last_name'],
        ':p' =>  $_POST['password_'],
        ':e' =>  $_POST['email'],
        ':c' =>  $_POST['class'],
        ':s' =>  $_POST['school'],
        ':id' =>  $user_id
    ]);
    if ($r == 1) {
        return 1;
    } else {
        return 0;
    }
}
function updateUsert($user_id)
{
    include('db.php');
    $st = $con->prepare("UPDATE users SET first_name=:f, last_name=:l, password_=:p, email=:e, school=:s WHERE user_id=:id");
    $r = $st->execute([
        ':f' =>  $_POST['first_name'],
        ':l' =>  $_POST['last_name'],
        ':p' =>  $_POST['password_'],
        ':e' =>  $_POST['email'],
        ':s' =>  $_POST['school'],
        ':id' =>  $user_id
    ]);
    if ($r == 1) {
        return 1;
    } else {
        return 0;
    }
}

function signup(){
    include('db.php');
    $st = $con->prepare("INSERT INTO users (first_name, last_name, password_, email, class, school, type_)
    VALUES (:first_name, :last_name, :password_, :email, :class, :school, :type_)");

    $st->bindParam(':first_name', $_POST['first_name']);
    $st->bindParam(':last_name', $_POST['last_name']);
    $st->bindParam(':password_', $_POST['password_']);
    $st->bindParam(':email', $_POST['email']);
    $st->bindParam(':class', $_POST['class']);
    $st->bindParam(':school', $_POST['school']);
    $st->bindParam(':type_', $_POST['type_']);

    $r = $st->execute();

    if($r==1){
        return 1;
        
    }else{
        return 0;
    };

}
function signin($email, $password_){

    include('db.php');
    
    $st=$con->prepare('select * from users where email=:e and password_=:p');
    $st->execute([':e'=> $email,':p'=>$password_]);      
    $user = $st->fetchAll(PDO::FETCH_OBJ);
    if(count($user)>0){
    return $user[0];}
   else{
    return "0";
   };          
}

?>