<?php
$xml = new DOMDocument();
$xml->load('../data/public/requirements.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/requirements.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
?>
