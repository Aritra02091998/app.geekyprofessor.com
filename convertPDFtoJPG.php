<?php include 'header.php';
session_start();    
//echo session_id();
?>

<!DOCTYPE  html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>PDF to JPG converter</title>

    <meta name="description" content="Convert PDF to JPG online for free in just under 5 seconds with this online PDF converter in a highly encrypted way without compromising your data on the Internet."/>

    <meta name="keywords" content="convert pdf to jpg,to convert pdf to jpg,convert from pdf to jpg,convert for pdf to jpg,convert from pdf to jpg free,convert pdf to jpg for free,convert pdf to jpg mac,how to convert pdf to jpg windows,online converter for pdf to jpg,convert pdf to jpg online,convert pdf to jpg download">
    
    <link rel="stylesheet" href="css/convertPDFtoJPG.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>


<body>

  <div class="heading">
    <h1>Convert PDF To JPG Online Free</h1>
  </div>

  <div class="container">

    <p style="color:#616A6B;font-family: 'PT Sans', sans-serif;margin: 0 auto;">
      The fastest online web application for quickly converting PDFs to high-quality JPG photos. Simply upload your file and let us do the hard work.
    </p>

    <br>

    <div class="drag-area">
      <div class="icon"><i class="fa-solid fa-file-pdf"></i></div>
      <header>Drag & Drop to Upload File</header>
      <span>OR</span>
      <button>Browse File</button>
      <form name="pdfUpload" id="pdfForm" method="post" action="handlers/handleConvertPDFtoJPG.php" enctype="multipart/form-data">
        <input id="imgField" name="pdfDoc" type="file" hidden>
      </form>
    </div>
  </div>

  <!-- Progress bar -->

  <div id="wrapper">
    <h1 id="head">Converting PDF into JPG Images </h1>
    <div id="myProgress">
      <div id="myBar">10%</div>
    </div>
    <br>
  </div>
        
  <!-- end -->


  <div id = "resultImage">
    <img src = "assets/completed1.gif" height="250px" width="200px">
    <p>
      * Cute isn't it? So we are. <br> 
      Your download will start automatically in 6 secs !!<br>
    </p>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Please Note!</strong> Large files can take upto 1 minutes. Stay Strong :) 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

  </div>

  

  <br>
  <button class = "btn" id="compress">Convert To JPG</button>    
  <button class = "btn" id="redirect">Convert Another PDF</button>


  <!-- Actual form submit occurs here,which is hidden and clicked by JS -->
  <button id="hiddenFormSubmitBtn" hidden>hiddenFormSubmit</button>

  <br>
  <br>
  <br>
  
  <div id="seoContent" class="container">
    
    <hr>
    
    <h2>Convert PDF to JPG Online Features<br>(Online Converter for PDF to JPG)</h2>

    <br>

    <div class="row">
      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-comment-dollar"></i>
        <h3>Convert from PDF to JPG free</h3>

        <p>
          This PDF to JPG conversion tool compresses and convert your PDF into high-quality images for free. You can use this Online tool to convert pdf to jpg for free for unlimited times.      
        </p>

        <br>

      </div>

      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-person-digging"></i>
        <h3>Convert PDF to JPG Easily</h3>

        <p>
          With just two clicks you can convert your PDF into high quality JPEG images under 10 seconds. Just click on the Convert To JPG button and let us do the rest of the hard work.      
        </p>

        <br>

      </div>

    </div>

    <div class="row">
      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-desktop"></i>
        <h3>Convert PDF to JPG Cross-Platform</h3>

        <p>
          This web-based PDF to JPG converter works on every platform and OS you can think of. Be it Windows, Mac, Linux or Android this app works swiftly so you can also convert PDF to JPG in mac, windows for free.
        </p>

        <br>

      </div>

      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-shield-halved"></i>
        <h3>Security Enhanced Conversion</h3>

        <p>
          For users content on the Internet our application uses highly encrypted techniques to convert PDF to JPG. And delivers the converted images in a zipped folder for better security of user data.      
        </p>

        <br>

      </div>

    </div>

    <div class="row">
      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-route"></i>
        <h3>Convert on the Way</h3>

        <p>
          Doesn't matter wherever you are or whichever device you are using. Our PDF to JPG online converter is available 24*7 in the web for you to use. Convert while you commute, Walk, in office, in College etc.
        </p>

        <br>

      </div>

      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-file-zipper"></i>
        <h3>Extract High Quality JPG</h3>

        <p>
          This web based Online PDF to JPG converter for free uses complex algorithm to preserve the converted JPG images quality. You can extract all of the high quality images from the Zip folder at once. No need to convert individually.
        </p>

        <br>

      </div>

      <hr>
      <br>

    </div>

    <div class="row">
      <div class="col-sm">
        <i id="seoIcon" class="fa-solid fa-person-chalkboard"></i>
        <h3>How to convert PDF to JPG ?</h3>

        <p>
          <strong>Step 1:</strong>
          Drag and Drop the PDF file or Click on the Browse button to select the file.
        </p>

        <p>
          <strong>Step 2:</strong>
          Click on Convert to JPG button and the PDF will upload automatically.
        </p>

        <p>
          <strong>Step 3:</strong>
          Wait for 10 seconds and let the PDF to JPG Free converter convert your PDF file.
        </p>

        <p>
          <strong>Step 4:</strong>
          After 10 seconds your Download will begin automatically.
        </p>

        <br>

      </div>

    </div>



  </div>

  <script src="js/convertPDFtoJPG.js"></script>

</body>

<?php include 'footer.php';?>

</html>


<!--

  https://getbootstrap.com/docs/4.1/layout/grid/

-->