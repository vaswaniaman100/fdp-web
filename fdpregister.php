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
                <script>
                    function changeyear(year)
                    {
                        if(year == "select"){

                        }
                       else{
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("pname").value = this.responseText;
                                   
                        
                                }
                            };           
                        xmlhttp.open("POST","dor.php",true);
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");              
                        xmlhttp.send("year="+year); 
                       }
                    }
                </script>

            </head>

            <body>

                <!-- header file -->
                <div id="header">

                </div>
                <br><br>


                <!-- register begins here-->

                <?php
                $aoiErr = $addressErr = $collegenameErr = $emailErr = $nameErr = $phoneErr = "";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    function input_data($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                    // name validation
                    if (empty($_POST["name"])) {
                        $nameErr = "Name is required";
                    } else {
                        $name = input_data($_POST["name"]);
                        // check if name only contains letters and whitespace  
                        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                            $nameErr = "Only alphabets and white space are allowed";
                        }
                    }

                    //phone validation
                    if (empty($_POST["phone"])) {
                        $phoneErr = "Mobile no is required";
                    } else {
                        $phone = input_data($_POST["phone"]);
                        // check if mobile no is well-formed  
                        if (!preg_match("/^[0-9]*$/", $phone)) {
                            $phoneErr = "Only numeric value is allowed.";
                        }
                        //check mobile no length should not be less and greator than 10  
                        if (strlen($phone) != 10) {
                            $phoneErr = "Mobile no must contain 10 digits.";
                        }
                    }

                    //college name validation

                    if (empty($_POST["collegename"])) {
                        $collegenameErr = "college name is required";
                    } else {
                        $collegename = input_data($_POST["collegename"]);

                        if (!preg_match('/[A-Za-z0-9\-\\,.]+/', $collegename)) {
                            $collegenameErr = "invalid college name.";
                        }
                    }

                    // email validation
                    if (empty($_POST["email"])) {
                        $emailErr = "Email is required";
                    } else {
                        $email = input_data($_POST["email"]);
                        // check that the e-mail address is well-formed  
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Invalid email format";
                        }
                    }

                    //address validation 

                    if (empty($_POST["address"])) {
                        $addressErr = "Address is required";
                    } else {
                        $address = input_data($_POST["address"]);

                        if (!preg_match('/[A-Za-z0-9\-\\,.]+/', $address)) {
                            $addressErr = "Invalid Address .";
                        }
                    }

                    //aoi validation(Area of Interest)
                    if (empty($_POST["aoi"])) {
                        $aoiErr = "Area of Interest is required";
                    } else {
                        $aoi = input_data($_POST["aoi"]);
                        // check if name only contains letters and whitespace  
                        if (!preg_match("/^[a-zA-Z ]*$/", $aoi)) {
                            $aoiErr = "Only alphabets and white space are allowed";
                        }
                    }
                    $yearofr = $_POST["year"];
                    $dor = $_POST["dor"];
                    $pname = $_POST["pname"];

                    if($nameErr == "" and $phoneErr == "" and $emailErr == "" and $collegenameErr == "" and $addressErr == "" and $aoiErr == "")
                    {
                        $conn = OpenCon();
                        $stmt = $conn->prepare("INSERT INTO  facultyregistration (name, phone, email, collegename, address, areaofinterest, dor, programname, year)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("ssssssssi",$name, $phone, $email,$collegename,$address,$aoi,$dor,$pname,$yearofr);
                        $stmt->execute();
                        echo "<script>alert('Data Entered Successfully')</script>";
                    }
                    else{
                        echo "<script>alert('Please Check Details')</script>";
                    }

                }


                ?>

                <form action="fdpregister.php" method="post">

                    <table style="width: 100%;">
                        <tr align="center">
                            <td align="right">
                                <h2>Year :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            </td>
                            <td align="left">
                                <select style="height: 35px; width: 290px;" name="year" id="year" onchange="changeyear(document.getElementById('year').value)">
                                    <option value="select"> select</option>
                                    <?php
                                    $year = date("Y"); 
                                    $programname = "" ;
                                    $conn = OpenCon();
                                    $sql = "SELECT * FROM fdpyear ";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            if($row["year"]==$year)
                                            {
                                                echo  " <option selected='selected' value='" . $row["year"] . "'>" . $row["year"] . "</option>";
                                                $programname =$row["programname"];
                                            }
                                            else
                                            {
                                                echo  " <option value='" . $row["year"] . "'>" . $row["year"] . "</option>";
                                            }

                                            
                                        }
                                    } else {
                                    }
                                    CloseCon($conn);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr align="center">
                            <td align="right" style="width: 50%;">
                                <h2>Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            </td>
                            <td align="left"><input type="text" name="name" id="name" size="40" style="height: 25px;"> <span class="error">* <?php echo $nameErr; ?> </span> </td>
                        </tr>
                        <tr align="center">
                            <td align="right">
                                <h2>Phone :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            </td>
                            <td align="left"><input type="text" name="phone" id="phone" size="40" style="height: 25px;"> <span class="error">* <?php echo $phoneErr; ?> </span> </td>
                        </tr>
                        <tr align="center">
                            <td align="right">
                                <h2>E-mail :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            </td>
                            <td align="left"><input type="text" name="email" id="email" size="40" style="height: 25px;"> <span class="error">* <?php echo $emailErr; ?> </span> </td>
                        </tr>
                        <tr align="center">
                            <td align="right">
                                <h2>College Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            </td>
                            <td align="left"><input type="text" name="collegename" id="collegename" size="40" style="height: 25px;"> <span class="error">* <?php echo $collegenameErr; ?> </span> </td>
                        </tr>
                        <tr align="center">
                            <td align="right">
                                <h2>Address :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            </td>
                            <td align="left"><input type="text" name="address" id="address" size="40" style="height: 25px;"><span class="error">* <?php echo $addressErr; ?> </span> </td>
                        </tr>
                        <tr align="center">
                            <td align="right">
                                <h2>Area Of Interest :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            </td>
                            <td align="left"><input type="text" name="aoi" id="aoi" size="40" style="height: 25px;"><span class="error">* <?php echo $aoiErr; ?> </span> </td>
                        </tr>
                        <tr align="center">
                            <td align="right">
                                <h2>Date Of Registration :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            </td>
                            <td align="left"><input type="text" name="dor" id="dor" size="40" value="<?php echo date("d/m/Y")?>" style="height: 25px;" readonly></td>
                        </tr>
                        <tr align="center">
                            <td align="right">
                                <h2>Program Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            </td>
                            <td align="left"><input type="text" name="pname" id="pname" size="40" style="height: 25px;" value="<?php echo $programname ?>"  readonly ></td>
                        </tr>
                        <tr align="center">
                            <td colspan="2" style="padding-top: 10px;"><input type="submit" value="Register" style="font-weight: bold; font-size: larger;  height: 40px; width: 100px;"></td>
                        </tr>
                    </table>
                    <br><br><br><br><br>
                </form>
                <?php
                function changeval() {
                    
                  }

                if($nameErr == "" and $phoneErr == "" and $emailErr == "" and $collegenameErr == "" and $addressErr == "" and $aoiErr == "")
                {
                }
                else{
                   
                    
                    echo "<script>document.getElementById('name').value = '",$_POST["name"],"';</script>";
                    
                    echo "<script>document.getElementById('phone').value = '",$_POST["phone"],"';</script>";
                    echo "<script>document.getElementById('collegename').value = '",$_POST["collegename"],"';</script>";
                    echo "<script>document.getElementById('email').value = '",$_POST["email"],"';</script>";
                    echo "<script>document.getElementById('address').value = '",$_POST["address"],"';</script>";
                    echo "<script>document.getElementById('aoi').value = '",$_POST["aoi"],"';</script>";
                    

                }
                ?>
                <!-- register ends here-->



            </body>
            <div id="footer">
            </div>

            </html>

<?php


            exit;
        } else {
            header("Location: index.php");
        }
    }
}
?>