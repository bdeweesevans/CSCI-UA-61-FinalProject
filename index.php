<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<script>
    $(function () {
        $("#header").load("header.php");
    })
</script>

<body>
    <div class="container">
        <div id="header"></div>
        <h1>CSCI-061 Final Project</h1>
        <h2>Gaming Lounge</h2>
        <div class="container">
            <?php
                if (isset($_SESSION['user_email'])) {
                    $userEmail = $_SESSION['user_email'];

                    //$path = "/home/bdd6280/databases";
                    //$db = new SQLite3($path.'/webDevFinal.db');
                    $db = new SQLite3(__DIR__.'/webDevFinal.db');

                    $stmt = $db->prepare('SELECT email, cash, tokens FROM users WHERE email = :email');
                    $stmt->bindValue(':email', $userEmail, SQLITE3_TEXT);
                    $result = $stmt->execute();

                    if ($row = $result->fetchArray()) {
                        echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";
                        echo "<p>Cash Balance: $" . htmlspecialchars($row['cash']) . "</p>";
                        echo "<p>Tokens: " . htmlspecialchars($row['tokens']) . "</p>";
                    } else {
                        echo "<p>User data not found.</p>";
                    }

                    $db->close();
                } else {
                    echo "<p>Please <a href='./login.html'>Login.</a></p>";
                }
            ?>
        </div>
    </div>
    <footer>
        <p>Contributors: BD, JC, HZ</p>
        <a href="https://github.com/bdeweesevans/webdev-final" target="_blank" rel="noopener noreferrer">Github</a>
    </footer>
</body>
</html>
