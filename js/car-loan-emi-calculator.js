var principalGlobal = 0;
var rateOfInterestGlobal = 0;
var loanTenureGlobal = 0;

var interestVariationWithMonth = new Array();
var remainingLoanAmount = new Array();
var principleClearedTillDate = new Array();
var monthsX_Label = new Array();

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
    document.getElementById("principalTextBox").value ='₹ amount'.replace('amount', principalGlobal); 
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
  document.getElementById('principalTextBox').value='₹ amount'.replace('amount', principalAmnt); 
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
 
 // once result is displayed , all rows in the table is deleted for storing result of next 
 // calculation.

  var table = document.getElementById('amortizedTable');
  var rowCount = table.rows.length;
  console.log("row count: ",rowCount);
  for (var i = rowCount-1; i > 0; i--) {
      table.deleteRow(i);
  }
  console.log(table.rows.length);

  document.getElementById('montlyEMI').innerHTML = monthlyEMI.toLocaleString("en-IN", {style:"currency", currency:"INR",maximumFractionDigits:0});
  document.getElementById('principalAmount').innerHTML = principalGlobal.toLocaleString("en-IN", {style:"currency", currency:"INR",maximumFractionDigits:0});
  document.getElementById('totInterest').innerHTML = totIntereset.toLocaleString("en-IN", {style:"currency", currency:"INR",maximumFractionDigits:0});
  document.getElementById('totAmountPayable').innerHTML = totAmountPayable.toLocaleString("en-IN", {style:"currency", currency:"INR",maximumFractionDigits:0});
}

//---------------------------------- end of value updation---------------------------------------------------------------------------------------------------------------------

function createMonthlyAmortizedSchedule() {
  var beginningPrincipal = principalGlobal;
  var interest = (rateOfInterestGlobal/100)/12;
  var loanTenure = loanTenureGlobal*12;
  var table = document.getElementById("amortizedTable");
  table.style.textAlign = "center";

  var tableRow = null;
  var principleCleared = 0;

  var currMonth,interestAmountExpense,remainingPrincipal,principalReducedInCurrMonth;

  var fixedAnnualPmnt;

  // whenever this function is called the array is cleared os that previous calculation 
  //values are not taken into the graph.

  interestVariationWithMonth.length = 0;
  remainingLoanAmount.length = 0;
  principleClearedTillDate.length = 0;

  // fixedAnnualPmnt = principal*int / [1-1/(1+int)^n]
  //                      term1          term2

  var term1 = beginningPrincipal*interest;
  var term2 = 1 - (1/Math.pow((1+interest),loanTenure));
  fixedAnnualPmnt = (term1 / term2).toFixed(4);

  interestAmountExpense = beginningPrincipal*interest;
  principalReducedInCurrMonth = fixedAnnualPmnt - interestAmountExpense;
  remainingPrincipal = beginningPrincipal - principalReducedInCurrMonth;
  currMonth = 1;

  while (currMonth!=(loanTenure+1)){
      //console.log("Mon ",currMonth," principal ",beginningPrincipal,"ann pmnt ",fixedAnnualPmnt," Intr Amount ",interestAmountExpense,"Princi reduced ",principalReducedInCurrMonth," Remaining Princi Bal: ",remainingPrincipal);
      //console.log("\n");
      
      tableRow = table.insertRow(table.rows.length);;
      var cell1 = tableRow.insertCell(0);
      var cell2 = tableRow.insertCell(1);
      var cell3 = tableRow.insertCell(2);
      var cell4 = tableRow.insertCell(3);
      var cell5 = tableRow.insertCell(4);

      cell1.innerHTML = currMonth;
      cell2.innerHTML = "₹ amount".replace("amount",parseInt(beginningPrincipal));
      cell3.innerHTML = "₹ amount".replace("amount",parseInt(interestAmountExpense));
      cell4.innerHTML = "₹ amount".replace("amount",parseInt(principalReducedInCurrMonth));
      cell5.innerHTML = "₹ amount".replace("amount",parseInt(remainingPrincipal));

      // for writing the text "End of n th Year" in between the rows

      if (currMonth % 12 == 0){
        tableRow = table.insertRow(table.rows.length);
        cell1 = tableRow.insertCell(0);
        cell2 = tableRow.insertCell(1);
        cell3 = tableRow.insertCell(2);
        cell4 = tableRow.insertCell(3);
        cell5 = tableRow.insertCell(4);
        
        cell3.innerHTML="End of nth Year".replace("nth",currMonth/12);
        cell3.style.backgroundColor = "#AED6F1";
        cell3.style.fontFamily = "'PT Sans', sans-serif";
        cell3.style.fontWeight = "bolder";


        cell1.style.backgroundColor = "#AED6F1";
        cell2.style.backgroundColor = "#AED6F1";
        cell4.style.backgroundColor = "#AED6F1";
        cell5.style.backgroundColor = "#AED6F1";

      }

      // for drawing Line graph
      principleCleared = parseInt(principleCleared) + parseInt(principalReducedInCurrMonth);
      console.log(principleCleared,"->",principalReducedInCurrMonth);

      interestVariationWithMonth.push(interestAmountExpense);
      remainingLoanAmount.push(remainingPrincipal);
      principleClearedTillDate.push(principleCleared);
      monthsX_Label.push(currMonth);

      // variable updates inside the loop

      currMonth = currMonth+1;
      beginningPrincipal = remainingPrincipal;
      // no change in fixedAnnualPmnt
      interestAmountExpense = (beginningPrincipal * interest).toFixed(4);
      principalReducedInCurrMonth = (fixedAnnualPmnt - interestAmountExpense).toFixed(4);
      remainingPrincipal = (Math.abs(beginningPrincipal - principalReducedInCurrMonth)).toFixed(3);
  }

  drawLineGraph();  
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
  createMonthlyAmortizedSchedule();

 
}




window.onload = function() {

  principalGlobal = 100000;
  rateOfInterestGlobal = 7;
  loanTenureGlobal = 5;
  calculateEMIValue();

  // setting initial values into the text Values.
  document.getElementById('principalTextBox').value = '₹ amount'.replace('amount', principalGlobal); 
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
              labels: monthsX_Label,
              datasets: [{ 
                            data: interestVariationWithMonth,
                            label: "Interest Reduction with Month",
                            borderColor: "#3498DB",
                            fill: false
                        },
                        { 
                            data: remainingLoanAmount,
                            label: "Remaining Loan Amount",
                            borderColor: "#F4D03F",
                            fill: false
                        },
                        { 
                            data: principleClearedTillDate,
                            label: "Principle Cleared Till Month",
                            borderColor: "#58D68D",
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
https://www.w3schools.com/jsref/met_table_insertrow.asp
https://stackoverflow.com/questions/18333427/how-to-insert-a-row-in-an-html-table-body-in-javascript

https://www.chartjs.org/docs/latest/charts/doughnut.html#doughnut
https://www.chartjs.org/docs/latest/getting-started/usage.html
https://tobiasahlin.com/blog/chartjs-charts-to-get-you-started/
*/