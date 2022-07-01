	
var modifiedText="";
var rawText="";

function clearTextArea(){
	document.getElementById("exampleFormControlTextarea6").value="";
	document.getElementById("keyword").value="";
	document.getElementById("stopWord").value="";

	document.getElementById("wordCount").innerHTML="0";
	document.getElementById("charCount").innerHTML="0";
	modifiedText = "";
}

function writeKeywordDensity(keywordCount){

	var fetchedWordCount=document.getElementById("wordCount").innerHTML;
	document.getElementById("writeKeywords").style.fontSize="16px";

	console.log("wordCount: ",fetchedWordCount);
	console.log("kcount: ",keywordCount);

	
	if (keywordCount == 0){
		document.getElementById("writeKeywords").style.color="#E74C3C";
	document.getElementById("writeKeywords").innerHTML="Keyword NOT Found";

	}
	else if (fetchedWordCount >= 800 && (keywordCount>=8 && keywordCount<=11) ){
		var s="Keyword Density: Average. Keyword appeared: "+keywordCount +" times";
		document.getElementById("writeKeywords").style.color="#F39C12";
		document.getElementById("writeKeywords").innerHTML=s;
	}
	else if (fetchedWordCount >= 1000 && (keywordCount>=12 && keywordCount<=15) ){
		var s="Keyword Density: Good. Keyword appeared: "+keywordCount +" times";
		document.getElementById("writeKeywords").style.color="#196F3D";
		document.getElementById("writeKeywords").innerHTML=s;

	}
	else if (fetchedWordCount >= 1500 && (keywordCount>=16 && keywordCount<=21) ){
		var s="Keyword Density: Good. Keyword appeared: "+keywordCount +" times";
		document.getElementById("writeKeywords").style.color="#196F3D";
		document.getElementById("writeKeywords").innerHTML=s;

	}
	else{
		document.getElementById("writeKeywords").style.color="#E74C3C";
		document.getElementById("writeKeywords").innerHTML="Keyword Density: Needs Improvement. Your KD is: "+keywordCount;
	}
}

function countWords(){
	rawText = document.getElementById("exampleFormControlTextarea6").value;
	let spaceRemovedText = rawText.trim();
	modifiedText = spaceRemovedText.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '|');

	const wordsArray = modifiedText.split(" ");
	let wordCount= 0 ;

	for (var i = 0; i < wordsArray.length; i++) {
	    if (wordsArray[i] != "|") {
	        wordCount += 1;
    	}
	}
	document.getElementById("wordCount").innerHTML = wordCount; 
	document.getElementById("charCount").innerHTML = rawText.length; 

}

function countKDensity() {
	let word = document.getElementById("keyword").value.toUpperCase(); 

	if (modifiedText.length == 0 || word.length == 0)
		alert("Please Enter Text");
	else{
		let string = modifiedText.toUpperCase(); 
		console.log(string.split(word).length - 1);
			var keywordCount = string.split(word).length - 1;
			writeKeywordDensity(keywordCount);
		}
}

function writeStopWordDensity(stopWordCount){
		document.getElementById("writeStopWords").style.fontSize="16px";
		var fetchedWordCount=document.getElementById("wordCount").innerHTML;
		var stopWordPercent = Math.ceil((stopWordCount/fetchedWordCount)*100);
		var s="This particular Stop Word occurs "+stopWordPercent+"% of your whole text";

		if (stopWordPercent > 10)
			document.getElementById("writeStopWords").style.color="#E67E22";
	else
		document.getElementById("writeStopWords").style.color="#28B463";
		document.getElementById("writeStopWords").innerHTML=s;
}

function countStopWordDensity() {
	let word = document.getElementById("stopWord").value.toUpperCase(); 

	if (modifiedText.length == 0 || word.length == 0)
		alert("Please Enter Text");
	else{
		let string = modifiedText.toUpperCase(); 
			var stopWordCount = string.split(word).length - 1;
			console.log("sCount",stopWordCount);
			writeStopWordDensity(stopWordCount);
		}
}
