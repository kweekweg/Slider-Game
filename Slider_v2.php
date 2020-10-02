<!DOCTYPE html>
<html>

<head>
<style>
.grid {
	display: grid;
	margin: auto;
	width: 50%;
	grid-template-rows: auto auto auto auto;
	grid-template-columns: auto auto auto;
	border: 5px solid cadetblue;
	background-color: solid azure;
}

.item {
 	background-color: azure;
	border: 2px solid cadetblue;
	color: Gray;
 	font-size: 30px;
 	text-align: center;
}


</style>
</head>

<body>
<h2 style = "font-family:helvetica, sans serif; color: black; margin:40px; text-align:center;">Slider </h2>

<br>

<form action="" style="text-align:center;">
	<label for="fullQuote">Enter Quote:</label>
	<input type="text" id="fullQuote" name="fullQuote" maxlength="72">
	<button type="submit">Submit</button>
</form>

<br>
<br>

<div class="grid">
	<div class="item">Here</div>
	<div class="item"> is </div>
	<div class="item">anot</div>
	<div class="item">her </div>
	<div class="item">vers</div>
	<div class="item">ion </div>
	<div class="item">of t</div>
	<div class="item">he a</div>
	<div class="item">ppli</div>
	<div class="item">cati</div>
	<div class="item">on</div>
	<div class="item"> </div>
</div>
</body>
</html>
