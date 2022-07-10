var principalGlobal = 0;
var rateOfInterestGlobal = 0;
var loanTenureGlobal = 0;

var lineGraphLoanTenureArray = new Array();
var lineGraphTotIntrstValueArray = new Array();
var lineGraphAmntPayableArray = new Array();

// principal = loan amount taken.

/* these updatefromtextbox() functions is very useful. If any user wants to enter the principal amount manually 
  into the text box, then these functions would update the slider and the textbox accordingly. 
*/

//------------------------------ Value updates from text Box----------------------------------------------------

/* for all the function below if value in text box is empty or not according to the rules 
  then system will show alert and will revert the text box value to the existing value by 
  accessing the old slider value.
*/
function updateValueFromPrincipalTextBox(){
  var textBox = document.getElementById('principalTextBox');
  var slider = document.getElementById('principalSlider');
  principalGlobal = parseInt(textBox.value);

  if (isNaN(principalGlobal)){
    alert("Principal must be a valid Number");
    updatePrincipalValue(slider.value);
  }
  else if (textBox.value == ""){
    alert("Principal can't be Empty");
    updatePrincipalValue(slider.value);
  }
  else if (principalGlobal < 90000){
    alert("Principal can't be less than 90000");
    updatePrincipalValue(slider.value);
  }
  else if (principalGlobal > 9000000){
    alert("Principal can't be higher than 90000");
    updatePrincipalValue(slider.value);
  }
  else{
    document.getElementById("principalSlider").value = principalGlobal;
    document.getElementById("principalTextBox").value ='$ amount'.replace('amount', principalGlobal); 
    calculateEMIValue();
  }
}

// when principal text box is clicked to enter value , existing value is cleared.

document.getElementById("principalTextBox").addEventListener("click", function () {
  document.getElementById("principalTextBox").value = "";
});


function updateValueFromRateOfInterestTextBox(){
  var textBox = document.getElementById('rateOfInterestTextBox');
  var slider = document.getElementById('rateSlider');
  rateOfInterestGlobal = parseFloat(textBox.value);

  if (isNaN(rateOfInterestGlobal)){
    alert("Interest must be a valid Number");
    updateRateOfInterest(slider.value); 
  }
  else if (textBox.value == ""){
    alert("Rate can't be Empty");
    updateRateOfInterest(slider.value); 
  }
  else if (rateOfInterestGlobal < 1){
    alert("Rate can't be less than 1");
    updateRateOfInterest(slider.value); 
  }
  else if (rateOfInterestGlobal > 30){
    alert("Rate can't be higher than 30");
    updateRateOfInterest(slider.value); 
  }
  else{
    document.getElementById("rateSlider").value = rateOfInterestGlobal;
    document.getElementById("rateOfInterestTextBox").value ='amount %'.replace('amount', rateOfInterestGlobal); 
    calculateEMIValue();
  }
}

// when rate text box is clicked to put value , existing value is cleared.

document.getElementById("rateOfInterestTextBox").addEventListener("click", function () {
  document.getElementById("rateOfInterestTextBox").value = "";
});

function updateValueFromLoanTenureTextBox(){
  var textBox = document.getElementById('loanTenureTextBox');
  var slider = document.getElementById('loanTenureSlider');
  loanTenureGlobal = parseInt(textBox.value);

  if (isNaN(loanTenureGlobal)){
    alert("Loan Tenure must be a valid Number");
    updateLoanTenure(slider.value);
  }
  else if (textBox.value == ""){
    alert("Loan Tenure can't be Empty");
    updateLoanTenure(slider.value);
  }
  else if (loanTenureGlobal < 1){
    alert("Loan Tenure can't be less than 1");
    updateLoanTenure(slider.value);
  }
  else if (loanTenureGlobal > 30){
    alert("Loan Tenure can't be more than 1");
    updateLoanTenure(slider.value);
  }
  else{
    document.getElementById("loanTenureSlider").value = rateOfInterestGlobal;
    document.getElementById("loanTenureTextBox").value ='amount Yr'.replace('amount', loanTenureGlobal); 
    calculateEMIValue();
  }
}

// when loan tenure text box is clicked to put value , existing value is cleared.

document.getElementById("loanTenureTextBox").addEventListener("click", function () {
  document.getElementById("loanTenureTextBox").value = "";
});




//------------------------- Value updates from Range Slider----------------------------------------------------



function updatePrincipalValue(principalAmnt) {
  document.getElementById('principalTextBox').value='$ amount'.replace('amount', principalAmnt); 
  //console.log(typeof invstAmnt);

  principalGlobal = parseInt(principalAmnt);
  calculateEMIValue();
}

function updateRateOfInterest(rateOfInterest) {
  document.getElementById('rateOfInterestTextBox').value='amount %'.replace('amount', rateOfInterest); 
  rateOfInterestGlobal = parseFloat(rateOfInterest);
  calculateEMIValue();
}

