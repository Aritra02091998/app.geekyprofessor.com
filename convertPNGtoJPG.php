<?php include 'header.php';?>

<!DOCTYPE  html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag & Drop or Browse: File Upload | CodingNepal</title>
    <link rel="stylesheet" href="css/convertPNGtoJPG.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>


<body>
  <div class="heading">
    <h1>Convert PNG To JPG</h1>
  </div>
  <div class="drag-area">
    <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
    <header>Drag & Drop to Upload File</header>
    <span>OR</span>
    <button>Browse File</button>
    <form name="imgUpload" id="imageForm" method="post" action="handlers/handleConvertPNGtoJPG.php" enctype="multipart/form-data">
      <input id="imgField" name="image" type="file" hidden>
    </form>
  </div>


  <br>
  <button id="compress">Convert To JPG</button>

  <script src="js/convertPNGtoJPG.js"></script>

</body>

<?php include 'footer.php';?>

</html>


