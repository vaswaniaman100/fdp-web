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

      </head>
      <body>
      <div id="header">

      </div>
      <form style="margin-top:5%; margin-left:32%;" method = "post" action = "<?php $_PHP_SELF ?>">
                  
                    
                        <label>Id</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name = "id" type = "text" id = "id">
                        &nbsp;&nbsp;&nbsp;
                        <input name = "search" type = "submit" id = "search" value = "Search" ><br><br>

                        <label>Name</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name = "name" type = "text" id = "name" readonly><br><br>

                        <label>Phone number</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name = "phone" type = "text" id = "phone" readonly><br><br>

                        <label>Email Id</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name = "email" type = "text" id = "email" readonly><br><br>

                        <label>College Name</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name = "college" type = "text" id = "college" readonly><br><br>

                        <label>Address</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name = "address" type = "text" id = "address" readonly><br><br>

                        <label>Area of Interest</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name = "areaofinterest" type = "text" id = "areaofinterest" readonly><br><br>

                        <label>Date of Registration</label>
                        &nbsp;&nbsp;
                        <input name = "dor" type = "text" id = "dor" readonly><br><br>

                        <label>Program Name</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name = "programname" type = "text" id = "programname" readonly><br><br>

                        <label>Year</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name = "year" type = "text" id = "year" readonly><br><br>

                        <input style="margin-left:20%;" name = "delete" type = "submit" id = "delete" value = "Delete">
                      
               </form>
               <br><br><br><br><br><br><br><br><br><br>
               <div id="footer">

      </div>
      </body>
      </html>
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['delete'])) {
          
          $id = $_POST['id'];
          //update

          $conn = OpenCon();

          $sql = "Delete from facultyregistration where id= $id";
          //$sql = "Update facultyregistration SET name = ?, phone = ?, email = ?, collegename = ?, address = ?,  areaofinterest = ? , dor = ? , //programname = ? ,  year = ? WHERE id = ?";

          $stmt = $conn->prepare($sql);

          //$stmt->bind_param('ssssssssii',$name,$phone,$email,$collegename,$address,$areaofinterest,$dor,$programname,$year,$id);
          $stmt->execute();

          //mysql_select_db('fdp');
          //$retval = mysql_query($sql , $conn);


          echo "Data Deleted successfully \n ";

          CloseCon($conn);

      }

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
        
      }
       exit;
    } else {
      header("Location: index.php");
    }
  }
}
?>