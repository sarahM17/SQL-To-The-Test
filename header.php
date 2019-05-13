<?php
$host = 'localhost';
$dbname = 'sql_ex';
$username = 'root';
$password = 'FFwachten123!';
try {
    $newpdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

} catch (PDOException $i) {
    die("Could not connect to the database $dbname :" . $i->getMessage());
}
?>

