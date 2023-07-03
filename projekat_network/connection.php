<?php
mysqli_report(MYSQLI_REPORT_OFF);
$server = "localhost";
$datebase = "network";
$username = "Nikola";
$password = "admin123";

$conn = new mysqli($server, $username, $password, $datebase);
if ($conn->connect_error)
{
  // header("Location: error.php?m=" . $conn->connect_error);
  die("Neuspela koneckija:" . $conn->connect_error);
}
$conn->set_charset("utf8");


// Ideja brojati followere tako sto cemo preko Whre ic reciver == $id pa count of rows