<?php

include "nav.php";
include 'conn.php';

if(isset($_SESSION['user'])){
            
   
    $stmt =  $conn ->prepare("SELECT `id`, `name`, `price`, `inst_name` FROM `courses` WHERE id = ?");
    $stmt->execute(array($_GET['id']));  
    $row = $stmt ->fetch();


    if($_SERVER['REQUEST_METHOD'] == 'POST'){  // user come from https post 
        $c_id = $_POST['c_id'];
        $c_name = $_POST['c_name'];
        $c_price = $_POST['c_price'] ;
        $c_inst = $_POST['c_inst'] ;

        $stmt_update =  $conn ->prepare("UPDATE `courses` SET `name`=?,`price`= ? ,`inst_name`=? WHERE id=?");
        $stmt_update->execute(array($c_name,$c_price,$c_inst,$_GET['id']));  
    
        echo '    <div class="alert alert-success" role="alert">';
        echo  "Record  Updated Susessfully  , Course Id  :  ". $_GET['id'];
          echo '</div>';
 
        }
    





  
}
else{
  header('Location: login.php');  // if found sesiion with registered user will direct him to dashboard 
  exit();
}

?>
<form action="" method = "POST" >
    <label for="">ID :</label>
<input type="text" class="form-control" name = "c_id"  autocomplete="off" required value = <?php echo $_GET['id']?> readonly>
<label for="">Couser Name :</label>
<input type="text" class="form-control" name = "c_name" placeholder="Course Name" autocomplete="off" required value = <?php echo $row['name']?>>
<label for="">Price :</label>
<input type="number" class="form-control" name = "c_price" placeholder="course price" required value = <?php echo $row['price']?>>
<label for="">Instructor Name :</label>
<input type="text" class="form-control" name = "c_inst" placeholder="Instructor Name" required value = <?php echo $row['inst_name']?>>

<div class="d-grid gap-2">
<input type="submit" class="btn btn-primary "  value = "Save">
<a href="courses.php" class="btn btn-danger " >Back To List</a>
</div>
</form>

<?php 
include "fotter.php";
?>