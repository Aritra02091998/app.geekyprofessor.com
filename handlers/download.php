<?php
    session_start();

//code to display errors.
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 


    echo ($_SESSION['my']);
    echo "<h1>Hello User, </h1> <p>Welcome to </p>";
/*
    header('Content-disposition: attachment; filename="my file.zip"');
    header('Content-type: application/zip');
    readfile($tmp_file);
    unlink($tmp_file);
*/
?>