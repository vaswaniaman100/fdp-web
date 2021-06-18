if ($_SERVER["REQUEST_METHOD"] == "POST") {

$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$collegename = $_POST['college'];
$address = $_POST['address'];
$areaofinterest = $_POST['areaofinterest'];
$dor = $_POST['dor'];
$programname = $_POST['programname'];
$year = $_POST['year'];


//search
$sql = "select * from facultyregistration WHERE id = $id ";

//update

$conn = OpenCon();

$sql = "Update facultyregistration SET name = ?, phone = ?, email = ?, collegename = ?, address = ?,  areaofinterest = ? , dor = ? , programname = ? ,  year = ? WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param('ssssssssii',$name,$phone,$email,$collegename,$address,$areaofinterest,$dor,$programname,$year,$id);
$stmt->execute();

//mysql_select_db('fdp');
//$retval = mysql_query($sql , $conn);


echo "Updated data successfully \n ";

CloseCon($conn);
}