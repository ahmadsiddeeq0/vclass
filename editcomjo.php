<?php
include"indheader.php";

$idimg=$_GET['idimg'];
$idcom=$_GET['idcom'];

$idnewc=$_GET['idnewc'];
if(isset($_POST['com'])){

    $com=$_POST['comment'];
    $stmtsr = $conn->prepare("UPDATE comments SET comment=? WHERE idcom='$idcom'");
    $stmtsr->bind_param("s", $com);
    if($stmtsr->execute()){
      header("Location:viewjo.php?idimg=$idimg&idnewc=$idnewc");
    }
}

?>

                    <div class="container">
                    <form class="d-inline" method="POST">
                            <div class="card">
                              <div class="card-body">
                            <div class="input-group">
                            <input type="text" class="form-control rounded-left"  name="comment" placeholder="Comment" value="<?php
                $idcom=$_GET['idcom'];
                $sqlun = "SELECT * FROM comments where idcom='$idcom'";
                $resultun = $conn->query($sqlun);
                if(!empty($resultun) && ($resultun->num_rows > 0)){
                    while($rowun = $resultun->fetch_assoc()) {
                        echo $rowun['comment'];
                    }
                }
                ?>">
                              <div class="input-group-prepend">
                            <input type="submit" name="com" class="input-group-text rounded-right btn btn-secondary" value="Update">
                              </div>
                            </div>
                            </div>
                              </div>
                            </form>
                            </div>
