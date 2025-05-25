<?php
session_start();

if (isset($_SESSION['error_notif'])) {
  $error_message = $_SESSION['error_notif'];
  unset($_SESSION['error_notif']);
} else {
  $error_message = '';
}

$xml = new DOMDocument();
$xml->load('../../data/public/register.xml');

$xsl = new DOMDocument();
$xsl->load('../../xslt/register.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

$proc->setParameter('', 'error_message', $error_message);

echo $proc->transformToXML($xml);
