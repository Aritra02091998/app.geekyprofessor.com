//selecting all required elements
const dropArea = document.querySelector(".drag-area"),
dragText = dropArea.querySelector("header"),
button = dropArea.querySelector("button"),
input = dropArea.querySelector("input");
let file; //this is a global variable and we'll use it inside multiple functions

button.onclick = ()=>{
  input.click(); //if user click on the button then the input also clicked
}

input.addEventListener("change", function(){
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = this.files[0];
  dropArea.classList.add("active");
  showFile(); //calling function
});


//If user Drag File Over DropArea
dropArea.addEventListener("dragover", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  dropArea.classList.add("active");
  dragText.textContent = "Release to Upload File";
});

//If user leave dragged File from DropArea
dropArea.addEventListener("dragleave", ()=>{
  dropArea.classList.remove("active");
  dragText.textContent = "Drag & Drop to Upload File";
});

//If user drop File on DropArea
dropArea.addEventListener("drop", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = event.dataTransfer.files[0];

  //setting the image input field to the image which has been dragged over to the droparea.
  document.querySelector('#imgField').files = event.dataTransfer.files;
  showFile(); //calling function
});

function showFile(){
  let fileType = file.type; //getting selected file type
  let validExtensions = ["image/png"]; //adding some valid image extensions in array
  if(validExtensions.includes(fileType)){ //if user selected file is an image file
    let fileReader = new FileReader(); //creating new FileReader object
    fileReader.onload = ()=>{
      let fileURL = fileReader.result; //passing user file source in fileURL variable
      let imgTag = `<img src="${fileURL}" alt="">`; //creating an img tag and passing user selected file source inside src attribute
      dropArea.innerHTML = imgTag; //adding that created img tag inside dropArea container
    }
    fileReader.readAsDataURL(file);
  }
  else{
    alert("This is not a PNG Image File!");
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
  }
}

/* code added by me */

function preventBack() {
      window.history.forward(); 
} 
setTimeout("preventBack()", 0);
window.onunload = function () { null };

function validateForm() {
  let x = document.forms["imgUpload"]["image"].value;
  if (x == "") {
    alert("Please Select a PNG Image.");
    console.log("called");
    return false;
  }
  else
    return true;
}

var form = document.getElementById("imageForm");
var flag = true;
document.body.appendChild(form);
document.getElementById("compress").addEventListener("click", function () {
  flag = validateForm();
  if (flag == true)
    form.submit();
});


// Ref for setting the input image field through javascript
// https://stackoverflow.com/questions/47515232/how-to-set-file-input-value-when-dropping-file-on-page