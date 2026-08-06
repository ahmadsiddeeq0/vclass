<title>My classrooms</title>
<?php
include "indheader.php";
$idnewtea=$_GET['idnewtea'];


$sqlun = "SELECT * FROM teacher where idnewtea='$idnewtea'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();
if($row["usernamet"] != $_SESSION["username"]){
 echo("<script>location.href = 'index.php';</script>");

}


$curses = $_SESSION['username'];



$sql = "SELECT * FROM teacher WHERE idnewtea='$idnewtea'";
$result = $conn->query($sql);
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $tempusr=$row['usernamet'];
      $tempcod=$row['newcodet'];
      $tempnam=$row['newnamedt'];
  }
}



if(isset($_POST["submit"])) {
$sqlun = "SELECT * FROM teacher where idnewtea='$idnewtea'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();
if($row["usernamet"] == $_SESSION["username"]){


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
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Students</a>
  </li>  

  <li class="nav-item" role="presentation">
  <a class="nav-link" id="pills-exi-tab" data-toggle="pill" href="#pills-exi" role="tab" aria-controls="pills-exi" aria-selected="false">Leave posting</a>
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
  
  
$sql = "SELECT * FROM images WHERE cod='$tempcod' AND nam='$tempnam' ORDER BY uploaded_date DESC";
$result = $conn->query($sql);
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      echo'
      <a href="view.php?idimg='.$row['idimg'].'&idnewc='.$idnewtea.'">
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


      echo'<a class="btn btn-secondary" href="editsemi.php?idimg='.$row['idimg'].'&idnewtea='.$idnewtea.'">edit</a>
      <a class="btn btn-danger" href="delsemi.php?idimg='.$row['idimg'].'&idnewtea='.$idnewtea.'">delete</a>';
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
    $sql = "SELECT * FROM teacher WHERE idnewtea='$idnewtea'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo $row['newcodet'];
      }
    }


    echo'
  </div>
    </p>
  </div>
  </div>
</div>
</div>
  
  

  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
  
  ';
  $thiscode = "";

  $sql = "SELECT * FROM teacher join approv ON teacher.newcodet=approv.joincodev WHERE idnewtea='$idnewtea'";
  $result = $conn->query($sql);
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $thiscode = $row['newcodet'];
    }
  }
  
  $sql = "SELECT * FROM approv WHERE joincodev = '$thiscode'";
      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            
  
          echo '
          <div class="card bg-light">
  <div class="card-body">
  '.$row['usernamev'].'

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






  <div class="tab-pane fade" id="pills-exi" role="tabpanel" aria-labelledby="pills-exi-tab">
  

  <div class="card bg-light mb-3">
  <div class="card-header">Are you sure you want to leave posting from this classroom</div>
  <div class="card-body">
    <p class="card-text">
<a class="btn btn-danger" href="leavetea.php?idnewtea='.$idnewtea.'" role="button">Leave posting</a>
      
    </p>
  </div>
</div>


    </div>
    </div>
  </div>';




?>


