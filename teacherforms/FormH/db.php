<?php
$dsn = 'mysql:host=localhost;dbname=dbms_project';
$username = 'root';
$password = '';
$options = [];
try {
$connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e) {

}
	$usernm="root";
        $passwd="";
        $host="localhost";
        $database="dbms_project";

        $conn = mysqli_connect($host,$usernm,$passwd,$database);

        if (!$conn) {
           die("Connection failed: " . mysqli_connect_error());
		}