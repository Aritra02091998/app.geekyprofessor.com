<?php include 'header.php';
session_start();
echo(session_id());
?>

<!DOCTYPE  html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag & Drop or Browse: File Upload | CodingNepal</title>
    <link rel="stylesheet" href="css/splitPDF.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
</head>


<body>
  <div id="headSplitPDF" class="heading">
    <h1>Split your PDF file into single PDF Docs</h1>
  </div>


  <div id="formWrapper" class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
              <div class="float-left"><strong>Please select PDF here</strong> </div>
              <div class="float-right"><strong>V 1.1 </strong> app</div>
          </div>

          <div class="card-body card-block">
              <form id="multipleImgForm" name="mulImagesForm" action="handlers/handleSplitPDF.php" method="post" enctype="multipart/form-data" class="form-horizontal">
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
      * Watch Me Walking <br> 
      Your download will start automatically !!<br>
      
      <p style="color:#E74C3C">
        * For your security on Internet the zip is encrypted.<br>
         Please Extract the zip file to open individual PDFs.
      </p>

    </p>

  </div>

  <!-- end of gif image -->

  <button id="splitPDF" class="btn">Split PDF</button>
  <button id="splitMorePDF" class="btn" >Split More PDFs</button>

  <!-- This btn is for tetsing purpose only , submits the form directly without progress or gif loading image. Unhide this when debugging -->
  <button id="debug" class="btn" onclick="debugSubmit()" hidden>Debug Test</button>  

  <!-- Actual form submit occurs here,which is hidden and clicked by JS -->
  <button id="hiddenFormSubmitBtn" hidden>hiddenFormSubmit</button>


  <script src="js/splitPDF.js"></script>

</body>

<?php include 'footer.php';?>

</html>


