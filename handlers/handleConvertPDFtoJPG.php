<?php 
session_start();  
ob_start();

 
// all the html content has been removed bcz header dont work unless all 
// output in the browser screen is removed

// code to display errors.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
 

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
    

    $imgExt = ".jpg";
    $fileNameLocationFormat = $uploadPath.$dotRemovedFileName.$imgExt;
    $fileNameLocation = $uploadPath.$dotRemovedFileName;
    $status = null;

    $imagick = new Imagick();

    # to get number of pages in the pdf to run loop below.
    # the below function generates unreadable images for each page.
    $imagick->pingImage($_FILES['pdfDoc']['tmp_name']);
    $noOfPagesInPDF = $imagick->getNumberImages();
    
    //increasing quality of JPG converted.

    $imagick->setResolution(300, 300);
    $imagick->readImage($_FILES['pdfDoc']['tmp_name']);
    $imagick->setImageFormat('jpeg');
    $imagick->setImageCompression(imagick::COMPRESSION_JPEG); 
    $imagick->setImageCompressionQuality(100);

    $statusMsg = "test";

    # writing pdf into images.
    try {
        $imagick->writeImages($fileNameLocationFormat, true);
        $status = 1; 
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $status = 0;
    }

    $imagick->clear();
    $imagick->destroy();

    $files = array();

    // storing converted images into array.

    $arrayEndIndex = ($noOfPagesInPDF * 2)-1;
    for ($x = $arrayEndIndex; $x >= $noOfPagesInPDF; $x--) {
        array_push($files,"{$fileNameLocation}-{$x}.jpg" );
    }

    # create new zip object
    $zip = new ZipArchive();

    # create a temp file & open it
    $tmp_file = tempnam('.', '');
    $zip->open($tmp_file, ZipArchive::CREATE);

    # loop through each file
    foreach ($files as $file) {
        # download file
        $download_file = file_get_contents($file);

        #add it to the zip
        $zip->addFromString(basename($file), $download_file);
    }

    # close zip
    $zip->close();

    # file cleaning code
    # only those pdf files will be deleted which the current user uploaded.
    # we match the sesion id of the user and delte the files which contains the same session id in the file name.
    # file naming format is: session_id + destination + fileName + extension
    
    $files = glob("../upload/pdfUploads/{$session_id}*"); // get all file names
    foreach($files as $file){ // iterate files
      if(is_file($file)) {
        unlink($file); // delete file
      }
    }

    // send the file to the header as a download
    ob_clean();

    header('Content-Description: File Transfer');
    header('Content-type: application/octet-stream');
    header('Content-disposition: attachment; filename="App-geekyprofessor-Images.zip"');
    //header("Content-Length: ".$size );
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    flush();
    readfile($tmp_file);  
    unlink($tmp_file);              
}
?>



<!-- Ref: 

https://stackoverflow.com/questions/1201798/use-php-to-convert-png-to-jpg-with-compression

https://www.kodingmadesimple.com/2018/05/convert-pdf-to-jpeg-php.html

https://www.geeksforgeeks.org/php-header-function/

https://stackoverflow.com/questions/14644353/get-the-number-of-pages-in-a-pdf-document/14644354#14644354

https://stackoverflow.com/questions/4594180/deleting-all-files-from-a-folder-using-php

https://stackoverflow.com/questions/50208249/php-imagick-pdf-are-converted-into-jpg-with-very-bad-quality


Question asked by me - solved the problem

(when using headers dont use any html tags to output something else headers will not download your file. In this case the header was downloading the working zip file in android browsers.)

https://stackoverflow.com/questions/72938610/php-header-downloading-unreadable-zip-file-in-android?noredirect=1#comment128831359_72938610

-->


