// Array containing the correct sentence and its scrambled words
const correctSentence = "Lawyers ensure justice in society";
const words = ["Lawyers", "ensure", "justice", "in", "society"];

// Function to shuffle the words array
function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

// Populate the word bank with shuffled words
function populateWordBank() {
    const wordBank = document.getElementById("word-bank");
    const shuffledWords = shuffle([...words]);
    shuffledWords.forEach(word => {
        const wordDiv = document.createElement("div");
        wordDiv.className = "word";
        wordDiv.draggable = true;
        wordDiv.textContent = word;

        // Add drag events
        wordDiv.addEventListener("dragstart", dragStart);
        wordBank.appendChild(wordDiv);
    });
}

// Event when dragging starts
function dragStart(event) {
    event.dataTransfer.setData("text/plain", event.target.textContent);
}

// Allow drop in the sentence area
function allowDrop(event) {
    event.preventDefault();
}

// Handle drop event
function drop(event) {
    event.preventDefault();
    const word = event.dataTransfer.getData("text/plain");
    const wordDiv = document.createElement("div");
    wordDiv.className = "word";
    wordDiv.textContent = word;

    // Add back the drag event in case users want to move words
    wordDiv.draggable = true;
    wordDiv.addEventListener("dragstart", dragStart);

    event.target.appendChild(wordDiv);
}

// Check if the sentence is correct
function checkAnswer() {
    const sentenceArea = document.getElementById("sentence-area");
    const wordsInSentence = Array.from(sentenceArea.querySelectorAll(".word")).map(wordDiv => wordDiv.textContent);
    const userSentence = wordsInSentence.join(" ");

    const resultMessage = document.getElementById("resultMessage");
    if (userSentence === correctSentence) {
        resultMessage.textContent = "Correct! Well done!";
        resultMessage.style.color = "green";
    } else {
        resultMessage.textContent = "Incorrect! Try again.";
        resultMessage.style.color = "red";
    }
}

// Attach events and initialize
document.addEventListener("DOMContentLoaded", () => {
    populateWordBank();

    const sentenceArea = document.getElementById("sentence-area");
    sentenceArea.addEventListener("dragover", allowDrop);
    sentenceArea.addEventListener("drop", drop);

    const checkButton = document.getElementById("checkButton");
    checkButton.addEventListener("click", checkAnswer);
});
