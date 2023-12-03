$(function()
{
    var cardSet = new Array(4);
    cardSet[0] = [0,"assets/cardimages/clubs_ace.png","assets/cardimages/clubs_2.png","assets/cardimages/clubs_3.png","assets/cardimages/clubs_4.png","assets/cardimages/clubs_5.png","assets/cardimages/clubs_6.png","assets/cardimages/clubs_7.png","assets/cardimages/clubs_8.png","assets/cardimages/clubs_9.png","assets/cardimages/clubs_jack.png","assets/cardimages/clubs_queen.png","assets/cardimages/clubs_king.png"];
    cardSet[1] = [0,"assets/cardimages/diamonds_ace.png","assets/cardimages/diamonds_2.png","assets/cardimages/diamonds_3.png","assets/cardimages/diamonds_4.png","assets/cardimages/diamonds_5.png","assets/cardimages/diamonds_6.png","assets/cardimages/diamonds_7.png","assets/cardimages/diamonds_8.png","assets/cardimages/diamonds_9.png","assets/cardimages/diamonds_jack.png","assets/cardimages/diamonds_queen.png","assets/cardimages/diamonds_king.png"];
    cardSet[2] = [0,"assets/cardimages/hearts_ace.png","assets/cardimages/hearts_2.png","assets/cardimages/hearts_3.png","assets/cardimages/hearts_4.png","assets/cardimages/hearts_5.png","assets/cardimages/hearts_6.png","assets/cardimages/hearts_7.png","assets/cardimages/hearts_8.png","assets/cardimages/hearts_9.png","assets/cardimages/hearts_jack.png","assets/cardimages/hearts_queen.png","assets/cardimages/hearts_king.png"];
    cardSet[3] = [0,"assets/cardimages/spades_ace.png","assets/cardimages/spades_2.png","assets/cardimages/spades_3.png","assets/cardimages/spades_4.png","assets/cardimages/spades_5.png","assets/cardimages/spades_6.png","assets/cardimages/spades_7.png","assets/cardimages/spades_8.png","assets/cardimages/spades_9.png","assets/cardimages/spades_jack.png","assets/cardimages/spades_queen.png","assets/cardimages/spades_king.png"];

    var img_collection = document.querySelectorAll(".cardImg");
    console.log(img_collection[0].src);
    
    function displayCard(img_num,number, suit_){
        var card_img = img_collection[img_num];
        console.log(card_img);
        let num = number;
        let suit = suit_;
        if (num != "" && suit != "")
        {
            if (num == "J")
            {
                num = 10;
            }
            else if (num == "Q")
            {
                num = 11;
            }
            else if (num == "K")
            {
                num = 12;
            }
            else if (num == "A")
            {
                num = 1;
            }
            else
            {
                num = parseInt(num);
            }
            let suit_num;
            if (suit == "clubs" || suit == "club")
            {
                suit_num = 0;
            }
            else if (suit == "diamonds" || suit == "diamond")
            {
                suit_num = 1;
            }
            else if (suit == "hearts" || suit == "heart")
            {
                suit_num = 2;
            }
            else
            {
                suit_num = 3;
            }
            
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

    
    function showKey(e)
    {
        e.preventDefault();
        console.log("showKey function is executed");
        if ($("#card1_num").val() != "9" || $("#card2_num").val() != "5" || $("#card3_num").val() != "2" || $("#card4_num").val() != "3" || $("#card5_num").val() != "12")
        {
            $("#result").text("Buy tokens to try again");
        }
        else if ($("#card1_suit").val() != "spades" || $("#card1_suit").val() != "spade")
        {
            $("#result").text("Buy tokens to try again");
        }
        else if ($("#card2_suit").val() != "ace" || $("#card2_suit").val() != "aces")
        {
            $("#result").text("Buy tokens to try again");
        }
        else if ($("#card3_suit").val() != "diamond" || $("#card3_suit").val() != "diamonds")
        {
            $("#result").text("Buy tokens to try again");
        }
        else if ($("#card4_suit").val() != "club" || $("#card4_suit").val() != "clubs")
        {
            $("#result").text("Buy tokens to try again");
        }
        else if ($("#card5_suit").val() != "spade" || $("#card5_suit").val() != "spades")
        {
            $("#result").text("Buy tokens to try again");
        }
        else
        {
            $("#result").text("Congratulation! You earn 10 tokens! ");
        }
        console.log($("#result").text);
        $("#key1").attr("src",cardSet[3][9]);
        $("#key2").attr("src",cardSet[2][5]);
        $("#key3").attr("src",cardSet[1][2]);
        $("#key4").attr("src",cardSet[0][3]);
        $("#key5").attr("src",cardSet[3][12]);
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
});