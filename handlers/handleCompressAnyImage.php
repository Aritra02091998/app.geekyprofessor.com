<?php include 'headerHandlersCopy.php';?>

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
            
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL); 

            if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
                header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
                die( header( 'location: /error.php' ) );
            }     

            if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                $uploadPath = "../upload/"; 
                $filenameWithExt=$_FILES["image"]["name"];
                $ext = pathinfo($filenameWithExt, PATHINFO_EXTENSION);

                if ($ext == "png")
                    $filenameWithoutExt=basename($_FILES["image"]["name"],'png');
                if ($ext == "jpg")
                    $filenameWithoutExt=basename($_FILES["image"]["name"],'jpg');
                if ($ext == "jpeg")
                    $filenameWithoutExt=basename($_FILES["image"]["name"],'jpeg');
                if ($ext == "gif")
                    $filenameWithoutExt=basename($_FILES["image"]["name"],'gif');

                $allowTypes = array('jpg','jpeg','png','gif'); 

                if(in_array($ext, $allowTypes)){ 
                    $imgCurrLocation = $_FILES["image"]["tmp_name"]; 
                    $imgStoreLocation = $uploadPath.$filenameWithoutExt;

                    $compressedImagePath = compressImage($imgCurrLocation,$imgStoreLocation,65);

                    if($compressedImagePath){
                        $origImgSize = ($_FILES['image']['size'])/1000; 
                        $compressedImgSize = filesize($compressedImagePath)/1000;
                        $compressedImgType = pathinfo($compressedImagePath, PATHINFO_EXTENSION);
                        $status = 'success'; 
                        $statusMsg = "Image Compressed Successfully."; 
                    }
                    else{ 
                        $status = 'failed'; 
                        $statusMsg = "Image Compression Failed!"; 
                    } 
                }else{ 
                    $status = 'failed'; 
                    $statusMsg = 'Sorry, only Image files under 20 MB are allowed to upload or, Image is corrupted.'; 
                } 
            }

            function compressImage($source, $destination, $quality) { 
                
                $mime = $_FILES['image']['type'];
                switch($mime){ 
                    case 'image/jpeg': 
                        $image = imagecreatefromjpeg($source);
                        imagejpeg($image,$destination.'jpeg', $quality); 
                        imagedestroy($image);
                        return ($destination.'jpeg'); 
                        break; 
                    case 'image/png': 
                        $image = imagecreatefrompng($source); 
                        // because png max-quality is 9 , above that it will gnrt error.
                        imagepng($image,$destination.'png', 5);
                        imagedestroy($image);
                        return ($destination.'png'); 
                        break; 
                    case 'image/gif': 
                        $image = imagecreatefromgif($source); 
                        imagegif($image,$destination.'gif', $quality); 
                        imagedestroy($image);
                        return ($destination.'gif'); 
                        break; 
                    
                }   
            } 
             
        ?>



        <div id="result" style="display: none;">
            <?php
                if ($status=="failed"){ 
                    echo "
                        <div class=\"alert alert-danger\">
                            <strong>Sorry! </strong>".$statusMsg."
                        </div>";
                    echo "<p id=\"statusFlag\">0</p>";
                    echo "
                        <div id=\"errorImage\">
                            <img src=\"../assets/invalidExtension.jpg\" height=30% width=30%>
                        </div>";
                }  

            ?>

            <?php if($status == "success"){ 
                    echo "<div class=\"alert alert-success\"><strong>Success! </strong>".$statusMsg."</div>"; 
                    echo "<p id=\"statusFlag\">1</p>";
                ?>

                <img id="cmprsdImg" src="<?php echo $compressedImagePath; ?>" height=25% width=25%>
                 
                <br>
                <br>
                
                <p id="silentMsg">
                    <i>
                        * Your Download will start Automatically ....
                        <br>
                        Click on the below link if its not started after 5 seconds.
                    </i>
                </p>


                <a href="<?php echo $compressedImagePath; ?>" download>
                    <button id="download">
                        Download Compressed Image
                    </button>
                </a> 

            <br>

            <!--Start of table data -->

            <table id="resultTable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Image Properties</th>
                    <th>Image Values</th>
                  </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Image Name</td>
                        <td><?php echo ($_FILES["image"]["name"]) ?></td>
                    </tr>
                    <tr>
                        <td>Uploaded Image Type</td>
                        <td><?php echo (strtoupper($_FILES["image"]["type"])) ?></td>
                    </tr>
                    <tr>
                        <td>Converted Image Type</td>
                        <td><?php echo (strtoupper($compressedImgType)) ?></td>
                    </tr>
                    <tr>
                        <td>Original Image Size</td>
                        <td><?php echo ($origImgSize)." KB"; ?></td>
                    </tr>
                    <tr>
                        <td>Compressed Image Size</td>
                        <td><?php echo ($compressedImgSize)." KB"; ?></td>
                    </tr>
                </tbody>

            </table>

            <!--table end -->

            <!-- This hidden btn will be clicked automatically by JS to download the image after 5 seconds of the page load.-->

            <a href="<?php echo $compressedImagePath; ?>" download>
                <button id="hiddenBtnForAutoDwnld" style="display: none;">
                    Download Auto test
                </button>
            </a>

        </div>
        <?php } ?>

        <a href="../compressAnyImage.php">
            <button id="download">Compress Another Image</button>
        </a>


        <script src="../js/handleCompressImage.js"></script>

    </body>
</html>


<?php include 'footerHandlersCopy.php';?>
