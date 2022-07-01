<?php include "header.php"; ?>

<!DOCTYPE html>
<html>
	<head>
        <link href="css/boldTextGenerator.css" rel="stylesheet" />
	</head>

	<body>
		<div class="heading">
			<h2>Bold Text Generator</h2>
		</div>
		<div class="formWrapper">
			<form>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Enter / Paste Your Text</label>
			    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Hi there !! Make Me Bold" onkeyup="makeTextBold()">
			  </div>
			</form>
			
			<label for="res">Bolded Text</label>
			<div class="output">
				<p id="boldedText"></p>
			</div>
		</div>
	    <input type="text" id="tempInputField" hidden>

		<button id="copyBtn" onclick="copyTextToClipboard()">Copy Text</button><br>
		
		<div class="alert alert-success" role="alert" id="copySuccessMsg">
		</div>

	  	<script src="js/boldTextGenerator.js"></script>
	</body>
</html>
<?php include "footer.php"; ?>



<!--
Ref: https://stackoverflow.com/questions/57827828/javascript-convert-text-to-bold-unicode-charset

This link contains the JS code which replaces each normal letters into unicode bold letters.
If we just make the text bold it wont work, if we place that in FB text box it will appear as 
normal text only
-->