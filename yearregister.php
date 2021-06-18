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
                    });

                    //document.getElementById("phone").value = "hello"
                </script>
                <style>
                    .error {
                        color: #FF0001;
                    }
                </style>

            </head>

            <body>

                <!-- header file -->
                <div id="header">

                </div>
                <br><br>


                <!-- register begins here-->

                <?php
                $yearErr = $pnameErr = "";
                $a = 0;
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    function input_data($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                    // name validation
                    if (empty($_POST["pname"])) {
                        $pnameErr = "Program Name is required";
                    } else {
                        $pname = input_data($_POST["pname"]);
                        // check if name only contains letters and whitespace  
                        if (!preg_match("/^[a-zA-Z ]*$/", $pname)) {
                            $pnameErr = "Only alphabets and white space are allowed";
                        }
                    }

                    //phone validation
                    if (empty($_POST["year"])) {
                        $yearErr = "year is required";
                    }
                    else {
                        $year = input_data($_POST["year"]);
                        
                        if (!preg_match("/^[0-9]*$/", $year)) {
                            $yearErr = "Only numeric value is allowed.";
                        }
                        
                       
                    }

                    

                    if($pnameErr == "" and $yearErr == "" )
                    {
                        $conn = OpenCon();
                        $stmt = $conn->prepare("INSERT INTO  fdpyear (year, programname)  VALUES (?, ?)");
                        $stmt->bind_param("is",$year,$pname);

                        if($stmt->execute() )
                        {
                            echo "<script>alert('Data Entered Successfully')</script>";
                        }
                        else{
                            echo "<script>alert('check wether year is not repeated')</script>";
                            $a=1;
                        }
                        
                    }
                    else{
                        echo "<script>alert('Please Check Details')</script>";
                    }

                }


                ?>

                <form action="yearregister.php" method="post">

                    <table style="width: 100%;">
                        
                        <tr align="center">
                            <td align="right" style="width: 50%;">
                                <h2>Year :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            </td>
                            <td align="left"><input type="text" name="year" id="year" size="40" style="height: 25px;"> <span class="error">* <?php echo $yearErr; ?> </span> </td>
                        </tr>
                        
                        <tr align="center">
                            <td align="right">
                                <h2>Program Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            </td>
                            <td align="left"><input type="text" name="pname" id="pname" size="40" style="height: 25px;"><span class="error">* <?php echo $pnameErr; ?> </span> </td>
                        </tr>
                        <tr align="center">
                            <td colspan="2" style="padding-top: 10px;"><input type="submit" value="Register" style="font-weight: bold; font-size: larger;  height: 40px; width: 100px;"></td>
                        </tr>
                    </table>
                </form>
                <?php
                if($pnameErr == "" and $yearErr == "" )
                {
                    
                }
                else{
                    echo "<script>document.getElementById('pname').value = '",$_POST["pname"],"';</script>";                    
                    echo "<script>document.getElementById('year').value = '",$_POST["year"],"';</script>";
                }
                if($a==1)
                {
                    echo "<script>document.getElementById('pname').value = '",$_POST["pname"],"';</script>";                    
                    echo "<script>document.getElementById('year').value = '",$_POST["year"],"';</script>";
                }
                ?>
                <!-- register ends here-->
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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