<?php
  $target_dir = "./uploads/";
  $target_file = $target_dir . basename($_FILES["document"]["name"]);
  $path_parts = pathinfo($target_file);
  $extension = $path_parts['extension'];
  $target_file = $target_dir .round(microtime(true)) . '.' .$extension;
  $uploadOk = 1;
  $file_type = $_FILES["document"]["type"];

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
  $feedback.= '<h1 class="text-danger">
          <i class="glyphicon glyphicon-remove"></i>
          Unsupported file type</h1><br />';
  $uploadOk = 0;
  break;

  }

  // Check if file already exists
  if (file_exists($target_file)) {
    $feedback.= '<h1 class="text-danger">
            <i class="glyphicon glyphicon-remove"></i>
            File already exists</h1><br />';
    $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["document"]["size"] >= 8388608) {
    $feedback.= '<h3 class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <i class="glyphicon glyphicon-remove"></i>
    The file size is too large.</h3>';
    $uploadOk = 0;
  }


  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $feedback.= "Sorry, your file was not uploaded. Please try again.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
        $feedback.= "The file ". basename( $_FILES["document"]["name"]). " has been uploaded.";
    } else {
        $feedback.= "Sorry, there was an error uploading your file.";
    }
  }
?>
