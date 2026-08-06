<?php
include "indheader.php";


$idimg = $_GET['idimg'];
$idnewc = $_GET['idnewc'];

$sqlun = "SELECT * FROM images where idimg='$idimg'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();
if($row["usrnam"] == $_SESSION["username"]){

$sql = "DELETE FROM images WHERE idimg='$idimg'";



$del=$conn->query($sql);
header("Location:myclass.php?idnewc=$idnewc");
}
else{
 echo("<script>location.href = 'view.php?idimg=$idimg&idnewc=$idnewc';</script>");
}

?>