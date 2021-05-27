<?php
include './dbcon.php';
// session_start();
?>
<!DOCTYPE html>
<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
</head>

<body>

<img width="100%" height="200px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSY1AqemHwFy8FBzKXStVg59p4EyRCVBgVHzg&usqp=CAU" alt="">


    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Self Adaptive Iot System for Precision Agriculture </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Temperature
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="viewtemp.php">View Last Readings</a></li>
            <li><a class="dropdown-item" href="viewtemppredict.php">View Predicted Readings </a></li>
            
          </ul>
        </li>



        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Humidity
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="viewhum.php">View Last Readings</a></li>
            <li><a class="dropdown-item" href="viewhumpredict.php">View Predicted Readings </a></li>
            
          </ul>
        </li>




        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Moisture
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="viewmoist.php">View Last Readings</a></li>
            <li><a class="dropdown-item" href="viewmoistpredict.php">View Predicted Readings </a></li>
            
          </ul>
        </li>


        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">LogOut</a>
        </li>

      
      </ul>
  
    </div>
  </div>
</nav>
    <br /><br />
    <div class="container" style="width:600px;">
        <h2 align="center"> View Humidity Readings </h2>
        <br /><br />





                <?php



                 $sql = "SELECT `date`, `humidity` FROM `humidity` ORDER BY `date` DESC LIMIT 10
                 ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    echo "<table class='table'> <tr>  <th> Date </th> <th> Humidity </th>    </tr>";

                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $date = $row["date"];
                        $Temperature = $row["humidity"];

                        echo " <tr>  <td> $date </td> <td> $Temperature </td>    </tr>";
                       
                    }

                    echo "</table>";
                
                
                }


                ?>



            </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>