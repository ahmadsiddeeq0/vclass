<?php
include "indheader.php";

$usrses=$_SESSION['username'];
$sql = "SELECT * FROM newc WHERE username='$usrses'";
$result = $conn->query($sql);

  echo'
  <div class="container">
  <div class="card bg-light">
  <h5 class="card-header">My classrooms</h5>
  <div class="card-body">
    <p class="card-text">';

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
   
    echo'

          <div class="card m-3" bg-light>
            <div class="card-body">
            <a href="myclass.php?idnewc='.$row["idnewc"].'">'. $row["newnamed"] .'</a>
            </div>
          </div>
        
    ';
  }
}

else{
  echo'
  <div class="alert alert-secondary" role="alert">
  No classrooms yet
</div>
';
}
  echo'
  </p>
  </div>
  </div>
  </div>
';

echo'
  <br>
';




$usrses=$_SESSION['username'];
$sql = "SELECT * FROM teacher WHERE usernamet='$usrses'";
$result = $conn->query($sql);

echo'
<div class="container">
<div class="card bg-light">
<h5 class="card-header">Post classrooms</h5>
<div class="card-body">
  <p class="card-text">';

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
 
  echo'

        <div class="card m-3" bg-light>
          <div class="card-body">
          <a href="semiclass.php?idnewtea='.$row["idnewtea"].'">'. $row["newnamedt"] .'</a>
          </div>
        </div>
      
  ';
}
}

else{
  echo'
  <div class="alert alert-secondary" role="alert">
  No classrooms yet
</div>
';
}
  echo'
  </p>
  </div>
  </div>
  </div>
  <br>
';







$usrses=$_SESSION['username'];
$sql = "SELECT * FROM approv WHERE usernamev='$usrses'";
$result = $conn->query($sql);

  echo'
  <div class="container">
  <div class="card bg-light">
  <h5 class="card-header">Joined classrooms</h5>
  <div class="card-body">
    <p class="card-text">';

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
   
    echo'

          <div class="card m-3">
            <div class="card-body">
            <a href="joinclass.php?idnewc='.$row["idjoincv"].'">'. $row["joinnamev"] .'</a>
            </div>
          </div>
        
    ';
  }
}

else{
  echo'
  <div class="alert alert-secondary" role="alert">
  No classrooms yet
</div>
';
}
  echo'
  </p>
  </div>
  </div>
  </div>
  <br>
';





?>
