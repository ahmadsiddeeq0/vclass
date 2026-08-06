<?php
include "indheader.php";

if(isset($_POST['sub'])){
    $pswold=$_POST['pswold'];
    $psw=$_POST['psw'];
    $pswre=$_POST['pswre'];
    $user=$_SESSION['username'];
    if($psw != $pswre){
        echo '
            <div class="container">
            <div class="alert alert-danger" role="alert">
            Password does not match
            </div></div><br>';    }
    else{
        if($psw == $pswold){
            echo '
            <div class="container">
            <div class="alert alert-danger" role="alert">
            New password can not be the same as old password
            </div></div><br>';        }
        else{
            $result = $conn->query("SELECT password FROM user WHERE username='$user'");
            if(!empty($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if(password_verify($pswold, $row['password'])) {
                        $stmt = $conn->prepare("UPDATE user SET password=? WHERE username='$user'");
                        $stmt->bind_param("s", $hashed_password);
                        $hashed_password = password_hash($psw, PASSWORD_DEFAULT);
                        if($stmt->execute()){
                            header('Location: logout.php');
                        }
                    }
                    else{
                        echo '
                        <div class="container">
                        <div class="alert alert-danger" role="alert">
                        Current password is wrong
                        </div></div><br>';                    }
                }
            }
        }
    }
}
?>

<div class="container">
    <form method="post">

        <div class="form-group">
            <label>Current Password</label>
            <input type="password" name="pswold" placeholder="Password" class="form-control rounded-right" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        <small id="passwordHelpBlock" class="form-text text-muted">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</small>
        </div>

        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="psw" placeholder="Password" class="form-control rounded-right" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        <small id="passwordHelpBlock" class="form-text text-muted">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</small>
        </div>

        <div class="form-group">
            <label>Confirm new Password</label>
            <input type="password" name="pswre" placeholder="Password" class="form-control rounded-right" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        <small id="passwordHelpBlock" class="form-text text-muted">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</small>
        </div>

        <div class="form-group">
            <input type="submit" name="sub" class="btn btn-danger" value="Update password and log out">
        </div>

    </form>
</div>