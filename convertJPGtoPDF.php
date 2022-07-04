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
    <link rel="stylesheet" href="css/convertJPGtoPDF.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
</head>


<body>
  <div class="heading">
    <h1>Convert JPG's To PDF Online Free</h1>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
              <div class="float-left"><strong>Please select Images here</strong> </div>
              <div class="float-right"><strong>V 1.1 </strong> app</div>
          </div>

          <div class="card-body card-block">
              <form id="multipleImgForm" name="mulImagesForm" action="handlers/handleConvertJPGtoPDF.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <div class="row form-group">
                      <div class="col-12 col-md-12">
                          <div class="control-group" id="fields">
                              <label class="control-label" for="field1">
                                  Upload one or more jpg files
                              </label>
                              <div class="controls">
                                  <div class="entry input-group upload-input-group">
                                      <input id="mulImages" class="form-control" name="image[]" type="file" multiple= "multiple" required>
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
    Preferred Image format is JPG,JPEG. Upload same resolution Images to get best results. You can convert images to JPG <a href="convertPNGtoJPG.php">here</a> directly from our tools itself.
  </p>

  <br>
  <br>
  <button id="convert">Generate PDF</button>

  <script src="js/convertJPGtoPDF.js"></script>

</body>

<?php include 'footer.php';?>

</html>


