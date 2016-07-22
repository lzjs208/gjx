<?php

$fileUrl = $_GET['fileUrl'];

$result = 0;

if(is_string($fileUrl)){
  if(file_exists($fileUrl)){
    unlink($fileUrl);
    $result = 1;
  }else{
    $result = 0;
  }
}

echo $result;

?>