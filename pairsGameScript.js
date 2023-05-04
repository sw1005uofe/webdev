const moves = document.getElementById("moves-count");
const timeValue = document.getElementById("time");
const startButton = document.getElementById("start");
const stopButton = document.getElementById("stop");
const result = document.getElementById("result");
const levelScore = document.getElementById("level-score");
const totalScore = document.getElementById("overall-score");
const level = document.getElementById("level");

const gameContainer = document.querySelector(".game-container");
const controls = document.querySelector(".controls-container");
const wrapper = document.querySelector(".wrapper");
wrapper.classList.add("hide");

let cards;
let interval;
let firstCard = false;
let secondCard = false;
let currentLevel = 1;

//Items array
const items = [
    { name: "closed", image: "emoji assets/eyes/closed.png" },
    { name: "laughing", image: "emoji assets/eyes/laughing.png" },
    { name: "long", image: "emoji assets/eyes/long.png" },
    { name: "normal", image: "emoji assets/eyes/normal.png" },
    { name: "rolling", image: "emoji assets/eyes/rolling.png" },
    { name: "winking", image: "emoji assets/eyes/winking.png" },
    { name: "green", image: "emoji assets/skin/green.png" },
    { name: "yellow", image: "emoji assets/skin/yellow.png" },
    { name: "red", image: "emoji assets/skin/red.png" },
    { name: "teeth", image: "emoji assets/mouth/teeth.png" },
    { name: "smiling", image: "emoji assets/mouth/smiling.png" },
    { name: "sad", image: "emoji assets/mouth/sad.png" },
];

let scores=[];
let x = document.cookie.split(';');
for (let i=0; i<7;i++) {
    let pos = x[0].search('=')
    let score = Number(x[0].slice(pos + 1));
    scores.push(score);
}

//Initial Time
let seconds = 0,
    minutes = 0;

//Initial moves and win count
let movesCount = 0,
    remainingMoves=0,
    winCount = 0;

//Initial Scores
let points = 0,
    overallPoints = 0;

levelScore.innerHTML=`<span>Level Score: </span>${points}`;
totalScore.innerHTML=`<span>Overall Score: </span>${points}`;
level.innerHTML=`<span>Level: </span>${currentLevel}`;

//For timer
const timeGenerator = () => {
    seconds += 1;
    //minutes logic
    if (seconds >= 60) {
        minutes += 1;
        seconds = 0;
    }
    //format time before displaying
    let secondsValue = seconds < 10 ? `0${seconds}` : seconds;
    let minutesValue = minutes < 10 ? `0${minutes}` : minutes;
    timeValue.innerHTML = `<span>Time: </span>${minutesValue}:${secondsValue}`;
};

//For calculating moves
const movesCounter = () => {
    movesCount += 1;
    remainingMoves -=1;
    moves.innerHTML = `<span>Moves Left: </span>${remainingMoves}`;
};

//Pick random objects from the items array
const generateRandom = (sizeWidth=3, sizeHeight=2) => {
    //temporary array
    let tempArray = [...items];
    //initializes cardValues array
    let cardValues = [];
    //size should be double (width*height matrix)/2 since pairs of objects would exist
    let size = (sizeWidth * sizeHeight) / 2;
    //Random object selection
    for (let i = 0; i < size; i++) {
        const randomIndex = Math.floor(Math.random() * tempArray.length);
        cardValues.push(tempArray[randomIndex]);
        //once selected remove the object from temp array
        tempArray.splice(randomIndex, 1);
    }
    return cardValues;
};

