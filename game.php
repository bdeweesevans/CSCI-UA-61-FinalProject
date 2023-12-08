<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <div class="container game">
        <div class="header" style="font-weight:bold">
            <a href="./index.html">Home</a> |
            <a href="./products.php">Products</a> |
            <a href="./search.html">Search</a> |
            <a href="./game.html">Game</a> |
            <a href="./contact.html">Contact</a> |
            <a href="./login.html">Login</a> |
            <a href="./signup.html">Sign Up</a>
        </div>
        <h2>
            Slot Machine
        </h2>
        <h3>
            Keys:
        </h3>
        <div id="keyCard">
            <div class="cardContainer"><img src="assets/cardimages/card_back.png"  class="cardImg smSpace" id="key1"></div>
            <div class="cardContainer"><img src="assets/cardimages/card_back.png"  class="cardImg smSpace" id="key2"></div>
            <div class="cardContainer"><img src="assets/cardimages/card_back.png"  class="cardImg smSpace" id="key3"></div>
            <div class="cardContainer"><img src="assets/cardimages/card_back.png"  class="cardImg smSpace" id="key4"></div>
            <div class="cardContainer"><img src="assets/cardimages/card_back.png"  class="cardImg smSpace" id="key5"></div>
        </div>
        <hr>
        <br>
        <h3>
            Your Selection:
        </h3>
        <div id="gamePage">
            <div id="container1" class="cardContainer">
                <img src="assets/cardimages/card_back.png"  class="cardImg smSpace" id="img1">
                <form class="instruction" id="card1">
                    Enter<p> a Number (2-9)/J/Q/K/A:</p> <input type="text" name="card1_num" id="card1_num" required>
                    Enter a suit: <p>(club
                        / diamond
                        / heart
                        / spade) </p><input type="text" name="card1_suit" id="card1_suit" required>
                </form>
            </div>
            <div id="container2" class="cardContainer">
                <img src="assets/cardimages/card_back.png"  class="cardImg smSpace">
                <form class="instruction" id="card2">
                    Enter<p>a Number (2-9)/J/Q/K/A:</p> <input type="text" name="card2_num" id="card2_num" required>
                    Enter a suit: <p>(club
                        / diamond
                        / heart
                        / spade) </p><input type="text" name="card2_suit" id="card2_suit" required>
                </form>
            </div>
            <div id="container3" class="cardContainer">
                <img src="assets/cardimages/card_back.png"  class="cardImg smSpace">
                <form class="instruction" id="card3">
                    Enter<p>a Number (2-9)/J/Q/K/A:</p> <input type="text" name="card3_num" id="card3_num" required>
                    Enter a suit: <p>(club
                        / diamond
                        / heart
                        / spade) </p><input type="text" name="card3_suit" id="card3_suit" required>
                </form>
            </div>
            <div id="container4" class="cardContainer">
                <img src="assets/cardimages/card_back.png"  class="cardImg smSpace">
                <form class="instruction" id="card4">
                    Enter<p>a Number (2-9)/J/Q/K/A:</p> <input type="text" name="card4_num" id="card4_num" required>
                    Enter a suit: <p>(club
                        / diamond
                        / heart
                        / spade) </p><input type="text" name="card4_suit" id="card4_suit" required>
                </form>
            </div>
            <div id="container5" class="cardContainer">
                <img src="assets/cardimages/card_back.png"  class="cardImg smSpace">
                <form class="instruction" id="card5">
                    Enter<p>a Number (2-9)/J/Q/K/A:</p><input type="text" name="card5_num" id="card5_num" required>
                    Enter a suit: <p>(club
                        / diamond
                        / heart
                        / spade) </p><input type="text" name="card5_suit" id="card5_suit" required>
                </form>
            </div>
        </div>
        <h3 id="result">No repetition please! Confirm your choice by clicking the button below. </h3>
        <form onsubmit="showKey()" id="toSubmit">
            Enter your Username: <input type="text" id="username" name="username">
            Enter your Password: <input type="text" id="password" name="password">
            <input type="submit" name="submitBtn">
            <input type="reset">
        </form>
        
    </div>
    <br>
    <footer>
        Final Project Footer
        <p>Contributors: BD, JC, HZ</p>
        <a href="https://github.com/bdeweesevans/webdev-final" target="_blank" rel="noopener noreferrer">Github</a>
    </footer>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <!-- Velocity -->
	<script src="velocity.min.js"></script>
	<script src="velocity.ui.min.js"></script>

    <script src="game.js"></script>

</body>

</html>
