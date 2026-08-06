<?php
include "indheader.php";
if(isset($_POST['sub'])){
$conf = $_POST['pass'];

    $user=$_SESSION['username'];
    $sql = "SELECT * FROM user WHERE username='$user'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (password_verify($conf, $row['password'])) {

                $sql = "DELETE FROM user WHERE username='$user'";
                if($conn->query($sql)) {
                    header("Location:logout.php");
                }
            }
            else{
                echo '
                <div class="container">
                <div class="alert alert-danger" role="alert">
                Wrong password
                </div></div><br>
                ';
            }
        }
    }
}
?>

<div class="container">
    <form method="post">

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass" placeholder="Password" class="form-control rounded-right" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            <small id="passwordHelpBlock" class="form-text text-muted">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</small>
        </div>

        <div class="alert alert-danger" role="alert">
            <div class="form-group">

 <p>Are you sure do you want to delete your account ?</p>
 <p>Be careful this step can not be undone !</p>
  <p class="mb-0"><input type="submit" name="sub" class="btn btn-danger" value="Yes"><a href="index.php" class="btn btn-dark ml-2"">No</a></p>
            </div>
        </div>


    </form>
</div>

