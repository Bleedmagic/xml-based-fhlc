<?php
$xml = new DOMDocument();
$xml->load('../data/public/about.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/about.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
