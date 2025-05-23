<?php
libxml_use_internal_errors(true);

$xmlPath = __DIR__ . '/../data/public/announcement.xml';
$xslPath = __DIR__ . '/../xslt/announcement.xsl';

// Create XML DOM and secure against XXE
$xml = new DOMDocument();
$xml->resolveExternals = false;
$xml->substituteEntities = false;
if (!$xml->load($xmlPath, LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING)) {
  foreach (libxml_get_errors() as $error) {
    echo "XML Load Error: ", $error->message, "<br>";
  }
  exit;
}

// Create XSL DOM and secure against XXE
$xsl = new DOMDocument();
$xsl->resolveExternals = false;
$xsl->substituteEntities = false;
if (!$xsl->load($xslPath, LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING)) {
  foreach (libxml_get_errors() as $error) {
    echo "XSL Load Error: ", $error->message, "<br>";
  }
  exit;
}

// Transform
$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);
echo $proc->transformToXML($xml);
