<?php
include "conn.php";
include "logheader.php";
if(isset($_POST['sub'])){
    $usermail=$_POST['um'];
    $password=$_POST['psw'];
    $stmt = $conn->prepare("SELECT * FROM user WHERE username=? OR email=?");
    $stmt->bind_param("ss", $usermail, $usermail);
    $stmt->execute();
    $result = $stmt->get_result();
    if(!empty($result) && $result->num_rows > 0){
    $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = true;
            header('Location: index.php');
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
    else{
        echo '
        <div class="container">
        <div class="alert alert-danger" role="alert">
        There is no account with that username or email
        </div></div><br>
        ';
    }

$stmt->close();
$conn->close();
}
?>



<div class="container">
    <form method="post">
        <label>Username Or E-mail</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">@</span>
          </div>
            <input type="text" name="um" placeholder="Username Or E-mail" class="form-control rounded-right" title="Username Or E-mail" required>
          <div class="invalid-feedback">
            Please choose a username or E-mail.
          </div>
        </div>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="psw" placeholder="Password" class="form-control rounded-right" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        <small id="passwordHelpBlock" class="form-text text-muted">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</small>
        </div>

        <div class="form-group">
            <input type="submit" name="sub" class="btn btn-dark" value="Login">
        </div>

        <div class="form-group">
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </div>
    </form>
</div>
