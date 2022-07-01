<?php include 'header.php';?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/handleCompressImage.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">


        <title>Compressing Image</title>
    </head>

    <body>
        <!-- Progress bar -->

        <div id="wrapper">
          <h1 id="head">Compressing Image</h1>
          <div id="myProgress">
            <div id="myBar">10%</div>
          </div>
          <br>
        </div>
        
        <!-- end -->

        <?php 
            function compressImage($source, $destination, $quality) { 
                $imgInfo = getimagesize($source); 
                $mime = $imgInfo['mime']; 

                switch($mime){ 
                    case 'image/jpeg': 
                        $image = imagecreatefromjpeg($source); 
                        break; 
                    case 'image/png': 
                        $image = imagecreatefrompng($source); 
                        break; 
                    case 'image/gif': 
                        $image = imagecreatefromgif($source); 
                        break; 
                    default: 
                        $image = imagecreatefromjpeg($source); 
                }                  
                $test= imagejpeg($image,$destination, $quality); 
                return $destination; 
            } 
             

            $uploadPath = "upload/"; 
            $status = $statusMsg = ''; 

            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $status = 'error'; 
                if(!empty($_FILES["image"]["name"])) { 
                    
                    $fileName = basename($_FILES["image"]["name"]); 
                    $imageUploadPath = $uploadPath.$fileName; 
                    $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
                     
                    $allowTypes = array('jpg','jpeg','png','gif'); 
                    if(in_array($fileType, $allowTypes)){ 
                        $imageTemp = $_FILES["image"]["tmp_name"]; 
                        $imageSize = $_FILES["image"]["size"];

                        $compressedImage = compressImage($imageTemp, $imageUploadPath,65); 
                         
                        if($compressedImage){ 
                            $compressedImageSize = filesize($compressedImage);
                            $status = 'success'; 
                            $statusMsg = "Image compressed successfully."; 
                        }
                        else{ 
                            $status = 'fail'; 
                            $statusMsg = "Image compression failed!"; 
                        } 
                    }else{ 
                        $status = 'fail'; 
                        $statusMsg = 'Sorry, only Image files are allowed to upload.'; 
                    } 
                }
            } 
        ?>



        <div id="result" style="display: none;">
             <?php
             if ($status=="fail") 
                echo "<div class=\"alert alert-danger\"><strong>Sorry! </strong>".$statusMsg."</div>";  
             ?>

             <?php if(!empty($compressedImage)){ ?>
             

             <?php
             if ($status=="success") 
                echo "<div class=\"alert alert-success\"><strong>Success! </strong>".$statusMsg."</div>"; 
             ?>

             <img id="cmprsdImg" src="<?php echo $compressedImage; ?>" height=25% width=25%>
             
             <br>
             <br>
             
            <a href="<?php echo $compressedImage; ?>" download>
                <button id="download">
                    Download Image
                </button>
            </a> 

             <?php } ?>

             <br>

            <!--Start of table data -->

            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Image Properties</th>
                    <th>Image Values</th>
                  </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Image Name</td>
                        <td><?php echo ($_FILES[image][name]) ?></td>
                    </tr>
                    <tr>
                        <td>Original Image Type</td>
                        <td><?php echo (strtoupper($_FILES[image][type])); ?></td>
                    </tr>
                    <tr>
                        <td>Compressed Image Type</td>
                        <td><?php echo (strtoupper($fileType)); ?></td>
                    </tr>
                    <tr>
                        <td>Original Image Size</td>
                        <td><?php echo ($imageSize/1000)." KB"; ?></td>
                    </tr>
                    <tr>
                        <td>Compressed Image Size</td>
                        <td><?php echo ($compressedImageSize/1000)." KB"; ?></td>
                    </tr>
                </tbody>

            </table>

            <!--table end -->

            <a href="compressDash.php">
                <button id="download">Compress Another</button>
            </a>
        </div>


        <script src="../js/handleCompressImage.js"></script>

    </body>
</html>


<?php include 'footer.php';?>
