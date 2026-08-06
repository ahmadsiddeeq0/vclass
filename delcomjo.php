<?php
include"indheader.php";

$idimg=$_GET['idimg'];
$idcom=$_GET['idcom'];
$idnewc=$_GET['idnewc'];

$sql = "DELETE FROM comments WHERE idcom='$idcom'";
if($conn->query($sql)) {

header("Location:viewjo.php?idimg=$idimg&idnewc=$idnewc");
}
// if($conn->query($sql)) {
//     $sqlcom = "SELECT * FROM images WHERE path='$pathlike'";
//     $resultcom = $conn->query($sqlcom);
//     if ($resultcom->num_rows > 0) {
//         while($rowcom = $resultcom->fetch_assoc()) {
//             $iidd=$rowcom['id'];
//         }
//     }
// }

?>

