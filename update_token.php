<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $cashEarned = $_POST['correctGuess'];

    $user = $_POST['username'];
    $password = $_POST['password'];

    $path = "/home/hz2330/databases";

    $db = new SQLite3($path.'/webDevFinal.db');

    $storedPwd = $db->query('SELECT Password FROM users WHERE Username=$username');
    

    if ($storedPwd == $password)
    {
        $currTokensQuery = $db->prepare('SELECT Tokens,Cash FROM users WHERE Username = :username');
        $currTokensQuery->bindParam(':username', $username);
        $currTokensQuery->execute();
    
        $currTokensResult = $currTokensQuery->fetch(PDO::FETCH_ASSOC);

        if ($currTokensResult) {
            $currTokens = $currTokensResult['Tokens'];
            $currCash = $currTokensResult['Cash'];
            
            $newCash = $currCash + $cashEarned;

            $updateStatement = $db->prepare('UPDATE users SET Cash = :newCash, Tokens = :currTokensMinus1 WHERE Username = :username');
            $updateStatement->bindParam(':newCash', $newCash);
            $updateStatement->bindParam(':currTokensMinus1', $currTokens - 1);
            $updateStatement->bindParam(':username', $username);
            $updateStatement->execute();
        }
    }

    echo 'Tokens updated successfully';
} else {
    // Handle invalid requests
    http_response_code(400);
    echo 'Invalid request';
}
?>