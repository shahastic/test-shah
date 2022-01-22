<?php 

//connecting to herokudb
$servername = "7faf2220@us-cdbr-east-05.cleardb.net";
$email = "bcffd359fc0e1a";
$password = "7faf2220";
$database = "heroku_27ad2dd43bf0955";


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