<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTh_cKhMLbHhhILlX59eQ0Iyx2L19sTWOm5NQ&usqp=CAU')" >
    <br><br><br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col col-sm-2">


            </div>

            <div class="col col-sm-8 col-12">
                <form action="" method="post">
                    <table class="table">
                        <tr>
                            <td></td>
                            <td>
                                <h4>
                                    <p class="text-light">ADMIN - Self Adaptive Iot System for Precision Agriculture</p>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>  <p class="text-light"> username </p>  </td>
                            <td><input type="text" class="form-control" name="username"></td>
                        </tr>
                        <tr>
                            <td>  <p class="text-light"> Password </p> </td>
                            <td><input type="password" class="form-control" name="password"></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><button class="btn btn-success" name="but" type="submit">LOGIN</button></td>
                        </tr>


                       


                    </table>
                </form>

            </div>


            <div class="col col-12 col-sm-2">


            </div>


        </div>

    </div>

</body>

</html>



<?php

if (isset($_POST["but"])) {

    $Uname = $_POST["username"];

    $Pass = $_POST["password"];

    if($Uname=="admin" && $Pass=="1234")

    {
header("location:viewtemp.php");

    }

   
}


?>