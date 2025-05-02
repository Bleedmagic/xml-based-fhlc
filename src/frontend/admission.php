<?php
$xml = new DOMDocument();
$xml->load('../data/public/admission.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/admission.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
