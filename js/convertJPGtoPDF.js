function extensionSupported(uploadedFileType){
    let validExtensions = ["image/jpeg", "image/jpg", "image/png"]; 
    if (validExtensions.includes(uploadedFileType))
        return true;
    else
        return false;
    console.log(uploadedFileType);
}


function validateForm() {

    // image is an array of images so [].
    let count = 0;
    let x = document.forms["mulImagesForm"]["image[]"].value;

    // case 1: if the input field is empty
    if (x == "") {
        alert("Please Select a JPG Image.");
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
            alert("Please Select only JPG,PNG Images");
            count = 0;
            return false;
        }
    }
}


var form = document.getElementById("multipleImgForm");
var flag = true;
document.getElementById("convert").addEventListener("click", function () {
    flag = validateForm();
    if (flag == true)
        form.submit();
});


/*

Ref: https://stackoverflow.com/questions/7023457/get-input-type-file-value-when-it-has-multiple-files-selected

*/


