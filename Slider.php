
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
        padding: none
    </style>
</head>

<?php $page_title = 'Slider'; ?>
<?php 
  	$nav_selected = "LIST";
  	$left_buttons = "NO";
  	$left_selected = "";
 	require 'db_credentials.php'; 
	include("./nav.php");
	include("SliderFunctions.php");
	//include("puzzlemaker.php");
 


?>

<?php

	include_once 'db_credentials.php'; 

  	$sql = "SELECT * FROM quote_table
		WHERE id = '-1'";
			
	$db->set_charset("utf8");

	$touched=isset($_POST['ident']);
	if (!$touched) {
		echo 'You need to select an entry. Go back and try again. <br>';
	
?>
	<button><a class="btn btn-sm" href="list.php">Go back</a></button>
<?php
	} else {     $id = $_POST['ident'];
    	$sql = "SELECT * FROM quote_table
        WHERE id = '$id'";
	}

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
	} 
	
	echo '<h2 id="title">Slider</h2><br>';

	$uninpo=1;
	$sqx = "SELECT * FROM pref WHERE id = '$uninpo'";
	$result2 = mysqli_query($db,$sqx);
	
	while ($row2 =mysqli_fetch_array($result2)) { 
		$nochars=$row2["Chunks"];	
	}
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()){
			$quoteline = $row["quote"];
	}
}

$arrays = SliderMaker($quoteline);
//Index 0 is the correct array
//Index 1 is the shuffled array
//Index 2 is the number of columns[0] and rows[1]


?>



<script>
		//bring in the arrays created by the PHP functions
		var arrays = <?php echo json_encode($arrays); ?>;

		//add a listener to the submit button
		const submit = document.getElementById('submit');

		//create an array to hold the current configuration of 
		//tiles to compare to the correct answer
		var testArray = new Array(arrays[0].length);

		//create a collection of all td elements in the HTML
		const td = document.getElementsByTagName('td');

		//loop through every cell and add an on click listener
		for(var i = 1; i < td.length; i++) {
			td[i].addEventListener('click', function(event) {
				var clickedOn = event.target;
				
				//note the column and row clicked on
				var cellColumn = clickedOn.cellIndex;
				var cellRow = clickedOn.parentNode.rowIndex;
				
				//check to see if the cell clicked on is the blank cell or not
				if (clickedOn.innerHTML != '') {
					var nodeList = document.getElementsByTagName('td');
					//find the blank cell in the table
					for(let i = 0; i < nodeList.length; i++) {
						//check to see if the clicked on cell is adjacent to the blank cell
						if ((nodeList[i].innerHTML == '') &&
							((((cellColumn == (nodeList[i].cellIndex + 1)) ||
							(cellColumn == (nodeList[i].cellIndex - 1))) && 
							(cellRow == nodeList[i].parentNode.rowIndex)) ||
							(((cellRow == (nodeList[i].parentNode.rowIndex + 1)) ||
							(cellRow == (nodeList[i].parentNode.rowIndex - 1))) &&
							cellColumn == nodeList[i].cellIndex))) {
								//if the blank cell is adjacent, swap the contents
								nodeList[i].innerHTML = clickedOn.innerHTML;
								clickedOn.innerHTML = '';
								break;
						}
					}
					
					//update the array containing the current configuration
					for(let j = 1; j < nodeList.length; j++) {
						testArray[j - 1] = nodeList[j].innerHTML;
					}
				}
			})
		};
		
		//add a listener to the submit button that compares the test array to
		//the correct answer
		submit.addEventListener('click', function() {
		for(let i = 0; i < testArray.length; i++) {
			if (testArray[i] != arrays[0][i]) {
				//if the test array is incorrect, display the following message
				alert('Try again');
				return;
			}
		}
		//if the test array is correct, display the following message
		alert('Congratulations!');
		return;
	});
</script>


