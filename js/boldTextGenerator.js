let text= "";

function makeTextBold() {
	text=document.getElementById("exampleFormControlInput1").value;
	let newText = text.replace (/[A-Za-z0-9]/g, translate);
	document.getElementById("boldedText").innerHTML=newText;
	document.getElementById("tempInputField").value=newText;

	console.log(newText);
}

function translate (char)
{
    let diff;
    if (/[A-Z]/.test (char))
    {
        diff = "𝗔".codePointAt (0) - "A".codePointAt (0);
    }
    if (/[0-9]/.test (char))
    {
        diff = "𝟬".codePointAt (0) - "0".codePointAt (0);
    }
    else
    {
        diff = "𝗮".codePointAt (0) - "a".codePointAt (0);
    }
    return String.fromCodePoint (char.codePointAt (0) + diff);
}


function copyTextToClipboard() {
  var copyText = document.getElementById("tempInputField");
  copyText.select();
  copyText.setSelectionRange(0, 99999); 

  navigator.clipboard.writeText(copyText.value);

  // If textfield is empty , text cant be copied.
  if (tempInputField.value.length==0){
  	alert("Please enter text !!");
  }
  else{
	  document.getElementById("copySuccessMsg").innerHTML="Text Copied !";
	  document.getElementById("copySuccessMsg").style.display="block";
  }
}
