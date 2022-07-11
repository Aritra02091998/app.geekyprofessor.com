<?php include 'headerHandlersCopy.php';
session_start();    
ob_start();

//echo session_id()."<br>";

      
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
    $imagick->setResolution(300, 300);
    $imagick->readImage($_FILES['pdfDoc']['tmp_name']);
    $imagick->setImageFormat('jpeg');
    $imagick->setImageCompression(imagick::COMPRESSION_JPEG); 
    $imagick->setImageCompressionQuality(100);

    try {
        $imagick->writeImages($fileNameLocationFormat, true);
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }

    $imagick->clear();
    $imagick->destroy();


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
        chmod("../upload/pdfUploads/{$session_id}converted-{$x}.pdf",0777);
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
    ob_clean();

    header('Content-Description: File Transfer');
    header('Content-type: application/octet-stream');
    header('Content-disposition: attachment; filename="Splitted-PDF-geekyprofessor-apps.zip"');
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

https://stackoverflow.com/questions/14644353/get-the-number-of-pages-in-a-pdf-document#:~:text=Here%20is%20a%20simple%20example,%7D%20%24pdfname%20%3D%20'example.
-->
