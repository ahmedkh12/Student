<?php
include "nav.php";
include 'conn.php';
?>

<div class="container text-center">
<form action="" method='POST'>
<label for="cc">Choose Course To Filter Students :</label>
<input list="courses" id="cc" name="userinput"  />
<datalist id="courses">

<?php
          $stmt =  $conn ->prepare("SELECT  `name` FROM `courses` ");
          $stmt->execute();
          $rows = $stmt->fetchAll();
          $count = $stmt->rowCount();

          foreach($rows as $row){
            echo '<option'.' value='. $row['name'] . '>';
            echo '</option>';

          }
  ?>

</datalist>


<?php
          $stmt =  $conn ->prepare("SELECT  `username` FROM `users` ");
          $stmt->execute();
          $rows = $stmt->fetchAll();
          $count = $stmt->rowCount();

          foreach($rows as $row){
            echo '<option'.' value='.$row['username'] . '>';
            echo '</option>';

          }
  ?>
</datalist>
<div class="d-grid gap-2">
<input type="Submit" value ="Find" class="btn btn-primary " >
</div>

</form>
</div>


<?php

if(isset($_SESSION['user'])){

    if($_SERVER["REQUEST_METHOD"] == 'POST'){

        // echo $_POST['userinput'];
        
        
        $stmt =  $conn ->prepare("SELECT student.id , student.ssn ,student.name as student_name ,student.mobile , student.age , student.address, student.gander ,student.reg_date as Register_Date ,
        courses.name , courses.price , courses.inst_name
        FROM `student` , `courses` 
        WHERE  student.Course_id = courses.id  AND courses.name = ? ");
        $stmt->execute(array($_POST['userinput']));
        $rows = $stmt->fetchAll();
        $count = $stmt->rowCount();
        
        
        
        
        
        
        
        ?>
        <table class="table table-striped">
        <thead>
        <tr>
        <th scope="col">Student Id</th>
        <th scope="col">SSN</th>
        <th scope="col">Student Name</th>
        <th scope="col">Mobile</th>
        <th scope="col">age</th>
        <th scope="col">address</th>
        <th scope="col">gander</th>
        <th scope="col">Register Date</th>
        <th scope="col">Course Name</th>
        <th scope="col">Instructor Name</th>
        
        </tr>
        </thead>
        <tbody>
        <?php
        if($count > 0){
            echo  $count . " Record Found ";
        foreach($rows as $row ){
        echo "<tr>";
        echo "<td>".$row['id']. "</td>";
        echo "<td>".$row['ssn']. "</td>";
        echo "<td>".$row['student_name']. "</td>";
        echo "<td>".$row['mobile']. "</td>";
        echo "<td>".$row['age']. "</td>";
        echo "<td>".$row['address']. "</td>";
        echo "<td>".$row['gander']. "</td>";
        echo "<td>".$row['Register_Date']. "</td>";
        echo "<td>".$row['name']. "</td>";
        echo "<td>".$row['inst_name']. "</td>";
        echo "</tr>";
        
        }
        }
        else{
        echo "No Record Found ";
        }
        ?>
        </tbody>
        </table>
        <?php
        
        
        
        
        
        
        
        
        
        
        
        }
    
}
else {
    header('Location: login.php');  // if found sesiion with registered user will direct him to dashboard 
    exit();
}




?>

<?php 
include "fotter.php";
?>