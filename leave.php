<?php
include "indheader.php";

$idjoincv=$_GET['idjoincv'];

$sql = "DELETE FROM approv WHERE idjoincv='$idjoincv'";
if($conn->query($sql)) {

header("Location:index.php");
}

?>
