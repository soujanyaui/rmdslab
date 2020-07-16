<?php
// database connection using mysqli,
// I prefer using PDO for bigger projects since its a small projet i used mysqli, but i do know with PDO too.
$conn = mysqli_connect('localhost', 'souji','test121', 'rmdstest');
if(!$conn){
  die('Please check the database connection'.mysqli_error());
}
 ?>
