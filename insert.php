<?php

include './dbcon.php';

if(isset($_GET['temp']))
{


$readTemp=$_GET['temp'];
$readMoist=$_GET['moist'];
$readHum=$_GET['hum'];


if($readHum>0)
{

    $finddate=date("Y/m/d");



// Create connection
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `humidity`(`date`, `humidity`)
VALUES ('$finddate',$readHum)";

if ($conn->query($sql) === TRUE) {
  echo "New humidity record created successfully"."<br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();



}


if($readMoist>0)
{

    include './dbcon.php';


    $finddate=date("Y/m/d");




 $moistsql = "INSERT INTO `moisture`(`date`, `mositure`)
  VALUES ('$finddate','$readMoist')";

  $result=$conn->query($moistsql);

if ( $result === TRUE) {
  echo "New moisture record created successfully"."<br>";
} else {
  echo "Error: " . $moistsql . "<br>" . $conn->error;
}

$conn->close();



}




if($readTemp>0)
{
    include './dbcon.php';


    $finddate=date("Y/m/d");



// Create connection
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$tempsql = "INSERT INTO `temperature`(`date`, `Temperature`) VALUES ('$finddate',$readTemp)";

if ($conn->query($tempsql) === TRUE) {
  echo "New temperature record created successfully"."<br>";
} else {
  echo "Error: " . $tempsql . "<br>" . $conn->error;
}

$conn->close();



}
if($readTemp<=0){
    include './dbcon.php';


    //////////////////////////
    header('Content-type: text/plain; charset=UTF-8');


     $json = file_get_contents("http://3.18.135.41/gettemperature.php");

    $fcsv = fopen('temperature.csv', 'w');
    $array = json_decode($json, true);

    $csv = '';

    $header = false;
    foreach ($array as $line) {
        if (empty($header)) {
            $header = array_keys($line);
            fputcsv($fcsv, $header);
            $header = array_flip($header);
        }

        $line_array = array();

        foreach($line as $value) {
            array_push($line_array, $value);
        }

        fputcsv($fcsv, $line_array);
    }

    //close CSV file after write
    fclose($fcsv);


    ///////////////////////

    $data = file_get_contents("http://127.0.0.1:5000/findnewtemp");




    $sql="INSERT INTO `temp_predictions`( `tempValue`,
    `addedDate`) VALUES(  $data, convert_tz(now(),@@session.time_zone,'+05:30')  ) ";

if ($conn->query($sql) === TRUE) {
    echo "New temperature predicted record created successfully"."<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

}


}
?>