function updateLoanTenure(loanTenure) {
  document.getElementById('loanTenureTextBox').value='amount Yr'.replace('amount', loanTenure); 
  loanTenureGlobal = parseInt(loanTenure);
  calculateEMIValue();
}


function displayResult(monthlyEMI,totIntereset,totAmountPayable){
  document.getElementById('montlyEMI').innerHTML = monthlyEMI.toLocaleString("en-US", {style:"currency", currency:"USD",maximumFractionDigits:0});
  document.getElementById('principalAmount').innerHTML = principalGlobal.toLocaleString("en-US", {style:"currency", currency:"USD",maximumFractionDigits:0});
  document.getElementById('totInterest').innerHTML = totIntereset.toLocaleString("en-US", {style:"currency", currency:"USD",maximumFractionDigits:0});
  document.getElementById('totAmountPayable').innerHTML = totAmountPayable.toLocaleString("en-US", {style:"currency", currency:"USD",maximumFractionDigits:0});
}

// Formula: E = P x r x(1 + r)^n / ( ( 1 + r )^n - 1 )
//                  term1               term2

function calculateEMIValue(){

  var loanTenureGlobalMonth = loanTenureGlobal*12;
  //console.log("nmonths ",loanTenureGlobalMonth);

  var rateOfInterestPerMonth = (rateOfInterestGlobal/12)/100;
  //console.log("ROI ",rateOfInterestPerMonth);

  var powerTerm = Math.pow((1+rateOfInterestPerMonth),loanTenureGlobalMonth);
  //console.log("power ",powerTerm);

  var term1 = principalGlobal*rateOfInterestPerMonth*powerTerm;
  //console.log("term1 ",term1);

  var term2 = powerTerm - 1;
  //console.log("term2 ",term2);


  // results fields calculation

  var monthlyEMI = term1/term2; 
  //console.log("emi ",monthlyEMI);

  var totAmountPayable = monthlyEMI*loanTenureGlobalMonth;
  var totIntereset = totAmountPayable - principalGlobal;

  displayResult(monthlyEMI,totIntereset,totAmountPayable);
  drawDonutGraph(principalGlobal,totIntereset);


  // for x-axis labels
  lineGraphLoanTenureArray.push(loanTenureGlobal);

  // total Interest
  lineGraphTotIntrstValueArray.push(totIntereset);

  // for estimated returns on SIP value.
  lineGraphAmntPayableArray.push(totAmountPayable);


  drawLineGraph();  
}


window.onload = function() {

  principalGlobal = 5000;
  rateOfInterestGlobal = 5;
  loanTenureGlobal = 4.5;
  calculateEMIValue();

  // setting initial values into the text Values.
  document.getElementById('principalTextBox').value = '$ amount'.replace('amount', principalGlobal); 
  document.getElementById('rateOfInterestTextBox').value = 'amount %'.replace('amount', rateOfInterestGlobal); 
  document.getElementById('loanTenureTextBox').value = 'amount Yr'.replace('amount', loanTenureGlobal);  
};


// donut graph
function drawDonutGraph(principalGlobal,totIntereset){
  const ctx = document.getElementById('myChart1');
  const myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
              labels: [
                'Principal Amount',
                'Total Interest Amount'
              ],
              datasets: [{
                label: 'EMI',
                data: [principalGlobal, totIntereset],
                backgroundColor: ['rgb(54, 162, 235)','rgb(255, 205, 86)'],
              }]
            },
      options: {
          title: {
            display: true,
            text: 'Principal Amount & Interest According to your Input'
          }
      }

      });
}


function drawLineGraph(){
  const ctx2 = document.getElementById('myChart2');
  const myChart2 = new Chart(ctx2, {
      type: 'line',
      data: {
              labels: lineGraphLoanTenureArray,
              datasets: [{ 
                            data: lineGraphTotIntrstValueArray,
                            label: "Interest with Year",
                            borderColor: "#E74C3C",
                            fill: false
                        },
                        { 
                            data: lineGraphAmntPayableArray,
                            label: "Amount Payable With Year",
                            borderColor: "#3498DB",
                            fill: false
                        }
              ]
            },

      options: {
          title: {
            display: true,
            text: 'ROI & Amount Payable vs Years'
          }
      }
  });
}








/*
Ref: 

https://stackoverflow.com/questions/10004723/html5-input-type-range-show-range-value
https://stackoverflow.com/questions/3304014/how-to-interpolate-variables-in-strings-in-javascript-without-concatenation
https://www.w3schools.com/jsref/jsref_tolocalestring_number.asp
https://stackoverflow.com/questions/17500704/how-can-i-set-focus-on-an-element-in-an-html-form-using-javascript
https://www.techonthenet.com/js/number_tolocalestring.php

https://www.chartjs.org/docs/latest/charts/doughnut.html#doughnut
https://www.chartjs.org/docs/latest/getting-started/usage.html
https://tobiasahlin.com/blog/chartjs-charts-to-get-you-started/
*/