<?php
include "indheader.php";
$idjoincv=$_GET['idjoincv'];
$idnewc=$_GET['idnewc'];



$sqlcall = "SELECT * FROM approv WHERE idjoincv='$idjoincv'";
$resultcall = $conn->query($sqlcall);
if($resultcall->num_rows > 0) {
  while($rowcall = $resultcall->fetch_assoc()) {
      $usernamev = $rowcall['usernamev'];
      $joincodev = $rowcall['joincodev'];
      $joinnamev = $rowcall['joinnamev'];
  }
}

$ownert=$_SESSION['username'];
$stmt = $conn->prepare("INSERT INTO teacher (usernamet, newcodet, newnamedt,ownert) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usernamev, $joincodev, $joinnamev,$ownert);
    $stmt->execute();



    $sql = "DELETE FROM approv WHERE idjoincv='$idjoincv'";
if($conn->query($sql)) {
    header("Location:myclass.php?idnewc=$idnewc");

}

?>