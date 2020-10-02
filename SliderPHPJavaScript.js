var td = document.getElementsByTagName('td');
        for(var i = 0; i < td.length; i++) {
            td[i].onclick = function(event) {
                var clickedOn = event.target;
    
                if (clickedOn.innerHTML != '') {
                    var nodeList = document.getElementsByTagName('td');
                    for(let i = 0; i < nodeList.length; i++) {
                        if (nodeList[i].innerHTML == '') {
                            nodeList[i].innerHTML = clickedOn.innerHTML;
                            clickedOn.innerHTML = '';
                            break;
                        }
                    }
                }
            }
        }


//var arrays = <?php echo json_encode($arrays); ?>;
//console.log(arrays);






/*<?php
echo "<script>
	var arrays = <?php echo json_encode($arrays); ?>;
	console.log(arrays);
	var testArray = new array(arrays[0].length);
	var td = document.getElementsByTagName('td');
			for(var i = 0; i < td.length; i++) {
				td[i].onclick = function(event) {
					var clickedOn = event.target;
		
					if (clickedOn.innerHTML != '') {
						var nodeList = document.getElementsByTagName('td');
						for(let i = 0; i < nodeList.length; i++) {
							if (nodeList[i].innerHTML == '') {
								nodeList[i].innerHTML = clickedOn.innerHTML;
								clickedOn.innerHTML = '';
								break;
							}
						}
						for(let i = 0; i < nodeList.length; i++) {
							testArray[i] = nodeList[i].innerHTML;
						}
					}
				}
			};
	
	const submit = document.getElementById('submit');
	submit.onclick = function() {
		for(let i = 0; i < testArray.length; i++) {
			if (testArray[i] != arrays[0][i]) {
				alert('Try again');
				return;
			}
		}
		alert('Congratulations!');
	}


	</script>"

?>*/