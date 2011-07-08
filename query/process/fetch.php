<?php
include_once("../config/config.php");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=iati_download_".date("Ymd")."_".$_GET['format']."_page".$_GET['page']."_".$_GET['format']);


$format = $_GET['format'];

switch($format) {
	case "csv": 
		header("Content-type: text/csv");		
	break;
	case "json":
		header("Content-type: text/json");
	break;
	default:
		header("Content-type: text/xml");
	break;
}

$url = EXIST_URI.EXIST_DB."?_query=".$_GET['query']
		."&_howmany=".$_GET['howmany']
		."&_start=".(($_GET['page'] == 1 ? 1 : ($_GET['page']-1) * $_GET['howmany']))
		.($_GET['xsl'] ? "&_xsl=".$_GET['xsl'] : null);


$file = file_get_contents($url);
echo $url;
echo $file;

?>