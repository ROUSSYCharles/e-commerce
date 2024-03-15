<?php
session_start();

try {
	// On se connecte à MySQL
	$mysqlClient = new PDO('mysql:host=localhost:3306;dbname=lmv', 'root', '');
} catch (Exception $e) {
	die('Erreur  : ' . $e->getMessage());
}
?>