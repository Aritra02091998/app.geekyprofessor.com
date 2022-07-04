<!-- pdf file cleaning code -->
        <?php

                # only those pdf files will be deleted which the current user uploaded.
                # we match the sesion id of the user and delte the files which contains the same session id in the file name.
                # file naming format is: session_id + destination + fileName + extension
                
                // get all matching file names in array
                sleep(4);
                $filesToBeDeleted = glob("../upload/{$sessionID}.*"); 
                foreach($filesToBeDeleted as $file){ // iterate files
                  if(is_file($file)) {
                    unlink($file); // delete file
                    echo ("deleted");
                  }
                }
        ?>
        <!-- end of pdf file cleaning code -->