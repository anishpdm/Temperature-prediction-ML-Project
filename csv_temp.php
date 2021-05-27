<?php

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



  ?>
