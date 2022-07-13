<?php include '../header.php';
session_start();
//echo(session_id());
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/handleConvertJPGtoPDFOnline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">


        <script src="../js/handleConvertJPGtoPDFOnline.js"></script>


        <title>JPG to PDF Online Free</title>
    </head>

    <body>
        <!-- Progress bar -->

        <div id="wrapper">
            <h1 id="head1">Compressing Uploaded Images</h1>
            <h1 id="head2">Generating PDF</h1>
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
                
                $images = array();
                $totalImages =count($_FILES['image']['tmp_name']);
                $sessionID = session_id();
                $saveAddress = "../upload/pdfUploads/{$sessionID}combinedPDF-geekyprofessor-App.pdf";
                //echo($totalImages."<br>".$sessionID);


                for( $i=0 ; $i < $totalImages ; $i++ ) {
                    $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                    array_push($images, $tmpFilePath);
                }

                $pdf = new Imagick($images);
                $pdf->setImageFormat('pdf');
                try{
                    $pdf->writeImages($saveAddress, true); 
                    $status = 1;
                    $statusMsg = "Images successfully converted into PDF Doc.";
                }
                catch(Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                    $status = 0;
                    $statusMsg = "Error while preparing PDF.";

                }
                $pdfFileSize = (filesize($saveAddress)/1000);
                $tmpDownloadFile = file_get_contents($saveAddress);   

                # delete files of yesterday 
                
                $filesToBeDeleted = glob("../upload/pdfUploads/*"); 
                foreach($filesToBeDeleted as $file){ 
                    if( (is_file($file)) && ( (time()-filectime($file))>=86400 ) ) {
                    unlink($file); // delete file
                  }
                }
    
                # end of pdf file cleaning code 
            }
        ?>


        <div id="result" style="display: none;">
            <?php
                if ($status == 0){ 
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

            <?php if(!empty($saveAddress)){ 
                if ($status == 1) 
                    echo "<div class=\"alert alert-success\"><strong>Success! </strong>".$statusMsg."</div>"; 
                    echo "<p id=\"statusFlag\">1</p>";
                ?>

                
                <div id = "resultImage">
                    <img src = "../assets/completed1.gif" height="250px" width="200px">
                    <p>
                      * Cute isn't it? So are we. <br> 
                      Your download will start automatically !!<br>
                      All your Images have been merged to a single PDF Doc.
                    </p>
                </div>

                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="text-align: center;">
                    <strong>Please Note!</strong> Large Images can take upto 1 minute to get converted into PDF file. Stay Strong :) 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <a href="<?php echo $saveAddress; ?>" download>
                    <button id="download">
                        Download Generated PDF
                    </button>
                </a> 
            <?php } ?>

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
                        <td>Images Merged in PDF</td>
                        <td>
                            <?php 
                                for( $i=0 ; $i < $totalImages ; $i++ )
                                echo (($i+1).". ".$_FILES["image"]["name"][$i]."<br>"); 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Uploaded Image Type</td>
                        <td><?php echo (strtoupper($_FILES["image"]["type"][0])) ?></td>
                    </tr>
                    <tr>
                        <td>Converted Doc Type</td>
                        <td><?php echo (strtoupper(pathinfo($saveAddress, PATHINFO_EXTENSION))) ?></td>
                    </tr>
                    <tr>
                        <td>Converted Doc Size</td>
                        <td><?php echo ($pdfFileSize." KB" ) ?></td>
                    </tr>
                </tbody>

            </table>

            <!--table end -->
        </div>

        <a href="../jpg-to-pdf-online.php">
            <button id="download">Convert Another Set of Images</button>
        </a>


        <!-- This hidden btn will be clicked automatically by JS to download the image after 5 seconds of the page load.-->

        <a href="<?php echo $saveAddress; ?>" download>
            <button id="hiddenBtnForAutoDwnld" style="display: none;">
                Download Auto test
            </button>
        </a>

        <!--SEO content starts from here-->

        <div id="seoContent" class="container">
            <br>
            <hr>
            
            <h2>Free JPG to PDF Converter Online Features<br>(for JPG to PDF)</h2>

            <br>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-comment-dollar"></i>
                <h3 id="seoHeader">JPG to PDF Converter Free</h3>

                <p>
                  This online JPG to PDF converter application can convert JPG to PDF for free (PDF) instantly under 10 seconds while preserving the highest possible quality and resolution of each JPEG image from the original file.     
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-person-digging"></i>
                <h3 id="seoHeader">Convert JPG to PDF Easily</h3>

                <p>
                  With just two clicks you can convert JPG to PDF online for free into high quality single PDF Doc under 10 seconds. Just click on the Generate PDF button and let us do the rest of the hard work for you.      
                </p>

                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-desktop"></i>
                <h3 id="seoHeader">Convert JPG to PDF Cross-Platform</h3>

                <p>
                  This web-based JPG to PDF converter application works on every platform and OS you can think of. Be it Windows, Mac, Linux or Android this application works perfectly everywhere so you can convert JPG to PDF online free for Mac, Windows instantly.
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-shield-halved"></i>
                <h3 id="seoHeader">Security Enhanced JPG to PDF Online</h3>

                <p>
                  For users content on the Internet our application uses highly encrypted techniques to convert JPG to PDF files . And delivers the converted PDF in a secure PDF file. User data is never stored in our server, it gets deleted after sometime as user exits.
                </p>

                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-route"></i>
                <h3 id="seoHeader">Convert JPG to PDF On The Way</h3>

                <p>
                  Doesn't matter wherever you are or whichever device you are using. Our JPG to PDF converter free online application is available 24*7 in the web for you to use. Convert JPG to PDF files while you commute, Walk, in office, in College etc.
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-file-zipper"></i>
                <h3 id="seoHeader">Extract High Quality Converted PDF</h3>

                <p>
                  This web based free JPG to PDF converter application uses complex algorithm to preserve the quality of the JPEG images being converted into the PDF document. You can get the high quality single PDF doc converted into a single one instantly. Use same resolution JPEG images to get best results.
                </p>

                <br>

              </div>

              <hr>
              <br>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-person-chalkboard"></i>
                <h3 id="seoHeader">How to Convert JPG to PDF Online ? | How to Change JPG to PDF ?</h3>

                <br>

                <p>
                  <strong>Step 1:</strong>
                  Select the JPEG image files in the form above which you want to convert into PDF in this JPG to PDF converter application online.
                </p>

                <p>
                  <strong>Step 2:</strong>
                  Click on Generate PDF for free button and the images will upload automatically.
                </p>

                <p>
                  <strong>Step 3:</strong>
                  Wait for 10 seconds and let the application work to convert JPG to PDF for free.
                </p>

                <p>
                  <strong>Step 4:</strong>
                  After 10 seconds your converted PDF online download will begin automatically.
                </p>

                <br>
                <hr>
                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-brands fa-apple"></i>
                <h3 id="seoHeader">How To convert JPG to PDF Files MAC</h3>

                <br>

                <p>
                  <strong>Step 1:</strong>
                  Open any Internert Browser to merge PDF online for free.
                </p>

                <p>
                  <strong>Step 2:</strong>
                  Visit the site apps.geekyprofessor.com
                </p>

                <p>
                  <strong>Step 3:</strong>
                  Navigate to the "Convert Images to PDF" section and click it.
                </p>

                <p>
                  <strong>Step 4:</strong>
                  Now you can upload JPG or PNG image files here to convert into PDF files for free.
                </p>

                <br>
                <hr>
                <br>

              </div>

            </div>



            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-hand-holding-heart"></i>
                <h3 id="seoHeader">Why our JPG to PDF converter Online Application is Free ?</h3>

                <br>

                <p>
                  As you all know JPG to PDF converter free online and all other PDF creation application of these type are not free at all. They have a daily limit on the number of JPEG imahe you can convert to PDF. They offer unlimited conversion fromJPG to PDF files in exchange of a monthly payment. 
                </p>

                <p>
                  We understand the need of these applications for school and university students who cant afford to pay high prices for these applications. So, we made our application free of cost with unlimited JPG to PDF conversion free online.
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


    </body>
</html>

<?php include 'footerHandlersCopy.php';?>



<!-- Ref: 

https://stackoverflow.com/questions/25680490/combine-jpgs-into-one-pdf-with-php#:~:text=In%20PHP%20you%20can%20use,%2D%3EwriteImages('combined.

https://stackoverflow.com/questions/2704314/multiple-file-upload-in-php

https://stackoverflow.com/questions/1921466/auto-delete-all-files-after-x-time#:~:text=You%20can%20use%20PHP%20core,and%20delete%20its%20file%2Ffiles.&text=It%20is%20only%20skeleton%20of%20the%20function.

-->
