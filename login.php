<?php
include "conn.php";
session_start();
if(isset($_SESSION['user'])){
    header('Location: home.php');  // if found sesiion with registered user will direct him to dashboard 
    exit();
}



if($_SERVER['REQUEST_METHOD'] == 'POST'){  // user come from https post 

$username = $_POST['user'];
$password = $_POST['pass'] ;
$hashedpass = sha1($password) ; // encrypt the password 



$stmt =  $conn ->prepare("SELECT id,username , password From users WHERE Username = ? AND password = ?  ");

$stmt->execute(array($username , $hashedpass));  // send username and password as a parameters 
$row = $stmt->fetch() ; // fetch the record 
$count = $stmt->rowCount(); // count the result of the selcet 
if($count > 0 ){
    $_SESSION['user'] = $username ;
    $_SESSION['userid'] = $row['id'];

    header('Location: home.php');
    exit();
    
}




}








?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <title>Login</title>
</head>
<body>

    <div class="container m-t-5">
<form action="" method = "POST" >
<input type="text" class="form-control" name = "user" placeholder="UserName" autocomplete="off" required>
<input type="password" class="form-control" name = "pass" placeholder="Password" required>
<div class="d-grid gap-2">
<input type="submit" class="btn btn-primary "  value = "Login">
</div>
</form>

</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php 
include "fotter.php";
?>