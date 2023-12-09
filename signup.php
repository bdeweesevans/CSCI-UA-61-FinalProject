<?php
	ini_set('display_errors', 1); // Enable error reporting for debugging
	error_reporting(E_ALL);

	$email = $_POST['email'] ?? '';
	$password = $_POST['password'] ?? '';
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$cash = 0.00; // Default cash balance
	$tokens = 0; // Default token balance


	// Assuming the database is in the same directory as this script
	$db = new SQLite3(__DIR__.'/webDevFinal.db');

	// Prepared statements to prevent SQL injection
	$stmt = $db->prepare('INSERT INTO users (email, password, cash, tokens) VALUES (:email, :hashed_password, :cash, :tokens)');
	$stmt->bindValue(':email', $email, SQLITE3_TEXT);
	$stmt->bindValue(':hashed_password', $hashed_password, SQLITE3_TEXT);
	$stmt->bindValue(':cash', $cash, SQLITE3_FLOAT);
	$stmt->bindValue(':tokens', $tokens, SQLITE3_INTEGER);

	$db->close();

	if ($stmt->execute()) {
    // Print JS alert
    	echo "<script>alert('Success! Email: $email, Password: $password'); window.location.href='login.html';</script>";
	} else {
	    echo "Error inserting values: " . $db->lastErrorMsg();
	}
?>
