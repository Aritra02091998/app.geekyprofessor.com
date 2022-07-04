<?php include 'headerHandlersCopy.php';
session_start();
echo(session_id());
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/handleConvertJPGtoPDF.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <script src="../js/handleConvertJPGtoPDF.js"></script>


        <title>Compressing Image</title>
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
                $saveAddress = "../upload/pdfUploads/{$sessionID}.combinedPDF.pdf";
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
                        echo ("deleted");
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
                      * Watch Me Walking <br> 
                      Your download will start automatically !!<br>
                      All your Images have been merged to a single PDF Doc.
                    </p>
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

        <a href="../convertJPGtoPDF.php">
            <button id="download">Convert Another Set of Images</button>
        </a>


        <!-- This hidden btn will be clicked automatically by JS to download the image after 5 seconds of the page load.-->

        <a href="<?php echo $saveAddress; ?>" download>
            <button id="hiddenBtnForAutoDwnld" style="display: none;">
                Download Auto test
            </button>
        </a>

        


    </body>
</html>

<?php include 'footerHandlersCopy.php';?>



<!-- Ref: 

https://stackoverflow.com/questions/25680490/combine-jpgs-into-one-pdf-with-php#:~:text=In%20PHP%20you%20can%20use,%2D%3EwriteImages('combined.

https://stackoverflow.com/questions/2704314/multiple-file-upload-in-php

https://stackoverflow.com/questions/1921466/auto-delete-all-files-after-x-time#:~:text=You%20can%20use%20PHP%20core,and%20delete%20its%20file%2Ffiles.&text=It%20is%20only%20skeleton%20of%20the%20function.

-->
