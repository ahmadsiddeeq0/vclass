<?php
include "indheader.php";

$idnewc=$_GET['idnewc'];

$sqlun = "SELECT * FROM newc where idnewc='$idnewc'";
$resultun = $conn->query($sqlun);
$row = $resultun->fetch_array();
if($row["username"] == $_SESSION["username"]){



$sql = "SELECT * FROM newc WHERE idnewc='$idnewc'";
$result = $conn->query($sql);
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $thiscode = $row['newcode'];
  }
}


$sql = "DELETE FROM images WHERE cod='$thiscode'";
$conn->query($sql);


$sql = "DELETE FROM approv WHERE joincodev='$thiscode'";
$conn->query($sql);


$sql = "DELETE FROM joinc WHERE joincode='$thiscode'";
$conn->query($sql);



$sql = "DELETE FROM newc WHERE newcode='$thiscode'";
$conn->query($sql);


$sql = "DELETE FROM teacher WHERE newcodet='$thiscode'";
if($conn->query($sql)) {
    header("Location:index.php");

}

}
else{
 echo("<script>location.href = 'index.php';</script>");
}


?>
