<?php
include "nav.php";
include 'conn.php';

if(isset($_SESSION['user'])){
  date_default_timezone_set('Africa/Cairo');
  
    if($_SERVER['REQUEST_METHOD'] == 'POST'){  // user come from https post 
        $ssn = $_POST['ssn'];
        $s_name = $_POST['s_name'];
        $s_mobile = $_POST['s_mobile'] ;
        $s_age = $_POST['s_age'] ;
        $s_add = $_POST['s_add'];
        $s_course = $_POST['course'];
        $s_gander = $_POST['s_gander'];
        $date = date('m/d/Y h:i:s a', time());
        


    
        
        
        $stmt =  $conn ->prepare("INSERT INTO `student`(`ssn` ,`name`, `mobile`, `age`, `address`, `gander`,`reg_date`,`Course_id`) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute(array($ssn,$s_name , $s_mobile , $s_age ,$s_add,$s_gander,$date,$s_course));  // send username and password as a parameters 
     // will add the record with  the user log on 
 

       $stmt1 = $conn->prepare("SELECT * FROM student WHERE ssn = ? ORDER BY id DESC LIMIT 1 ");
       $stmt1->execute(array($ssn));
       $row = $stmt1->fetch();
       $std_new_id = $row['id'];
    echo '    <div class="alert alert-success" role="alert">';
  echo  "Student Added Susessfully  with id :  ". $std_new_id . " in the Database ";
    echo '</div>';
    
        
        
        
        }
    





  
}
else{
  header('Location: login.php');  // if found sesiion with registered user will direct him to dashboard 
  exit();
}


?>

<h5 class="text-center">Add New Student </h5>

<form action="" method = "POST" >
<input type="text" class="form-control" name = "ssn" placeholder="National ID" autocomplete="off" required >
<input type="text" class="form-control" name = "s_name" placeholder="Student Name" autocomplete="off" required>
<input type="number" class="form-control" name = "s_mobile" placeholder="Student Mobile" required>
<input type="number" class="form-control" name = "s_age" placeholder="Age" required>
<input type="text" class="form-control" name = "s_add" placeholder="Address" required>



<?php
          $stmt =  $conn ->prepare("SELECT `id` FROM `courses` ");
          $stmt->execute();
          $rows = $stmt->fetchAll();
          $count = $stmt->rowCount();


  ?> 
<select name="course"  class="form-control">
  <option value="volvo">  Course ID </option>
<?php
          foreach($rows as $row){
            echo '<option'.' value='.$row['id'] . '>';
            echo $row['id'];
            echo '</option>';

          }
?>
</select>
<br><br>
  

  <label class="form-check-label">Gander</label>  
<input type="radio" id="male" name="s_gander" value="male" class="form-check-input" required >
  <label for="male" class="form-check-label">male</label>  

 <input type="radio" id="female" name="s_gander" value="female" class="form-check-input" required>
  <label for="female" class="form-check-label">female</label>
<br>
<input type="submit" class="btn btn-primary "  value = "Add Record">
<input type="reset" class="btn btn-danger "  value = "Cancle">
</form>



<?php 
include "fotter.php";
?>