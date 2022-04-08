<div class="welcome-box">

<div class="tetris" id="tetris-bg">



<!-- Main play area for the tetris game - the grid -->
<div class='grid' id='grid'>
</div>

<script>
// Waits for everything to be loaded on page
document.addEventListener('DOMContentLoaded', () => {

    // Adding divs to the grid to fill out the tetris play-area.
    for (i = 0; i<200; i++){
        document.getElementById("grid").appendChild(document.createElement("div"));
    }

    // Adding divs to the bottom of the grid to obstruct the active tetrominos from falling beneath the play-area
    for (i = 0; i<10; i++){
      newDiv = document.createElement("div");
      newDiv.classList.add("obstruction");
      document.getElementById("grid").appendChild(newDiv);
    }


    // Get all divs in tetris grid as an array
    let blocks = Array.from(document.querySelectorAll('.grid div'));
  
    // Initialise score
    let score = 0;
    const scoreDisplay = document.querySelector('#score');
    const pauseButton = document.querySelector('#pause-button');

      // To convert: (X + 10) and (10 * Y) & IF (Y < -1, then -1; else +1)
      const baseTetrominos = new Map([
      [ 'L', [ [-1, 0], [0, 0], [1, 0], [1, -1] ] ],
      [ 'J', [ [-1, -1], [-1, 0], [0, 0], [1, 0] ] ],
      [ 'T', [ [-1, 0], [0, 0], [0, -1], [1, 0] ] ],
      [ 'S', [ [-1, 0], [0, 0], [0, -1], [1, -1] ] ],
      [ 'Z', [ [-1, -1], [0, 0], [0, -1], [1, 0] ] ],
      [ 'O', [ [-1, -1], [-1, 0], [0, -1], [0, 0] ] ],
      [ 'I', [ [-1, 0], [0, 0], [1, 0], [2, 0] ] ],
      //[ 'I', [ [0, -2], [0, -1], [0, 0], [0, 1] ] ],
      ]);

    const tetrominos = new Map([
        [ 'L', [10, 11, 12, 2] ],
        [ 'J', [0, 10, 11, 12] ],
        [ 'T', [10, 1, 11, 12] ],
        [ 'S', [10, 1, 11, 2] ],
        [ 'Z', [0, 1, 11, 12] ],
        [ 'O', [0, 10, 1, 11] ],
        [ 'I', [10, 11, 12, 13] ]
    ]);

    // Generates an ordered array randomisation of the possible tetromino blocks
    // Creating a bag mitigates consecutive duplicate pieces and provides fair distribution
    function generateBag(){
        let newBag = [];
        var min = 0;
        tetrominoArray = ['L', 'J', 'Z', 'S', 'T', 'O', 'I'];
        for (max = 6; max >= min; max--){

            // Generate a random index number of the tetromino array and assign it to 'roll'
            var roll = Math.floor(Math.random() * (max - min + 1) + min);
            // Take out the tetromino at the 'rolled' index and append it to the new ordered array 'bag'
            newBag.push(tetrominoArray.splice(roll, 1)[0]);
        }
        return newBag;
    }

    // Map of colours to use for particular tetrimino pieces
    const tetrominoColours = new Map([
        [ 'L', 'orange' ],
        [ 'J', 'blue' ],
        [ 'T', 'purple' ],
        [ 'S', 'green' ],
        [ 'Z', 'red' ],
        [ 'O', 'yellow' ],
        [ 'I', 'lightblue' ]
    ]);

    // Create starting position and then use for active position of active piece
    let blockPosition = 4;
    let width = 10;

    // Randomly select a tetromino
    let bag = generateBag();
    let activePiece = bag.pop();

    // Show the tetrimino piece in the grid
    function show() {
    // For each block in the piece
    tetrominos.get(activePiece).forEach(index => {
    blocks[blockPosition + index].classList.add('tetromino');
    blocks[blockPosition + index].style.backgroundColor = tetrominoColours.get(activePiece);
    })
    }
  
    // Remove the tetrimino piece from the grid for movement or scoring
    function hide() {
      // For each block in the piece
    tetrominos.get(activePiece).forEach(index => {
    blocks[blockPosition + index].classList.remove('tetromino');
    blocks[blockPosition + index].style.backgroundColor = '';

    })
    }

    // Logic to make the piece appear to move
    function fallingPiece() {
    hide();
    blockPosition += 10;
    show();
    stopMovement();
    }


let timerId;
  //add functionality to the button
  pauseButton.addEventListener('click', () => {
    if (timerId) {
      clearInterval(timerId);
      timerId = null;
    } else {
      show();
      timerId = setInterval(fallingPiece, 50);
      nextPiece = bag.pop();
    }
  })


  // Logic to make tetrimino stop moving due to obstructions, also handles scores and end of play
  function stopMovement() {
    if(tetrominos.get(activePiece).some(index => blocks[blockPosition + index + width].classList.contains('obstruction'))) {
      tetrominos.get(activePiece).forEach(index => blocks[blockPosition + index].classList.add('obstruction'))
      
      //start a new tetromino falling
      activePiece = nextPiece;
      if (bag.length < 1){
        bag = generateBag();
        nextPiece = bag.pop();
      } else {
        nextPiece = bag.pop();
      }
      // Reset the current block position for new piece
      blockPosition = 4;

      // Increment score for every new piece
      score +=1;
      scoreDisplay.innerHTML = score;

      show();
      endGame();
    }
  }

  // When the game finishes
  function endGame() {
    if(tetrominos.get(activePiece).some(index => blocks[blockPosition + index].classList.contains('obstruction'))) {
      clearInterval(timerId)
      var xhttp = new XMLHttpRequest();
      xhttp.open("POST", "leaderboard.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("score=" + scoreDisplay.innerHTML);

      // Provides a slight delay so that the server can get the user's score can get to the leaderboard page before it redirects
      setTimeout(function () {
        document.location.href = 'leaderboard.php';
        }, 1000);

    }
  }



})
</script>



</div>

</div>