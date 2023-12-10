<?php 
    session_start();
    ob_start(); // Start output buffering at the beginning

    function updateTokens($userEmail, $additionalTokens) {
        try {
            $db = new SQLite3(__DIR__.'../../databases/webDevFinal.db');
            $db->exec('BEGIN');
            $stmt = $db->prepare('UPDATE users SET tokens = tokens + :tokens WHERE email = :email');
            $stmt->bindValue(':tokens', $additionalTokens, SQLITE3_INTEGER);
            $stmt->bindValue(':email', $userEmail, SQLITE3_TEXT);
            $stmt->execute();
            $db->exec('COMMIT');
            $db->close();
        } catch (Exception $e) {
            $db->exec('ROLLBACK');
            return ['success' => false, 'error' => "Database error: " . $e->getMessage()];
        }
        return ['success' => true];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $providedEmail = $_POST['email'] ?? '';

        if (!filter_var($providedEmail, FILTER_VALIDATE_EMAIL)) {
            $response = ['success' => false, 'error' => 'Invalid email format.'];
        } else {
            $db = new SQLite3(__DIR__.'../../databases/webDevFinal.db');
            $stmt = $db->prepare('SELECT email FROM users WHERE email = :email');
            $stmt->bindValue(':email', $providedEmail, SQLITE3_TEXT);
            $result = $stmt->execute();

            if ($row = $result->fetchArray()) {
                $db->close();
                $fiveTokenPacksPurchased = intval($_POST['quantity3']);
                $tokensPerPack = 5;

                if ($fiveTokenPacksPurchased > 0) {
                    $totalTokensToAdd = $fiveTokenPacksPurchased * $tokensPerPack;
                    $response = updateTokens($providedEmail, $totalTokensToAdd);
                } else {
                    $response = ['success' => false, 'error' => 'No tokens to update'];
                }
            } else {
                $db->close();
                $response = ['success' => false, 'error' => 'No registered user found with the provided email.'];
            }
        }

        header('Content-Type: application/json');
        ob_end_clean(); // Clean (discard) the output buffer
        echo json_encode($response);
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
    <link rel="stylesheet" href="./styles.css">
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
        <h1>Shopping</h1>
        <form action="#" method="post">
            <h2>Our Shop:</h2>
            <div id="product1">
                <h3>1 Hour PS5 Time</h3>
                <p>New Spiderman game?!</p>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6cbhg24BNYD9JqSkB6wDexsHk_7sqPOC76F5vWSWEEA&s" alt="Product 1" width="200"><br>
                <label for="quantity1">Quantity:</label>
                <input type="number" id="quantity1" name="quantity1" value="0" min="0" onchange="total()">
                <p>Unit Cost: $12.00</p>
                <p>Subtotal: $<span id="subtotal1">0.00</span></p>
              </div>
              
            <div id="product2">
                <h3>1 Hour PC Time</h3>
                <p>Ryzen CPU!</p>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXJbfwgNSdbM69N2HNf4LwhOHAJeCBUv_ixhHzbjvGQQ&s" alt="Product 2" width="200"><br>
                <label for="quantity2">Quantity:</label>
                <input type="number" id="quantity2" name="quantity2" value="0" min="0" onchange="total()">
                <p>Unit Cost: $20.00</p>
                <p>Subtotal: $<span id="subtotal2">0.00</span></p>
            </div>
              
            <div id="product3">
                <h3>5 Game Tokens</h3>
                <img src="https://crescent.edu/uploads/editor/images/Blackjack.png" alt="Product 3" width="200"><br>
                <label for="quantity3">Quantity:</label>
                <input type="number" id="quantity3" name="quantity3" value="0" min="0" onchange="total()">
                <p>Unit Cost: $10.00</p>
                <p>Subtotal: $<span id="subtotal3">0.00</span></p>
            </div>

            <h3>Grand Total: $<span id="grandTotal">0.00</span></h3>

            <h2>Your Information:</h2>

            <div>
                Name:<br>
                <input type="text" id="name" name="name" placeholder="John Doe" required>
            </div>

            <div>
                Phone Number:<br>
                <input type="tel" id="phone" name="phone" placeholder="123-456-7890" required>
            </div>

            <div>
                Email Address:<br>
                <input type="email" id="email" name="email" placeholder="youremail@gmail.com" 
                    value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>" 
                    required>
            </div>

            <div>
                Billing Address:<br>
                <input type="text" id="address-street" name="address" placeholder="Street Address" required>
                <input type="text" id="address-city" name="address" placeholder="City" required>
                <input type="text" id="address-state" name="address" placeholder="State" required>
                <input type="text" id="address-areacode" name="address" placeholder="Area Code" required>
            </div>

            <div>
                Name on Credit Card:<br>
                <input type="text" id="cc-name" name="cc-name" placeholder="John Doe" required>
            </div>

            <div>
                Credit Card Number:<br>
                <input type="text" id="cc-number" name="cc-number" pattern="[0-9]{16}" placeholder="1234567890987654" required>
            </div>

            <div>
                Credit Card Expiration:<br>
                <input type="month" id="cc-expiration" name="cc-expiration" required>
            </div>

            <div>
                Credit Card CVV:<br>
                <input type="text" id="cc-cvv" name="cc-cvv" pattern="[0-9]{3,4}" placeholder="123" required>
            </div>

            <input type="submit" class="submit-button" value="Submit Order">
            <input type="reset" class="reset-button" value="Reset">
        </form>
        
    </div>
    <br>
    <footer>
        <p>Contributors: BD, JC, HZ</p>
        <a href="https://github.com/bdeweesevans/webdev-final" target="_blank" rel="noopener noreferrer">Github</a>
    </footer>

    <script src="products.js"></script>
</body>

</html>