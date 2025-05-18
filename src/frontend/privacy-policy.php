<?php
$xml = new DOMDocument();
$xml->load('../data/public/privacy-policy.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/privacy-policy.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
