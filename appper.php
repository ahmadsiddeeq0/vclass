<?php
include "indheader.php";

$nam=$_GET['nam'];
$idc=$_GET['idc'];

$stmt = $conn->prepare("SELECT * FROM joinc WHERE idjoinc=? AND joinname=?");
$stmt->bind_param("ss", $idc, $nam);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$usnm=$user['username'];
$jncd=$user['joincode'];
$owcd=$user['ownerd'];
$jnnm=$user['joinname'];

$stmt = $conn->prepare("INSERT INTO approv (usernamev, joincodev, ownerdv, joinnamev) VALUES (?, ?, ? ,?)");
$stmt->bind_param("ssss", $usnm, $jncd, $owcd, $jnnm);
if($stmt->execute()){
    $sql = "DELETE FROM joinc WHERE joinname='$nam' and idjoinc='$idc'";

        if ($conn->query($sql) === TRUE) {
            header("Location:approv.php");

        }

}

?>