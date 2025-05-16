<?php

//@TODO logout

http_response_code(404);

$xml = new DOMDocument();
$xml->load('../data/public/404.xml');

$xsl = new DOMDocument();
$xsl->load('../xslt/404.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXML($xml);
