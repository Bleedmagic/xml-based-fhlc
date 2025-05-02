<?php
$xml = new DOMDocument();
$xml->load('../data/public/home.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/home.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
