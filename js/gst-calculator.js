var productPriceGlobal = 0;
var GSTRateGlobal = 0;
var loanTenureGlobal = 0;

// Price including GST = 1 , Proce excluding GST = 0
// Based on the value of this flag, either calculateInclGST() or calculateExclGST() method will be called.
var inclExclGSTFLag = null;

document.getElementById('incl').addEventListener("click", function(){
  document.getElementById('incl').style.backgroundColor="#28B463";
  document.getElementById('incl').style.color="white";
  document.getElementById('excl').style.backgroundColor="white";
  document.getElementById('excl').style.color="#28B463";
  document.getElementById('inclExclLabel').innerHTML="Price GST Incl.";
  inclExclGSTFLag = 1;
  calculateInclGSTValue();
})
document.getElementById('excl').addEventListener("click", function(){
  document.getElementById('excl').style.backgroundColor="#28B463";
  document.getElementById('excl').style.color="white";
  document.getElementById('incl').style.backgroundColor="white";
  document.getElementById('incl').style.color="#28B463";
  document.getElementById('inclExclLabel').innerHTML="Price GST Excl.";
  inclExclGSTFLag = 0;
  calculateExclGSTValue();
})





/* these updatefromtextbox() functions is very useful. If any user wants to enter the principal amount manually 
  into the text box, then these functions would update the slider and the textbox accordingly. 
*/

//------------------------------ Value updates from text Box----------------------------------------------------

/* for all the function below if value in text box is empty or not according to the rules 
  then system will show alert and will revert the text box value to the existing value by 
  accessing the old slider value.
*/
function updateValueFromProdPriceTextBox(){
  var textBox = document.getElementById('productPriceTextBox');
  var slider = document.getElementById('prodPriceSlider');
  productPriceGlobal = parseInt(textBox.value);

  if (textBox.value == ""){
    alert("Product/Services Price can't be Empty");
    updateProdPriceValue(slider.value);
  }
  else if (isNaN(productPriceGlobal)){
    alert("Product/Services charge must be a valid Number");
    updateProdPriceValue(slider.value);
  }
  else if (productPriceGlobal < 300){
    alert("Product/Services Price is not supported");
    updateProdPriceValue(slider.value);
  }
  else if (productPriceGlobal > 500000){
    alert("Product/Services Price is not supported");
    updateProdPriceValue(slider.value);
  }
  else{
    document.getElementById("prodPriceSlider").value = productPriceGlobal;
    document.getElementById("productPriceTextBox").value ='₹ amount'.replace('amount', productPriceGlobal); 
    
    if (inclExclGSTFLag) calculateInclGSTValue();
    else calculateExclGSTValue();
  }
}

// when principal text box is clicked to enter value , existing value is cleared.

document.getElementById("productPriceTextBox").addEventListener("click", function () {
  document.getElementById("productPriceTextBox").value = "";
});

//------------------------- Value updates from Range Slider----------------------------------------------------

function updateProdPriceValue(prodPriceAmnt) {
  document.getElementById('productPriceTextBox').value='₹ amount'.replace('amount', prodPriceAmnt); 

  productPriceGlobal = parseInt(prodPriceAmnt);
  
  if (inclExclGSTFLag) calculateInclGSTValue();
  else calculateExclGSTValue();
}

// As we can only have few GST% ad per govt. so input through text box for this field is
// not allowed. Only can be seleted through sliding the range slider.

function updateGSTRateValue(selectedSliderGSTRateValue) {
  var GSTRateTextBox = document.getElementById('GSTrateTextBox');
  
  if (selectedSliderGSTRateValue>=0 && selectedSliderGSTRateValue<=4)
    GSTRateTextBox.value = 0.25;
  else if (selectedSliderGSTRateValue>=5 && selectedSliderGSTRateValue<10)
    GSTRateTextBox.value = 3;
  else if (selectedSliderGSTRateValue>=10 && selectedSliderGSTRateValue<15)
    GSTRateTextBox.value = 5;
  else if (selectedSliderGSTRateValue>=15 && selectedSliderGSTRateValue<20)
    GSTRateTextBox.value = 12;
  else if (selectedSliderGSTRateValue>=20 && selectedSliderGSTRateValue<25)
    GSTRateTextBox.value = 18;
  else if (selectedSliderGSTRateValue>=25 && selectedSliderGSTRateValue<30)
    GSTRateTextBox.value = 28;

  document.getElementById('GSTrateTextBox').value='amount %'.replace('amount', GSTRateTextBox.value); 
  GSTRateGlobal = parseFloat(GSTRateTextBox.value);

  if (inclExclGSTFLag) calculateInclGSTValue();
  else calculateExclGSTValue();
}



