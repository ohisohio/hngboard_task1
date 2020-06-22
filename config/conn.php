<?php

/* define('host','localhost');
define('user','ohis');
define('pass','success@305');
define('db','hngboard');



$conn = mysqli_connect(host,user,pass,db);

if(!$conn){
    die("Error: failed to connect to database ");
} 
 */


function OpenCon()
{
$dbhost = "localhost";
$dbuser = "ohis";
$dbpass = "success@305";
$db = "hngboard";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

return $conn;
}

function CloseCon($conn)
{
$conn -> close();
}

?>