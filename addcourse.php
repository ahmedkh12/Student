<?php

include "nav.php";
include 'conn.php';

if(isset($_SESSION['user'])){
  
    if($_SERVER['REQUEST_METHOD'] == 'POST'){  // user come from https post 

        $c_name = $_POST['c_name'];
        $c_price = $_POST['c_price'] ;
        $c_inst = $_POST['c_inst'] ;


    
    
        
        
        $stmt =  $conn ->prepare("INSERT INTO `courses`(`name`, `price`, `inst_name`) VALUES (?,?,?)");
        $stmt->execute(array($c_name , $c_price , $c_inst));  
    
        echo '    <div class="alert alert-success" role="alert">';
        echo  "Course Added Susessfully  Added Sucessfully  ";
         echo '</div>';

          sleep(3);
          header('Location: courses.php'); 
              


        
        
        
        }
    





  
}
else{
  header('Location: login.php');  // if found sesiion with registered user will direct him to dashboard 
  exit();
}

?>
<form action="" method = "POST" >
<input type="text" class="form-control" name = "c_name" placeholder="Course Name" autocomplete="off" required>
<input type="number" class="form-control" name = "c_price" placeholder="course price" required>
<input type="text" class="form-control" name = "c_inst" placeholder="Instructor Name" required>

<div class="d-grid gap-2">
<input type="submit" class="btn btn-primary "  value = "Add Record">
<a href="courses.php" class="btn btn-danger " >Back To List</a>
</div>
</form>

<?php 
include "fotter.php";
?>