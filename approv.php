<title>Approve students</title>

<?php
include "indheader.php";



$usr=$_SESSION['username'];
$sql = "SELECT * FROM joinc WHERE ownerd = '$usr'";
$result = $conn->query($sql);

if (!empty($result) && $result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo'
    <div class="container">
    <div class="card bg-light">
  <div class="card-header">
    Confirm
  </div>
  <div class="card-body">
    <p class="card-text">Vclass name :  '. $row["joinname"].'</p>
    <p class="card-text">Vclass code :  '. $row["joincode"].'</p>
    <p class="card-text">student\'s name :  '. $row["username"].'</p>
    <a href="appper.php?nam='.$row["joinname"].'&idc='.$row["idjoinc"].'" class="btn btn-success">Approve</a>
    <a href="delper.php?nam='.$row["joinname"].'&idc='.$row["idjoinc"].'" class="btn btn-danger">Delete</a>
  </div>
</div>
</br>
</div>
';

  }
}
else{
  echo'
  <div class="container">
      <div class="alert alert-secondary" role="alert">
          No students to approve
      </div>
  </div>';}
?>