//selecting all required elements
const dropArea = document.querySelector(".drag-area"),
dragText = dropArea.querySelector("header"),
button = dropArea.querySelector("button"),
input = dropArea.querySelector("input");
let file; //this is a global variable and we'll use it inside multiple functions
var i = 0;


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
  let validExtensions = ["application/pdf"]; //adding some valid image extensions in array
  if(validExtensions.includes(fileType)){ //if user selected file is an image file
    let fileReader = new FileReader(); //creating new FileReader object
    fileReader.onload = ()=>{
      let fileURL = fileReader.result; //passing user file source in fileURL variable
      let imgTag = file.name; //creating an img tag and passing user selected file source inside src attribute
      
      dropArea.innerHTML = "";  

      var icon = document.createElement('i'); // is a node
      icon.className = "fa-solid fa-file-pdf fa-4x";
      dropArea.appendChild(icon);

      var pdfFileName = document.createElement('p'); // is a node
      pdfFileName.innerHTML = imgTag;
      pdfFileName.style.margin = "28px 13px 10px 20px";
      pdfFileName.style.fontSize = "x-large";
      dropArea.appendChild(pdfFileName);

      dropArea.style.backgroundColor = "#D6DBDF";
      dropArea.style.color = "#5D6D7E";
    }
    fileReader.readAsDataURL(file);
  }
  else{
    alert("This is not a PDF File!");
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
  }
}

/* code added by me */

var progressBar = document.getElementById("wrapper");
var image = document.getElementById("resultImage");
var form = document.getElementById("pdfForm");
var flag = true;


window.onload = function() {
  progressBar.style.display = "none";
  image.style.display = "none";
  document.getElementById("redirect").style.display = "none";
};


// code to disable back btn.

function preventBack() {
      window.history.forward(); 
} 
setTimeout("preventBack()", 0);
window.onunload = function () { null };


// code to validate if the form is empty.

function validateForm() {
  let x = document.forms["pdfUpload"]["pdfDoc"].value;
  if (x == "") {
    alert("Please Select a PDF Document.");
    console.log("called");
    return false;
  }
  else
    return true;
}


document.body.appendChild(form);
document.getElementById("compress").addEventListener("click", function () {
  flag = validateForm();
  if (flag == true){
    dropArea.style.display = "none";
    progressBar.style.display = "block";
    document.getElementById("redirect").style.display = "block";
    document.getElementById("compress").style.display = "none";
    moveProgressBar();
  }
});

document.getElementById("hiddenFormSubmitBtn").addEventListener("click", function () {
  form.submit();
});


document.getElementById("redirect").addEventListener("click", function () {
  window.location.href = "convertPDFtoJPG.php";
});

function moveProgressBar() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var dot = document.getElementById("head");

    var width = 10;
    var id = setInterval(frame, 100);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        i = 0;
      } 
      else {
        width++;
        //console.log(width);
        elem.style.width = width + "%";
        elem.innerHTML = width  + "%";
        if (width == 20||width == 35||width == 50||width == 65 ||width == 80||width == 95) {
          head.innerHTML = head.innerHTML  + ".";
        }

        if (width == 100){
          progressBar.style.display = "none";
          image.style.display = "block";
          document.getElementById("hiddenFormSubmitBtn").click();
        }  
      }
    }
  }
}







// Ref for setting the input image field through javascript
// https://stackoverflow.com/questions/47515232/how-to-set-file-input-value-when-dropping-file-on-page
// https://stackoverflow.com/questions/27079598/error-failed-to-execute-appendchild-on-node-parameter-1-is-not-of-type-no
// https://stackoverflow.com/questions/1804745/get-the-filename-of-a-fileupload-in-a-document-through-javascript
