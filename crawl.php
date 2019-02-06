<?php 
include('classes/DomDocumentParser.php');

function followLinks($url){
  $parser = new DomDocumentParser($url);
}

$startUrl ="http://www.lcw.com.tr";
followLinks($startUrl);
?>