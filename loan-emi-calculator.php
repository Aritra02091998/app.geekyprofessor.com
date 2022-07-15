<?php include 'header.php';?>

<!DOCTYPE  html>
<html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Free Online EMI calculator for Home loans & Personal Loans.</title>

      <meta name="description" content="Calculate your EMI with online EMI Calculator for Home loans & Personal Loans for absolutely free. Geekyprofessor App's EMI calculator 100% accurately calculates the EMI."/>

      <meta name="keywords" content="emi calculator home loan,emi calculator for home loans,emi calculator personal loan,emi calculator online,Online EMI calculator,emi calculator for personal loan sbi,emi calculator for home loan hdfc,emi calculator sbi home loan,Geekyprofessor optimisation,Geekyprofessor apps">

      <link rel="stylesheet" href="css/loan-emi-calculator.css">

  </head>


  <body>
  <br>

  <div id="background" class="container">
    <br>
    <h1 id="SIPheading">Online EMI calculator for Home loans & Personal Loans.</h1>

    <p id="seoContent" style="font-size:20px">
      There are some life milestones that determine our progress and success. Purchasing your dream home is a significant milestone. Having a place to call one's own is a source of pride and fulfillment. So,We have come up with the best home loan EMI calculator through which you can plan your dream of buying a home.
    </p>

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

        <div id="results" class="container">
          <div class="row">
            <div class="col col-lg-8">
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

            <div class="col">
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
        
      </div>

      <div id="section2" class="col-sm-6">

        <canvas id="myChart1" width="55" height="35px"></canvas> 
        <br>
        <p id="seoContent">
          For example, if you borrow Rs.10,00,000 from the bank at 6.5% annual interest for a period of 5 years then Monthly EMI = 10,00,000 * 0.00541 * (1 + 0.00541)60 / ((1 + 0.00541)60 - 1) = Rs.1957. i.e. you will have to pay Rs.1957 for 60 months to repay the entire loan amount. The total amount payable will be Rs.1,17,397 that includes Rs.17,397 as interest toward the loan.
        </p>  
        
      </div>

    </div>
  </div>

  <br><br>
  
  <div class="container">

        <p class="notice">
          * To undestand how the Interest in Rupees would increase your Net Amount to be paid for repayment, fix a Principal and Rate and then gradually increase the Loan Tenure and observe the Graph.
        </p> 

    <div id="section3">

      <canvas id="myChart2" width="50px" height="25px"></canvas>   

      <br>
      
      <p id="seoContent">
        This Line Graph of this Online EMI calculator will show you a clear cut growth of Interest in Rupees and Total Amount to be paid back to the bank with respect to the increase of Load Tenure.
      </p>

      <br><br>

    </div>
  </div>

  <div id="seoContent" class="container">
    <div class="row">
      <div class="col">
        <h2>What is EMI ?</h2>

        <p>
          Equated Monthly Installment, or EMI for short, is the sum due to the bank or other financial institution each month until the loan balance is completely repaid. It includes a portion of the principal that needs to be repaid as well as the loan's interest. The duration, or number of months, during which the loan must be repaid, is determined by dividing the sum of the principal and interest. Monthly payments are required for this sum. The interest portion of the EMI would initially be higher and subsequently shrink with each payment. The interest rate determines the precise portion devoted to principal repayment.
        </p>

        <p>
          While the amount of principal and interest components in your monthly EMI payment won't alter, it will over time. You'll put more money toward the principal and less toward interest with each additional payment.
        </p>
        <br>

      </div>
    </div>

    <div class="row">
      <div class="col">
        <h2>How to Use our Online EMI calculator for home loans ? </h2>

        <p>
          Our Online EMI Calculator for home loan is quick, simple to use, and intuitive to grasp with colourful charts and instant results. Using this Online EMI calculator, you may determine the EMI for a home loan, personal loan, education loan, or any other fully amortising loan.
        </p>

        <p>
          Please find the steps below to calculate EMI online using our online EMI calculator Tool.
        </p>

        <p><strong>Step 1:</strong>
          Slide the Loan Amount bar or enter the Loan amount( Principal ) manually into the text box to calculate EMI online.
        </p>

        <p><strong>Step 2:</strong>
          Slide the Rate of Interest bar or enter the ROI ( Percentage )manually into the text box to calculate EMI online in India.
        </p>

        <p><strong>Step 3:</strong>
          Slide the Loan Tenure bar or enter the Loan Tenure ( Loan Period ) manually into the text box to calculate EMI online in India.
        </p>

        <p><strong>Step 4:</strong>
          See the result instantly in our EMI calculator online for home loan, you can see Monthly EMI installment, Total Interest and Total Amount you need to payback to the bank. Look at the graph to get more insights about GST calculation Online.
        </p>

        <p><strong>Step 5:</strong>
          Look at the chart and graph below to get more insights about your EMI calculation Online and how the amount payable to the bank changes with the increase Loan Tenure or Interest Rate.
        </p>

        <p>
          Adjust the values in our Online EMI calculator form using the slider. You can manually type the values in the aforementioned boxes if you need to enter more exact values. The EMI calculator will update your monthly payment (EMI) amount as soon as the settings are modified using the slider (or after putting the values straight into the input fields click outside the box).
        </p>

        <p>This Online EMI calculator works for all scenarios either its for Personal loan EMI calculator or Home loan EMI calculator </p>

        <br>  

      </div>
    </div>

    <div class="row">
      <div class="col">
        <h2>How Online EMI calculator calculate EMI accurately ?</h2>

        <p>
          As every other Online EMI calculator on the Internet our EMI calculator for Home loans uses a specific formula to calculate your EMI, Net payback to the bank.
        </p>

        <p>
          <strong>
            EMI = [Px Rx (1+R) ^N]/ [(1+R) (N-1)] ,  where
          </strong>
        </p>

        <p>
          <strong>P</strong> is the principal amount.<br>
        </p>

        <p>
          <strong>R</strong> is the rate of interest.<br>
        </p>

        <p>
          <strong>N</strong> is the loan tenure.<br>
        </p>

        <br>

      </div>
    </div>

    <div class="row">
      <div class="col">
        <h2>Consider Floating Rate EMI In Calculation </h2>

        <p>
          We advise you to compute the floating or variable rate EMI by taking into account two opposing situations, namely the optimistic (deflationary) and pessimistic (inflationary) scenarios. You are going to choose how much money you need to borrow and how long your loan term should be. Loan amount and loan tenure are two factors needed to compute the EMI. However, banks and HFCs choose interest rates based on the rates and guidelines set by the RBI. You should compute your EMI as a borrower taking into account the two extreme scenarios of an increase and a drop in the interest rate.
        </p>

        <p><strong>Optimistic( Deflationary ) Case:</strong>
          Assume that the interest rate decreases from its current level by 1% to 3%. Calculate your EMI taking this circumstance into account. Your EMI will decrease in this case, or you might choose to reduce the loan's term. For instance, a positive situation allows you to compare buying a house as an investment with other investment alternatives.
        </p>

        <p><strong>Pessimistic( Inflationary ) Case:</strong>
          Assume that the interest rate is increased by 1% to 3% in a similar manner. Do you think you'll be able to keep making EMI payments without too much difficulty? Your monthly payment for the duration of the loan could significantly increase with even a 2% increase in the interest rate.
        </p>

        <p>
          Your planning and instant online EMI calculation for such potential future events is aided by such a computation. When you take out a loan, you're committing to a certain amount of money for the upcoming months, years, or decades. Think on the best and worst case scenarios, and prepare for both. In other words, expect the best while preparing for the worse!
        </p>

              
        <br>

      </div>
    </div>

    <div class="row">
      <div class="col">
        <h2>How can an Online EMI calculator for home loans help you ?</h2>

        <p>
          A EMI calculator online in India is an calculator through which any customer can check their monthly EMI to be paid back to the bank or HFC along with the Interest instantly. 
        </p>

        <p>
          This online EMI calculator for home loans enables you to calculate your EMI amount accurately and make the necessary financial plans. Keeping your debt-to-income ratio below 50% will increase the likelihood that your loan application will be approved.
        </p>

        <p>
          A Home loan EMI calculator can help you save time. You are not need to perform difficult calculations manually, which can be quite frustrating.
        </p>

        <p>
          It removes the possibility of error, giving you an accurate estimate every time. Also, this EMI calculator for home loan gives you much better insights with charts and line graphs for your clarity. This online EMI calculator is highly tailored to each form of loan. A home loan's EMI structure differs from that of a personal loan.
        </p>


        <br>

      </div>
    </div>

    <div class="row">
      <div class="col">
        <h2>What are Advantages of using Geekyprofessor App's Online EMI calculator ?</h2>

        <p>
          It is completely free of charge. Anyone, at any time, can use it as many times as they wish.        
        </p>

        <p>
          Our online loan calculator is always 100 percent accurate.
        </p>

        <p>
          It's quick and gives you an accurate estimate right away.        
        </p>

        <p>
          Geekyprofessor App, in addition to the loan EMI calculator, provides the other calculators like SIP, GST calculators you can find them below. They are all free to use and can be used as many times as you wish.
        </p>

        <br>

      </div>
    </div>

    <div class="row">
      <div class="col">
        <h2>What are other Home loan EMI calculator online ?</h2>

        <p>
          1. EMI calculator sbi home loan.<br>
          2. EMI calculator for home loan HDFC.<br>
          3. EMI calculator personal loan HDFC.<br>
          4. EMI calculator for personal loan SBI.<br>
        </p>

        <br>

      </div>
    </div>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="js/loan-emi-calculator.js"></script>

  </body>

<?php include 'footer.php';?>

</html>


  