function displayResult(GSTAmountRs,prodAmountWihoutGST,cgst,sgst){
  document.getElementById('gstAmount').innerHTML = GSTAmountRs.toLocaleString("en-IN", {style:"currency", currency:"INR",maximumFractionDigits:2});
  document.getElementById('prodAmount').innerHTML = prodAmountWihoutGST.toLocaleString("en-IN", {style:"currency", currency:"INR",maximumFractionDigits:2});
  document.getElementById('cgstAmount').innerHTML = cgst.toLocaleString("en-IN", {style:"currency", currency:"INR",maximumFractionDigits:2});
  document.getElementById('sgstAmount').innerHTML = sgst.toLocaleString("en-IN", {style:"currency", currency:"INR",maximumFractionDigits:2});
}

// Formula: GST amount Rs. = orig. cost - [orig. cost * {100/(100+GST%)}]
//                                                           term2
//                                                    term1
function calculateInclGSTValue(){

  var term2 = 100/(100+GSTRateGlobal);
  //console.log("term2 ",term2);

  var term1 = productPriceGlobal * term2;
  //console.log("term1 ",term1);
  // results fields calculation

  var GSTAmountRs = productPriceGlobal - term1;
  //console.log("GST ",GSTAmountRs);
  var prodAmountWihoutGST = productPriceGlobal - GSTAmountRs;
  var cgst = GSTAmountRs/2;
  var sgst = GSTAmountRs/2;

  displayResult(GSTAmountRs,prodAmountWihoutGST,cgst,sgst);
  drawDonutGraph(prodAmountWihoutGST,cgst,sgst);
}


function calculateExclGSTValue(){

  // results fields calculation

  var GSTAmountRs = productPriceGlobal * (GSTRateGlobal/100);
  //console.log("GST ",GSTAmountRs);
  var prodAmountWithGST = productPriceGlobal + GSTAmountRs;
  var cgst = GSTAmountRs/2;
  var sgst = GSTAmountRs/2;

  displayResult(GSTAmountRs,prodAmountWithGST,cgst,sgst);
  drawDonutGraph(prodAmountWithGST,cgst,sgst);
}


// by default on window load we will calculate including GST, so we trigger calculateInclGST()
// with a click on window load.

window.onload = function() {
  productPriceGlobal = 25000;
  GSTRateGlobal = 12;

  document.getElementById('incl').click();
  
  // setting initial values into the text Values.
  document.getElementById('productPriceTextBox').value = '₹ amount'.replace('amount', productPriceGlobal); 
  document.getElementById('GSTrateTextBox').value = 'amount %'.replace('amount', GSTRateGlobal); 
};


// donut graph
function drawDonutGraph(prodAmountWihoutGST,cgst,sgst){
  const ctx = document.getElementById('myChart1');
  const myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
              labels: [
                'Product/Service Actual Price',
                'CGST',
                'SGST'
              ],
              datasets: [{
                label: 'EMI',
                data: [prodAmountWihoutGST,cgst,sgst],
                backgroundColor: ['rgb(236, 112, 99)','rgb(255, 205, 86)','rgb(130, 224, 170)'],
              }]
            },
      options: {
          title: {
            display: true,
            text: 'GST Chart'
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


https://www.chartjs.org/docs/latest/charts/doughnut.html#doughnut
https://www.chartjs.org/docs/latest/getting-started/usage.html
https://tobiasahlin.com/blog/chartjs-charts-to-get-you-started/
*/