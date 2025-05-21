<?php
$xml = new DOMDocument();
$xml->load('../data/public/currentstudents.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/currentstudents.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
?>
