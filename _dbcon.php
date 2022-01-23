<?php 

//connecting to herokudb
$servername = "us-cdbr-east-05.cleardb.net";
$username = "bcffd359fc0e1a";
$password = "7faf2220";
$database = "heroku_27ad2dd43bf0955";


//create a connection
$conn = mysqli_connect($servername , $username , $password  , $database );

//die if not connected
if(!$conn){
    die("Failed due to " . mysqli_connect_error());
}