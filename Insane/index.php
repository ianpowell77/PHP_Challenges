<?php

$deck = createShuffleDeck();

function createShuffleDeck()
  {
  $suits = array(
    "clubs",
    "diamonds",
    "hearts",
    "spades"
  );
  $faces = array(
    "Ace" => 1,
    "2" => 2,
    "3" => 3,
    "4" => 4,
    "5" => 5,
    "6" => 6,
    "7" => 7,
    "8" => 8,
    "9" => 9,
    "10" => 10,
    "Jack" => 11,
    "Queen" => 12,
    "King" => 13
  );

  //loops through suits & faces -- creates deck array
  foreach($suits as $suit){
    foreach($faces as $face => $value){
      $deck[] = $value . " " . $suit;
    }
  }
  //randomizes order of cards
  shuffle($deck);
  return $deck;
}

$players = [
  "dealer" => array() ,
  "player" => array() ,
];

function dealCards($numOfCards)
  {
    global $deck;
    //iterates per number of cards to be passed out
    for ($i = 0; $i < $numOfCards; $i++){
      //pushes first index of $deck into a new array
      $cardsToDeal[] = $deck[0];
      //takes the first index off of the deck
      array_shift($deck);
    }
    //returned so when we call the function, the value is a returned array of the cards
    return $cardsToDeal;
  }
function givePlayerHand()
  {
  global $players;
  //loops through each player and calls deal cards to give them a new hand
  foreach($players as $player => $handArray)
    {
    $players[$player] = array_merge($players[$player], dealCards(2));
    }
  return $players;
}

function drawCard($player){
  //just calls the dealcards function with 1 card, equivalent to drawing
  global $players;
  $players[$player] = array_merge($players[$player], dealCards(1));
}

$sumOfPlayerHand = 0;
$sumOfDealerHand = 0;

function addPlayerValue()
  {
    global $players;
    global $sumOfPlayerHand;
    global $sumOfDealerHand;
    $sumOfDealerHand = 0;
    $sumOfPlayerHand = 0;
    $playerHasAce = false;
    for($i = 0 ; $i < count($players["dealer"]); $i++){
      $dealerCardValue = intval($players["dealer"][$i]);
      $sumOfDealerHand += $dealerCardValue;
    }
    for($i = 0 ; $i < count($players["player"]); $i++){
      $cardValue = intval($players["player"][$i]);
      if($cardValue === 1){
        $playerHasAce = true;
      }
      $sumOfPlayerHand += $cardValue;
    }
    if($sumOfPlayerHand <= 11 && $playerHasAce){
      $sumOfPlayerHand += 10;
    }
  }

function game() {
  global $deck;
  global $players;
  global $sumOfPlayerHand;
  global $sumOfDealerHand;

  $playerWon = "Player Won";
  $dealerWon = "Dealer Won";
  $money = 1000;
  $roundCount = 0;
  $winnerArray = [];
  $blackjackCount = 0;
  
  while (count($deck) > 0 && $money > 0){
    $round = false;
    $players["dealer"] = array();
    $players["player"] = array();
    givePlayerHand();
    while(!$round){
      if($money === 500){
        echo "You have 500 dollars left, and you're on round $roundCount."; 
      }
      addPlayerValue();
      echo "<p> Player - " . $sumOfPlayerHand . "</p>";
      echo "<p> Dealer - " . $sumOfDealerHand . "</p>";
      //echo "anything";
      //print_r($players["player"]);
      if(count($deck) == 0 ){

        echo "<pre>";
        echo "End Round :";
        echo " BlackJack Count :$blackjackCount ";
        echo " Round count : $roundCount ";
        echo " Bank : $money ";
        print_r($winnerArray);
        echo "</pre>";

        $round = true;
        //blackjack win  with 2 cards that are equal to 21
      }else if(count($players["player"]) == 2 && $sumOfPlayerHand == 21){
        $blackjackCount++;
        $money += 200;
        $winnerArray[] = $playerWon;
        $roundCount++;
        $round = true;
        echo "player got blackjack";   
      }else if($sumOfPlayerHand === 21 ){

        $money += 200;
        $winnerArray[] = $playerWon;
        $roundCount++;
        $round = true;
        echo "player gets blackjack"; 

        //dealer you win for getting 21
      } else if ($sumOfDealerHand === 21){

        $money += 200;
        $winnerArray[] = $dealerWon;
        $roundCount++;
        $round = true;
        echo "player bust "; 

      }else if($sumOfDealerHand > 21) {
        $money += 200;
        $winnerArray[] = $playerWon;
        $roundCount++;
        $round = true;
        echo "dealer busts";   
      }else if($sumOfPlayerHand <= $sumOfDealerHand){
        drawCard("player");
        echo "player draws card";
      }else if($sumOfPlayerHand > 21){
        $money -= 100;
        $winnerArray[] = $dealerWon;
        $roundCount++;
        $round = true;
        echo "player busts";
      }else if($sumOfPlayerHand < 21 && $sumOfPlayerHand > $sumOfDealerHand){
        drawCard("dealer");
        echo "dealer draws card";
      }
      
  //print_r($winnerArray);
    }
  }
}
game();
// givePlayerHand();
// print_r($deck);



?>