<!-- Customized from w3schools https://www.w3schools.com/php/php_file_upload.asp -->
<?php
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
  $feedback.=  '<div class="alert alert-danger alert-dismissable">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
   <h3><i class="glyphicon glyphicon-remove"></i> Unsupported File Type.</h3> If you have uploaded a correct file type there may be an issue with your file.</div>';;
  $uploadOk = 0;
  break;

  }

  // Check if file already exists - should not happen as using microtime to create filename
  if (file_exists($target_file)) {
    $feedback.= '<h3 class="alert alert-danger alert-dismissable">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     <i class="glyphicon glyphicon-remove"></i>
     Sorry, there was an error uploading your File. Please try again.</h3>';
    $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["uploaded_document"]["size"] >= 8388608) {
    $feedback.= '<h3 class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <i class="glyphicon glyphicon-remove"></i>
    The file size is too large.</h3>';
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    //$feedback.= "Sorry, your file was not uploaded. Please try again.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["uploaded_document"]["tmp_name"], $target_file)) {
        // $feedback.= "The file ". basename( $_FILES["document"]["name"]). " has been uploaded.";
    } else {
        $feedback.= '<h3 class="alert alert-danger alert-dismissable">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
         <i class="glyphicon glyphicon-remove"></i>
         Sorry, there was an error uploading your File. Please try again.</h3>';
    }
  }
?>
