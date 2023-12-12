<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $cashEarned = $_POST['correctGuess'];

    //$path = "/home/bdd6280/databases";
    //$db = new SQLite3($path.'/webDevFinal.db');
    $db = new SQLite3(__DIR__.'/webDevFinal.db');
    

    $email = $_SESSION['user_email'];
    $currTokensQuery = $db->prepare('SELECT tokens, cash FROM users WHERE email = :email');
    $currTokensQuery->bindParam(':email', $email);

    $result = $currTokensQuery->execute();
    
    if ($result) 
    {
        $currTokensResult = $result->fetchArray(SQLITE3_ASSOC);

        if ($currTokensResult) 
        {
            $currTokens = $currTokensResult['tokens'] - 1;
            $currCash = $currTokensResult['cash'];

            $newCash = $currCash + $cashEarned;

            $updateStatement = $db->prepare('UPDATE users SET cash = :newCash, tokens = :currTokensMinus1 WHERE email = :email');
            $updateStatement->bindParam(':newCash', $newCash, SQLITE3_INTEGER);
            $updateStatement->bindParam(':currTokensMinus1', $currTokens, SQLITE3_INTEGER);
            $updateStatement->bindParam(':email', $email);

            $updateResult = $updateStatement->execute();

            if ($updateResult) 
            {
                echo 'Tokens updated successfully';
            } 
            else 
            {
                echo 'Error updating tokens';
            }
        } 
        else 
        {
            echo 'No user found with the specified email';
        }
    } 
    else 
    {
        echo 'Error executing the query';
    }
} 
else 
{
    http_response_code(400);
    echo 'Invalid request';
}
?>