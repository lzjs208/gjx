<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title></title>
  </head>
  
  <body>
<?php
    $sType= $_REQUEST["type"];
	$id = $_REQUEST["id"];
	$htmlFile = "";

	if (strcasecmp($sType, "word")==0) {
		$htmlFile = "aabb" . $id . ".mht";
	}
	
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);	   
	$query = "update " . $sType . "  set htmlFile='" . $htmlFile . "' where id=".$id;
	$conn->Execute($query); 
	
	header("Location:doc/" .$htmlFile);
?>
  </body>
</html>
