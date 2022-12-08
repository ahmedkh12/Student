<?php
include "nav.php";
include "conn.php";
if(isset($_SESSION['user'])){
    echo $_GET['id'];

    $stmt =  $conn ->prepare("DELETE FROM `courses` WHERE id = ?");
    $stmt->execute(array($_GET['id'])); 

sleep(3);
header('Location: courses.php');
exit();





}
else{
    header('Location: login.php');  // if found sesiion with registered user will direct him to dashboard 
    exit();
}
?>

<?php 
include "fotter.php";
?>