<?php include 'headerHandlersCopy.php';?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/handleConvertJPGPNGtoWebP.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">



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

                $ext = pathinfo($filenameWithExt, PATHINFO_EXTENSION);

                if ($ext == "png")
                    $filenameWithoutExt=basename($_FILES["image"]["name"],'png');
                if ($ext == "jpg")
                    $filenameWithoutExt=basename($_FILES["image"]["name"],'jpg');
                if ($ext == "jpeg")
                    $filenameWithoutExt=basename($_FILES["image"]["name"],'jpeg');
                if ($ext == "gif")
                    $filenameWithoutExt=basename($_FILES["image"]["name"],'gif');

                
                if ($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif"){
                    $imgCurrLocation = $_FILES["image"]["tmp_name"];
                    $imgStoreLocation = $uploadPath.$filenameWithoutExt;

                    $imgToBePrinted = convertImage($imgCurrLocation,$imgStoreLocation,50,$ext);

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
                    $statusMsg = "Please upload Image files Only. Supported Formats are JPG, JPEG, PNG, GIF."; 
                }
            }
            function convertImage($source, $destination, $quality, $imageFormat) { 
                $filePath = $source;

                if ($imageFormat == "jpeg" || $imageFormat == "jpg")
                    $image = imagecreatefromjpeg($filePath);
                if ($imageFormat == "png")
                    $image = imagecreatefrompng($filePath);
                if ($imageFormat == "gif")
                    $image = imagecreatefromgif($filePath);
                imagepalettetotruecolor($image);


                // image should be saved and returned with .WebP extension in the upload directory. Otherwise it will have no extension and will gnrt error.

                imagewebp($image, $destination.'webp', $quality);
                imagedestroy($image); 
                return ($destination.'webp');
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

                <img id="cmprsdImg" src="<?php echo $imgToBePrinted; ?>" height=250px width=500px>

                <p id="silentMsg">Image Preview</p>

                <br>

                <p id="silentMsg"> Your download will begin shortly . . .</p> 
                
                <a href="<?php echo $imgToBePrinted; ?>" download>
                    <button id="download">
                        Download WebP Image
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

            <br>

            <!--table end -->

            <a href="../jpg-to-webp-online.php">
                <button id="download">Convert Another Image</button>
            </a>


            <!-- This hidden btn will be clicked automatically by JS to download the image after 5 seconds of the page load.-->

            <a href="<?php echo $imgToBePrinted; ?>" download>
                <button id="hiddenBtnForAutoDwnld" style="display: none;">
                    Download Auto test
                </button>
            </a>

        </div>

        <!--SEO content starts from here-->

        <div id="seoContent" class="container">
            <br>
            <hr>
            
            <h2>Free Convert JPG to WEBP Online Features<br>(from JPG,PNG,GIF to WebP)</h2>

            <br>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-comment-dollar"></i>
                <h3>JPG to Webp Converter Free</h3>

                <p>
                  This online PG to Webp Converter application can convert JPG,PNG,GIF to WebP format for free instantly under 5 seconds while preserving the highest possible quality and resolution of each JPEG image from the original file.     
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-person-digging"></i>
                <h3>Convert JPG to WebP Easily</h3>

                <p>
                  With just two clicks you can convert JPG to WebP online for free into high quality WebP Image for your Blog or Website under 5 seconds. Just click on the Convert to WebP button and let us do the rest of the hard work for you.      
                </p>

                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-desktop"></i>
                <h3>From JPG to WebP Cross-Platform</h3>

                <p>
                  This web-based JPG to WebP converter application works on every platform and OS you can think of. Be it Windows, Mac, Linux or Android this application works perfectly everywhere so you can convert to WebP format online free for Mac, Windows instantly.
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-shield-halved"></i>
                <h3>Security Enhanced JPG to WebP Conversion</h3>

                <p>
                  For users content on the Internet our application uses highly encrypted techniques for converting JPG to WebP images. And delivers the converted WebP image in a secure file. User images is never stored in our server, it gets deleted after sometime as user exits.
                </p>

                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-people-roof"></i>
                <h3>All Image Extension Supported</h3>

                <p>
                  Geekyprofessor apps converter to WebP application supports all image format to be converted into high qulity WebP images. It supports JPG, JPEG, PNG, GIF image extensions. Not many converter on Internet supports all these.
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-check-double"></i>
                <h3>Best WebP Converter</h3>

                <p>
                  Convert JPG to WebP online free with highest quality of WebP Images possible. The WebP image size may imcrease but we never compromise with the resolution of images. We understand the need of clarity while using WebP in sites.
                </p>

                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-route"></i>
                <h3>Convert JPG WebP On the Go</h3>

                <p>
                  Doesn't matter wherever you are or whichever device you are using. Our JPG to WebP converter (converter to WebP )free online application is available 24*7 in the web for you to use. Convert JPG to WebP images while you commute, Walk, in office, in College etc.
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-file-zipper"></i>
                <h3>High Quality JPEG to WebP Images</h3>

                <p>
                  This web based free JPG to WebP converter application uses complex algorithm to preserve the quality of the JPEG images being converted into the WebP images. Because we know how quality images matter for your websiteand blogs. You can get the high quality WebP images instantly. 
                </p>

                <br>

              </div>

              <hr>
              <br>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-person-chalkboard"></i>
                <h3>How to Convert JPG to WebP Online ?</h3>

                <br>

                <p>
                  <strong>Step 1:</strong>
                  Select the JPEG, PNG or GIF image file in the upload box above which you want to convert into WebP in this JPG to WebP converter application online.
                </p>

                <p>
                  <strong>Step 2:</strong>
                  Click on Generate WebP Image for free button and the images will upload automatically.
                </p>

                <p>
                  <strong>Step 3:</strong>
                  Wait for 10 seconds and let the application work to convert JPG to WebP for free.
                </p>

                <p>
                  <strong>Step 4:</strong>
                  After 10 seconds your converted WebP image online download will begin automatically.
                </p>

                <br>
                <hr>
                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-circle-question"></i>
                <h3>What is WebP Image Extensions ?</h3>

                <br>

                <p>
                  This is a new format for photographs on the Internet that offers lossless and loss compression quality. This format was created by Google expressly for doing work online as swiftly and conveniently as feasible. The key advantage is that its file size is minimal in comparison to other image formats, yet image quality is comparable.
                </p>

                <br>
                <hr>
                <br>

              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-down-left-and-up-right-to-center"></i>
                <h3>Why Convert to WebP Online ?</h3>

                <br>

                <p>
                  WebP often delivers 30% greater compression than JPEG and JPEG 2000 without sacrificing image quality. Simply told, WebP images are typically smaller than their equivalents while maintaining the same quality due to improved compression.
                </p>

                <br>
                <hr>
                <br>

              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-brands fa-apple"></i>
                <h3>How To convert JPG to WebP Images MAC</h3>

                <br>

                <p>
                  <strong>Step 1:</strong>
                  Open any Internert Browser to convert to WebP format for free.
                </p>

                <p>
                  <strong>Step 2:</strong>
                  Visit the site apps.geekyprofessor.com
                </p>

                <p>
                  <strong>Step 3:</strong>
                  Navigate to the "Convert Images to WebP" section and click it.
                </p>

                <p>
                  <strong>Step 4:</strong>
                  Now you can upload JPG,PNG or GIF image files here to convert into WebP image files for free.
                </p>

                <br>
                <hr>
                <br>

              </div>

            </div>



            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-hand-holding-heart"></i>
                <h3>Why our JPG to WebP converter Online Application is Free ?</h3>

                <br>

                <p>
                  As you all know JPG to WebP converter free online and all other Image conversion application of these type are not free at all. They have a daily limit on the number of JPEG image you can convert to other formats like WebP. They offer unlimited conversion from JPG to WebP files in exchange of a monthly payment. 
                </p>

                <p>
                  We understand the need of these applications for school and university students who cant afford to pay high prices for these applications. So, we made our application free of cost with unlimited JPG to WebP conversion free online.
                </p>

                <p>
                  If you are reading this please make sure you disable the adblocker when you use the application. Because only through ads revenue it is possible to build such an application for free for you.
                </p>

                <p>
                  At the same time please view and click the ads to support us. Have a good day. Wish you all the best.
                </p>

                <br>

              </div>

            </div>
        </div>

        <!--SEO content ends here-->


        <script src="../js/handleConvertJPGPNGtoWebP.js"></script>

    </body>
</html>

<?php include 'footerHandlersCopy.php';?>



<!-- Ref: 

https://stackoverflow.com/questions/1201798/use-php-to-convert-png-to-jpg-with-compression


-->
