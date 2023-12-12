<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link rel="stylesheet" href="./styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<script>
    $(function () {
        $("#header").load("header.php");
        $("#tokenDisplay").load("display_tokens.php");
    })
</script>

<body>
    <div class="container game">
        <div id="header"></div>
        <h2>
            Card Game
        </h2>
        <div id="tokenDisplay"></div>
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
            <!--input type="hidden" name="submitted" value="1"-->
            <input type="submit" class="submit-button" name="submitBtn">
            <input type="reset" class="reset-button">
        </form>
        
    </div>
    <br>
    <footer>
        <p>Contributors: BD, JC, HZ</p>
        <a href="https://github.com/bdeweesevans/webdev-final" target="_blank" rel="noopener noreferrer">Github</a>
    </footer>
    <script>
        var userTokens = <?php echo json_encode($_SESSION['tokens']); ?>;
    </script>
    

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <!-- Velocity -->
	<script src="velocity.min.js"></script>
	<script src="velocity.ui.min.js"></script>

    <script src="game.js"></script>

</body>

</html>
