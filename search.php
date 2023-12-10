<?php
    // Database connection
    $path = "/home/bdd6280/databases";
    $db = new SQLite3($path.'/webDevFinal.db');

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
