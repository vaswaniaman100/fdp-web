
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