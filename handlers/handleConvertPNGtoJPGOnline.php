<?php include '../header.php';?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/handleConvertPNGtoJPG.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <title>Converting to PNG to JPG</title>

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

                    $imgToBePrinted = convertImage($imgCurrLocation,$imgStoreLocation,95);

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

                <img id="cmprsdImg" src="<?php echo $imgToBePrinted; ?>" height=280px width=500px>
                
                <br>

                <p id="silentMsg">
                    Image Preview. Click to Enlarge.<br><br>
                    Your Download will start Automatically ....<br>
                    Click on the below link if its not started after 5 seconds.
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
                        <td>PNG Image Size</td>
                        <td><?php echo ($_FILES["image"]["size"]/1000)." KB"; ?></td>
                    </tr>
                    <tr>
                        <td>JPEG Image Size</td>
                        <td><?php echo ($convertedImgSize/1000)." KB"; ?></td>
                    </tr>
                </tbody>

            </table>

            <!--table end -->

            <a href="../png-to-jpg-online.php">
                <button id="download">Convert Another Image</button>
            </a>


            <!-- This hidden btn will be clicked automatically by JS to download the image after 5 seconds of the page load.-->

            <a href="<?php echo $imgToBePrinted; ?>" download>
                <button id="hiddenBtnForAutoDwnld" style="display: none;">
                    Download Auto test
                </button>
            </a>

        </div>

        <!-- start of SEO content -->
        <div id="seoContent" class="container">
            <br>
            <hr>
            
            <h2>Convert to PNG to JPG Online Features<br>(PNG to JPG Converter)</h2>

            <br>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-comment-dollar"></i>
                <h3>Free PNG to JPG Converter</h3>

                <p>
                  This online PNG to JPG Converter application can convert PNG to JPG format for free instantly under 5 seconds while preserving the highest possible quality and resolution of each JPEG image from the original PNG file.     
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-person-digging"></i>
                <h3>Convert PNG to JPG Easily</h3>

                <p>
                  With just two clicks you can convert PNG to JPEG online for free into high quality JPEG Image for your Blog or Website under 5 seconds. Just click on the Convert to JPEG button and let us do the rest of the hard work for you.      
                </p>

                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-desktop"></i>
                <h3>PNG to JPG Converter Cross-Platform</h3>

                <p>
                  This web-based PNG to JPG converter application works on every platform and OS you can think of. Be it Windows, Mac, Linux or Android this application works perfectly everywhere so you can convert to JPEG format from PNG image online free PNG to JPG Mac, Windows, PNG to JPG iphone instantly.
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-shield-halved"></i>
                <h3>Security Enhanced PNG to JPG Conversion</h3>

                <p>
                  For users content on the Internet our application uses highly encrypted techniques for converting PNG to JPG images. And delivers the converted JPEG image in a secure file. User images is never stored in our server, it gets deleted after sometime as user exits.
                </p>

                <br>

              </div>

            </div>  

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-route"></i>
                <h3>Convert PNG to JPG On the Go</h3>

                <p>
                  Doesn't matter wherever you are or whichever device you are using. Our PNG to JPG Online converter (converter to JPEG )free online application is available 24*7 in the web for you to use. Convert PNG to JPG images while you commute, Walk, in office, in College etc.
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-file-zipper"></i>
                <h3>High Quality PNG to JPEG Images</h3>

                <p>
                  This web based free PNG to JPG converter application uses complex algorithm to preserve the quality of the PNG images being converted into the JPEG images online. Because we know how quality images matter for your website and blogs. You can get the high quality JPEG images instantly. 
                </p>

                <br>

              </div>

              <hr>
              <br>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-person-chalkboard"></i>
                <h3>How to use PNG to JPG Converter ?</h3>

                <br>

                <p>
                  <strong>Step 1:</strong>
                  Select the PNG image file in the upload box above which you want to convert into JPEG in this PNG to JPG converter application online.
                </p>

                <p>
                  <strong>Step 2:</strong>
                  Click on Generate JPEG Image for free button and the images will upload automatically.
                </p>

                <p>
                  <strong>Step 3:</strong>
                  Wait for 10 seconds and let the application work to convert PNG to JPEG for free.
                </p>

                <p>
                  <strong>Step 4:</strong>
                  After 10 seconds your converted JPEG image online download will begin automatically.
                </p>

                <br>
                <hr>
                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-circle-question"></i>
                <h3>What is JPEG Image Extensions ?</h3>

                <br>

                <p>
                  JPEG is an abbreviation for "Joint Photographic Experts Group," which is also the name of the body that developed it.<br>

                  JPEG is the most widely used digital camera format. Furthermore, the majority of photographs we view on the internet today are JPEGs.<br>

                  JPEGs are divided into two types: Exif (for digital cameras) and JFIF (for storing and transferring).
                </p>

                <p>
                  JPEG files are among the most ubiquitous and commonly used image formats. JPEG files, which use lossy compression, assist reduce the overall size of your image files without affecting image quality. JPEG is the ideal file type to use when publishing photos to the web or sharing photos with others.        
                </p>

                <br>
                <hr>
                <br>

              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-down-left-and-up-right-to-center"></i>
                <h3>Difference Between JPG and JPEG Images ?</h3>

                <br>

                <p>
                  JPEG and JPG are both file types that stand for "Joint Photographic Experts Group." JPG is a file extension that originated on early Windows machines that only allowed for a three-letter extension name. Although the JPEG file extension is more typically found on current computers, some individuals still refer to these files as JPG.        
                </p>

                <br>
                <hr>
                <br>

              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-brands fa-apple"></i>
                <h3>How To convert PNG to JPG Images MAC / iPhone ?</h3>

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
                  Navigate to the "Convert PNG to JPEG" section and click it.
                </p>

                <p>
                  <strong>Step 4:</strong>
                  Now you can upload PNG image files here to convert into JPEG image files for free.
                </p>

                <br>
                <hr>
                <br>

              </div>

            </div>



            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-hand-holding-heart"></i>
                <h3>Why our PNG to JPG Converter Online Application is Free ?</h3>

                <br>

                <p>
                  As you all know PNG to JPG Converter free online and all other Image conversion application of these type are not free at all. They have a daily limit on the number of PNG images you can convert to other formats like JPG,WebP. They offer unlimited conversion from PNG to JPG files in exchange of a monthly payment. 
                </p>

                <p>
                  At geekyprofessor apps we understand the need of these applications for school and university students who cant afford to pay high prices for these applications. So, we made our application free of cost with unlimited PNG to JPG conversion free online.
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
        <!-- end o SEO content-->

        <script src="../js/handleConvertPNGtoJPG.js"></script>
    </body>
</html>

<?php include '../footer.php';?>



<!-- Ref: 

https://stackoverflow.com/questions/1201798/use-php-to-convert-png-to-jpg-with-compression


-->
