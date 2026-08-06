<?php
include "indheader.php";


$idimg = $_GET['idimg'];
$idnewtea = $_GET['idnewtea'];
$sqlun = "SELECT * FROM images where idimg='$idimg'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();
    if($row["usrnam"] == $_SESSION["username"]){




$sql = "DELETE FROM images WHERE idimg='$idimg'";
$del=$conn->query($sql);
header("Location:semiclass.php?idnewtea=$idnewtea");
    }
else{
 echo("<script>location.href = 'view.php?idimg=$idimg&idnewtea=$idnewtea';</script>");
}

?>