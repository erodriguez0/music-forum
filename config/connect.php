<?php
if(!isset($_SESSION)) {
	session_start();
}
$server = 'localhost';
$dbuser = 'erodriguez';
$dbpass = 'Uc@00760cL';
$db = 'erodriguez';
$conn = new PDO("mysql:host=$server;dbname=$db", $dbuser, $dbpass);
?>
