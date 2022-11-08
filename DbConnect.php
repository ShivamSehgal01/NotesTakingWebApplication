<?php

//Creating Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "contact";

// Connecting 
$conn = mysqli_connect($servername, $username, $password, $database);

//Check is Connection was Successfull
if(!$conn){
    die("Failed to Connect ! Error:". mysqli_connect_error());
}
else {
    // echo "Connection was succesfull";
}

// $sql = "INSERT INTO `contactus` (`Title`, `Description`, `Date`) VALUES ('Hey', 'dwd', current_timestamp());";


// $result = mysqli_query($conn, $sql);

// if($result){
//     echo"<br>Record Inserted";
// }
// else{
//     echo"<br>Record not Inserted Error: " . mysqli_error($conn);
// }


?>