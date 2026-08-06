<?php
include "indheader.php";
$idjoincv=$_GET['idjoincv'];
$idnewc=$_GET['idnewc'];

$sql = "DELETE FROM approv WHERE idjoincv='$idjoincv'";
if($conn->query($sql)) {

header("Location:myclass.php?idnewc=$idnewc");
}


?>