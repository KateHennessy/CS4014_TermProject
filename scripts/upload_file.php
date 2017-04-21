<!-- Customized from w3schools https://www.w3schools.com/php/php_file_upload.asp -->
<?php
   require_once __DIR__. '/phpvalidation.php';
  $target_dir = "./uploads/";
  $target_file = $target_dir . basename($_FILES["uploaded_document"]["name"]);
  $path_parts = pathinfo($target_file);
  $extension = $path_parts['extension'];
  $target_file = $target_dir .round(microtime(true)) . '.' .$extension;
  $uploadOk = 1;
  $file_type = $_FILES["uploaded_document"]["type"];


  switch($file_type){
  case "application/pdf":

  $uploadOk = 1;
  break;
  case "application/vnd.openxmlformats-officedocument.wordprocessingml.document": //docx

  $uploadOk = 1;
  break;
  case "application/msword":

  $uploadOk = 1;
  break;
  default:
  $feedback.=  phpvalidation::displayFailureSubtext('Unsupported File Type.', 'If you have uploaded a correct file type there may be an issue with your file.');
  $uploadOk = 0;
  break;

  }

  // Check if filename already exists - should not happen as using microtime to create filename
  if (file_exists($target_file)) {
    //feedback is variable also used within upload task to display feedback to user.
    $feedback.= phpvalidation::displayFailure('Sorry, there was an error uploading your File. Please try again.');
    $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["uploaded_document"]["size"] >= 8388608) {
    $feedback.= phpvalidation::displayFailure('The file size is too large.');
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
  } else {
    if (move_uploaded_file($_FILES["uploaded_document"]["tmp_name"], $target_file)) {

    } else {
        $feedback.= phpvalidation::displayFailure('Please try again.');
    }
  }
?>
