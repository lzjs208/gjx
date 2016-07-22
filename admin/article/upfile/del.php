<?php

$fileUrl = $_GET['fileUrl'];

if(is_string($fileUrl)){
  if(file_exists($fileUrl)){
    unlink($fileUrl);
    die('ok');
  }else{
    die('error');
  }
}

?>