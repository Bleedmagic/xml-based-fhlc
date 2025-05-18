<?php
$xml = new DOMDocument();
$xml->load('../data/public/terms-conditions.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/terms-conditions.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
