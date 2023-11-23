<?php 
function getquestions($exam_id){
    include('db.php');
    $st = $con->prepare('select * from questions where exam_id=:id');
    $st->execute([':id'=>$exam_id]);
    $questions = $st->fetchAll(PDO::FETCH_OBJ);
    return $questions;
}
function getuser($id){
    include('db.php');
    $st = $con->prepare('select * from users where user_id=:id');
    $st->execute([':id'=>$id]);
    $users = $st->fetchAll(PDO::FETCH_OBJ);
    $user = $users[0];
    return $user;
}

function getexambyid($exam_id){
    include('db.php');
    $st = $con->prepare('SELECT * FROM exams WHERE exam_id = :id');
    $st->bindParam(':id', $exam_id);
    $st->execute();
    $exams = $st->fetchAll(PDO::FETCH_OBJ);
    return $exams[0];
}

function getexams($user_id){
    include('db.php');
    include('sinsupop.php');
    $user=getuserbyid($user_id);
    $st = $con->prepare('SELECT * FROM exams WHERE school_n = :school AND class_n = :class');
    $st->bindParam(':school', $user->school);
    $st->bindParam(':class', $user->class);
    $st->execute();
    $exams = $st->fetchAll(PDO::FETCH_OBJ);
    return $exams;
}

function getexamsforteacher($user_id){
    include('db.php');
    include('sinsupop.php');
    $st = $con->prepare('SELECT * FROM exams WHERE user_id = :id');
    $st->bindParam('id', $user_id);
    $st->execute();
    $exams = $st->fetchAll(PDO::FETCH_OBJ);
    return $exams;
}

function createxam($user, $class, $exam_id){
    include('db.php');
    $user_id = $user->user_id;
    $school_n = $user->school;
   
        $st = $con->prepare("INSERT INTO exams (exam_id, user_id, school_n, name_, start_d, finish_d, duration, class_n)
        VALUES (:exam_id, :user_id, :school_n, :name_, :start_d, :finish_d, :duration, :class_n)");
        $st->bindParam(':exam_id', $exam_id);
        $st->bindParam(':user_id', $user_id);
        $st->bindParam(':school_n', $school_n);
        $st->bindParam(':name_', $_POST['name_']);
        $st->bindParam(':start_d', $_POST['start_d']);
        $st->bindParam(':finish_d', $_POST['finish_d']);
        $st->bindParam(':duration', $_POST['duration']);
        $st->bindParam(':class_n', $class);
    
    $r = $st->execute();

    if($r==1){
        return 1;
        
    }else{
        return 0;
    };

};

function createquestions($exam_id, $choices, $qn){
    include('db.php');
    $st = $con->prepare("INSERT INTO questions(exam_id, qn, question, choices, points)
    VALUES (:exam_id, :qn, :question, :choices, :points)");
     $st->bindParam(':exam_id', $exam_id);
     $st->bindParam(':qn', $qn);
     $st->bindParam(':question', $_POST['question']);
     $st->bindParam(':choices', $choices);
     $st->bindParam(':points', $_POST['points']);
     $r= $st->execute();
     if($r==1){
        return 1;
        
    }else{
        return 0;
    };

}

function creategrade($id, $exam_id, $grade, $totale){
    include('db.php');
    $st = $con->prepare("INSERT INTO grades(exam_id, user_id, note, totale)
    VALUES (:exam_id, :user_id, :note, :totale)");
     $st->bindParam(':exam_id', $exam_id);
     $st->bindParam(':user_id', $id);
     $st->bindParam(':note', $grade);
     $st->bindParam(':totale', $totale);
     $r = $st->execute();
     if($r==1){
        return 1;
        
    }else{
        return 0;
    };
}

function getgrade($id, $exam_id){
    include('db.php');
    $st = $con->prepare("SELECT * FROM grades WHERE exam_id=:exam AND user_id=:id ");
    $st->execute([':exam'=>$exam_id, 'id'=>$id]);
    $grade = $st->fetchAll(PDO::FETCH_OBJ);
    if(count($grade) >= 1){
        $grade = $grade[0];
        return $grade;
    }else {
        $grade = [
            'exam_id' =>"",
            'user_id' => "",
            'note' => ""
        ];
        return $grade;}
    
}


function getgrades($id){
    include('db.php');
    $st = $con->prepare("SELECT * FROM grades WHERE user_id=:id ");
    $st->execute([ 'id'=>$id]);
    $grades = $st->fetchAll(PDO::FETCH_OBJ);
    if(count($grades) >= 1){
        return $grades;
    }else {
        $grades = [
            [ 'exam_id' =>"", 'user_id' => "", 'note' => "", 'totale' =>"" ], [ 'exam_id' =>"", 'user_id' => "", 'note' => "", 'totale' =>"" ]
            ];
        return $grades;}
    
}
function getgradesforteacher($exam_id, $class_n){
    include('db.php');
    $st = $con->prepare('SELECT * FROM grades INNER JOIN users 
    ON  users.class =:c  AND grades.user_id = users.user_id AND grades.exam_id=:e;');
    $st->bindParam(':c', $class_n);
    $st->bindParam(':e', $exam_id);
    $st->execute();
    $exams = $st->fetchAll(PDO::FETCH_OBJ);
    return $exams;
}




?>