<?php
    session_start(); 
    if (isset($_SESSION['user_email'])) 
    {
        $userEmail = $_SESSION['user_email'];
    
        $path = "/home/hz2330/databases";
        $db = new SQLite3($path.'/webDevFinal.db');
    
        $stmt = $db->prepare('SELECT tokens FROM users WHERE email = :email');
        $stmt->bindValue(':email', $userEmail, SQLITE3_TEXT);
        $result = $stmt->execute();
    
        if ($row = $result->fetchArray()) 
        {
            echo "<script>var userTokens = " . json_encode($row['tokens']) . ";</script>";
            echo "<h3>Current User Tokens: " . $row['tokens'] . "</h3>";
        } 
        else 
        {
            echo "<p>User data not found.</p>";
        }
    
        $db->close();
    } 
    else 
    {
        echo "<p>Please <a href='./login.html'>Login.</a></p>";
    }
?>