<?php
    include "nav.php";
    include 'conn.php';
    
if(isset($_SESSION['user'])){


    $stmt =  $conn ->prepare("SELECT student.id , student.ssn ,student.name as student_name ,student.mobile , student.age , student.address, student.gander ,student.reg_date as Register_Date ,
    courses.name , courses.price , courses.inst_name
    FROM `student` , `courses` 
    WHERE  student.Course_id = courses.id  ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    
    // echo "<pre>";
    // print_r($rows);
    // echo "</pre>";


}
else{
header('Location: login.php');  // if found sesiion with registered user will direct him to dashboard 
exit();
}

?>



<table class="table table-striped" >
<thead class="table-primary">
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">National ID</th>
      <th scope="col">Student Name </th>
      <th scope="col">Mobile</th>
      <th scope="col">age</th>
      <th scope="col">address</th>
      <th scope="col">gander</th>
      <th scope="col">Register Date</th>
      <th scope="col">course Name</th>
      <th scope="col">course Price</th>
      <th scope="col">Instructor</th>
 
    </tr>
  </thead>
  <tbody id="data">
<?php

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
    echo "<td>".$row['price']. "</td>";
    echo "<td>".$row['inst_name']. "</td>";

    echo "</tr>";
    
    }
    ?>
    </tbody>

</table>

<?php 
include "fotter.php";
?>