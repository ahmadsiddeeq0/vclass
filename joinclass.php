<title>Joined classrooms</title>

<?php
include "indheader.php";

$idnewc=$_GET['idnewc'];




// $sql = "SELECT * FROM newc WHERE idnewc='$idnewc'";
// $result = $conn->query($sql);
// if($result->num_rows > 0) {
//   while($row = $result->fetch_assoc()) {
//       $tempusr=$row['username'];
//       $tempcod=$row['newcode'];
//       $tempnam=$row['newnamed'];
//   }
// }

$curusr = $_SESSION['username'];

$sql = "SELECT * FROM approv WHERE idjoincv='$idnewc'";
$result = $conn->query($sql);
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $tempusr=$row['usernamev'];
      $tempcod=$row['joincodev'];
      $tempnam=$row['joinnamev'];
      $idjoincv=$row['idjoincv'];
  }
}

/*
if(isset($_POST["submit"])) {

    $name=$_FILES['upload']['name'];
    $size=$_FILES['upload']['size'];
    $tname=$_FILES['upload']['tmp_name'];
    $type=$_FILES['upload']['type'];
    $dir ="i/";
    $path=$dir. $name;
    $ext=substr($type,-3);
    $extx=substr($type,-4);
    $title=$_POST['title'];
    $description=$_POST['description'];
    $stmt = $conn->prepare("INSERT INTO images (name, size, type, path, title, description, usrnam , cod, nam) VALUES (?, ?, ?,?, ?, ?,?, ?, ?)");
    $stmt->bind_param("sisssssss", $name, $size, $type, $path, $title, $description, $tempusr, $tempcod ,$tempnam);
    $stmt->execute();
    move_uploaded_file($tname, $path);
}

*/
echo'
<div class="container">

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Posts</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Leave this classroom</a>
  </li>
  
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  ';
  
$sql = "SELECT * FROM images  WHERE cod='$tempcod' ORDER BY uploaded_date DESC";
$result = $conn->query($sql);
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {

echo'
<a href="viewjo.php?idimg='.$row['idimg'].'&idnewc='.$idnewc.'">
<div class="card bg-light">
<div class="card-header">
<div class="row ml-1">
  <div>
     '.$row['title'].'
  </div>
  <div class="ml-auto mr-3">
     '.$row['usrnam'].'
  </div>
</div>
</div>
</a>
<div class="card-body">';
if($row['size'] != 0){
echo'
<div class="alert alert-info" role="alert">
<a href="'.$row['path'].'">attachment</a>
</div>';
}
echo'
<p class="card-text">'.$row['description'].'</p>
</div>
<div class="card-footer text-muted">
'.$row['uploaded_date'].'
</div>
</div>
</br>
';
}
}
echo'
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  

      <div class="card bg-light mb-3">
  <div class="card-header">Are you sure you want to leave this classroom</div>
  <div class="card-body">
    <p class="card-text">
<a class="btn btn-danger" href="leave.php?idjoincv='.$idjoincv.'" role="button">Leave this classroom</a>
      
    </p>
  </div>
</div>


  </div>
</div>
</div>

';
?>


