const card1 = document.getElementById("card1");
const card2 = document.getElementById("card2");
const card3 = document.getElementById("card1");
const card4 = document.getElementById("card4");
const card5 = document.getElementById("card5");

var img = document.querySelectorAll("img");
var img1 = img[0];
var img2 = img[1];
var img3 = img[2];
var img4 = img[3];
var img5 = img[4];
console.log(igm1);

let cardSet = new Array(4);
cardSet[0] = [0,"images/clubs_ace.png","images/clubs_2.png","images/clubs_3.png","images/clubs_4.png","images/clubs_5.png","images/clubs_6.png","images/clubs_7.png","images/clubs_8.png","images/clubs_9.png","images/clubs_jack.png","images/clubs_queen.png","images/clubs_king.png"];
cardSet[1] = [0,"images/diamonds_ace.png","images/diamonds_2.png","images/diamonds_3.png","images/diamonds_4.png","images/diamonds_5.png","images/diamonds_6.png","images/diamonds_7.png","images/diamonds_8.png","images/diamonds_9.png","images/diamonds_jack.png","images/diamonds_queen.png","images/diamonds_king.png"];
cardSet[2] = [0,"images/hearts_ace.png","images/hearts_2.png","images/hearts_3.png","images/hearts_4.png","images/hearts_5.png","images/hearts_6.png","images/hearts_7.png","images/hearts_8.png","images/hearts_9.png","images/hearts_jack.png","images/hearts_queen.png","images/hearts_king.png"];
cardSet[3] = [0,"images/spades_ace.png","images/spades_2.png","images/spades_3.png","images/spades_4.png","images/spades_5.png","images/spades_6.png","images/spades_7.png","images/spades_8.png","images/spades_9.png","images/spades_jack.png","images/spades_queen.png","images/spades_king.png"];

var card1_num = document.getElementById("card1_num").value;
var card2_num = document.getElementById("card2_num");
var card3_num = document.getElementById("card3_num");
var card4_num = document.getElementById("card4_num");
var card5_num = document.getElementById("card5_num");

var card1_suit = document.getElementById("card1_suit").value;
var card2_suit = document.getElementById("card2_suit");
var card3_suit = document.getElementById("card3_suit");
var card4_suit = document.getElementById("card4_suit");
var card5_suit = document.getElementById("card5_suit");

var form = document.querySelectorAll("form");
var form1 = form[0];
var form2 = form[1];
var form3 = form[2];
var form4 = form[3];
var form5 = form[4];

var btn1 = document.getElementById("test");
var btn2 = form[1].element[2];
var btn3 = form[2].element[2];
var btn4 = form[3].element[2];
var btn5 = form[4].element[2];

btn1.addEventListener(click,displayCard(img1,card1_num,card1_suit));
//form2.addEventListener(submit,displayCard(img2,card2_num,card2_suit));
//form3.addEventListener(submit,displayCard(img3,card3_num,card3_suit));
//form4.addEventListener(submit,displayCard(img4,card4_num,card4_suit));
//form5.addEventListener(submit,displayCard(img5,card5_num,card5_suit));

function displayCard(card,number,suit_){
    obj = card;
    num = number;
    suit = suit_;

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

    var suit_num;
    if (suit == "clubs" | suit == "club")
    {
        suit_num = 0;
    }
    else if (suit == "diamonds" | suit == "diamond")
    {
        suit_num = 1;
    }
    else if (suit == "hearts" | suit == "heart")
    {
        suit_num = 2;
    }
    else
    {
        suit_num = 3;
    }

    obj.src = cardSet[num][suit_num];
};