const matrixGenerator = (cardValues, sizeWidth=3, sizeHeight=2) => {
    gameContainer.innerHTML = "";
    cardValues = [...cardValues, ...cardValues];
    //simple shuffle
    cardValues.sort(() => Math.random() - 0.5);
    for (let i = 0; i < sizeWidth * sizeHeight; i++) {
        /*
            Create Cards
            before => front side (contains question mark)
            after => back side (contains actual image);
            data-card-values is a custom attribute which stores the names of the cards to match later
          */
        gameContainer.innerHTML += `
     <div class="card-container" data-card-value="${cardValues[i].name}">
        <div class="card-before">?</div>
        <div class="card-after">
        <img src="${cardValues[i].image}" class="image" alt=""/></div>
     </div>
     `;
    }
    //Grid
    gameContainer.style.gridTemplateColumns = `repeat(${sizeWidth},auto)`;

    //Cards
    cards = document.querySelectorAll(".card-container");
    cards.forEach((card) => {
        card.addEventListener("click", () => {
            //If selected card is not matched yet then only run (i.e. already matched card when clicked would be ignored)
            if (!card.classList.contains("matched")) {
                //flip the clicked card
                card.classList.add("flipped");
                //if it is the firstcard (!firstCard since firstCard is initially false)
                if (!firstCard) {
                    //so current card will become firstCard
                    firstCard = card;
                    //current cards value becomes firstCardValue
                    firstCardValue = card.getAttribute("data-card-value");
                } else {
                    //increment moves since user selected second card
                    movesCounter();
                    //secondCard and value
                    secondCard = card;
                    let secondCardValue = card.getAttribute("data-card-value");
                    if (firstCardValue === secondCardValue) {
                        //if both cards match add matched class so these cards would be ignored next time
                        firstCard.classList.add("matched");
                        secondCard.classList.add("matched");
                        //set firstCard to false since next card would be first now
                        firstCard = false;
                        //winCount increment as user found a correct match
                        winCount += 1;
                        points += 500;
                        overallPoints += 500;
                        levelScore.innerHTML=`<span>Level Score: </span>${points}`;
                        totalScore.innerHTML=`<span>Overall Score: </span>${overallPoints}`;
                        if (overallPoints>scores[0]){
                            wrapper.style.backgroundColor="#FFD700";
                        }
                        //check if winCount ==half of cardValues
                        if (winCount === Math.floor(cardValues.length / 2)) {
                            let timeInSeconds=minutes*60 + seconds;
                            if (5000-timeInSeconds*movesCount>500){
                                points += 5000-timeInSeconds*movesCount;
                                overallPoints += 5000 - timeInSeconds*movesCount;
                            } else {
                                points += 500;
                                overallPoints += points;
                            }
                            currentLevel+=1;
                            totalScore.innerHTML=`<span>Overall Score: </span>${overallPoints}`;
                            result.innerHTML = `<h2>Level Complete</h2>
                                                <h3>Overall Score: ${overallPoints}</h3>
                                                <h3>Level Score: ${points}</h3>`
                            stopGame();
                        }

                    } else {
                        //if the cards don't match
                        //flip the cards back to normal
                        let [tempFirst, tempSecond] = [firstCard, secondCard];
                        firstCard = false;
                        secondCard = false;
                        let delay = setTimeout(() => {
                            tempFirst.classList.remove("flipped");
                            tempSecond.classList.remove("flipped");
                        }, 900);
                    }

                    if (remainingMoves===0){
                        result.innerHTML= `<h2>Ran Out Of Moves</h2>
                                                <h3>Overall Score: ${overallPoints}</h3>
                                                <h3>Level Score: ${points}</h3>`;
                        if (overallPoints>scores[0]) {
                            document.cookie=`highScore=${overallPoints}`;
                        }
                        overallPoints=0;
                        totalScore.innerHTML=`<span>Overall Score: </span>${overallPoints}`;
                        currentLevel=1;
                        wrapper.style.backgroundColor="gray";
                        stopGame();
                    }
                }
            }
        });
    });
};

//Start game
startButton.addEventListener("click", () => {
    movesCount = 0;
    seconds = 0;
    minutes = 0;
    points = 0
    //controls amd buttons visibility
    controls.classList.add("hide");
    startButton.classList.add("hide");
    wrapper.classList.remove("hide");
    //Start timer
    interval = setInterval(timeGenerator, 1000);
    const [width, height, moveLimit]=levelSize();
    remainingMoves=moveLimit;
    //initial moves
    moves.innerHTML = `<span>Moves Left: </span> ${remainingMoves}`;
    levelScore.innerHTML=`<span>Level Score:</span>${points}`;
    level.innerHTML=`<span>Level:<\span>${currentLevel}`;
    initializer(width, height);
});

//Stop game
stopButton.addEventListener("click",
    (stopGame = () => {
        controls.classList.remove("hide");
        startButton.classList.remove("hide");
        wrapper.classList.add("hide");
        clearInterval(interval);
    })
);

//Initialize values and func calls
const initializer = (width, height) => {
    result.innerText = "";
    winCount = 0;
    let cardValues = generateRandom(width, height);
    console.log(cardValues);
    matrixGenerator(cardValues,width, height);
};

//level matrix sizes
const levelSize = () => {
    switch (currentLevel){
        case 1:
            return [3, 2, 10];
        case 2:
            return [4,2, 15];
        case 3:
            return [5,2, 20];
        case 4:
            return [4,3, 25];
        case 5:
            return [4,4, 35];
        default://repeat last level until too many guess used
            return [5,4, 62-(currentLevel*2)]; //level 6 50 moves
    }
}