<?php

// HARD:
// Bring in your createDeck and dealCards function from the previous challenges. For the specified number of players below, assign each player an even set of cards.
// We will do this by counting out how many players there are, counting how many cards are in the deck and then dividing them so we know how many cards each player should get.
//   */
//   $deck =
//   $num_players = 4;
//   $num_cards_in_deck = //find a function to count the # of elements in an array
//   $num_cards_to_give_each_player =
//   /*
// Use a for loop to add the "dealt hands" to the $players array
// Let’s create a simple game. Each player will play a card and whoever has the highest value wins. If there are 2 cards played that have the same value, everyone loses and that round is a draw. Store the results of each game and also who won that round as the value.
// If the round is a draw, store the value as DRAW. Use a loop to play each game until all opponents are out of cards. Print out the array of all the rounds. If there was a draw, the round should say DRAW.
// If a player has won, it should displayer “Player X” where X is the index of the player.

$deck = createShuffleDeck();

function createShuffleDeck() {
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

  foreach ($suits as $suit) {
    foreach ($faces as $face => $value) {
      $deck[] = $value . " " . $suit;
    }
  }

  shuffle($deck);
  //print_r($deck);
  return $deck;
}
//players would be used global 
$players = [
  "player 1" => array(),
  "player 2" => array(),
  "player 3" => array(),
  "player 4" => array(),
];

function dealCards($numOfCards){
  global $deck;
  // num of cards 
  for($i = 0; $i < $numOfCards; $i++){
    $cardsToDeal[] = $deck[0];
    array_shift($deck);
  }

  return $cardsToDeal;
}

function givePlayerHand(){
    global $players;

    foreach ($players as $player => $handArray) {
      //gives each player 13 cards by merge 
        $players[$player] = array_merge($players[$player], dealCards(13));
    }
    return $players;
}
 givePlayerHand();

function compareHands(){
    global $players;
    //array to hold the results of the match 
   $winnerOrDraw = [];
  //loops through the amount of cards in each players hands to play each other 
  for($i = 0; $i < 13; $i++){
    $player1 = "player 1 -". " ". $players["player 1"][0];
    $player2 = "player 2 -". " ". $players["player 2"][0];
    $player3 = "player 3 -". " ". $players["player 3"][0];
    $player4 = "player 4 -". " ". $players["player 4"][0];
    $draw = "draw";
    //grab fird off deck 

    //cehcks if any cards are equal 
    if(intval($players["player 1"][0]) === intval($players["player 2"][0]) ||
        intval($players["player 1"][0]) === intval($players["player 3"][0]) ||
        intval($players["player 1"][0]) === intval($players["player 4"][0])){
                      
          array_push($winnerOrDraw, $draw);

        } else if(intval($players["player 2"][0]) === intval($players["player 1"][0]) ||
        intval($players["player 2"][0]) === intval($players["player 3"][0]) ||
        intval($players["player 2"][0]) === intval($players["player 4"][0]) ){

          array_push($winnerOrDraw, $draw);

       } else if(intval($players["player 3"][0]) === intval($players["player 1"][0]) ||
        intval($players["player 3"][0]) === intval($players["player 2"][0]) ||
        intval($players["player 3"][0]) === intval($players["player 4"][0])){

          array_push($winnerOrDraw, $draw);

     } else if(intval($players["player 4"][0]) === intval($players["player 1"][0]) ||
        intval($players["player 4"][0]) === intval($players["player 2"][0]) ||
        intval($players["player 4"][0]) === intval($players["player 3"][0])){

          array_push($winnerOrDraw, $draw);
          
     //compare every players 1st card
    } else if( intval($players["player 1"][0]) > intval($players["player 2"][0]) &&
        intval($players["player 1"][0]) > intval($players["player 3"][0]) &&
        intval($players["player 1"][0]) > intval($players["player 4"][0]) ){
           
           array_push($winnerOrDraw, $player1);

     } else if(intval($players["player 2"][0]) > intval($players["player 1"][0]) &&
        intval($players["player 2"][0]) > intval($players["player 3"][0]) &&
        intval($players["player 2"][0]) > intval($players["player 4"][0]) ){

           array_push($winnerOrDraw, $player2);

       } else if(intval($players["player 3"][0]) > intval($players["player 1"][0]) &&
        intval($players["player 3"][0]) > intval($players["player 2"][0]) &&
        intval($players["player 3"][0]) > intval($players["player 4"][0])){

           array_push($winnerOrDraw, $player3);

     } else if(intval($players["player 4"][0]) > intval($players["player 1"][0]) &&
        intval($players["player 4"][0]) > intval($players["player 2"][0]) &&
        intval($players["player 4"][0]) > intval($players["player 3"][0])){

           array_push($winnerOrDraw, $player4);
    }

    // reuslt in winner of that round and push winner into winner array 
    // run it back 
    array_shift($players["player 1"]);
    array_shift($players["player 2"]);
    array_shift($players["player 3"]);
    array_shift($players["player 4"]);

  }
  echo "<pre>";
   print_r($winnerOrDraw);
   echo "</pre>";
}
compareHands();
?>