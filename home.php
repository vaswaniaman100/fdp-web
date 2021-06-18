<?php
session_start();
include 'connection.php';



$conn = OpenCon();
$sql = "SELECT * FROM login ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    if ($_SESSION["password"] ==  $row['pass'] && $_SESSION["username"] ==  $row['user']) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <script>
        $(function() {
            $("#header").load("header.html");
            $("#footer").load("footer.html");
            $("#slider").load("slider.html");
        });
    </script>

</head>

<body>

    <!-- header file -->
    <div id="header">

    </div>
    <br><br><br><br>

<!--
<marquee behavior="alternate" scrollamount="10" direction="left"><h1>Welcome to MCOE Faculty Registration Programme </h1></marquee>-->
<div id="slider">

        </div>
        <br><br><br><br>
<div id="footer">
      
        
    </div>
</body>
</html>

<?php


      exit;
    } else {
      header("Location: index.php");
    }
  }
}
?>