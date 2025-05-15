<?php
http_response_code(403);

$xml = new DOMDocument();
$xml->load('../data/public/403.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/403.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
