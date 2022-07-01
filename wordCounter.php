<?php include "header.php"; ?>

<!DOCTYPE html>
<html>
	<head>
        <link href="css/wordCounter.css" rel="stylesheet" />
	</head>

	<body>
		<div class="heading">
			<h1>Word Counter For BLOG SEO</h1>
		</div>

		<div class="flex-container">
			<div class="textareaWrapper">
				<div class="form-group shadow-textarea">
				  <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="16" placeholder="Write something here..." onkeyup="countWords()"></textarea>
				</div>
				<button id="clearBtn" class="button" onclick="clearTextArea()">Clear Text</button>
			</div>


			<div class="advancedFeatures" id="adv">
			  	<label id="advancedFeaturesLabel">Advanced Features</label>

				<div class="form-group">
				    <label for="exampleInputEmail1">Keyword Density</label>
				    <input type="email" class="form-control" id="keyword" aria-describedby="emailHelp" placeholder="Enter Keyword e.g 'best gadgets'">
				    <p id="writeKeywords">Keyword Analysis</p>
				    <button class="button" onclick="countKDensity()">Calculate</button>
			  	</div>

			  	<div class="form-group">
				    <label for="exampleInputEmail1">Stop Words Density</label>
				    <input type="email" class="form-control" id="stopWord" aria-describedby="emailHelp" placeholder="Enter Stop Words e.g 'is', 'are', 'of'">
				    <p id="writeStopWords">Selected Stop Word Density</p>
				    <button class="button" onclick="countStopWordDensity()">Calculate</button>

			  	</div>
			</div>
		</div>

		<div class="output">
			<p class=wordLabel>Words:&nbsp</p>
			<p id="wordCount">0</p>
			<p class="characterLabel">Characters:&nbsp</p>
			<p id="charCount">0</p>
		</div>

		
	  	<script src="js/wordCounter.js"></script>
	</body>
</html>
<?php include "footer.php"; ?>
