// variable declarations.

var progressBar = document.getElementById("wrapper");
var image = document.getElementById("resultImage");
var i = 0;



// code to disable back btn.

function preventBack() {
      window.history.forward(); 
} 
setTimeout("preventBack()", 0);
window.onunload = function () { null };


// function to check if its a valid extension

function extensionSupported(uploadedFileType){
    let validExtensions = ["application/pdf"]; 
    if (validExtensions.includes(uploadedFileType))
        return true;
    else
        return false;
    console.log(uploadedFileType);
}


// function to validate the form entry

function validateForm() {

    console.log("validateForm");
    // image is an array of images so [].
    let count = 0;
    let x = document.forms["mulImagesForm"]["pdfDoc"].value;

    // case 1: if the input field is empty
    if (x == "") {
        alert("Please Select atleast one PDF Document.");
        console.log("called");
        return false;
    }

    // case 2: if input files are uploaded are they all have jpg,jpeg,png formats?
    else{
        var files = document.getElementById("mulImages").files;
        for (var i = 0; i < files.length; i++){
            if (extensionSupported(files[i].type))
                count++;
        }
        console.log(count);
        // if all files uploaded has either jpg or png extension, submit the form.
        if (count == files.length)
            return true;

        // even if one of the file has some other extension, form will not be submitted. 
        else{
            alert("Please Select only PDF Documents");
            count = 0;
            return false;
        }
    }
}


// actual form submission code.

function submitForm(){
    var form = document.getElementById("multipleImgForm");
    console.log("form submitting");
    form.submit();           
}

// on clicking the hidden btn the form will be submitted aftre validation check.

document.getElementById("hiddenFormSubmitBtn").addEventListener("click", function () {
  submitForm();
});

// while the progress bar is loading, user can go back and change the PDFs.

document.getElementById("splitMorePDF").addEventListener("click", function () {
  window.location.href = "splitPDF.php";
});


// function to move the progressbar on page load

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
                console.log("hidden btn clicked");
                document.getElementById("hiddenFormSubmitBtn").click();
            }  
          }
        }
    }
}


document.getElementById("splitPDF").addEventListener("click", function () {
    
    if (validateForm()){

        document.getElementById("formWrapper").style.display = "none";
        document.getElementById("headSplitPDF").style.display = "none";
        document.getElementById("silentMsg").style.display = "none";
        document.getElementById("splitPDF").style.display = "none";
        document.getElementById("splitMorePDF").style.display = "block";
        progressBar.style.display = "block";
        moveProgressBar();
    }

});


// when the page loads no progressbar , no gif loading will be shown.

window.onload = function() {
  progressBar.style.display = "none";
  image.style.display = "none";
  document.getElementById("splitMorePDF").style.display = "none";
};


function debugSubmit(){
    var form = document.getElementById("multipleImgForm");
    console.log("Debug Form Submitting");
    form.submit();      
}






/*

Ref: https://stackoverflow.com/questions/7023457/get-input-type-file-value-when-it-has-multiple-files-selected

*/



