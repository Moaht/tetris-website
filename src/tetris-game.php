<div class="welcome-box">

<div class="tetris" id="tetris-bg">



<!-- Main play area for the tetris game - the grid -->
<div class='grid' id='grid'>
</div>

<script>
// Waits for everything to be loaded on page
document.addEventListener('DOMContentLoaded', () => {
  
    let gridWidth = 10;
    let gridHeight = 20;

    // Adding divs to the grid to fill out the tetris play-area.
    for (i = 0; i<gridWidth*gridHeight; i++){
        document.getElementById("grid").appendChild(document.createElement("div"));
    }

    // Adding divs to the bottom of the grid to obstruct the active tetrominos from falling beneath the play-area
    for (i = 0; i<gridWidth; i++){
        newDiv = document.createElement("div");
        newDiv.classList.add("obstruction");
        document.getElementById("grid").appendChild(newDiv);
    }


    // Get all divs in tetris grid as an array
    let gridSquares = Array.from(document.querySelectorAll('.grid div'));
  
    // Initialise score
    let score = 0;
    const scoreDisplay = document.querySelector('#score');
    const pauseButton = document.querySelector('#pause-button');

    // To convert: (X + 11) and (10 * Y)
    const baseTetrominos = new Map([
        [ 'L', [ [-1, 0], [0, 0], [1, 0], [1, -1] ] ],
        [ 'J', [ [-1, -1], [-1, 0], [0, 0], [1, 0] ] ],
        [ 'T', [ [-1, 0], [0, 0], [0, -1], [1, 0] ] ],
        [ 'S', [ [-1, 0], [0, 0], [0, -1], [1, -1] ] ],
        [ 'Z', [ [-1, -1], [0, 0], [0, -1], [1, 0] ] ],
        [ 'O', [ [-1, -1], [-1, 0], [0, -1], [0, 0] ] ],
        [ 'I', [ [-1, 0], [0, 0], [1, 0], [2, 0] ] ]
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

    // Create starting position and then use for active position of active piece
    let blockPosition = 4;

    // Randomly select a tetromino
    let bag = generateBag();
    let activePiece = bag.pop();

    // Show the tetrimino piece in the grid
    function show() {
        // For each block in the piece, off-set by blockPosition, add class name 'tetrimino' and add the background and style
        tetrominos.get(activePiece).forEach(index => {
            gridSquares[blockPosition + index].classList.add('tetromino');
            gridSquares[blockPosition + index].style.background = "url('images/" + activePiece + ".png') repeat-x center";
            gridSquares[blockPosition + index].style.backgroundSize = "contain";
        })
    }
  
    // Remove the tetrimino piece from the grid for movement or scoring
    function clear() {
            // For each block in the piece, remove class name, background and other styling
            tetrominos.get(activePiece).forEach(index => {
            gridSquares[blockPosition + index].classList.remove('tetromino');
            gridSquares[blockPosition + index].style.background = '';
        })
    }

    // Logic to make the piece appear to move
    function fallingPiece() {
        clear();
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
            timerId = setInterval(fallingPiece, 1000);
            nextPiece = bag.pop();  
        }
    })

    // Add event listener on keydown
    document.addEventListener('keydown', (event) => {

        // Pause the game
        if (event.code == "Enter"){
        }
        if (event.code == "KeyZ"){
            alert(`Key code value: ${event.code}`);
        }

        if (event.code == "KeyX"){
            alert(`Key code value: ${event.code}`);
        }

        // Snap piece to bottom
        if (event.code == "ArrowUp"){
            alert(`Key code value: ${event.code}`);
        }

        // Move piece down
        if (event.code == "ArrowDown"){
            fallingPiece();
        }

        // Move piece left
        if (event.code == "ArrowLeft"){
            clear();
            blockPosition -= 1;
            show();
        }

        // Move piece right
        if (event.code == "ArrowRight"){
            clear();
            blockPosition += 1;
            show();
            stopMovement();
        }

        // // Reserved in case I want to implement 'saving pieces' functionality
        // if (event.code == "Space"){
        // }

    }, false);



    // Logic to make tetrimino stop moving due to obstructions, also handles scores and end of play
    function stopMovement() {

        // if (tetrominos.get(activePiece).some(index => gridSquares[blockPosition + index].classList.contains('obstruction'))){
        //     clear();
        //     blockPosition -= 10;
        //     show();
        //     // Change the active falling piece status to "obstruction" to make it inactive
        //     tetrominos.get(activePiece).forEach(index => gridSquares[blockPosition + index].classList.add('obstruction'))
        
        if(tetrominos.get(activePiece).some(index => gridSquares[blockPosition + index + gridWidth].classList.contains('obstruction'))) {
            tetrominos.get(activePiece).forEach(index => gridSquares[blockPosition + index].classList.add('obstruction'))
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
        if(tetrominos.get(activePiece).some(index => gridSquares[blockPosition + index].classList.contains('obstruction'))) {
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