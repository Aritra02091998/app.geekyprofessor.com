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
    <link rel="stylesheet" href="css/convertPDFtoJPG.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>


<body>

  <div class="heading">
    <h1>Convert PDF To JPG Online Free</h1>
  </div>

  <br>

  <div class="container">
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
    <h1 id="head">Converting your PDF into JPG Images </h1>
    <div id="myProgress">
      <div id="myBar">10%</div>
    </div>
    <br>
  </div>
        
  <!-- end -->


  <div id = "resultImage">
    <img src = "assets/completed1.gif" height="250px" width="200px">
    <p>
      * Watch Me Walking <br> 
      Your download will start automatically !!<br>
      Please extract Your Zip after download.
    </p>
  </div>



  <br>
  <button class = "btn" id="compress">Convert To JPG</button>    
  <button class = "btn" id="redirect">Convert Another PDF</button>


  <!-- Actual form submit occurs here,which is hidden and clicked by JS -->
  <button id="hiddenFormSubmitBtn" hidden>hiddenFormSubmit</button>


  <script src="js/convertPDFtoJPG.js"></script>

</body>

<?php include 'footer.php';?>

</html>


