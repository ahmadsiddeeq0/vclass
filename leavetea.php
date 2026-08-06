<?php
include "indheader.php";
$idnewtea=$_GET['idnewtea'];
$sqlun = "SELECT * FROM teacher where idnewtea='$idnewtea'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();
if($row["usernamet"] == $_SESSION["username"]){


$sqlcall = "SELECT * FROM teacher WHERE idnewtea='$idnewtea'";
$resultcall = $conn->query($sqlcall);
if($resultcall->num_rows > 0) {
  while($rowcall = $resultcall->fetch_assoc()) {
      $newcode = $rowcall['newcodet'];
      $ownert = $rowcall['ownert'];
      $newnamet = $rowcall['newnamedt'];
      $usernamet = $rowcall['usernamet'];
  }
}


$stmt = $conn->prepare("INSERT INTO approv (usernamev, joincodev,ownerdv, joinnamev) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usernamet, $newcode, $ownert,$newnamet);
    $stmt->execute();



    $sql = "DELETE FROM teacher WHERE idnewtea='$idnewtea'";
if($conn->query($sql)) {
    header("Location:index.php");

}
}
else{
 echo("<script>location.href = 'index.php';</script>");
}

?>