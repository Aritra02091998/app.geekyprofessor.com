<?php include "header.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Bold Text Generator Facebook, Instagram, Twitter</title>

	    <meta name="description" content="A simple online tool Bold text generator for writing a bold text on Facebook, Instagram, Twitter & Youtube. It converts your entered text into Unicode bold strings and copies to clipboard."/>

	    <meta name="keywords" content="bold text generator,text fonts bold,bold text generator facebook,bold text generator copy and paste,bold text generator instagram,bold text generator for google forms,how to make text bold on youtube,is bold text better on iphone,tiny bold text generator">

        <link href="css/boldTextGenerator.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    	<script src="https://kit.fontawesome.com/a076d05399.js"></script>

	</head>

	<body>
		<div id="heading" class="container">
			<br>
			<h1>Bold Text Generator</h1>
			<p id="seoContent">	
				Enter text below to make it bold for Facebook, Instagram, Twitter & Youtube.
			</p>
			<br>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-sm">
					<form>
					  <div class="form-group">
					    <label for="exampleFormControlInput1">Enter / Paste Your Text</label>
					    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Hi there !! Make Me Bold" onkeyup="makeTextBold()">
					  </div>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="col-sm">
					<label for="res">Bolded Text</label>
					<div id="output" class="container">
						<p id="boldedText"></p>
					</div>
				</div>
			</div>

		</div>

	    <input type="text" id="tempInputField" hidden>

	    <br>

		<button id="copyBtn" onclick="copyTextToClipboard()">Copy Text</button><br>
		
		<div class="alert alert-success" role="alert" id="copySuccessMsg">
		</div>

		<div id="seoContent" class="container">
		    <br>
		    <hr>
		    
		    <h2>Bold Text Generator Online Features</h2>

		    <br>


		    <div class="row">
		      <div class="col-sm">

		      	<div class="justify-content-center">
		        	<i id="seoIcon" class="fa-solid fa-bold"></i>
		        </div>
		        <br>
		        
		        <h3 id="seoHeader">What is Bold Text Generator ?</h3>

		        <br>

		        <p>
		          The Bold text generator is a breakthrough tool that can convert a normally written paragraph into bold text. It is thought to be a dance of digital text so that internet users can quickly recognise and appreciate it. (Italic Text)
		        </p>

		        <p>
		          𝗳𝗼𝗿 𝗲𝘅𝗮𝗺𝗽𝗹𝗲 𝘁𝗵𝗶𝘀 𝘁𝗲𝘅𝘁 𝗵𝗮𝘀 𝗯𝗲𝗲𝗻 𝗴𝗲𝗻𝗲𝗿𝗮𝘁𝗲𝗱 𝗳𝗿𝗼𝗺 𝘁𝗵𝗲 𝗯𝗼𝗹𝗱 𝘁𝗲𝘅𝘁 𝗴𝗲𝗻𝗲𝗿𝗮𝘁𝗼𝗿.
		        </p>

		        <br>
		        <hr>
		        <br>

		      </div>

		    </div>

		    <div class="row">
		      <div class="col-sm">

		      	<div class="justify-content-center">
					<i id="seoIcon" class="fa-solid fa-users"></i>
				</div>
				<br>

		        <h3 id="seoHeader">Why use Bold Text Generator for Instagram, Facebook, Twitter  ?</h3>

		        <br>

		        <p>
		        	This is an online bold text generator that can turn normal text into bold text characters that you can copy and paste anywhere. The bold text generator generates a set of Unicode Text Symbols symbols and special characters. These symbols are supported by almost all popular web browsers.   
		        </p>

		        <p>
		        	Use bold text generator for Facebook posts, Twitter tweets, Instagram bio text, and other social media platforms with ease. It will assist you in making your post wording unique and noticeable by making text fonts bold. You may also generate social media profile names to make your presence more unique and recognisable.
		        </p>

		        <p>
		        	You can also use these bold text generator yo generate texts to send SMS, email, WhatsApp, and Facebook Messenger messages; it also supports all other chat programmes.
		        </p>

				<br>
		        <hr>
		        <br>

		      </div>

		    </div>

		    <div class="row">
		      <div class="col-sm">

  			      	<div class="justify-content-center">
				        <i id="seoIcon" class="fa-solid fa-person-chalkboard"></i>
				    </div>
				<br>
		        <h3 id="seoHeader">How to use our Bold Text Generator ?</h3>

		        <br>

		        <p>
		        	<strong>Step 1: </strong>
	        		To use our Bold Text Generator, you need to first copy text from other place to make it bold using the bold text generator.   
		        </p>

		        <p>
		        	<strong>Step 2: </strong>
	        		You can also write text of your own in the Enter text box of Bold Text Generator
		        </p>

		        <p>
		        	<strong>Step 3: </strong>
		        	As you write or paste the text into our bold text generator, your text will be automatically converted into unicode bold characters.
		        </p>

		        <p>
		        	<strong>Step 4: </strong>
		        	Now click on "copy text" button below the bold text generator to copy the text in your device clip board.
		        </p>

				<br>
		        <hr>
		        <br>

		      </div>

		    </div>

		    <div class="row">
		      <div class="col-sm">

		      	<div class="justify-content-center">
			        <i id="seoIcon" class="fa-solid fa-rectangle-ad"></i>
			    </div>
			    <br>
		        <h3 id="seoHeader">Where bold text generator is used and needed ?</h3>

		        <br>
		        <p>
		        	<strong>1. </strong>
					You can effortlessly personalise and explore different types of fonts with the use of a bold text generator for your project work or even for publishing on your websites.		        
				</p>

		        <p>
		        	<strong>2. </strong>
		        	You can use this bold text generator for google forms or for bold text generator instagram, bold text generator youtube. Just you need to the bold text generator copy and paste feature to fetch the bold text.
		        </p>

		        <p>
		        	<strong>3. </strong>
		        	Now click on "copy text" button below the bold text generator to copy the text in your device clip board.
		        </p>

		        <p>
		        	<strong>4. </strong>
		        	This bold text generator may also be used to create the welcome line for any website or blog, so that when a potential client or visitor reaches the page, the bold lettering attracts their attention and makes an indelible impression on their memory.
		        </p>

				<br>
		        <hr>
		        <br>

		      </div>

		    </div>

		    <div class="row">
		      <div class="col-sm">

		      	<div class="justify-content-center">
			        <i id="seoIcon" class="fa-brands fa-facebook"></i>
			    </div>
			    <br>
		        <h3 id="seoHeader">How to Post Bold Text on Facebook ?</h3>

		        <br>
		        <p>
		        	<strong>1. </strong>
					Enter your desired text or paste it into the field above of the bold text generator.		        
				</p>

		        <p>
		        	<strong>2. </strong>
		        	After pasting or writing your text will automatically be converted to unicode bold characters by the bold text generators.
		        </p>

		        <p>
		        	<strong>3. </strong>
		        	Click on "copy text" button below the bold text generator to copy the text in your device clip board.
		        </p>

		        <p>
		        	<strong>4. </strong>
		        	Open Facebook and go to create new post dialog box.
		        </p>

		        <p>
		        	<strong>5. </strong>
		        	Now you can paste the bolded text generated by the bold text generator here along with other text to attract readers attention to that particular text. 
		        </p>

		        <p>
		        	You can genaerate bold text better on iphone and android also with this bold text generator.	
		        </p>

				<br>
		        <hr>
		        <br>

		      </div>

		    </div>

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