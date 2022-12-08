<?php
include "nav.php";
include 'conn.php';
?>

<form action="" method = "POST" >
<input type="number" class="form-control" name = "s_id" placeholder="National ID" required>
<div class="d-grid gap-2">
<input type="submit" class="btn btn-primary "  value = "Get Data ">
</div>
</form>

<?php


if(isset($_SESSION['user'])){
  


if($_SERVER['REQUEST_METHOD'] == 'POST'){  // user come from https post 

  $serch = $_POST['s_id'];


    $stmt =  $conn ->prepare("SELECT student.id ,student.ssn,student.name as student_name ,student.mobile , student.age , student.address, student.gander , student.reg_date as Register_Date ,
    courses.name as c_name
    FROM `student` , `courses` 
    WHERE  student.Course_id = courses.id AND ssn = ? ");
    $stmt->execute(array($serch));
    $rows = $stmt->fetchAll();
    $count = $stmt->rowcount();
    // echo $count;
   
  ?>
<table class="table table-striped">
<thead class="table-primary">
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">National ID</th>
      <th scope="col">Student Name</th>
      <th scope="col">Mobile</th>
      <th scope="col">age</th>
      <th scope="col">address</th>
      <th scope="col">gander</th>
      <th scope="col">Register Date </th>
      <th scope="col">course name</th>

    </tr>
  </thead>
  <tbody>
<?php

if($count > 0 ) {
  echo  $count . "  row  found  ";
  foreach($rows as $row){
    echo "<tr>";
    echo "<td>".$row['id']. "</td>";
    echo "<td>".$row['ssn']. "</td>";
    echo "<td>".$row['student_name']. "</td>";
    echo "<td>".$row['mobile']. "</td>";
    echo '<td>'. $row['age'].'</td>';
    echo '<td>'. $row['address'].'</td>';
    echo '<td>'. $row['gander'].'</td>';
    echo '<td>'. $row['Register_Date'].'</td>';
    echo '<td>'. $row['c_name'].'</td>';
   
    echo "</tr>";
  }
}
elseif($count<1){
  echo $count . " row found ";
}

?>
</tbody>
</table>



<?php
  }


}
else{
  header('Location: login.php');  // if found sesiion with registered user will direct him to dashboard 
  exit();
}





?>








<?php 
include "fotter.php";
?>