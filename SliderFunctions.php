<head>
<div class="container">
<style>.title {text-align: center; color: darkgoldenrod;}

  .words {
            height: 50px;
            text-align: center;
        }
        
        h1,
        h2,
        h3 {
            text-align: center;
        }
        
        table {
            border: 1px solid black;
            border-collapse: separate;
            table-layout: fixed;
            width: 100px;
            height: 200px;
            text-align: center;
        }
        
        table td,
        table th {
            font-size: 20px;
            padding: 10px;
        }
        
        .answerkey td {
            width: 200px;
            height: 200px;
            border: 1px solid black;
            padding: none}
        
    .cell {}
    </style>
</head>



<?php
include ("telugu_parser.php");
include ("usefultool.php");

Function SliderMaker($quote) {
    
    //check to see if the quote length is within the bounds of the allowed lengths per grid sizes
    if (strlen($quote) > 70 || strlen($quote) < 3) {
        echo 'Slider only supports strings of length between 3 and 70.
            Please pick a string of appropriate length<br><br>';
        echo '<form action=list.php method="post">
            <button type="submit" formaction="list.php">Go back</button></form>';
        return;
    }

    //determine the size of the grid based on string length
    $numValues = TableSize(strlen($quote));
    
    //determine the number of cells that will have text
    $arrayLen = ($numValues[0] * $numValues[1]) - 1;
    
    //replace any new line characters in the quote with spaces
	$quote=str_replace("\n"," ",$quote);
	

	$t2 = parseToCodePoints($quote);
	$t=array();
	foreach ($t2 as $axe)
	{
		if (ctype_cntrl($axe)==false) //this exists so we can strip control characters from the set.
		{ array_push($t,$axe);
		}
	}

    //convert the contents of the array to characters
	for ($x=0;$x<strlen($quote);$x++)
	{ $t[$x] =parseToCharacter($t[$x]);}

    //the following block of code generates an array containing the quote, broken into
    //chunks of size 2 or 1

    //charRemaining and count track how far into the quote the loop is and how much remains
	$charRemaining = strlen($quote);
    $count = 0;
    //an array to hold the quote
    $quoteArray = array();
    //a string to push to the array
	$tempString;
	for($i = 0; $i < $arrayLen; $i++) {
        //if there are only enough characters to put one in each of the remaining cells,
        //only put one in each remaining index
		if ($charRemaining <= ($arrayLen - $i)) {
			$tempString = $t[$count];
			array_push($quoteArray, $tempString);
			$count++;
			$charRemaining--;
		} else {
            //otherwise put two
			$tempString = $t[$count];
			$count++;
			$tempString = $tempString . $t[$count];
			$count++;
			$charRemaining = $charRemaining - 2;
			array_push($quoteArray, $tempString);
		}
	}
    
    //add an empty str at the end of the array
    array_push($quoteArray, "");
    //create a duplicate of the quote array
    $shuffledArray = $quoteArray;
    //shuffle the duplicated array
	shuffle($shuffledArray);

    //draw the grid on the client side
	DrawTable($shuffledArray, $numValues);
    
    //put all of the necessary arrays into one neat package to return
	$arrays = array();
	$arrays[0] = $quoteArray;
	$arrays[1] = $shuffledArray;
	$arrays[2] = $numValues;

    //return the array of arrays
	return $arrays;
}

//a function to draw the grid on the client side
Function DrawTable($array, $numValues) {
?>
		
	<table border="1" style="width:100%" id="myTable">
	<tbody>

<?php

    //keep track of how many cells have been filled
    $count = 0;
    
    //outer for loop to track rows
	for($i = 0; $i < $numValues[1]; $i++) {
        //start a new row when the row length has been met
        echo("<tr>");
        
        //inner for loop to track columns
		for($j = 0; $j < $numValues[0]; $j++) {
            //add the cell to the row and display the contents of the shuffled array at that index noted by count
            echo '<td id="cellnum'.$count.'">';
			echo $array[$count];
			$count++;
			echo("</td>");

		}
		echo("</tr>");
	}

    //end the table and add the submit button
    echo "  </tbody>
        </table><br>
        <br><button id='submit' type='submit'>Submit</button>";
}

//determines the size of the grid based on the length of the quote
Function TableSize($length) {

    //if-else block to determine number of rows/columns
    if ($length == 3 || $length == 4) {
        $numCols = 3;
        $numRows = 1;
    } else if ($length == 5 || $length == 6) {
        $numCols = 2;
        $numRows = 2;
    } else if ($length > 6 && $length < 11) {
        $numCols = 3;
        $numRows = 2;
    } else if ($length > 10 && $length < 15) {
        $numCols = 4;
        $numRows = 2;
    } else if ($length == 15 || $length == 16) {
        $numCols = 3;
        $numRows = 3;
    } else if ($length == 17 || $length == 18) {
        $numCols = 5;
        $numRows = 2;
    } else if ($length > 18 && $length < 23) {
        $numCols = 4;
        $numRows = 3;
    } else if ($length > 22 && $length < 29) {
        $numCols = 5;
        $numRows = 3;
    } else if ($length == 29 || $length == 30) {
        $numCols = 4;
        $numRows = 4;
    } else if ($length > 30 && $length < 35) {
        $numCols = 6;
        $numRows = 3;
    } else if ($length > 34 && $length < 39) {
        $numCols = 5;
        $numRows = 4;
    } else if ($length > 38 && $length < 47) {
        $numCols = 6;
        $numRows = 4;
    } else if ($length == 47 || $length == 48) {
        $numCols = 5;
        $numRows = 5;
    } else if ($length > 48 && $length < 59) {
        $numCols = 6;
        $numRows = 5;
    } else {
        $numCols = 6;
        $numRows = 6;
    }
    
	$numValues[0] = $numCols;
	$numValues[1] = $numRows;
    return $numValues;
}

?>