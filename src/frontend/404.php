<?php

http_response_code(404);

$requestUri = $_SERVER['REQUEST_URI'];

if (strpos($requestUri, '/admin/') !== false) {
  include './admin/404.php';
} elseif (strpos($requestUri, '/user/') !== false) {
  include './user/404.php';
} else {
  $xml = new DOMDocument();
  $xml->load('../data/public/404.xml');

  $xsl = new DOMDocument();
  $xsl->load('../xslt/404.xsl');

  $proc = new XSLTProcessor();
  $proc->importStylesheet($xsl);

  echo $proc->transformToXML($xml);
}
