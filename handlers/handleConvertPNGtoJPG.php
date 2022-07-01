<?php include 'headerHandlersCopy.php';?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/handleConvertPNGtoJPG.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">


        <title>Compressing Image</title>
    </head>

    <body>
        <!-- Progress bar -->

        <div id="wrapper">
            <h1 id="head1">Compressing Image</h1>
            <h1 id="head2">Converting Image</h1>
            <div id="myProgress">
                <div id="myBar">10%</div>
            </div>
            <br>
        </div>
        
        <!-- end -->

        <?php 
      
            //code to display errors.
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
                $filenameWithoutExt=basename($_FILES["image"]["name"],'png');

                $ext = pathinfo($filenameWithExt, PATHINFO_EXTENSION);

                if ($ext == "png"){
                    $imgCurrLocation = $_FILES["image"]["tmp_name"];
                    $imgStoreLocation = $uploadPath.$filenameWithoutExt;

                    $imgToBePrinted = convertImage($imgCurrLocation,$imgStoreLocation,50);

                    if($imgToBePrinted){
                        $convertedImgSize = filesize($imgToBePrinted);
                        $status = "success"; 
                        $statusMsg = "Image Converted successfully."; 
                    }
                    else{
                        $status = "failed"; 
                        $statusMsg = "Image Convesion Failed ! Please Try Another Image."; 
                    }
                }
                else{
                    $status = "failed"; 
                    $statusMsg = "Please upload PNG file Only."; 
                }
            }
            function convertImage($source, $destination, $quality) { 
                $filePath = $source;
                $image = imagecreatefrompng($filePath);
                $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
                imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
                imagealphablending($bg, TRUE);
                imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                imagedestroy($image); 

                // image should be saved and returned with .jpeg extension in the upload directory. Otherwise it will have no extension and will gnrt error.

                imagejpeg($bg, $destination.'jpeg', $quality);
                imagedestroy($bg); 
                return ($destination.'jpeg');
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

            <?php if(!empty($imgToBePrinted)){ 
                if ($status=="success") 
                    echo "<div class=\"alert alert-success\"><strong>Success! </strong>".$statusMsg."</div>"; 
                    echo "<p id=\"statusFlag\">1</p>";
                ?>

                <img id="cmprsdImg" src="<?php echo $imgToBePrinted; ?>" height=25% width=25%>
                 
                <br>
                <br>
                
                <p id="silentMsg">
                    <i>
                        Your Download will start Automatically ....
                        <br>
                        Click on the below link if its not started after 5 seconds.
                    </i>
                </p>


                <a href="<?php echo $imgToBePrinted; ?>" download>
                    <button id="download">
                        Download JPEG Image
                    </button>
                </a> 
            <?php } ?>

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
                        <td><?php echo (strtoupper(pathinfo($imgToBePrinted, PATHINFO_EXTENSION))) ?></td>
                    </tr>
                    <tr>
                        <td>Original Image Size</td>
                        <td><?php echo ($_FILES["image"]["size"]/1000)." KB"; ?></td>
                    </tr>
                    <tr>
                        <td>Compressed Image Size</td>
                        <td><?php echo ($convertedImgSize/1000)." KB"; ?></td>
                    </tr>
                </tbody>

            </table>

            <!--table end -->

            <a href="../convertPNGtoJPG.php">
                <button id="download">Convert Another Image</button>
            </a>


            <!-- This hidden btn will be clicked automatically by JS to download the image after 5 seconds of the page load.-->

            <a href="<?php echo $imgToBePrinted; ?>" download>
                <button id="hiddenBtnForAutoDwnld" style="display: none;">
                    Download Auto test
                </button>
            </a>

        </div>


        <script src="../js/handleConvertPNGtoJPG.js"></script>

    </body>
</html>

<?php include 'footerHandlersCopy.php';?>



<!-- Ref: 

https://stackoverflow.com/questions/1201798/use-php-to-convert-png-to-jpg-with-compression


-->
