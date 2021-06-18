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

      <html>
      <head>
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
          $(function() {
            $("#header").load("header.html");
            $("#footer").load("footer.html");
          });
        </script>
 <style>
      .error {
          color: #FF0001;
      }
  </style>
      </head>
      <body>
      <div id="header">

      </div>



      <?php
       $aoiErr = $addressErr = $collegenameErr = $emailErr = $nameErr = $phoneErr = "";
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['update'])) {
          

         


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

                    if (empty($_POST["college"])) {
                        $collegenameErr = "college name is required";
                    } else {
                        $collegename = input_data($_POST["college"]);

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
                    if (empty($_POST["areaofinterest"])) {
                        $aoiErr = "Area of Interest is required";
                    } else {
                        $aoi = input_data($_POST["areaofinterest"]);
                        // check if name only contains letters and whitespace  
                        if (!preg_match("/^[a-zA-Z ]*$/", $aoi)) {
                            $aoiErr = "Only alphabets and white space are allowed";
                        }
                    }
                   
                  
                    if($nameErr == "" and $phoneErr == "" and $emailErr == "" and $collegenameErr == "" and $addressErr == "" and $aoiErr == "")
                    {
                      $conn = OpenCon();

                      $sql = "Update facultyregistration SET name = ?, phone = ?, email = ?, collegename = ?, address = ?,  areaofinterest = ? WHERE id = ?";
            
                      $stmt = $conn->prepare($sql);
            
                      $stmt->bind_param('ssssssi',$name,$phone,$email,$collegename,$address,$aoi,$_POST["id"]);
                      $stmt->execute();
                        echo "<script>alert('Data Updated Successfully')</script>";
                    }
                    else{
                        echo "<script>alert('Please Check Details')</script>";
                    }

      }

        
      }





      ?>





<form style="margin-top:5%; margin-left:32%;" method = "post" action = "<?php $_PHP_SELF ?>">
                  
                    
                  <label>Id</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name = "id" type = "text" id = "id">
                  &nbsp;&nbsp;&nbsp;
                  <input name = "search" type = "submit" id = "search" value = "Search"> <br><br>

                  <label>Name</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name = "name" type = "text" id = "name"><span class="error">* <?php echo $nameErr; ?> </span><br><br>

                  <label>Phone number</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name = "phone" type = "text" id = "phone"><span class="error">* <?php echo $phoneErr; ?> </span><br><br>

                  <label>Email Id</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name = "email" type = "text" id = "email"><span class="error">* <?php echo $emailErr; ?> </span><br><br>

                  <label>College Name</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name = "college" type = "text" id = "college"><span class="error">* <?php echo $collegenameErr; ?> </span><br><br>

                  <label>Address</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name = "address" type = "text" id = "address"><span class="error">* <?php echo $addressErr; ?> </span><br><br>

                  <label>Area of Interest</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name = "areaofinterest" type = "text" id = "areaofinterest"><span class="error">* <?php echo $aoiErr; ?> </span><br><br>

                  <label>Date of Registration</label>
                  &nbsp;&nbsp;
                  <input name = "dor" type = "text" id = "dor" readonly><br><br>

                  <label>Program Name</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name = "programname" type = "text" id = "programname"   readonly><br><br>

                  <label>Year</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name = "year" type = "text" id = "year"  readonly><br><br>

                  <input style="margin-left:20%;" name = "update" type = "submit" id = "update" value = "Update">
                
         </form>
         <br><br><br><br><br><br><br><br><br>
         <div id="footer">

      </div>
</body>
</html>




      <?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['search'])) {
        
    $id = $_POST['id'];
    
    $conn = OpenCon();
          $sql = "select * from facultyregistration WHERE id = $id ";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
          
    
              echo " <script> document.getElementById('id').value = '".$row['id']."'</script> ";
              echo " <script> document.getElementById('name').value = '".$row['NAME']."'</script> ";
              echo " <script> document.getElementById('phone').value = '".$row['phone']."'</script> ";
              echo " <script> document.getElementById('email').value = '".$row['email']."'</script> ";
              echo " <script> document.getElementById('college').value = '".$row['collegename']."'</script> ";
              echo " <script> document.getElementById('address').value = '".$row['address']."'</script> ";
              echo " <script> document.getElementById('areaofinterest').value = '".$row['areaofinterest']."'</script> ";
              echo " <script> document.getElementById('dor').value = '".$row['dor']."'</script> ";
              echo " <script> document.getElementById('programname').value = '".$row['programname']."'</script> ";
              echo " <script> document.getElementById('year').value = '".$row['year']."'</script> ";
             
            }
          } else {
          }
          CloseCon($conn);
          
 }
 if($nameErr == "" and $phoneErr == "" and $emailErr == "" and $collegenameErr == "" and $addressErr == "" and $aoiErr == "")
 {
 }
 else{
    
  echo "<script>document.getElementById('id').value = '",$_POST["id"],"';</script>";
     echo "<script>document.getElementById('name').value = '",$_POST["name"],"';</script>";
     
     echo "<script>document.getElementById('phone').value = '",$_POST["phone"],"';</script>";
     echo "<script>document.getElementById('college').value = '",$_POST["college"],"';</script>";
     echo "<script>document.getElementById('email').value = '",$_POST["email"],"';</script>";
     echo "<script>document.getElementById('address').value = '",$_POST["address"],"';</script>";
     echo "<script>document.getElementById('areaofinterest').value = '",$_POST["areaofinterest"],"';</script>";
     echo "<script>document.getElementById('dor').value = '",$_POST["dor"],"';</script>";
     echo "<script>document.getElementById('programname').value = '",$_POST["programname"],"';</script>";
     echo "<script>document.getElementById('year').value = '",$_POST["year"],"';</script>";
     

 }
}

       exit;
    } else {
      header("Location: index.php");
    }

  }
}
?>





         <!-- validation -->






     








