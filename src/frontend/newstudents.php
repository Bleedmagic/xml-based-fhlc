<?php
$xml = new DOMDocument();
$xml->load('../data/public/newstudents.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/newstudents.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
?>
