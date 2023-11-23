<?php 
try {


    $con= new PDO('mysql:host=localhost;dbname=online_exams','root','');
    
} catch (\Exception $th) {
  

    echo $th->getMessage();
}
?>