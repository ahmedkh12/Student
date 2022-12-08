<?php
include "nav.php";
include 'conn.php';

if(isset($_SESSION['user'])){
  

  $stmt =  $conn ->prepare("SELECT `id`, `name`, `price`, `inst_name` FROM `courses` ");
  $stmt->execute();
  $rows = $stmt->fetchAll();





  
}
else{
  header('Location: login.php');  // if found sesiion with registered user will direct him to dashboard 
  exit();
}






?>
<br>

<a href="addcourse.php" class="btn btn-primary">Add New</a>
<br> <br>

<table class="table table-striped">
<thead class="table-primary">
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">Course Name</th>
      <th scope="col">Price</th>
      <th scope="col">Instructor Nmae</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php

foreach($rows as $row ){
echo "<tr>";
echo "<td>".$row['id']. "</td>";
echo "<td>".$row['name']. "</td>";
echo "<td>".$row['price']. "</td>";
echo "<td>".$row['inst_name']. "</td>";
echo '<td>' ;
echo '<div>';
echo '<a href="update_c.php?id='. $row['id'].' "class="btn btn-primary " title="Update Record" data-toggle="tooltip">Edit</a>';
echo" ";
echo '<a href="delete_c.php?id='.$row['id'].'  "class="btn btn-danger"" title="Update Record" data-toggle="tooltip">Delete</a>';
echo '</div>';
echo '</td>';
echo "</tr>";

}


?>
  </tbody>
</table>

<?php 
include "fotter.php";
?>