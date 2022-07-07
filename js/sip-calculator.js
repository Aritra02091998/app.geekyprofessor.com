var invstAmntGlobal = 1000;
var returnPercentageGlobal = 12;
var timePeriodGlobal = 2;
var lineGraphSIPValueArray = new Array();
var lineGraphYearValueArray = new Array();
var lineGraphTotInvstValueArray = new Array();
var lineGraphEstReturnsArray = new Array();





function updateInvstValue(invstAmnt) {
  document.getElementById('invstValueTextBox').value='₹ amount'.replace('amount', invstAmnt); 
  //console.log(typeof invstAmnt);

  invstAmntGlobal = parseInt(invstAmnt);
  calculateFinalValue();
}

function updateReturnPercentage(returnPercentage) {
  document.getElementById('expectedReturnTextBox').value='amount %'.replace('amount', returnPercentage); 
  returnPercentageGlobal = parseInt(returnPercentage);
  calculateFinalValue();
}

function updateTimePeriod(timePeriod) {
  document.getElementById('timeTextBox').value='amount Yr'.replace('amount', timePeriod); 
  timePeriodGlobal = parseInt(timePeriod);
  calculateFinalValue();
}


function displayResult(finalValueOfSIP,totInvstInAYear,estReturns){
  document.getElementById('invstAmnt').innerHTML = totInvstInAYear.toLocaleString("en-IN", {style:"currency", currency:"INR",maximumFractionDigits:0});
  document.getElementById('estReturns').innerHTML = estReturns.toLocaleString("en-IN", {style:"currency", currency:"INR",maximumFractionDigits:0});
  document.getElementById('totVal').innerHTML = finalValueOfSIP.toLocaleString("en-IN", {style:"currency", currency:"INR",maximumFractionDigits:0});
}

// Formula: FV = P * [ (1+i)^n-1 ] * (1+i)/i
//                      term1         term2

function calculateFinalValue(){
  var timePeriodGlobalMonth = timePeriodGlobal*12;
  var i = (returnPercentageGlobal/100)/12;
  //console.log("time ",timePeriodGlobalMonth);
  //console.log("i ",i);
  
  var iSum = i+1;
  var power = Math.pow(iSum,timePeriodGlobalMonth);
  var term1 = power-1;
  //console.log("term1 ",term1);
  
  var term2 = (1+i)/i;
  //console.log("term2 ",term2);
  
  // results fields calculation

  var finalValueOfSIP = Math.round(invstAmntGlobal*term1*term2);
  var totInvstInAYear = timePeriodGlobalMonth*invstAmntGlobal;
  var estReturns = finalValueOfSIP-totInvstInAYear;

  displayResult(finalValueOfSIP,totInvstInAYear,estReturns);
  drawDonutGraph(totInvstInAYear,estReturns);

  // for SIP value curve
  lineGraphSIPValueArray.push(finalValueOfSIP);

  // for x-axis labels
  lineGraphYearValueArray.push(timePeriodGlobal);

  // for return invested amount curve at the end of each year.
  lineGraphTotInvstValueArray.push(timePeriodGlobalMonth*invstAmntGlobal);

  // for estimated returns on SIP value.
  lineGraphEstReturnsArray.push(estReturns);


  drawLineGraph();
  console.log("array: ",lineGraphSIPValueArray.toString());
  console.log("array: ",lineGraphYearValueArray.toString());

}


window.onload = function() {

  invstAmntGlobal = 1000;
  returnPercentageGlobal = 12;
  timePeriodGlobal = 2;
  calculateFinalValue(); 

  document.getElementById('invstValueTextBox').value = '₹ amount'.replace('amount', invstAmntGlobal); 
  document.getElementById('expectedReturnTextBox').value = 'amount %'.replace('amount', returnPercentageGlobal); 
  document.getElementById('timeTextBox').value = 'amount Yr'.replace('amount', timePeriodGlobal); 
  //  drawLineGraph();

};


// donut graph
function drawDonutGraph(totInvstInAYear,estReturns){
  const ctx = document.getElementById('myChart1');
  const myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
              labels: [
                'Total Investment',
                'Estimated Returns'
              ],
              datasets: [{
                label: 'My First Dataset',
                data: [totInvstInAYear, estReturns],
                backgroundColor: ['rgb(54, 162, 235)','rgb(255, 205, 86)'],
              }]
            }
      });
}


function drawLineGraph(){
  const ctx2 = document.getElementById('myChart2');
  const myChart2 = new Chart(ctx2, {
      type: 'line',
      data: {
              labels: lineGraphYearValueArray,
              datasets: [{ 
                            data: lineGraphSIPValueArray,
                            label: "SIP Value after each Year",
                            borderColor: "#E74C3C",
                            fill: false
                        },
                        { 
                            data: lineGraphTotInvstValueArray,
                            label: "Invested Amount With Year",
                            borderColor: "#3498DB",
                            fill: false
                        },
                        { 
                            data: lineGraphEstReturnsArray,
                            label: "Est. Returns of SIP with Year",
                            borderColor: "#008000",
                            fill: false
                        }
                        ]
            },

      options: {
          title: {
            display: true,
            text: 'ROI vs Years'
          }
      }
  });
}








/*
Ref: 

https://stackoverflow.com/questions/10004723/html5-input-type-range-show-range-value
https://stackoverflow.com/questions/3304014/how-to-interpolate-variables-in-strings-in-javascript-without-concatenation
https://www.w3schools.com/jsref/jsref_tolocalestring_number.asp

https://www.chartjs.org/docs/latest/charts/doughnut.html#doughnut
https://www.chartjs.org/docs/latest/getting-started/usage.html
https://tobiasahlin.com/blog/chartjs-charts-to-get-you-started/
*/