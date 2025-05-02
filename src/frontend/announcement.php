<?php
$xml = new DOMDocument();
$xml->load('../data/public/announcement.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/announcement.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
