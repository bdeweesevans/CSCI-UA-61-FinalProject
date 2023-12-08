<?php
$user = $_POST['user'];
$password = $_POST['password'];

$path = "/home/hz2330/databases";

$db = new SQLite3($path.'/webDevFinal.db');

$query = 'update users set Cash=5 and Tokens=4 WHERE Username=$user AND Password=$password';


?>