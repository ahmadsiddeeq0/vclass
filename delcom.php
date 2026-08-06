<?php
include"indheader.php";

$idimg=$_GET['idimg'];
$idcom=$_GET['idcom'];
$idnewc=$_GET['idnewc'];

$sqlun = "SELECT * FROM comments where idcom='$idcom'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();



if(isset($_POST['com'])){
    $sqlun = "SELECT * FROM comments where idcom='$idcom'";
    if($row["user"] == $_SESSION["username"]){
        $sql = "DELETE FROM comments WHERE idcom='$idcom'";
        if($conn->query($sql)) {
            header("Location:view.php?idimg=$idimg&idnewc=$idnewc");
        }
    }
}
else{
 echo("<script>location.href = 'view.php?idimg=$idimg&idnewc=idnewc';</script>");
}



?>

