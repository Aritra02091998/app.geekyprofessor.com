<?php include 'header.php';?>

<!DOCTYPE  html>
<html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Free GST Calculator Online India With CGST-SGST Charts</title>

      <meta name="description" content="Free GST Calculator Online India With CGST-SGST Distribution Charts. Only GST calculator online for free shows you the distribution of your money spent into actual Goods/Service price, GST in Rupees, SGST and CGST."/>

      <meta name="keywords" content="GST Calculator Online, GST calculator, GST calculator India, calculator GST India, GST calculator formula, GST calculator online India,GST calculator inclusive">
      
      <link rel="stylesheet" href="css/gst-calculator.css">

  </head>


  <body>

    <div class="container">
      <br>
      <h1 id="SIPheading">GST Calculator Online India</h1>
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
          <p id="seoContent">
            Typically, the GST rates are high for luxuries and low for necessities. The GST rate for different commodities and services in India is separated into four brackets: 5% GST, 12% GST, 18% GST, and 28% GST. For your convenience we also included the GST rate 0.25% for rough diamonds and 3% for Gold, Silver. 
          </p>
          <br>

        </div>

      </div>
    </div>

    <br><br>

    <div id="seoContent" class="container">
      <div class="row">
        <div class="col">
          <h2>What is GST ?</h2>

          <p>
            The indirect tax imposed on the provision of goods and services is known as the "Goods and Services Tax," or GST. With effect from July 1, 2017, GST replaced all indirect taxes in India as a single system of taxation. The GST Act was passed by the central government during the 2017 budget session and was accepted by the Parliament on March 29, 2017. The Central Excise Duty, VAT, Entry Tax, and Octroi were only a few of the indirect taxes that were eliminated.
          </p>

          <p>
            The country imposes a comprehensive tax known as GST on the production, sale, and consumption of goods and services. To register under GST regulation, various small and large enterprises must have a GST Identification Number. The Integrated GST is applied to all sales transactions that take place between states (inter-state). Additionally, both Central GST and State GST are assessed on any intrastate sales.
          </p>
          <br>

        </div>
      </div>

      <div class="row">
        <div class="col">
          <h2>What is GST in India and its different forms ? </h2>

          <p>Different forms of GST collected by the government are:</p>

          <p>
            <p><b>State GST (SGST):</b> It is collected by State Government<p>

            <p><b>Central GST (CGST):</b> It is collected by Central Government<p>

            <p><b>Integrated GST (IGST):</b> It is collected by Central Government for inter-state transactions and imports<p>

            <p><b>Union Territory GST (UTGST):</b> It is collected by Union Territory Government<p>
          </p>
          <br>  

        </div>
      </div>

      <div class="row">
        <div class="col">
          <h2>How is GST calculated ? </h2>

          <p>
            The unified taxation system has made it possible for taxpayers to understand the tax imposed at multiple points for different goods and services under the GST regime. The taxpayer should be aware of the individual categories' respective GST rates in order to calculate the GST. 5 percent, 12 percent, 18 percent, and 28 percent are the various GST slabs.
          </p>

          <p>
            A straightforward example can help to demonstrate how to calculate GST:
          </p>

          <p>
            If a goods or services is sold at Rs. 2,000 and the GST rate applicable is 18%, then the net price calculated will be = 2,000 + (2,000X(18/100)) = Rs. 2,360.00.
          </p>       
          <br>

        </div>
      </div>

      <div class="row">
        <div class="col">
          <h2>What is GST calculator India ?</h2>

          <p>
            A GST calculator online in India is an calculator through which any tax-payers can check their GST amount associated with the goods/ services he or she purchased from a GST registered business owner. A GST calculator online follows the standard formula and government GST slabs (GST rates) to calculate the GST amount of any goods/services. 
          </p>
          <br>

        </div>
      </div>

      <div class="row">
        <div class="col">
          <h2>How to use our GST Calculation Tool ?</h2>

          <p>
            We at Geekyprofessor Apps provide taxpayers with a dedicated and expert GST Calculator tool that makes calculating GST simple. Our tool is available for free online to taxpayers who want to calculate GST using the differential GST rate.
          </p>

          <p>
            Please find the steps below to calculate GST online using our GST calculator online Tool
          </p>

          <p><strong>Step 1:</strong>
            Select if you want to calculate GST Inclusive amount or GST Exclusive Amount from the Green buttons above.
          </p>

          <p><strong>Step 2:</strong>
            Slide the bar or enter the Product Price manually into the text box to calculate GST online.
          </p>

          <p><strong>Step 3:</strong>
            Select the GST Rate anywhere between 0.3% to 28% and the see the GST calculation result.
          </p>

          <p><strong>Step 4:</strong>
            See the result our GST calculator online, you can see Net Product Price, Net GST added in Rupees, CGST, SGST. Look at the graph to get more insights about GST calculation Online.
          </p>

          <br>

        </div>
      </div>

      <div class="row">
        <div class="col">
          <h2>What are GST taxes ? </h2>

          <p>
            GST taxes Slabs(Percentage of GST in India) are 0% (necessity items like milk, wheat flour), 0.25% (rough diamonds), 3%  (gold, silver etc.), 5 percent, 12 percent, 18 percent, and 28 percent are the various GST Tax slabs.
          </p>
          <br>

        </div>
      </div>

      <div class="row">
        <div class="col">
          <h2>What is GST Calculation Formula ? </h2>

          <p>
            For calculating GST through our GST calculator online, a taxpayer can use the below mentioned formula :
          </p>

          <p>
            <b>GST Excluding Calculation Formula</b>
            <p>
              Add GST <br>
              GST Amount = ( Original Cost * GST% ) / 100 <br>
              Net Price = Original Cost + GST Amount
            </p>
          </p>
          <p>
            <b>GST Including Calculation Formula</b>
            <p>
              Remove GST <br>
              GST Amount = Original Cost – (Original Cost * (100 / (100 + GST% ) ) ) <br>
              Net Price = Original Cost – GST Amount
            </p>
          </p>
          <br>

        </div>
      </div>

      <div class="row">
        <div class="col">
          <h2>What is GST Inclusive amount ?</h2>

          <p>
            GST Inclusive amount as you can see in our GST calculator online India above, is the price of the product(goods) or service(s) in which the GST tax is already included.
          </p>
          <br>

        </div>
      </div>

      <div class="row">
        <div class="col">
          <h2>What is GST Exclusive amount ?</h2>

          <p>
            GST Exclusive amount as you can see in our GST calculator online India above, is the price of the product(goods) or service(s) in which the GST tax is not included and are calculated on the net price of the goods.
          </p>
          <p>Using our GST calculator online you can calculate both the amount quickly.</p>
          <br>

        </div>
      </div>

      <div class="row">
        <div class="col">
          <h2>How to make calculation of GST in case of reverse charge ?</h2>

          <p>
            The calculation will be the same in the case of reverse charge as well. For instance, you may be compelled to pay GST on reverse charge at the rate of 18% because you purchased items from someone for Rs. 5,000. As a result, you must pay Rs. 900 in GST on the reversal charge (5,000 x 18 percent ). CGST and SGST of Rs. 450 each must be paid if they are to be assessed.
          </p>
          <br>
          
        </div>
      </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="js/gst-calculator.js"></script>

  </body>

<?php include 'footer.php';?>

</html>


  