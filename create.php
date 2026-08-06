<title>Create Vclass</title>
<?php
include "indheader.php";

if(isset($_POST['sub'])){
    $ne=$_POST['ne'];
//random ascii
$a = chr(rand(1,10) + 48);
$b = chr(rand(1,10) + 65);
$c = chr(rand(1,10) + 75);
$d = chr(rand(1,10) + 80);
$e = chr(rand(1,10) + 97);
$f = chr(rand(1,10) + 107);
$g = chr(rand(1,10) + 112);
$h = chr(rand(1,10) + 48);
$i = chr(rand(1,10) + 65);
$j = chr(rand(1,10) + 75);
$k = chr(rand(1,10) + 80);
$l = chr(rand(1,10) + 97);
$m = chr(rand(1,10) + 107);
$n = chr(rand(1,10) + 112);

$my_array = $a.$b.$c.$d.$e.$f.$g.$h.$i.$j.$k.$l.$m.$n;

str_shuffle($my_array);
// echo $my_array;

    $stmt = $conn->prepare("SELECT * FROM newc WHERE newcode=?");
    $stmt->bind_param("s", $my_array);
    $stmt->execute();
    $result = $stmt->get_result();
    while( !empty($resultu) && $resultu->num_rows > 0){
    
        $a = chr(rand(1,10) + 48);
        $b = chr(rand(1,10) + 65);
        $c = chr(rand(1,10) + 75);
        $d = chr(rand(1,10) + 80);
        $e = chr(rand(1,10) + 97);
        $f = chr(rand(1,10) + 107);
        $g = chr(rand(1,10) + 112);
        $h = chr(rand(1,10) + 48);
        $i = chr(rand(1,10) + 65);
        $j = chr(rand(1,10) + 75);
        $k = chr(rand(1,10) + 80);
        $l = chr(rand(1,10) + 97);
        $m = chr(rand(1,10) + 107);
        $n = chr(rand(1,10) + 112);
        
        $my_array = $a.$b.$c.$d.$e.$f.$g.$h.$i.$j.$k.$l.$m.$n;

        str_shuffle($my_array);
    }
    
    $usern = $_SESSION['username'];
    $stmt = $conn->prepare("INSERT INTO newc (username, newcode, newnamed) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usern, $my_array, $ne);
    if($stmt->execute()){
        echo'
        <div class="container">
            <div class="alert alert-success" role="alert">
            '.$my_array.'
            </div>
        </div>';
    }
    
        

$stmt->close();
$conn->close();


}


?>

<div class="container">
    <form method="post">
        <label>Please enter the Vclass name</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Name</span>
          </div>
            <input type="text" name="ne" placeholder="Name" class="form-control rounded-right" title="Name" required>
          <div class="invalid-feedback">
            Name
          </div>
        </div>
            <small id="emailHelp" class="form-text text-muted">This name what will show in your home page</small>

        <div class="form-group mt-2">
            <input type="submit" name="sub" class="btn btn-dark" value="Create">
        </div>

    </form>
</div>
