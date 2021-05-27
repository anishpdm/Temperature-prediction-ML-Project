<?php
include './dbcon.php';
$r=array();

// Create connection
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `tempValue` FROM `temp_predictions` order by `addedDate` DESC LIMIT 1 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
echo $row['tempValue'];



}

// echo json_encode(
//     $r
// );
} else {
  // echo "0 results";
}
$conn->close();

?>
