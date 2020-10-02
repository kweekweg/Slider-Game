/**
 * SEVERAL PIECES OF CODE WERE ADAPTED FROM THIS URL:
 * https://levelup.gitconnected.com/build-an-etch-a-sketch-knock-off-with-plain-js-css-and-html-9ab9e104b43f?gi=555ff5f52c4
 */

const grid = document.getElementById("container");

const quote = "";

/**
 * Function to create or replace the displayed grid once a quote
 * is submitted via the submit button
 * @param {} quoteArray 
 */
function updateGrid(quoteArray) {
    
    //Clear out any currently existing cells/contents
    grid.innerHTML = '';

    //Set the number of columns
    grid.style.setProperty(
        "grid-template-columns", 
        `repeat(` + numCols + ` , 1fr)`
    );

    //Set the number of rows
    grid.style.setProperty(
        "grid-template-rows", 
        `repeat(` + numRows + `, 1fr)`
    );

    //For loop to fill each column and row with the appropriate chunk of the quote
    for(let i = 0; i < (numRows * numCols) - 1; i++) {
        const div = document.createElement("div");
        div.classList.add("cell");
        div.name = "cell" + i;
        div.innerHTML = quoteArray[i];
        grid.appendChild(div);
    }

    //Fill the last cell with an empty string
    const div = document.createElement("div");
    div.classList.add("cell");
    div.name = "cell" + (numRows * numCols);
    div.innerHTML = "";
    grid.appendChild(div)
}


/**
 * Function to determine the number of rows and columns necessary
 * for the grid based on the length of the quote and the limiting
 * factor of no cell holding more than two characters
 */
function checkQuoteLength(quote) {

    tempLength = quote.value.length;

    //declare variables for this block's scope
    let numRows = 0;
    let numCols = 0;

    //if-else block to determine number of rows/columns
    if (tempLength == 3 || tempLength == 4) {
        numCols = 3;
        numRows = 1;
    } else if (tempLength == 5 || tempLength == 6) {
        numCols = 2;
        numRows = 2;
    } else if (tempLength > 6 && tempLength < 11) {
        numCols = 3;
        numRows = 2;
    } else if (tempLength > 10 && tempLength < 15) {
        numCols = 4;
        numRows = 2;
    } else if (tempLength == 15 || tempLength == 16) {
        numCols = 3;
        numRows = 3;
    } else if (tempLength == 17 || tempLength == 18) {
        numCols = 5;
        numRows = 2;
    } else if (tempLength > 18 && tempLength < 23) {
        numCols = 4;
        numRows = 3;
    } else if (tempLength > 22 && tempLength < 29) {
        numCols = 5;
        numRows = 3;
    } else if (tempLength == 29 || tempLength == 30) {
        numCols = 4;
        numRows = 4;
    } else if (tempLength > 30 && tempLength < 35) {
        numCols = 6;
        numRows = 3;
    } else if (tempLength > 34 && tempLength < 39) {
        numCols = 5;
        numRows = 4;
    } else if (tempLength > 38 && tempLength < 47) {
        numCols = 6;
        numRows = 4;
    } else if (tempLength == 47 || tempLength == 48) {
        numCols = 5;
        numRows = 5;
    } else if (tempLength > 48 && tempLength < 59) {
        numCols = 6;
        numRows = 5;
    } else {
        numCols = 6;
        numRows = 6;
    }
    
    let numValues = [numCols, numRows];

    return numValues;
}


/**
 * Function to break the quote into an array of size and chunk
 * length, which is currently permanently two
 */
 function breakQuote(numCols, numRows, quote) {
    
    var charRemaining = quote.value.length;
    var count = 0;
    var arraySize = ((numCols * numRows) - 1);

    let quoteArray = new Array(arraySize);
    for (let i = 0; i < arraySize; i++) {
        /**If there are only enough characters to fill the rest of the array
         * then only grab the next character in the quote for the next
         * index of the array
         */
        if (charRemaining <= (arraySize - i)) {
            quoteArray[i] = quote.value.substr(count, 1);
            count++;
            charRemaining--;
        } 
        /**
         * Otherwise grab the next 2 characters of the quote to store in the
         * next index in the array
         */
        else {
            quoteArray[i] = quote.value.substr(count, 2);
            count = count + 2;
            charRemaining = charRemaining - 2;
        }
    }

    //Return the array containing the broken apart quote
    return quoteArray;
}

//Function to randomize the array once it is created
function shuffle(array) {

    /**
     * THIS FUNCTION WAS OBTAINED FROM THE URL:
     * https://stackoverflow.com/questions/2450954/how-to-randomize-shuffle-a-javascript-array
     */

    var currentIndex = array.length, temporaryValue, randomIndex;
  
    // While there remain elements to shuffle...
    while (0 !== currentIndex) {
  
      // Pick a remaining element...
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;
  
      // And swap it with the current element.
      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
    }
  
    return array;
}

const button = document.getElementById("quoteSubmit");
/**
 * Adds the function to display and scramble the quote in the grid to the
 * submit button
 */
button.addEventListener('click', function(event) {

    //Declare the quote variable within this function 
    //of what the user submitted
    const quote = document.getElementById("userQuote");

    //Call the function to determine grid size
    let numValues = checkQuoteLength(quote);
    numCols = numValues[0];
    numRows = numValues[1];
    
    //Break the quote apart, shuffle it, and display it
    strArray = breakQuote(numValues[0], numValues[1], quote);
    strArray = shuffle(strArray);
    updateGrid(strArray);
})

const cell = document.querySelector("div");
//Add a listener to every cell in the grid that swaps it
//with the empty cell when clicked on
cell.addEventListener('click', function(event) {
    var clickedOn = event.target;
    
    if (clickedOn.innerHTML != '') {
        var nodeList = document.getElementsByClassName("cell");
        for(let i = 0; i < nodeList.length; i++) {
            if (nodeList[i].innerHTML == '') {
                nodeList[i].innerHTML = clickedOn.innerHTML;
                clickedOn.innerHTML = '';
                break;
            }
        }
    }
});