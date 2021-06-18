<?php
session_start();

include 'connection.php';
$conn = OpenCon();
$sql = "SELECT * FROM login ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if (isset($_SESSION["password"]) && isset($_SESSION["username"])) {
            if ($_SESSION["password"] ==  $row['pass'] && $_SESSION["username"] ==  "moderncoe") {
                header("Location: home.php");
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar1.css">

</head>

<body>

    <!-- header file -->
    <div id="header">
        <br>
        <div>

            <!-- logo image  -->
            <div class="logoblock">
                <div class="spacebeforelogo"></div>
                <div class="logo"><img class="logoimg" src="logo.png" alt="logo"></div>
            </div>

            <!-- college info  -->
            <div class="college-info">
                <h3>Progressive Education Society's</h3>
                <h2>Modern College of Engineering</h2>
                <h5>Approved by AICTE New Delhi, Recognized by Govt. of Maharashtra</h5>
                <h5>Affiliated to Savitribai Phule Pune University. </h5>
                <h5>Accredited by NAAC with <b>A</b> Grade, Awarded Best college by Savitribai Phule Pune University. </h5>
            </div>

            <!-- logoutblock -->
            <div class="logout-block">
               
            </div>
        </div>

        <!-- navigation bar -->
        <div class="navbar">
            <a href="home.php">HOME</a>

            <div class="dropdown">
                <button class="dropbtn">REGISTRATION
                </button>
                <div class="dropdown-content">
                    <a href="#">FDP year</a>
                    <a href="#">Registration</a>
                </div>
            </div>

            <a href="view.php">VIEW</a>
            <a href="update.php">UPDATE</a>
            <a href="delete.php">DELETE</a>

        </div>
    </div>

    <!-- login -->
    <div class="login-block">
        <form action="index.php" method="POST">
            <center>
                <br>
                <h1>Login</h1>
                <br>
                <h2 class="name">Username :</h2>
                <input class="username-text" name="user" type="text">
                <br><br>
                <h2 class="name">Password :</h2>
                <input class="username-text" name="pass" type="password">
                <br><br>

                <input class="submit-button" type="submit" value="Login">
                <a href="forgot.php">Forgot password?</a>
            </center>
        </form>

        <?php


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST['user'] == "moderncoe") {
                $_SESSION["username"] = "moderncoe";

                $conn = OpenCon();

                $stmt = $conn->prepare("SELECT * FROM login ");
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {

                        if ($_POST['pass'] == $row['pass']) {
                            $_SESSION["password"] =  $row['pass'];
                            header("Location: home.php");
                            CloseCon($conn);
                            exit;
                        } else {
                            echo "<script>alert('invalid username or password');</script>";
                        }
                    }
                }
            } else {
            }
        }
        ?>
    </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="footter">
        <p>Copyright &#169; by Modern College of Engineering</p>
    </div>

</body>

</html>