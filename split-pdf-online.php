<?php include 'header.php';
session_start();
//echo(session_id());
?>

<!DOCTYPE  html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Split PDF Online For Free</title>

    <meta name="description" content="Split PDF into pages for free online with this split PDF tool. Split PDF by page while preserving the highest quality of each page of the PDF converted from the original doc."/>

    <meta name="keywords" content="split pdf,split pdf pages,split pdf to pages,split pdf into pages,to separate pdf pages,split pdf online,split pdf into multiple files,split pdf online free,split pdf pages free,split pdf for mac,pdf split ,split pdf free">

    <link rel="stylesheet" href="css/splitPDFOnline.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>


<body>
  <div id="headSplitPDF" class="heading">
    <h1>Split PDF file into single PDF Docs</h1>
  </div>

  <p id="seoContent"> 
    Split pdf into multiple files instantly while preserving the best quality for each of the page.
  </p>
  <div id="formWrapper" class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
              <div class="float-left"><strong>Please select PDF here</strong> </div>
              <div class="float-right"><strong>V 1.1 </strong> app</div>
          </div>

          <div class="card-body card-block">
              <form id="multipleImgForm" name="mulImagesForm" action="handlers/handleSplitPDFOnline.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <div class="row form-group">
                      <div class="col-12 col-md-12">
                          <div class="control-group" id="fields">
                              <label class="control-label" for="field1">
                                  Upload single PDF file
                              </label>
                              <div class="controls">
                                  <div class="entry input-group upload-input-group">
                                      <input id="mulImages" class="form-control" name="pdfDoc" type="file" multiple= "multiple" required>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <p id="silentMsg">
     Only PDF format is supported.You can convert bulk images to PDF <a href="convertJPGtoPDF.php">here</a> directly from our tools itself.
  </p>

  <br>
  <br>

  <!-- Progress bar -->

  <div id="wrapper">
    <h1 id="head">Combining your PDF's into a single PDF Doc</h1>
    <div id="myProgress">
      <div id="myBar">10%</div>
    </div>
    <br>
  </div>
        
  <!-- end -->

  <!-- gif loading image -->

  <div id = "resultImage">
    <img src = "assets/completed1.gif" height="250px" width="200px">
    
    <p>
      * Cute isn't it ? So are we. <br> 
      Your download will start automatically in 10 secs !!<br>
      
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Please Note!</strong> For your security zip has been encrypted. Extract zip to use its content :) 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    </p>

  </div>

  <!-- end of gif image -->

  <button id="splitPDF" class="btn">Split PDF</button>
  <button id="splitMorePDF" class="btn" >Split More PDFs</button>

  <!-- This btn is for tetsing purpose only , submits the form directly without progress or gif loading image. Unhide this when debugging -->
  <button id="debug" class="btn" onclick="debugSubmit()" hidden>Debug Test</button>  

  <!-- Actual form submit occurs here,which is hidden and clicked by JS -->
  <button id="hiddenFormSubmitBtn" hidden>hiddenFormSubmit</button>

  <div id="seoContent" class="container">
    <br>
    <br>
    <hr>
    
    <h2>Split PDF Pages Online Free Features<br>(Split PDF Online)</h2>

    <br>

    <div class="row">
      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-comment-dollar"></i>
        <h3>Split PDF Into Multiple Files Free</h3>

        <p>
          This online tools can split pdf to multiple files (PDF) instantly under 10 seconds for free while preserving quality and resolution of each of the pages in the original PDF.     
        </p>

        <br>

      </div>

      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-person-digging"></i>
        <h3>Split PDF Online Free Easily</h3>

        <p>
          With just two clicks you can split PDF pages free online into high quality single PDF Docs under 10 seconds. Just click on the Split PDF button and let us do the rest of the hard work for you.      
        </p>

        <br>

      </div>

    </div>

    <div class="row">
      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-desktop"></i>
        <h3>Split PDF Pages Cross-Platform</h3>

        <p>
          This web-based PDF split application works on every platform and OS you can think of. Be it Windows, Mac, Linux or Android this app works perfectly everywhere so you can split PDF for Mac, Windows for free online.
        </p>

        <br>

      </div>

      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-shield-halved"></i>
        <h3>Security Enhanced PDF split </h3>

        <p>
          For users content on the Internet our application uses highly encrypted techniques to split PDF to pages. And delivers the converted images in a encrypted zipped folder which needs to be extracted first for better security of user data.      
        </p>

        <br>

      </div>

    </div>

    <div class="row">
      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-route"></i>
        <h3>Split PDF On The Way</h3>

        <p>
          Doesn't matter wherever you are or whichever device you are using. Our split PDF into pages online free tool is available 24*7 in the web for you to use. Split PDF while you commute, Walk, in office, in College etc.
        </p>

        <br>

      </div>

      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-file-zipper"></i>
        <h3>Extract High Quality PDF</h3>

        <p>
          This web based split PDF into pages online tool for free uses complex algorithm to preserve the quality of the converted PDF document quality. You can extract all of the high quality single PDF docs from the Zip folder at once. No need to convert individually.
        </p>

        <br>

      </div>

      <hr>
      <br>

    </div>

    <div class="row">
      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-person-chalkboard"></i>
        <h3>How to split PDF into multiple files( PDFs ) ?</h3>

        <p>
          <strong>Step 1:</strong>
          Select the PDF file in the form which you want to split in this split PDF tool online.
        </p>

        <p>
          <strong>Step 2:</strong>
          Click on split PDF for free button and the PDF will upload automatically.
        </p>

        <p>
          <strong>Step 3:</strong>
          Wait for 10 seconds and let the application work to separate pdf pages free to split PDF by page.
        </p>

        <p>
          <strong>Step 4:</strong>
          After 10 seconds your splitted PDF download will begin automatically.
        </p>

        <br>
        <hr>
        <br>

      </div>

    </div>

    <div class="row">
      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-hand-holding-heart"></i>
        <h3>Why our split PDF online application is Free ?</h3>

        <br>

        <p>
          As you all know split PDF pages and all application of these type are not free at all. They have a daily limit on the number of PDF you can split. They offer unlimited PDF split in exchange of a monthly payment. 
        </p>

        <p>
          We understand the need of these applications for school and university students who cant afford to pay high prices for these applications. So, we made our application free of cost with unlimited PDF split.
        </p>

        <p>
          If you are reading this please make sure you disable the adblocker when you use the application. Because only through ads revenue it is possible to build such application for free for you.
        </p>

        <p>
          At the same time please view and click the ads to support us. Have a good day. Wish you all the best.
        </p>

        <br>

      </div>

    </div>
  </div>


  <script src="js/splitPDFOnline.js"></script>

</body>

<?php include 'footer.php';?>

</html>


