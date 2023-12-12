<?php
    // Database connection
    $path = "/home/hz2330/databases";
    $db = new SQLite3($path.'/webDevFinal.db');

    // Grab product names from DB
    $productNames = "SELECT Product_name FROM products";
    $resultNames = $db->query($productNames);
    $productList = array();
    while ($row = $resultNames->fetchArray(SQLITE3_ASSOC)) {
        $productList[] = $row['Product_name'];
    }

    // Grab prices from DB
    $prices = "SELECT Price FROM products";
    $resultPrice = $db->query($prices);
    $priceList = array();
    while ($row = $resultPrice->fetchArray(SQLITE3_ASSOC)) {
        $priceList[] = $row['Price'];
    }

    // Grab descriptions from DB
    $descriptions = "SELECT Description FROM products";
    $resultDesc = $db->query($descriptions);
    $descriptionList = array();
    while ($row = $resultDesc->fetchArray(SQLITE3_ASSOC)) {
        $descriptionList[] = $row['Description'];
    }

    $db->close();

    // Check if form is submitted
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

        $('.reset-button').on('click', function() {
            $('#searchResults').hide();

            $('input[name="searchInput"]').val('');
        });
    });
</script>

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
        <?php if ($submitted): ?>
            <div class="container" id="searchResults">
                <?php
                    if ($submitted) {
                        $resultsFound = false;

                        foreach ($productList as $index => $productName) {
                            $priceString = strval($priceList[$index]);

                            if (stripos($productName, $input) !== false || stripos($descriptionList[$index], $input) !== false || $priceString === $input) {
                                $resultsFound = true;
                                echo ("<li> $productName </li>");
                                echo ("<li> Price: $" . $priceList[$index] . " </li>");
                                echo ("<li> " . $descriptionList[$index] . " </li><br>");
                            }
                        }

                        if (!$resultsFound) {
                            echo ("We don’t have this product at our shop.");
                        }
                    }
                ?>
            </div>
        <?php endif; ?>
    </div>
    <br>
    <footer>
        <p>Contributors: BD, JC, HZ</p>
        <a href="https://github.com/bdeweesevans/webdev-final" target="_blank" rel="noopener noreferrer">Github</a>
    </footer>
</body>
</html>
