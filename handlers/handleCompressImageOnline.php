<?php include '../header.php';?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/handleCompressImage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">


        <title>Compressing Image Online - JPG, JPEG, GIF and PNG</title>
    </head>

    <body>
        <!-- Progress bar -->

        <div id="wrapper">
          <h1 id="head">Compressing Image </h1>
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
                        imagepng($image,$destination.'png', 7);
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
                
                <a target="_blank" href="<?php echo $compressedImagePath; ?>">
                    <img id="cmprsdImg" src="<?php echo $compressedImagePath; ?>" height=25% width=25%>
                </a>

                <p id="silentMsg">Click to Enlarge</p>              
                 
                <br>
                
                <p id="silentMsg">   
                    * Your Download will start Automatically ....
                    <br>
                    Click on the below link if its not started after 8 seconds.
                </p>


                <a href="<?php echo $compressedImagePath; ?>" download>
                    <button id="download">
                        Download Compressed Image
                    </button>
                </a>

                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="text-align: center;">
                    <strong>Please Note!</strong> Large Images (>20 MB) can take upto 1 minute to compress. Stay Strong :) 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>

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

        <a href="../compress-image-online.php">
            <button id="download">Compress Another Image</button>
        </a>

        <div id="seoContent" class="container">
            <br>
            <hr>
            
            <h2>Compress Image Online Features<br>(JPEG Image Compresser Online)</h2>

            <br>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-comment-dollar"></i>
                <h3 id="seoHeader">Compress Images Free Online</h3>

                <p>
                  This online JPEG, PNG, GIF Image Compresser application can compress JPEG, PNG, GIF images for free instantly under 5 seconds while preserving the highest possible quality and resolution of each images from the original uploaded file.     
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-person-digging"></i>
                <h3 id="seoHeader">Compress Images Easily</h3>

                <p>
                  With just two clicks you can compress image size of JPEG, JPG, PNG, GIF online for free into high quality image for your Blog/Website or for online form fill up under 5 seconds. Just click on the Compress Image online button and let us do the rest of the hard work for you.      
                </p>

                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-desktop"></i>
                <h3 id="seoHeader">Image Compresser Cross-Platform</h3>

                <p>
                  This web-based Compress Image Online application works on every platform and OS you can think of. Be it Windows, Mac, Linux or Android this application works perfectly everywhere so you can compress image JPEG, PNG format from uploaded image in Mac, Windows, iphone instantly.
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-shield-halved"></i>
                <h3 id="seoHeader">Security Enhanced Image Compresser </h3>

                <p>
                  We might be poor at design but never at security. For users content on the Internet our application uses highly encrypted techniques to compress image without losing quality. And delivers the compressed image in a secure file. User images is never stored in our server, it gets deleted after sometime as user exits.
                </p>

                <br>

              </div>

            </div>  

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-route"></i>
                <h3 id="seoHeader">Compress Image File On the Go</h3>

                <p>
                  Doesn't matter wherever you are or whichever device you are using. Our free JPEG, PNG, GIF image compresser online application is available 24*7 in the web for you to use. Compress images of any format (JPG, JPEG, PNG, GIF) while you commute, Walk, in office, in College etc.
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-file-zipper"></i>
                <h3 id="seoHeader">Compress Image Online High Quality</h3>

                <p>
                  This web based free JPEG image compresser application uses complex algorithm to preserve the quality of the uploaded images while being compressed into the lower image size online. Because we know how quality images matter for your website and blogs. You can get the high quality compressed images instantly. 
                </p>

                <br>

              </div>

              <hr>
              <br>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-person-chalkboard"></i>
                <h3 id="seoHeader">How to Compress an Image ? | How to Compress Image Size in Mobile ?</h3>

                <br>

                <p>
                  <strong>Step 1:</strong>
                  Select the image file in the upload box above, which you want to compress image online in this jpeg image compresser application online.
                </p>

                <p>
                  <strong>Step 2:</strong>
                  Click on Compress Image online for free button and the images will upload automatically.
                </p>

                <p>
                  <strong>Step 3:</strong>
                  Wait for 10 seconds and let the application work to compress image online for free.
                </p>

                <p>
                  <strong>Step 4:</strong>
                  After 10 seconds your compressed JPEG image online download will begin automatically.
                </p>

                <br>
                <hr>
                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-circle-exclamation"></i>
                <h3 id="seoHeader">Why is image compression important ?</h3>

                <br>

                <p>
                  1. A compressed image is smaller in size. As a result, your memory card can carry either 10 raw (uncompressed) photographs or 100 compressed images (numbers out of air here). You get more for your money when you buy a memory card.
                </p>

                <p>  
                  2. When viewing a picture from the Internet on a mobile phone, you may need to wait 5 seconds for a raw image or 1 second for a compressed image. This improves the user experience while also lowering the cost of your data plan.
                </p>

                <p>
                  3. Another reason why you might need to compress images is while filling up a registration form of any Organisation or University who have a certain restriction on the size of image that can be uploaded. In this case also you need to compress image online to be able to submit the form successfully.
                </p>

                <br>
                <hr>
                <br>

              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-circle-question"></i>
                <h3 id="seoHeader">What is JPEG Image Extensions ?</h3>

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
                <i id="seoIcon" class="fa-brands fa-apple"></i>
                <h3 id="seoHeader">How To convert PNG to JPG Images MAC / iPhone ? | How to Compress Image Size in Laptop ?</h3>

                <br>

                <p>
                  <strong>Step 1:</strong>
                  Open any Internet Browser to compress image online for free.
                </p>

                <p>
                  <strong>Step 2:</strong>
                  Visit the site apps.geekyprofessor.com
                </p>

                <p>
                  <strong>Step 3:</strong>
                  Navigate to the "Compress Image Online" section and click it.
                </p>

                <p>
                  <strong>Step 4:</strong>
                  Now you can upload image files here to compress image into JPEG image files for free.
                </p>

                <br>
                <hr>
                <br>

              </div>

            </div>



            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-hand-holding-heart"></i>
                <h3 id="seoHeader">Why our Compress Image Online Application is Free ?</h3>

                <br>

                <p>
                  As you all know Image Compresser free online and all other Image Compresser application of these type are not free at all. They have a daily limit on the number of images you can compress to other formats like JPG,WebP. They offer unlimited Image compression of image files in exchange of a monthly payment. 
                </p>

                <p>
                  At geekyprofessor apps we understand the need of these applications for school and university students who cant afford to pay high prices for these applications. So, we made our image compresser application free of cost with unlimited JPEG image compressing free online.
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

        <script src="../js/handleCompressImage.js"></script>

    </body>
</html>


<?php include "../footer.php";?>
