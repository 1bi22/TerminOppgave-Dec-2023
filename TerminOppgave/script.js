



//TO DO LIST:
// lag bomber
// fix UI
//  lage leaderboard tabell


//WHACK A MOLE:

const cursor = document.querySelector('.cursor')
const holes = [...document.querySelectorAll('.hole')]
const scoreEl = document.getElementById('moleScore')
const formEl = document.getElementById('moleform')
let score = 0
var timeleft = 30
var elem = document.getElementById('countdown')


//run functionen starter spillet og gjør slik at muldvarpene kommer opp av hullene
function run(){
    const i = Math.floor(Math.random() * holes.length)
    const hole = holes[i]
    let timer = null 


    const img = document.createElement('img')
    img.classList.add('mole')
    img.src = './Images/mole.png'

    img.addEventListener('click', () => {
        score += 10
        scoreEl.value = score 
        img.src = 'Images/mole-whacked.png'
        clearTimeout(timer)
        setTimeout(() => {
            hole.removeChild(img)
            run()
        },100)
    })
    hole.appendChild(img)
    
    timer = setTimeout(() => {
        hole.removeChild(img)
        run()
    },1500)


    if (timeleft <= 0) {
    moleGameOver()        
    }
}
//når timeren er ferdig submittes score til databasen
function moleGameOver(){
    formEl.submit();
}
//counter functionen starter en timer, det er en if statement 
//inne i run functionen som stopper spillet når tiden har gått ut
function counter(){
var countdownId = setInterval(function(){
    
    if (timeleft <= 0){
        clearInterval(countdownId)
    }
    else{
        elem.innerHTML = timeleft + 'seconds remaining'
        timeleft --
        }
    },1000)
}

//Gjør at hammer bildet følger etter musen
window.addEventListener('mousemove', e => {
    cursor.style.top = e.pageY + 'px'
    cursor.style.left = e.pageX + 'px'
})
//roterer hammeren når du clicker
window.addEventListener('mousedown', () => {
    cursor.classList.add('active')
} )
//returnerer hammeren til orginal positionen
window.addEventListener('mouseup', () => {
    cursor.classList.remove('active')
} )


//FLAPPY BIRD:

let board;
let boardwidth = 360;
let boardheight = 540;
let context;

let birdWidth = 34
let birdHeight = 24
let birdX = boardwidth/8
let birdY = boardheight/2
let birdImg;


let bird = {
    x : birdX,
    y : birdY,
    width : birdWidth,
    height : birdHeight
}

let pipeArray = []
let pipeWidth = 64
let pipeHeight = 512
let pipeX = boardwidth
let pipeY = 0

let topPipeImg
let bottomPipeImg


let velocityX = -2 //Pipenes hastighet
let velocityY = 0 
let gravity = 0.4  //Definerer hvor sterk gravitasjonen er

let gameOver = false;
let gameStarted = false;
let birdScore = 0;
const flapEl = document.getElementById('flappyScore')
const birdEl = document.getElementById('birdForm') 

//Tegner opp start skjermen
window.onload = function(){

    board = document.getElementById("birdBoard");
    board.height = boardheight;
    board.width = boardwidth;
    context = board.getContext("2d");

  
    birdImg = new Image()
    birdImg.src = "Images/flappybird.png";
    birdImg.onload = function(){
        context.drawImage(birdImg, bird.x, bird.y, bird.width, bird.height);
    }

    topPipeImg = new Image()
    topPipeImg.src = "Images/toppipe.png"
    bottomPipeImg = new Image()
    bottomPipeImg.src = "Images/bottompipe.png"

    document.addEventListener("keydown", startGame)
    document.addEventListener("keydown", exitGame)

    context.fillStyle = "white"
    context.font = "25px sans-serif"
    if (gameStarted == false){
        context.fillText("PRESS SPACE TO START OR", 5, 90,)
        context.fillText("ESC TO LEAVE", 5, 130,)
    }
}

function exitGame(event){
    if(event.code == "Escape"){
        window.location.href = "Home.php"
    }
}

//Starter spillet når space trykkes
function startGame(event){
    if(event.code == "Space" && !gameStarted) {
        gameStarted = true
        requestAnimationFrame(update);
        setInterval(placePipes,1500); 
    } else if (gameStarted && (event.code === "Space" || event.code === "ArrowUp")) {
        velocityY = -6
    }    
}

function update(){
    requestAnimationFrame(update)
    if (gameOver){
        return;
    }
    context.clearRect(0, 0, board.width, board.height)

    //Gir fuglen gravitasjon
    velocityY += gravity
    
    //Hindrer fuglen fra å gå over pipene
    bird.y = Math.max(bird.y + velocityY, 0)

    //oppdaterer fuglens posisjon
    context.drawImage(birdImg, bird.x, bird.y, bird.width, bird.height)

    //stopper spillet hvis man går under canvas
    if (bird.y > board.height){
        gameOver = true
    }

    //Printer pipene
    for (let i = 0; i < pipeArray.length; i++ ){
        let pipe = pipeArray[i]
        pipe.x += velocityX
        context.drawImage(pipe.img, pipe.x, pipe.y, pipe.width, pipe.height)

        //Oppdaterer score hver gang man passerer en pipe
        if (!pipe.passed && bird.x > pipe.x + pipe.width){
            birdScore += 0.5;
            flapEl.value = birdScore;
            console.log (flapEl.value);
            pipe.passed = true;
        }
        //stopper spillet når man crasher
        if (detectCollision(bird, pipe)){
            gameOver = true
        }
    }
    console.log (birdScore);
    //Fjerner pipene fra array når de er passert
    while (pipeArray.length > 0 && pipeArray[0].x < -pipeWidth) {
        pipeArray.shift()
    }

    
 
    context.fillStyle = "white"
    context.font = "45px sans-serif"
    context.fillText(birdScore, 5, 45)

    if (gameOver){
        context.fillText("GAME OVER", 5, 90)
        setTimeout(() => {
            birdGameOver()
        },1200)
    }
}

//Gjør at pipene blir randomly plassert samtidig som det alltid er et like stort mellomrom mellom de
function placePipes(){
    if (gameOver || !gameStarted){
        return;
    }

    let randomPipeY = pipeY - pipeHeight/3 - Math.random()*(pipeHeight/2)
    let openingSpace = board.height/4


    let topPipe = {
        img : topPipeImg,
        x : pipeX,
        y : randomPipeY,
        width : pipeWidth,
        height : pipeHeight,
        passed : false
    }
    pipeArray.push(topPipe)

    let bottomPipe = {
        img : bottomPipeImg,
        x : pipeX,
        y : randomPipeY + pipeHeight + openingSpace,
        width : pipeWidth,
        height : pipeHeight,
        passed : false
    }
    pipeArray.push(bottomPipe)
}

function birdGameOver(){
    birdEl.submit()
}

function detectCollision(a, b){
    return a.x < b.x + b.width &&
           a.x + a.width > b.x &&
           a.y < b.y + b.height &&
           a.y + a.height > b.y
        
}