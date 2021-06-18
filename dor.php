<?php
include 'connection.php';

$conn = OpenCon();
$year = $_POST["year"];

$sql = "SELECT * FROM fdpyear where year = $year";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["programname"];
    }
}



?>