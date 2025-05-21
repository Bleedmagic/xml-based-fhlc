<?php
$xml = new DOMDocument();
$xml->load('../data/public/gradelevels.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/gradelevels.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
?>
