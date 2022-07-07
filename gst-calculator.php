<?php include 'header.php';?>

<!DOCTYPE  html>
<html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>abc</title>
      <link rel="stylesheet" href="css/gst-calculator.css">

  </head>


  <body>

  <div class="container">
    <br>
    <h1 id="SIPheading">Online GST Calculator</h1>
    <br>     
    <div id="main-content" class="row">
      <div id="section1" class="col-sm-6">

        <label for="incl" class="form-label">GST Mode&nbsp&nbsp</label>
        <button id="incl" class="btn btn-outline-success">GST Inclusive</button>
        <button id="excl" class="btn btn-outline-success">GST Exclusive</button>
        <br><br>

        <label id="inclExclLabel" for="customRange3" class="form-label">Price GST Incl.</label>
        <input type="text" id="productPriceTextBox" onfocusout="updateValueFromProdPriceTextBox()">
        <input type="range" class="form-range" min="0" max="500000" step="1000" id="prodPriceSlider" value="25000" onchange="updateProdPriceValue(this.value);">

        <label for="customRange3" class="form-label">GST Rate ( in % )</label>
        <input type="text" id="GSTrateTextBox" readonly>
        <input type="range" class="form-range" min="0" max="28" step="1" id="rateSlider" value="16" onchange="updateGSTRateValue(this.value);">

        <p class="notice">
          * <i>GST Rate is given as per the rates of the Government.</i>
        </p> 
        <br>

        <div class="container-fluid">
          <div id="child1">
            <p>
              GST Amount
            </p>

            <p>
              Product/Service Amount
            </p>

            <p>
              CGST
            </p>

            <p>
              SGST
            </p>
          </div>

          <div id="child2">
            <p id="gstAmount">
              Amount 1
            </p>

            <p id="prodAmount">
              Amount 2
            </p>

            <p id="cgstAmount">
              Amount 3
            </p>

            <p id="sgstAmount">
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

        

    <div id="section3">

      <canvas id="myChart2" width="50px" height="25px"></canvas>   

    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="js/gst-calculator.js"></script>

  </body>

<?php include 'footer.php';?>

</html>


  