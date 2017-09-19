<?php
// MEDIUM:
// We will now create a function to deal these cards to each user. 
//Modify this function so that it returns the number of cards specified for the user.
// Also, it must modify the deck so that those cards are no longer available to be distributed.
$deck = createShuffleDeck();

function createShuffleDeck(){
  $suits = array ("clubs", "diamonds", "hearts", "spades");
  $faces = array (
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

  $deck = array();
  //gives me a suit as a suit
  foreach($suits as $suit){
    //gives me a value for each suit
    foreach($faces as $faceName => $faceValue){
      $deck["$faceName of $suit"] = $faceValue;
    }
  }

  $cardIndices = array_keys($deck);
  shuffle($cardIndices);
  $shuffledDeck = [];

  foreach($cardIndices as $cardName) {
    $shuffledDeck[$cardName] = $deck[$cardName];
  }

  return($shuffledDeck);
}


function dealCards($numOfCards) {
  global $deck;
  $deckIndices = array_keys($deck);
  $cardsToDeal = [];
  for($i = 0 ; $i < $numOfCards ; $i++) {
    $cardsToDeal[$deckIndices[0]] = $deck[$deckIndices[0]];
    array_shift($deck);
    array_shift($deckIndices);
  }
  return $cardsToDeal;
};

$players = [
  "player 1" => array(),
  "player 2" => array(),
];

function startEachPlayerHand() {
  global $players;
  foreach($players as $player => $handArray) {
    $players[$player] = array_merge($players[$player], dealCards(2));
  }
}

startEachPlayerHand();

print_r($players);


?> 