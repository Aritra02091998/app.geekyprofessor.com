<?php include 'header.php';?>

<!DOCTYPE  html>
<html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>abc</title>
      <link rel="stylesheet" href="css/sip-calculator.css">

  </head>


  <body>

  <div class="container">
    <br>
    <h1 id="SIPheading">Online SIP Calculator</h1>
    <br>     
    <div id="main-content" class="row">

      <div id="section1" class="col-sm-6">
        <label for="customRange3" class="form-label">Investment Amount</label>
        <input type="text" id="invstValueTextBox" readonly>
        <input type="range" class="form-range" min="500" max="100000" step="500" id="rangeSlider" value="2000" onchange="updateInvstValue(this.value);">

        <label for="customRange3" class="form-label">Expected Return %</label>
        <input type="text" id="expectedReturnTextBox" readonly>
        <input type="range" class="form-range" min="1" max="30" step="1" id="rangeSlider" value="12" onchange="updateReturnPercentage(this.value);">

        <label for="customRange3" class="form-label">Period (In Year)</label>
        <input type="text" id="timeTextBox" readonly>
        <input type="range" class="form-range" min="1" max="30" step="1" id="rangeSlider" value="2" onchange="updateTimePeriod(this.value);">

        <br><br><br>

        <div class="container-fluid">
          <div id="child1">
            <p>
              Invested Amount
            </p>

            <p>
              Est. Returns
            </p>

            <p>
              Total Value of SIP
            </p>
          </div>

          <div id="child2">
            <p id="invstAmnt">
              Amount 1
            </p>

            <p id="estReturns">
              Amount 2
            </p>

            <p id="totVal">
              Amount 3
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
          * To undestand the compounding effect of SIPs after long term choose any Investment amount and Expected Return Percent above and increase the number of years gradually to see effect on the graph for your SIP values.
        </p> 

    <div id="section3">

      <canvas id="myChart2" width="50px" height="25px"></canvas>   

    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="js/sip-calculator.js"></script>

  </body>

<?php include 'footer.php';?>

</html>


  