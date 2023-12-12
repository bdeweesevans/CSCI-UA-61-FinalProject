$(function()
{
    console.log("User tokens:", userTokens);
    var cardSet = new Array(4);
    cardSet[0] = ["0","assets/cardimages/clubs_ace.png","assets/cardimages/clubs_2.png","assets/cardimages/clubs_3.png","assets/cardimages/clubs_4.png","assets/cardimages/clubs_5.png","assets/cardimages/clubs_6.png","assets/cardimages/clubs_7.png","assets/cardimages/clubs_8.png","assets/cardimages/clubs_9.png","assets/cardimages/clubs_10.png","assets/cardimages/clubs_jack.png","assets/cardimages/clubs_queen.png","assets/cardimages/clubs_king.png"];
    cardSet[1] = ["0","assets/cardimages/diamonds_ace.png","assets/cardimages/diamonds_2.png","assets/cardimages/diamonds_3.png","assets/cardimages/diamonds_4.png","assets/cardimages/diamonds_5.png","assets/cardimages/diamonds_6.png","assets/cardimages/diamonds_7.png","assets/cardimages/diamonds_8.png","assets/cardimages/diamonds_9.png","assets/cardimages/diamonds_10.png","assets/cardimages/diamonds_jack.png","assets/cardimages/diamonds_queen.png","assets/cardimages/diamonds_king.png"];
    cardSet[2] = ["0","assets/cardimages/hearts_ace.png","assets/cardimages/hearts_2.png","assets/cardimages/hearts_3.png","assets/cardimages/hearts_4.png","assets/cardimages/hearts_5.png","assets/cardimages/hearts_6.png","assets/cardimages/hearts_7.png","assets/cardimages/hearts_8.png","assets/cardimages/hearts_9.png","assets/cardimages/hearts_10.png","assets/cardimages/hearts_jack.png","assets/cardimages/hearts_queen.png","assets/cardimages/hearts_king.png"];
    cardSet[3] = ["0","assets/cardimages/spades_ace.png","assets/cardimages/spades_2.png","assets/cardimages/spades_3.png","assets/cardimages/spades_4.png","assets/cardimages/spades_5.png","assets/cardimages/spades_6.png","assets/cardimages/spades_7.png","assets/cardimages/spades_8.png","assets/cardimages/spades_9.png","assets/cardimages/spades_10.png","assets/cardimages/spades_jack.png","assets/cardimages/spades_queen.png","assets/cardimages/spades_king.png"];

    var img_collection = document.querySelectorAll(".cardImg");
    console.log(img_collection[0].src);

    function convertNum(val)
    {
        if (val == "J")
        {
            return 11;
        }
        else if (val == "Q")
        {
            return 12;
        }
        else if (val == "K")
        {
            return 13;
        }
        else if (val == "A")
        {
            return 1;
        }
        else
        {
            return parseInt(val);
        }
    }


    function convertSuit(val)
    {
        if (val == 'club' || val == 'clubs')
        {
            return 0;
        }
        else if (val == 'diamond' || val == 'diamonds')
        {
            return 1;
        }
        else if (val == 'heart' || val == 'hearts')
        {
            return 2;
        }
        else
        {
            return 3;
        }
    }
    
    function displayCard(img_num,number, suit_){
        var card_img = img_collection[img_num];
        console.log(number);
        let num = number;
        let suit = suit_;
        if (num != "" && suit != "")
        {
            num = convertNum(num);
            suit_num = convertSuit(suit);
            card_img.src = cardSet[suit_num][num];
        }
        else
        {
            card_img.src = "assets/cardimages/card_back.png";
        }
    };


    $("#card1_num").change(function()
    {
        displayCard(5,$("#card1_num").val(),$("#card1_suit").val());
    });
    $("#card1_suit").change(function()
    {
        displayCard(5,$("#card1_num").val(),$("#card1_suit").val());
    });
    $("#card2_num").change(function()
    {
        displayCard(6,$("#card2_num").val(),$("#card2_suit").val());
    });
    $("#card2_suit").change(function()
    {
        displayCard(6,$("#card2_num").val(),$("#card2_suit").val());
    });
    $("#card3_num").change(function()
    {
        displayCard(7,$("#card3_num").val(),$("#card3_suit").val());
    });
    $("#card3_suit").change(function()
    {
        displayCard(7,$("#card3_num").val(),$("#card3_suit").val());
    });
    $("#card4_num").change(function()
    {
        displayCard(8,$("#card4_num").val(),$("#card4_suit").val());
    });
    $("#card4_suit").change(function()
    {
        displayCard(8,$("#card4_num").val(),$("#card4_suit").val());
    });
    $("#card5_num").change(function()
    {
        displayCard(9,$("#card5_num").val(),$("#card5_suit").val());
    });
    $("#card5_suit").change(function()
    {
        displayCard(9,$("#card5_num").val(),$("#card5_suit").val());
    });


    function keyGen()
    {
        let num_min = 1;
        let num_max = 13;
        key_dict = new Array(5);
        num1 = Math.floor(Math.random()*(num_max - num_min + 1)) + num_min;
        num2 = Math.floor(Math.random()*(num_max - num_min + 1)) + num_min;
        num3 = Math.floor(Math.random()*(num_max - num_min + 1)) + num_min;
        num4 = Math.floor(Math.random()*(num_max - num_min + 1)) + num_min;
        num5 = Math.floor(Math.random()*(num_max - num_min + 1)) + num_min;
        let suit_min = 0;
        let suit_max = 3;
        suit_num1 = Math.floor(Math.random()*(suit_max - suit_min + 1)) + suit_min;
        suit_num2 = Math.floor(Math.random()*(suit_max - suit_min + 1)) + suit_min;
        suit_num3 = Math.floor(Math.random()*(suit_max - suit_min + 1)) + suit_min;
        suit_num4 = Math.floor(Math.random()*(suit_max - suit_min + 1)) + suit_min;
        suit_num5 = Math.floor(Math.random()*(suit_max - suit_min + 1)) + suit_min;
        key_dict[0] = [suit_num1,num1];
        key_dict[1] = [suit_num2,num2];
        key_dict[2] = [suit_num3,num3];
        key_dict[3] = [suit_num4,num4];
        key_dict[4] = [suit_num5,num5];
        return key_dict;
    }

    var username = $("#username").val();
    var password = $("#password").val();
    
    correct_count = 0;
    tokens_earn = correct_count*2;
    function showKey(e) {
        e.preventDefault();
        console.log("showKey function is executed");
        if (userTokens > 0) 
        {
            let key_ = keyGen();
            console.log(key_);

            correct_count = 0; 

            for (let i = 0; i < 5; i++) 
            {
                img_collection[i].src = cardSet[key_[i][0]][key_[i][1]];
            }

            for (let j = 0; j < 5; j++) 
            {
                let userSelectedNum = convertNum(document.querySelectorAll("form")[j][0].value);
                let userSelectedSuit = convertSuit(document.querySelectorAll("form")[j][1].value);

                for (let i = 0; i < 5; i++) 
                {
                    if (userSelectedSuit === key_[i][0] && userSelectedNum === key_[i][1]) 
                    {
                        correct_count++;
                    }
                }
            }

            $("#result").text("You got " + correct_count + " cards right! Buy tokens to try again");
            tokens_earn = correct_count * 2; // Calculate tokens earned
        
            console.log($("#result").text());
            updateTokens(tokens_earn); // Update tokens
        } 
        else 
        {
            $("#result").text("You don't have enough tokens. Buy tokens to play.");
            alert("You don't have enough tokens. Buy tokens to play.");
        }
    }



    $("#toSubmit").submit(function(e)
    {
        showKey(e);
        displayCard(5,$("#card1_num").val(),$("#card1_suit").val());
        displayCard(6,$("#card2_num").val(),$("#card2_suit").val());
        displayCard(7,$("#card3_num").val(),$("#card3_suit").val());
        displayCard(8,$("#card4_num").val(),$("#card4_suit").val());
        displayCard(9,$("#card5_num").val(),$("#card5_suit").val());
    });

    function updateTokens(tokens_earn) {
        const url = './update_token.php';
    
        var username = "<?php echo $_SESSION['username']; ?>";
    
        const data = new URLSearchParams();
        data.append('username', username);
        data.append('correctGuess', tokens_earn);
    

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: data.toString(), 
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);  
        })
        .catch(error => {
            console.error('Error:', error);
        });
        $("#tokenDisplay").load("display_tokens.php");
    }
    
});