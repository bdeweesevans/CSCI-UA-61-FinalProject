<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $subject = $_POST['subject'] ?? '';
        $email = $_POST['email'] ?? '';
        $body = $_POST['body'] ?? '';

        $path = "/home/hz2330/databases";
        $db = new SQLite3($path.'/webDevFinal.db');

        // INSERT statement
        $insert = "INSERT INTO contact (subject, email, body) VALUES (:subject, :email, :body)";
        $stmt = $db->prepare($insert);

        $stmt->bindValue(':subject', $subject, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':body', $body, SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo "Successful send.";
        } 
        else {
            echo "Error sending: " . $db->lastErrorMsg();
        }

        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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
        <h1>Contact</h1>
        <form class="form-container" method="post" action="contact.php">
            <h3>Contact Form</h3>
            <input type="text" name="subject" placeholder="Subject" required>
            <input type="email" name="email" placeholder="Your email" value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>" required>
            <textarea name="body" placeholder="Email body" required></textarea>
            <button type="submit" class="submit-button">Submit</button>
            <button type="reset" class="reset-button">Clear</button>
        </form>

    </div>
    <br>
    <footer>
        <p>Contributors: BD, JC, HZ</p>
        <a href="https://github.com/bdeweesevans/webdev-final" target="_blank" rel="noopener noreferrer">Github</a>
    </footer>
</body>