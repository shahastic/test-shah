<?php 

//connecting to db
$servername = "localhost";
$email = "email";
$password = "";
$database = "test";

//create a connection
$conn = mysqli_connect($servername , $email , $password  , $database );

//die if not connected
if(!$conn){
    die("Failed due to " . mysqli_connect_error());
}