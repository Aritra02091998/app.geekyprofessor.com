<?php include 'headerHandlersCopy.php';
session_start();    
//echo session_id()."<br>";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/handleConvertPDFtoJPG.css">
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

            function countNumOfPages($pdfFile){
                $pdftext = file_get_contents($pdfFile);
                $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
                return $num;
            }
             
            
            if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
                header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
                die( header( 'location: /error.php' ) );
            }
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                $session_id = session_id();
                $uploadPath = "../upload/pdfUploads/"; 
                $pdfFileNameWithOutExt = basename($_FILES["pdfDoc"]["name"],"pdf");
                $dotRemovedFileNameTemp = str_replace(".", "", $pdfFileNameWithOutExt);
                $dotRemovedFileName = $session_id.$dotRemovedFileNameTemp;
                
                # echo($dotRemovedFileName."<br>");

                $imgExt = ".jpg";
                $fileNameLocationFormat = $uploadPath.$dotRemovedFileName.$imgExt;
                $fileNameLocation = $uploadPath.$dotRemovedFileName;
                $status = null;

                $noOfPagesInPDF = countNumOfPages($_FILES['pdfDoc']['tmp_name']);
                #echo($noOfPagesInPDF."<br>");


                /* Converting PDF into series of Images */

                $imagick = new Imagick();
                $imagick->readImage($_FILES['pdfDoc']['tmp_name']);

                try {
                    $imagick->writeImages($fileNameLocationFormat, true);
                }
                catch(Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                }

                /* end converting PDF to series of Images */


                $imageFilesArray = array();
                $pdfFilesArray = array();

                $arrayEndIndex = $noOfPagesInPDF-1;

                for ($x = $arrayEndIndex; $x >= 0; $x--) {
                    if ($noOfPagesInPDF == 1)
                        array_push($imageFilesArray,"{$fileNameLocation}.jpg" );
                    else
                        array_push($imageFilesArray,"{$fileNameLocation}-{$x}.jpg" );
                }
                #print_r($imageFilesArray);

                /* Converting Images back to splitted PDFs */

                for ($x = $arrayEndIndex; $x >= 0; $x--) {
                    $pdf = new Imagick($imageFilesArray[$x]);
                    $pdf->setImageFormat('pdf');
                    $pdf->writeImages("../upload/pdfUploads/{$session_id}converted-{$x}.pdf", true); 
                    array_push($pdfFilesArray,"../upload/pdfUploads/{$session_id}converted-{$x}.pdf");
                }
                
                /* end of converting Images back to splitted PDFs */

                #print_r($pdfFilesArray);

                
                # create new zip object
                $zip = new ZipArchive();

                # create a temp file & open it
                $tmp_file = tempnam('.', '');

                $zip->open($tmp_file, ZipArchive::CREATE);

                # loop through each file
                foreach ($pdfFilesArray as $pdf) {
                    $download_file = file_get_contents($pdf);
                    $zip->addFromString(basename($pdf), $download_file);
                }

                # close zip
                $zip->close();
                

                // file cleaning code
            
                $files = glob("../upload/pdfUploads/{$session_id}*"); // get all file names
                foreach($files as $file){ // iterate files
                  if(is_file($file)) {
                    unlink($file); // delete file
                  }
                }
                
                
                // send the file to the browser as a download

                header('Content-disposition: attachment; filename="Splitted-PDFs-geekyprofessor-app.zip"');
                header('Content-type: application/zip');
                readfile($tmp_file);
                unlink($tmp_file);
            }
        ?>


        <!-- the below section will not be executed in this file bcz a
            when the request comes to this page the header delivers the zip file to be downloaded -->
        <!-- should be used for debugging purpose by commenting the header codes-->
        
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

            <?php if ($status == 1){ 
                    echo "<div class=\"alert alert-success\"><strong>Success! </strong>".$statusMsg."</div>"; 
                    echo "<p id=\"statusFlag\">1</p>";
                ?>

                <img id="cmprsdImg" src="../assets/invalidExtension.jpg" height=25% width=25%>
                 
                <br>
                <br>
                
                <p id="silentMsg">
                    <i>
                        Your Download will start Automatically ....
                        <br>
                        Click on the below link if its not started after 5 seconds.
                    </i>
                </p>


                <a href="<?php $zip; ?>" download>
                    <button id="download">
                        Download JPGs
                    </button>
                </a> 
            <?php } ?>

            <br>

            <!--Start of table data -->

            <table id="resultTable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>PDF Properties</th>
                    <th>Values</th>
                  </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>PDF Name</td>
                        <td><?php echo ($_FILES["pdfDoc"]["name"]) ?></td>
                    </tr>
                    <tr>
                        <td>Uploaded File Type</td>
                        <td><?php echo (strtoupper($_FILES["pdfDoc"]["type"])) ?></td>
                    </tr>
                    <tr>
                        <td>Uploaded PDF File Size</td>
                        <td><?php echo ($_FILES["pdfDoc"]["size"]/1000)." KB"; ?></td>
                    </tr>
                    
                </tbody>

            </table>

            <!--table end -->

            <a href="../convertPDFtoJPG.php">
                <button id="download">Convert Another PDF</button>
            </a>


            <!-- This hidden btn will be clicked automatically by JS to download the image after 5 seconds of the page load.-->

            <a href="<?php echo $imgToBePrinted; ?>" download>
                <button id="hiddenBtnForAutoDwnld" style="display: none;">
                    Download Auto test
                </button>
            </a>

        </div>


        <script src="../js/handleConvertPDFtoJPG.js"></script>

    </body>
</html>

<?php include 'footerHandlersCopy.php';?>



<!-- Ref: 

https://stackoverflow.com/questions/1201798/use-php-to-convert-png-to-jpg-with-compression

https://www.kodingmadesimple.com/2018/05/convert-pdf-to-jpeg-php.html

https://www.geeksforgeeks.org/php-header-function/

https://stackoverflow.com/questions/14644353/get-the-number-of-pages-in-a-pdf-document/14644354#14644354

https://stackoverflow.com/questions/4594180/deleting-all-files-from-a-folder-using-php

https://stackoverflow.com/questions/14644353/get-the-number-of-pages-in-a-pdf-document#:~:text=Here%20is%20a%20simple%20example,%7D%20%24pdfname%20%3D%20'example.
-->
