<?php

$absolutePath = $task->get_storage_address();
$pathParts = pathinfo($absolutePath);
$fileName = $pathParts['basename'];
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$fileType = finfo_file($fileInfo, $absolutePath);
finfo_close($fileInfo);
$fileSize = filesize($absolutePath);
header('Content-Length: ' .$fileSize);
header('Content-Type: ' .$fileType);
header('Content-Disposition: attachment;filename=' .$fileName);
ob_clean();
flush();
readfile($absolutePath);
?>
