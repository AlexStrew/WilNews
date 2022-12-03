<?php
define('DB_SERVER','localhost');
define('DB_USER','u313100_admin');
define('DB_PASS' ,'13011952Alex');
define('DB_NAME','u313100_db');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>