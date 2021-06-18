<?php
function OpenCon()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fdp";
    $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed: " . $conn->connect_error);     
    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}
