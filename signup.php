<?php
    ini_set('display_errors', 1); // Enable error reporting for debugging
    error_reporting(E_ALL);

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $tokens = 0; // Default token balance

    $path = "/home/bdd6280/databases";
    $db = new SQLite3($path.'/webDevFinal.db');

    // Check if the email is already registered
    $checkStmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $checkStmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $checkStmt->execute();

    if ($result->fetchArray()) {
        // Email already exists
        echo "<script>alert('An account with this email already exists.'); window.location.href='signup.html';</script>";
    } else {
        // Email does not exist, proceed to insert
        $stmt = $db->prepare('INSERT INTO users (email, password, tokens) VALUES (:email, :hashed_password, :tokens)');
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':hashed_password', $hashed_password, SQLITE3_TEXT);
        $stmt->bindValue(':tokens', $tokens, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            // Print JS alert
            echo "<script>alert('Success! Email: $email, Password: $password'); window.location.href='login.html';</script>";
        } else {
            echo "Error inserting values: " . $db->lastErrorMsg();
        }
    }

    $db->close();
?>
