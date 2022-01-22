<?php 

//connecting to db
$servername = "localhost";
$email = "root";
$password = "";
$database = "test";

//create a connection
$conn = mysqli_connect($servername , $email , $password  , $database );

//die if not connected
if(!$conn){
  //  echo "Connection successful";
//}
//else{
    die("Failed due to " . mysqli_connect_error());
}