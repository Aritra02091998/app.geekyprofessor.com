<?php include 'header.php';?>

<!DOCTYPE  html>
<html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>abc</title>
      <link rel="stylesheet" href="css/loan-emi-calculator.css">

  </head>


  <body>

  <div class="container">
    <br>
    <h1 id="SIPheading">Online EMI Calculator</h1>
    <br>     
    <div id="main-content" class="row">

      <div id="section1" class="col-sm-6">
        <label for="customRange3" class="form-label">Loan Amount</label>
        <input type="text" id="principalTextBox" onfocusout="updateValueFromPrincipalTextBox()">
        <input type="range" class="form-range" min="90000" max="9000000" step="1000" id="principalSlider" value="100000" onchange="updatePrincipalValue(this.value);">

        <label for="customRange3" class="form-label">Rate of Interest ( p.a )</label>
        <input type="text" id="rateOfInterestTextBox" onfocusout="updateValueFromRateOfInterestTextBox()">
        <input type="range" class="form-range" min="1" max="30" step="0.1" id="rateSlider" value="6.5" onchange="updateRateOfInterest(this.value);">

        <label for="customRange3" class="form-label">Loan Tenure</label>
        <input type="text" id="loanTenureTextBox" onfocusout="updateValueFromLoanTenureTextBox()">
        <input type="range" class="form-range" min="1" max="30" step="1" id="loanTenureSlider" value="5" onchange="updateLoanTenure(this.value);">

        <br><br><br>

        <div class="container-fluid">
          <div id="child1">
            <p>
              Monthly EMI Amount
            </p>

            <p>
              Principal Amount
            </p>

            <p>
              Total Interest
            </p>

            <p>
              Total Amount Payable
            </p>
          </div>

          <div id="child2">
            <p id="montlyEMI">
              Amount 1
            </p>

            <p id="principalAmount">
              Amount 2
            </p>

            <p id="totInterest">
              Amount 3
            </p>

            <p id="totAmountPayable">
              Amount 4
            </p>

          </div>
        </div>
        
      </div>

      <div id="section2" class="col-sm-6">

        <canvas id="myChart1" width="300px" height="150px"></canvas>   
        <br><br>
      </div>

    </div>
  </div>

  <br><br>
  
  <div class="container">

        <p class="notice">
          * To undestand how the Interest Rate would increase your Net Amount to be paid for repayment, fix a Principal and Rate and then gradually increase the Loan Tenure and observe the Graph.
        </p> 

    <div id="section3">

      <canvas id="myChart2" width="50px" height="25px"></canvas>   

    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="js/loan-emi-calculator.js"></script>

  </body>

<?php include 'footer.php';?>

</html>


  