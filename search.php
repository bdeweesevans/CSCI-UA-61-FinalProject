<?php
// Database connection
$db = new SQLite3(__DIR__.'/webDevFinal.db');

// Grab product names from the database and put in list
$productNames = "SELECT Product_name FROM products";
$resultNames = $db->query($productNames);
$productList = array();
while ($row = $resultNames->fetchArray(SQLITE3_ASSOC)) {
    $productList[] = $row['Product_name'];
}

// Grab prices from the database and put in list
$prices = "SELECT Price FROM products";
$resultPrice = $db->query($prices);
$priceList = array();
while ($row = $resultPrice->fetchArray(SQLITE3_ASSOC)) {
    $priceList[] = $row['Price'];
}

// Grab descriptions from the database and put in list
$descriptions = "SELECT Description FROM products";
$resultDesc = $db->query($descriptions);
$descriptionList = array();
while ($row = $resultDesc->fetchArray(SQLITE3_ASSOC)) {
    $descriptionList[] = $row['Description'];
}

// Close connection
$db->close();

// Check if the form is submitted
$submitted = isset($_POST['searchInput']);

// Get input from search form
$input = $submitted ? $_POST['searchInput'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="header" style="font-weight:bold">
            <a href="./index.html">Home</a> |
            <a href="./products.php">Products</a> |
            <a href="./search.php">Search</a> |
            <a href="./game.html">Game</a> |
            <a href="./contact.html">Contact</a> |
            <a href="./login.html">Login</a> |
            <a href="./signup.html">Sign Up</a>
        </div>
        <h1>Search Page</h1>
        <form class="form-container" method="post">
            <h3>Search for our products below: </h3>
            <input type="search" placeholder="Search" name="searchInput">
            <button type="submit" class="submit-button">Submit</button>
            <button type="reset" class="reset-button">Clear</button>
        </form>
        <div class="container">
            <?php
            if ($submitted) {
                $index = -1;
                $resultsFound = false; 

                // Run loop to check if user input matches a product
                foreach ($productList as $element) {
                    $index++;
                    // Echo all information if match is found
                    if (stripos($element, $input) !== false) {
                        $resultsFound = true; 
                        echo ("<li> $element </li>");
                        echo ("<li> Price: $$priceList[$index] </li>");
                        echo ("<li> $descriptionList[$index] </li><br>");
                    }
                }

                // Echo message if there is no match
                if (!$resultsFound) {
                    echo ("We don’t have this product at our shop.");
                }
            }
            ?>
        </div>
    </div>
    <br>
    <footer>
        <p>Contributors: BD, JC, HZ</p>
        <a href="https://github.com/bdeweesevans/webdev-final" target="_blank" rel="noopener noreferrer">Github</a>
    </footer>
</body>
</html>
