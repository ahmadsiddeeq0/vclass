<?php
include "indheader.php";
$idnewc=$_GET['idnewc'];
$username=$_GET['username'];

$sqlcall = "SELECT * FROM teacher WHERE usernamet='$username'";
$resultcall = $conn->query($sqlcall);
if($resultcall->num_rows > 0) {
  while($rowcall = $resultcall->fetch_assoc()) {
      $newcode = $rowcall['newcodet'];
      $ownert = $rowcall['ownert'];
      $newnamet = $rowcall['newnamedt'];
  }
}


$stmt = $conn->prepare("INSERT INTO approv (usernamev, joincodev,ownerdv, joinnamev) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $newcode, $ownert,$newnamet);
    $stmt->execute();



    $sql = "DELETE FROM teacher WHERE usernamet='$username'";
if($conn->query($sql)) {
    header("Location:myclass.php?idnewc=$idnewc");

}

?>