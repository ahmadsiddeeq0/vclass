<title>My classrooms</title>
<?php
include "indheader.php";
$idnewc=$_GET['idnewc'];

$sqlun = "SELECT * FROM newc where idnewc='$idnewc'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();
if($row["username"] != $_SESSION["username"]){
 echo("<script>location.href = 'index.php';</script>");

}

$curses = $_SESSION['username'];



$sql = "SELECT * FROM newc WHERE idnewc='$idnewc'";
$result = $conn->query($sql);
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $tempusr=$row['username'];
      $tempcod=$row['newcode'];
      $tempnam=$row['newnamed'];
  }
}



if(isset($_POST["submit"])) {
$sqlun = "SELECT * FROM newc where idnewc='$idnewc'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();
if($row["username"] == $_SESSION["username"]){

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
else{
 echo("<script>location.href = 'index.php';</script>");
}

}
echo'
<div class="container">

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Posts</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Classroom\'s code</a>
  </li>
  <li class="nav-item" role="presentation">
  <a class="nav-link" id="pills-tech-tab" data-toggle="pill" href="#pills-tech" role="tab" aria-controls="pills-tech" aria-selected="false">Teachers</a>
</li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Students</a>
  </li>  
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-del-tab" data-toggle="pill" href="#pills-del" role="tab" aria-controls="pills-del" aria-selected="false">Delete classroom</a>
  </li>  
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">




  <form method="POST" enctype="multipart/form-data">
      <label for="exampleFormControlFile1">Choose a file</label>
       <div class="custom-file mb-3">
          <label class="custom-file-label" for="validatedCustomFile">Choose a file</label>
          <input type="file" class="custom-file-input" id="validatedCustomFile" name="upload">
        </div>

      <div class="form-group">
          <label for="exampleInputEmail1">Tilte</label>
          <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title">
          <small id="emailHelp" class="form-text text-muted">post\'s title</small>
      </div>

      <div class="form-group">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" placeholder="Description"></textarea>
          <small id="emailHelp" class="form-text text-muted">post\'s description</small>
      </div>

      <div class="form-group">
          <input type="submit" name="submit" class="btn btn-dark" value="Publish">
      </div>

  </form>
<br>



  ';
  
  
$sql = "SELECT * FROM images WHERE cod='$tempcod' AND nam='$tempnam'  ORDER BY uploaded_date DESC";
$result = $conn->query($sql);
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      echo'
      <a href="view.php?idimg='.$row['idimg'].'&idnewc='.$idnewc.'">
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
      <p class="card-text">'.$row['description'].'</p>';
if($row['usrnam'] == $_SESSION["username"]){

      echo'<a class="btn btn-secondary" href="editimg.php?idimg='.$row['idimg'].'&idnewc='.$idnewc.'">edit</a>
      <a class="btn btn-danger" href="deleteimg.php?idimg='.$row['idimg'].'&idnewc='.$idnewc.'">delete</a>';
}
    echo'</div>
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
  
  
  
  
<div class="container">
<div class="card bg-light mb-3" >
  <div class="card-header">my Vclass code</div>
  <div class="card-body">
    <p class="card-text">

    <div class="alert alert-secondary font-weight-bold text-center display-4" role="alert">';
    $sql = "SELECT * FROM newc WHERE idnewc='$idnewc'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo $row['newcode'];
      }
    }


    echo'
  </div>
    </p>
  </div>
  </div>
</div>
</div>
  
  










<div class="tab-pane fade" id="pills-tech" role="tabpanel" aria-labelledby="pills-tech-tab">
  



  <form method="post">
      <label>Please enter a teasher\'s username</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">username</span>
        </div>
          <input type="text" name="addtea" placeholder="username" class="form-control rounded-right" title="username" required>
        <div class="invalid-feedback">
          Code
        </div>
      </div>
          <small id="emailHelp" class="form-text text-muted">Enter a valid username</small>

      <div class="form-group mt-2">
          <input type="submit" name="subtea" class="btn btn-dark" value="Add">
      </div>

  </form>


  ';

if(isset($_POST['subtea'])){
$sqlun = "SELECT * FROM newc where idnewc='$idnewc'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();
if($row["username"] == $_SESSION["username"]){

  $addtea = $_POST['addtea'];

  $sql = "SELECT * FROM newc WHERE idnewc='$idnewc'";
  $result = $conn->query($sql);
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $curusr = $row['username'];
        $curcod = $row['newcode'];
        $curnam = $row['newnamed'];
    }
  }


$stmt = $conn->prepare("SELECT * FROM user WHERE username=? ");
$stmt->bind_param("s", $addtea);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {

  $stmt = $conn->prepare("SELECT * FROM teacher WHERE usernamet=? AND newcodet='$curcod'");
  $stmt->bind_param("s", $addtea);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    
  echo '
  <div class="alert alert-danger" role="alert">
  Can not add the same teacher twice
</div>
  ';
  }
  else{

    if ($addtea == $curses) {
      echo'
      <div class="alert alert-danger" role="alert">
      Can not add yourself
    </div>
      ';

    }
    else{


    $stmt = $conn->prepare("INSERT INTO teacher (usernamet, newcodet, newnamedt, ownert) VALUES (?, ?, ? ,?)");
    $stmt->bind_param("ssss", $addtea, $curcod, $curnam, $curses);
    $stmt->execute();
}

    
    $stmt = $conn->prepare("SELECT * FROM approv WHERE usernamev=? ");
    $stmt->bind_param("s", $addtea);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
      
    

  $sqlde = "DELETE FROM approv WHERE usernamev='$addtea' AND joincodev='$curcod'";
  $conn->query($sqlde);
    }

}
  }
