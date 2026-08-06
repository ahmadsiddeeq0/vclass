<?php
include "indheader.php";

$idimg = $_GET['idimg'];
$idnewc = $_GET['idnewc'];


if(isset($_POST['submit'])){
$sqlun = "SELECT * FROM images where idimg='$idimg'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();
    $title =$_POST['title'];
    $description =$_POST['description'];
    if($row["usrnam"] == $_SESSION["username"]){
    $sql = "UPDATE images SET title='$title' , description='$description' WHERE idimg='$idimg'";
    $del=$conn->query($sql);
    header("Location:view.php?idimg=$idimg&idnewc=$idnewc");    
    }
else{
 echo("<script>location.href = 'view.php?idimg=$idimg&idnewc=$idnewc';</script>");
}

}
?>
<div class="container">
<form method="POST">
<div class="form-group">
            <label for="exampleInputEmail1">Tilte</label>
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="
<?php
$sqlun = "SELECT * FROM images where idimg='$idimg'";
$resultun = $conn->query($sqlun);

//if one photo then unlink and delete row
if(mysqli_num_rows($resultun) == 1){
    while($rowun = $resultun->fetch_assoc()) {
        echo $rowun['title'];
    }
}
?>
">
<small id="emailHelp" class="form-text text-muted">post's title</small>
        </div>




        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">
<?php
$sqlun = "SELECT * FROM images where idimg='$idimg'";
$resultun = $conn->query($sqlun);

//if one photo then unlink and delete row
if(mysqli_num_rows($resultun) == 1){
    while($rowun = $resultun->fetch_assoc()) {
        echo $rowun['description'];
    }
}
?>
</textarea>

<small id="emailHelp" class="form-text text-muted">post's description</small>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-danger" value="Update">
<?php
             echo'<a class="btn btn-secondary" href="myclass.php?idnewc='. $_GET['idnewc'].'">cancel</a>';
?>
        </div>



</div>