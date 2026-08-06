<?php
include "indheader.php";

$nam=$_GET['nam'];
$idc=$_GET['idc'];

$sql = "DELETE FROM joinc WHERE joinname='$nam' and idjoinc='$idc'";

if ($conn->query($sql) === TRUE) {
    header("Location:approv.php");

}

?>