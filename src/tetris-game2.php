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
    const scoreDisplay = document.querySelector('#score');
    const startBtn = document.querySelector('#start-button');

    const tetrominos = new Map([
        [ 'L', [0, 10, 20, 21] ],
        [ 'J', [0, 10, 20, 1] ],
        [ 'T', [0, 1, 2, 11] ],
        [ 'S', [1, 2, 10, 11] ],
        [ 'Z', [0, 1, 11, 12] ],
        [ 'O', [0, 1, 10, 11] ],
        [ 'I', [0, 10, 20, 30] ]
    ]);

    console.log(tetrominos);
    console.log(Array.from(tetrominos.values())[6]);

    // Generates an ordered array randomisation of the possible tetromino blocks
    function generateBag(){
        let bag = [];
        var min = 0;
        tetrominos = ['L', 'J', 'Z', 'S', 'T', 'O', 'I'];
        for (max = 6; max >= min; max--){

            // Generate a random index number of the tetromino array and assign it to 'roll'
            var roll = Math.floor(Math.random() * (max - min + 1) + min);
            // Take out the tetromino at the 'rolled' index and append it to the new ordered array 'bag'
            bag.push(tetrominos.splice(roll, 1)[0]);
        }
        return bag;
    }

    const tetrominoColours = [
    'orange',
    'red',
    'purple',
    'green',
    'blue',
    'black',
    'white'
    ]

    let blockPosition = 4;


    //randomly select a Tetromino and its first rotation
    let random = Math.floor(Math.random()*tetrominos.size);
    let activePiece = Array.from(tetrominos.values())[random];

    console.log(random);


    function show() {
    // For each block in the piece
    activePiece.forEach(index => {
    blocks[blockPosition + index].classList.add('tetromino')
    blocks[blockPosition + index].style.backgroundColor = tetrominoColours[random]
    })
    }

    function hide() {
    activePiece.forEach(index => {
    blocks[blockPosition + index].classList.remove('tetromino')
    blocks[blockPosition + index].style.backgroundColor = ''

    })
    }

    function fallingPiece() {
    hide()
    blockPosition += 10
    show()
    }

let timerId
  //add functionality to the button
  startBtn.addEventListener('click', () => {
    if (timerId) {
      clearInterval(timerId)
      timerId = null
    } else {
      show()
      timerId = setInterval(fallingPiece, 1000)
      nextRandom = Math.floor(Math.random()*tetrominos.size)
    }
  })


  //freeze function
  function stopMovement() {
    if(current.some(index => squares[currentPosition + index + width].classList.contains('obstruction'))) {
      current.forEach(index => squares[currentPosition + index].classList.add('obstruction'))
      //start a new tetromino falling
      random = nextRandom
      nextRandom = Math.floor(Math.random() * theTetrominoes.length)
      current = theTetrominoes[random][currentRotation]
      currentPosition = 4
      show()
      displayShape()
      addScore()
      gameOver()
    }
  }
  




})
</script>



</div>

</div>