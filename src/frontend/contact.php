<?php
$xml = new DOMDocument();
$xml->load('../data/public/contact.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/contact.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