else{
  echo '
  <div class="alert alert-danger" role="alert">
  Invalid teacher
</div>
  ';
}

}
else{
 echo("<script>location.href = 'index.php';</script>");
}




}

  

$sql = "SELECT * FROM newc WHERE idnewc='$idnewc'";
$result = $conn->query($sql);
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $thiscode = $row['newcode'];
  }
}

$sql = "SELECT * FROM teacher WHERE newcodet='$thiscode'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
         

      echo'
  
      <div class="card bg-light">
      <div class="card-body">
      '.$row['usernamet'].'
      <div class="float-right">
      ';
      if( $row['ownert'] == $_SESSION['username']) {
        echo'
      <a href="dngrade.php?username='.$row['usernamet'].'&idnewc='.$idnewc.'" class="btn btn-danger">Remove teacher</a>
      ';
      }
      echo'
      </div>
      </div>
    </div>
    <br>
';
  }
}
else{
  echo'
  <div class="alert alert-secondary" role="alert">
  No teachers yet
</div>
  ';
}
echo'
</div>
  




  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
  
  <form method="post">
      <label>Please enter a student\'s username</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">username</span>
        </div>
          <input type="text" name="addstu" placeholder="username" class="form-control rounded-right" title="username" required>
        <div class="invalid-feedback">
          Code
        </div>
      </div>
          <small id="emailHelp" class="form-text text-muted">Enter a valid username</small>

      <div class="form-group mt-2">
          <input type="submit" name="substu" class="btn btn-dark" value="Add">
      </div>

  </form>


  ';

if(isset($_POST['substu'])){
$sqlun = "SELECT * FROM newc where idnewc='$idnewc'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();
if($row["username"] == $_SESSION["username"]){


  $addstu = $_POST['addstu'];

  $sql = "SELECT * FROM newc WHERE idnewc='$idnewc'";
  $result = $conn->query($sql);
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $curusr = $row['username'];
        $curcod = $row['newcode'];
        $curnam = $row['newnamed'];
    }
  }


$stmt = $conn->prepare("SELECT * FROM user WHERE username=? ");
$stmt->bind_param("s", $addstu);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {

  $stmt = $conn->prepare("SELECT * FROM approv WHERE usernamev=? AND joincodev='$curcod'");
  $stmt->bind_param("s", $addstu);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    
  echo '
  <div class="alert alert-danger" role="alert">
  Can not add the same student twice
</div>
  ';
  }
  else{

  
    if ($addstu == $curses) {
      echo'
      <div class="alert alert-danger" role="alert">
      Can not add yourself
    </div>
      ';

    }
    else{
  $stmt = $conn->prepare("INSERT INTO approv (usernamev, joincodev, ownerdv, joinnamev) VALUES (?, ?, ? ,?)");
  $stmt->bind_param("ssss", $addstu, $curcod, $curses, $curnam);
  $stmt->execute();

  $stmtvb = $conn->prepare("SELECT * FROM teacher WHERE usernamet=? ");
  $stmtvb->bind_param("s", $addstu);
  $stmtvb->execute();
  $resultvb = $stmtvb->get_result();


  if ($resultvb->num_rows > 0) {
    

  $sqldee = "DELETE FROM teacher WHERE usernamet='$addstu' AND newcodet='$curcod'";
  
  if($conn->query($sqldee)){
    echo("<script>location.href = 'myclass.php?idnewc=$idnewc';</script>");

  }
  }
  }
}
}
else{
  echo '
  <div class="alert alert-danger" role="alert">
  Invalid student
</div>
  ';
}



}
else{
 echo("<script>location.href = 'index.php';</script>");
}
}
  $thiscode = "";

  $sql = "SELECT * FROM newc join approv ON newc.newcode=approv.joincodev WHERE idnewc='$idnewc'";
  $result = $conn->query($sql);
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $thiscode = $row['newcode'];
    }
  }
  
  $sql = "SELECT * FROM approv WHERE joincodev='$thiscode'";
      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           
  
          echo '
          <div class="card bg-light">
  <div class="card-body">
  '.$row['usernamev'].'
  <div class="float-right">
  ';
  if($row['ownerdv'] == $curses){
    echo'
  <a href="kick.php?idjoincv='.$row['idjoincv'].'&idnewc='.$idnewc.'" class="btn btn-danger">Delete</a>
  <a href="upgrade.php?idjoincv='.$row['idjoincv'].'&idnewc='.$idnewc.'" class="btn btn-info">Make as teacher</a>
  ';
  }
        echo'
        </div>
        </div>
      </div>
      <br>
  ';
    }
  }
    else{
      echo'
      <div class="alert alert-secondary" role="alert">
      No students yet
    </div>
      ';
    }
    echo'

    </div>


    <div class="tab-pane fade" id="pills-del" role="tabpanel" aria-labelledby="pills-del-tab">
  
    
    <div class="card bg-light mb-3">
    <div class="card-header">Are you sure you want to delete this classroom</div>
    <div class="card-body">
      <p class="card-text">
  <a class="btn btn-danger" href="delall.php?idnewc='.$idnewc.'" role="button">Delete this classroom</a>
        
      </p>
    </div>
  </div>
  
   
    </div>
  </div>';




?>


