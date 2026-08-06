<?php
include "conn.php";
include "regheader.php";
if(isset($_POST['sub'])){
    $username=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['psw'];
    $passwordre=$_POST['pswre'];

        if($password != $passwordre){
          echo '
          <div class="container">
          <div class="alert alert-danger" role="alert">
          password does not match
          </div></div><br>
          ';
        }
        else{
            $sqlu = "SELECT username FROM user WHERE username ='$username'";
            $resultu = $conn->query($sqlu);

            $sqle = "SELECT email FROM user WHERE email ='$email'";
            $resulte = $conn->query($sqle);

            if (!empty($resultu) && $resultu->num_rows > 0) {
              // output data of each row
              echo '
            <div class="container">
            <div class="alert alert-danger" role="alert">
            username already taken
            </div></div><br>
            ';
            }

            elseif (!empty($resulte) && $resulte->num_rows > 0) {
              // output data of each row
              echo '
              <div class="container">
              <div class="alert alert-danger" role="alert">
              username already taken
              </div></div><br>
              ';
            }
            else{
                $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $email, $hashed_password);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                if($stmt->execute()){
                    header('Location: login.php');
                }
            }
        }

}

?>






<div class="container">
    <form  method="post">
        <label>Username Or E-mail</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
                <input type="text" name="name" placeholder="Username" class="form-control rounded-right" title="Username" required>
              <div class="invalid-feedback">
                Please choose a username or E-mail.
              </div>
            </div>
            <small id="emailHelp" class="form-text text-muted">Username must be unique</small>

        <label>E-mail</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
                <input type="email" name="email" placeholder="E-mail" class="form-control rounded-right" title="E-mail" required>
              <div class="invalid-feedback">
                Please choose a username or E-mail.
              </div>
            </div>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="psw" placeholder="Password" class="form-control rounded-right" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            <small id="passwordHelpBlock" class="form-text text-muted">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</small>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pswre" placeholder="Password" class="form-control rounded-right" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            <small id="passwordHelpBlock" class="form-text text-muted">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</small>
            </div>

            <div class="form-group">
                <input type="submit" name="sub" class="btn btn-dark" value="Sign Up">
            </div>

            <p>Already have an account? <a href="login.php">Login here</a>.</p>

    </form>
</div>