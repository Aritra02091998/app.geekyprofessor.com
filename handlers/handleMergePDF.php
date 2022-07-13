<?php include '../header.php';
session_start();
//echo(session_id());
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Merge PDF Files </title>
        <link rel="stylesheet" href="../css/handleMergePDF.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        
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
                $saveAddress = "../upload/pdfUploads/{$sessionID}merged-PDF-geekyprofessor-apps.pdf";
                $sumOfUploadedPDFs = 0;
                //echo($totalImages."<br>".$sessionID);


                for( $i=0 ; $i < $totalImages ; $i++ ) {
                    $tmpFilePath = $_FILES['image']['tmp_name'][$i];
                    $sumOfUploadedPDFs += filesize($_FILES['image']['tmp_name'][$i]);
                    array_push($images, $tmpFilePath);
                }

                $pdf = new Imagick($images);
                $pdf->setResolution(300, 300);
                $pdf->setImageCompression(imagick::COMPRESSION_JPEG); 
                $pdf->setImageCompressionQuality(100);
                $pdf->setImageFormat('pdf');
                
                try{
                    $pdf->writeImages($saveAddress, true); 
                    $status = 1;
                    $statusMsg = "PDFs successfully merged into single PDF Doc.";
                }
                catch(Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                    $status = 0;
                    $statusMsg = "Error while merging PDF.";

                }
                $pdfFileSize = (filesize($saveAddress)/1000);
                $sumOfUploadedPDFs = $sumOfUploadedPDFs/1000;

                # delete files of yesterday 
                
                $filesToBeDeleted = glob("../upload/pdfUploads/*"); 
                foreach($filesToBeDeleted as $file){ 
                    //echo ( time()-filectime($file)."<br>" );
                    if( (is_file($file)) && ( (time()-filectime($file))>=86400 ) ) {
                        unlink($file); // delete file
                        //echo ("deleted");
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
                      All your PDFs have been merged to a single PDF Doc.
                    </p>
                </div>

                

                <a href="<?php echo $saveAddress; ?>" download>
                    <button id="download">
                        Download Merged PDF
                    </button>
                </a> 
            <?php } ?>

            <!--Start of table data -->

            <table id="resultTable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>PDF Properties</th>
                    <th>PDF Values</th>
                  </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Documents Merged in PDF</td>
                        <td>
                            <?php 
                                for( $i=0 ; $i < $totalImages ; $i++ )
                                echo (($i+1).". ".$_FILES["image"]["name"][$i]."<br>"); 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Uploaded Doc Type</td>
                        <td><?php echo (strtoupper($_FILES["image"]["type"][0])) ?></td>
                    </tr>
                    <tr>
                        <td>Converted Doc Type</td>
                        <td><?php echo (strtoupper(pathinfo($saveAddress, PATHINFO_EXTENSION))) ?></td>
                    </tr>
                    <tr>
                        <td>Uploaded PDF total Size</td>
                        <td><?php echo ($sumOfUploadedPDFs." KB" ) ?></td>
                    </tr>
                    <tr>
                        <td>Converted PDF Size</td>
                        <td><?php echo ($pdfFileSize." KB" ) ?></td>
                    </tr>
                </tbody>

            </table>

            <!--table end -->
        </div>

        <a href="../merge-pdf-online.php">
            <button id="download">Merge more PDFs</button>
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
            
            <h2>Merge PDF Pages Online Free Features<br>(Merge as PDF)</h2>

            <br>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-comment-dollar"></i>
                <h3>Merge PDF Free</h3>

                <p>
                  This online pdf merge tool can merge pdf for free (PDF) instantly under 10 seconds while preserving the highest possible quality and resolution of each page in the original PDF.     
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-person-digging"></i>
                <h3>Easy To Combine PDF Files</h3>

                <p>
                  With just two clicks you can merge PDF online for free into high quality single PDF Doc under 10 seconds. Just click on the Merge PDFs button and let us do the rest of the hard work for you.      
                </p>

                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-desktop"></i>
                <h3>Merge PDF Files Cross-Platform</h3>

                <p>
                  This web-based merge pdf application works on every platform and OS you can think of. Be it Windows, Mac, Linux or Android this application works perfectly everywhere so you can merge PDF online free for Mac, Windows instantly.
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-shield-halved"></i>
                <h3>Security Enhanced Merge PDF</h3>

                <p>
                  For users content on the Internet our application uses highly encrypted techniques to combine PDF files. And delivers the merged PDF in a secure merged PDF file. User data is never stored in our server, it gets deleted after sometime as user exits.
                </p>

                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-route"></i>
                <h3>Merge PDF Files On The Way</h3>

                <p>
                  Doesn't matter wherever you are or whichever device you are using. Our PDF merger free online application is available 24*7 in the web for you to use. Merge PDF files while you commute, Walk, in office, in College etc.
                </p>

                <br>

              </div>

              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-file-zipper"></i>
                <h3>Extract High Quality Merged PDF</h3>

                <p>
                  This web based free PDF merger application uses complex algorithm to preserve the quality of the merged PDF document quality. You can get all of the high quality single PDF docs merged into a single one instantly. Use same resolution PDFs to get best results.
                </p>

                <br>

              </div>

              <hr>
              <br>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-person-chalkboard"></i>
                <h3>How To Combine PDF files ? | How to Merge PDF files ?</h3>

                <br>

                <p>
                  <strong>Step 1:</strong>
                  Select the PDF files in the form above which you want to merge in this PDF merger application online.
                </p>

                <p>
                  <strong>Step 2:</strong>
                  Click on Merge PDF for free button and the PDF will upload automatically.
                </p>

                <p>
                  <strong>Step 3:</strong>
                  Wait for 10 seconds and let the application work to combine PDF files for free.
                </p>

                <p>
                  <strong>Step 4:</strong>
                  After 10 seconds your Merged PDF online download will begin automatically.
                </p>

                <br>
                <hr>
                <br>

              </div>

            </div>

            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-brands fa-apple"></i>
                <h3>How To Merge PDF Files MAC</h3>

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
                  Navigate to the "Merge PDF" section and click it.
                </p>

                <p>
                  <strong>Step 4:</strong>
                  Now you can upload PDF files here to combine pdf files for free.
                </p>

                <br>
                <hr>
                <br>

              </div>

            </div>



            <div class="row">
              <div class="col-sm">
                <i id="seoIcon" class="fa-solid fa-hand-holding-heart"></i>
                <h3>Why our PDF Merger Online Application is Free ?</h3>

                <br>

                <p>
                  As you all know merge PDF for free and all other PDF application of these type are not free at all. They have a daily limit on the number of PDF you can merge. They offer unlimited merging of PDF files in exchange of a monthly payment. 
                </p>

                <p>
                  We understand the need of these applications for school and university students who cant afford to pay high prices for these applications. So, we made our application free of cost with unlimited PDF merge.
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

        <script src="../js/handleMergePDF.js"></script>

    </body>
</html>

<?php include 'footerHandlersCopy.php';?>



<!-- Ref: 

https://stackoverflow.com/questions/25680490/combine-jpgs-into-one-pdf-with-php#:~:text=In%20PHP%20you%20can%20use,%2D%3EwriteImages('combined.

https://stackoverflow.com/questions/2704314/multiple-file-upload-in-php

https://stackoverflow.com/questions/1921466/auto-delete-all-files-after-x-time#:~:text=You%20can%20use%20PHP%20core,and%20delete%20its%20file%2Ffiles.&text=It%20is%20only%20skeleton%20of%20the%20function.

-->
