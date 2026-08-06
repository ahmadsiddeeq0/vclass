<title>join Vclass</title>
<?php
include "indheader.php";

// $sql = "SELECT * FROM joinc WHERE username='$idnewc'";
// $result = $conn->query($sql);
// if($result->num_rows > 0) {
//   while($row = $result->fetch_assoc()) {
//       $tempusr=$row['usernamev'];
//       $tempcod=$row['joincodev'];
//       $tempnam=$row['joinnamev'];
//       $idjoincv=$row['idjoincv'];
//   }
// }
$usrcurr=$_SESSION['username'];

if(isset($_POST['sub'])){
    $jo=$_POST['jo'];

    $usrcurr = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT * FROM newc WHERE newcode=? AND username='$usrcurr'");
    $stmt->bind_param("s", $jo);
    $stmt->execute();
    $result = $stmt->get_result();
    if(!empty($result) && $result->num_rows > 0){
        echo '
        <div class="container">
        <div class="alert alert-danger" role="alert">
        You can not join a class that you have created
        </div>
        </div>';
    }
    else{
        $stmt = $conn->prepare("SELECT * FROM newc WHERE newcode=?");
        $stmt->bind_param("s", $jo);
        $stmt->execute();
        $result = $stmt->get_result();
        if(!empty($result) && $result->num_rows > 0){
            $stmtj = $conn->prepare("SELECT * FROM joinc WHERE joincode=? AND username='$usrcurr'");
            $stmtj->bind_param("s", $jo);
            $stmtj->execute();
            $resultj = $stmtj->get_result();
            if(!empty($resultj) && $resultj->num_rows > 0){
                echo '
                <div class="container">
                <div class="alert alert-danger" role="alert">
                You can not join a class twice
                </div>
                </div>';
            }
            else{
                $stmtj = $conn->prepare("SELECT * FROM approv WHERE joincodev=? AND usernamev='$usrcurr'");
                $stmtj->bind_param("s", $jo);
                $stmtj->execute();
                $resultj = $stmtj->get_result();
                if(!empty($resultj) && $resultj->num_rows > 0){
                    echo '
                    <div class="container">
                    <div class="alert alert-danger" role="alert">
                    You have already joined the class
                    </div>
                    </div>';
                }
                else{
                    $user = $result->fetch_assoc();
                    $userown = $user['username'];
                    $nam = $user['newnamed'];
                    $userow = $_SESSION['username'];
                    $stmt = $conn->prepare("INSERT INTO joinc (username, joincode, ownerd,joinname) VALUES (?, ?, ? ,?)");
                    $stmt->bind_param("ssss", $userow, $jo, $userown, $nam);
                    if($stmt->execute()){
                        echo'
                        <div class="container">
                            <div class="alert alert-info" role="alert">
                            Waite untill the admin aprove
                            </div>
                            </div>';
                    }
                }
            }
        }
        else{
            echo'
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    Not a valid code
                </div>
            </div>';

            }
    }


$stmt->close();
$conn->close();
}

?>



<div class="container">
    <form method="post">
        <label>Please enter the Vclass code</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Code</span>
          </div>
            <input type="text" name="jo" placeholder="Code" class="form-control rounded-right" title="Code" required>
          <div class="invalid-feedback">
            Code
          </div>
        </div>
            <small id="emailHelp" class="form-text text-muted">Code is case sensitive</small>

        <div class="form-group mt-2">
            <input type="submit" name="sub" class="btn btn-dark" value="Join">
        </div>

    </form>
</div>
