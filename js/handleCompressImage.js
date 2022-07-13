var i = 0;

function move() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var dot = document.getElementById("head");

    var width = 10;
    var id = setInterval(frame, 45);
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
          displayResult();
          performDwnldAfterDelay();
        }  
        //document.getElementById("result").style.display="block";

      }
    }
  }
}

window.onload = function() {
  move();
};




// By default the result will not be shown, only after the progress bar reaches 100 it will be shown.
function displayResult(){
  document.getElementById("result").style.display="block";
  document.getElementById("wrapper").style.display="none";
}

// this function performs the automatic download 5 secs after the progress bar 
// reaches to 100%

function performDwnldAfterDelay() {
  console.log("inside");
  setTimeout(function(){ document.getElementById("hiddenBtnForAutoDwnld").click(); }, 5000);
}


// This function hides the resultTable if the img conversion is not successful
// like when invalid extension file is uploaded.

function hideTableWhenStatusFailed(){
  status = document.getElementById("statusFlag").innerHTML;
  table = document.getElementById("resultTable");  
  console.log(status);
  if (status == "0")
    table.style.display = "none";

  return status;
}



// ref: https://www.w3schools.com/howto/howto_js_progressbar.asp
// ref: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_progressbar_label_js

// for executing function after a delay.
// ref: https://tutorial.eyehunts.com/js/javascript-run-function-after-a-delay-simple-example-code/
