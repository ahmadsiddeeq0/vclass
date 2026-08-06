<title>Details</title>
<?php
include "indheader.php";

$idimg=$_GET['idimg'];
if(isset($_GET['idnewc'])){
    $idnewc=$_GET['idnewc'];
}
else{
    $idnewc=$_GET['idnewtea'];
}

$sql = "SELECT * FROM images WHERE idimg='$idimg' ORDER BY uploaded_date DESC";
$result = $conn->query($sql);
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      echo'
      <div class="container">
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
      echo'<p class="card-text mt-4"><small class="text-muted">'.$row['uploaded_date'].'</small></p>
    </div>
    
    
    
    
    
    <div class="container mb-4">
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Hide/Show comments
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">';

          
$sqlcom = "SELECT * FROM comments where postid='$idimg'";
$resultcom = $conn->query($sqlcom);

if ($resultcom->num_rows > 0) {
  while($rowcom = $resultcom->fetch_assoc()) {
$idcom=$rowcom['idcom'];

echo'
<div class="card mb-4">
  <div class="card-header">
  '.$rowcom['user'].'
  </div>
  <div class="card-body">
      <p class="blockquote mb-0">'.$rowcom['comment'].'</p>';
     if (($rowcom["user"]) == ($_SESSION["username"])){
    echo'
    <a class="btn btn-secondary" href="editcom.php?idimg='.$idimg.'&idnewc='.$idnewc.'&idcom='.$idcom.'">Edit</a>
    <a class="btn btn-danger" href="delcom.php?idimg='.$idimg.'&idnewc='.$idnewc.'&idcom='.$idcom.'">Delete</a>
    ';
    }
    echo'
    <footer class="blockquote-footer">'.$rowcom['timecom'].'</footer>
  </div>
</div>';

  }
}

else{
echo'
    <div class="alert alert-secondary" role="alert">
        No comments yet
    </div>
';
}
echo '

          </div>
        </div>
      </div>
      </div>
    </div> 

    <div class="card-footer text-muted">
    <form class="d-inline" method="POST">
       <div class="input-group">
           
         <input type="text" class="form-control rounded-left"  name="comment" placeholder="Comment">
         <div class="input-group-prepend">
       <input type="submit" name="com" class="input-group-text rounded-right btn btn-secondary" value="Comment">
         </div>
       </div>
       </form>

      </div>
    </div>


    
</div>
<br>
  ';
    }
}

$curusrr=$_SESSION["username"];

if(isset($_POST['com'])){
    $comment=$_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO comments (comment, user, postid) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $comment, $curusrr, $idimg);
    $stmt->execute();
    echo("<script>location.href = 'view.php?idimg=$idimg&idnewc=$idnewc';</script>");
}



?>

