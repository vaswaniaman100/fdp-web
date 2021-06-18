<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['userpassword']);
include 'connection.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/forgot.css">
    <script>
        $(function() {
            $("#header").load("header.html");
        });
    </script>

</head>

<body>




<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['key'] == "a4g28@92g5710@hw2") {
       

        $conn = OpenCon();
        
        $stmt = $conn->prepare("Update login set pass = ? where user = 'moderncoe' ");
        $stmt->bind_param('s',$_POST["password"]);
        $stmt->execute();
        header("Location: index.php");
        
    } else {
        echo "<script>alert('invalid key');</script>";
    }
}
?>




    <!-- header file -->
    <div id="header">

    </div>
    <div style="margin-top: 20px;">
        <center>
            <h2>Did you forget your password ?</h2>
        </center>
        <form action="forgot.php" method="post">
            <center>
                <br><br><br>
            <h2 class="keytitle">Enter the Forget password key :</h2>
            <input class="name-text" name="key" type="text">
            <br><br>
            <h2 class="passw">Enter the new Password :</h2>
            <input class="name-text" name="password" type="password">
            <br><br>

            <input class="submit-button" type="submit" value="Change Password">
            </center>
        </form>
    </div>

</body>

</html>