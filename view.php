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
        <link rel="stylesheet" href="css/view.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
          $(function() {
            $("#header").load("header.html");
            $("#footer").load("footer.html");
          });
        </script>



        <script>
          function viewtable() {
            document.getElementById("my-form").submit();
          }

          function printData() {
            var divToPrint = document.getElementById("display");
            divToPrint.style.textAlign = "center";
            divToPrint.style.borderCollapse = "collapse";
            var htmlToPrint = '' +
              '<style type="text/css">' +
              'th,td {' +
              'border:1px solid black;' +
              'padding:5px;' +
              '}' +
              '</style>';
            htmlToPrint += divToPrint.outerHTML;
            newWin = window.open("");
            newWin.document.write("<center><h1>Faculty Development Program</h1></center><br>");
            newWin.document.write(htmlToPrint);
            newWin.print();
            newWin.close();
          }
        </script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Registration</title>
      </head>

      <body>

        <!-- header file -->
        <div id="header">

        </div>

        <!-- body of the file  -->
        <div class="body-of-file" style="margin-top: 30px;">
          <center>
            <h1>FDP REGISTRATIONS</h1>
          </center>





          <form id="my-form" action='view.php' method="post">
            <h3>Select Year Of Registrations</h3>
            <select name="year-of-registration" id="year-of-registration" onchange="viewtable(this)">
              <option value="select"> select</option>
              <?php

              $conn = OpenCon();
              $sql = "SELECT * FROM fdpyear ";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {

                  echo  " <option value='" . $row["year"] . "'>" . $row["year"] . "</option>";
                }
              } else {
              }
              CloseCon($conn);
              ?>
            </select>
          </form>



          <br>
          <table class="display" id="display">



            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if ($_POST["year-of-registration"] == "select") {
              } else {




                $a = $_POST["year-of-registration"];

                $conn = OpenCon();

                $sql = "SELECT * FROM facultyregistration where year = $a ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  echo '<tr>';
                  echo '<th>Id</th>';
                  echo '<th>Name</th>';
                  echo '<th>Phone</th>';
                  echo '<th>Email</th>';
                  echo '<th>College Name</th>';
                  echo '<th>Address</th>';
                  echo '<th>Area of Interest</th>';
                  echo '<th>Date of Registration</th>';
                  echo '<th>Program Name</th>';
                  echo '</tr>';
                  // output data of each row
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["NAME"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["collegename"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["areaofinterest"] . "</td>";
                    echo "<td>" . $row["dor"] . "</td>";
                    echo "<td>" . $row["programname"] . "</td></tr>";

                    //echo  $row["year"];

                  }
                  echo "</table>";
                  echo "<br><center><button onclick='printData()'>Print </button></center>";
                } else {
                  echo '</table>';
                  echo "no data found";
                  echo "<table>";
                }
                CloseCon($conn);
              }
            }
            ?>


        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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