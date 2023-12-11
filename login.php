<?php
    session_start();

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $path = "/home/hz2330/databases";
    $db = new SQLite3($path.'/webDevFinal.db');

    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');   // prevent SQL injection
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    $login_success = false;

    if ($row = $result->fetchArray()) {
        if (password_verify($password, $row['password'])) {
            // Session variables
            $_SESSION['user_email'] = $email;
            $_SESSION['logged_in'] = true;

            $tokensQuery = $db->prepare('SELECT tokens FROM users WHERE email = :email');
            $tokensQuery->bindValue(':email', $email, SQLITE3_TEXT);
            $tokensResult = $tokensQuery->execute();

            if ($tokensRow = $tokensResult->fetchArray()) 
            {
                $_SESSION['tokens'] = $tokensRow['tokens'];
            }

            // Redirect to different page after successful login
            header('Location: products.php');
            exit();
        }
    }

    if ($login_success) {
        echo "<script>alert('Login successful! Welcome, $email');</script>";
    } else {
        echo "<script>alert('Login failed! Incorrect email or password.'); window.location.href='login.html';</script>";
    }

    $db->close();
?>
