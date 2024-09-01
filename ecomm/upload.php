
<?php

$targetDirectory = "img/";
$targetFile = $targetDirectory.basename($_FILES['fileToUpload']['name']);
$uploadSucces = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile);

if ($uploadSucces) {
    echo "success";
} else {
    echo "failed";

}
