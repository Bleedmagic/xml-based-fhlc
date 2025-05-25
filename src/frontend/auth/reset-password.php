<?php
session_start();

if (isset($_SESSION['error_notif'])) {
  $error_message = $_SESSION['error_notif'];
  unset($_SESSION['error_notif']);
} else {
  $error_message = '';
}

$token = $_GET['token'] ?? '';

$xml = new DOMDocument();
$xml->load('../../data/public/reset-password.xml');

$xsl = new DOMDocument();
$xsl->load('../../xslt/reset-password.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

$proc->setParameter('', 'error_message', $error_message);
$proc->setParameter('', 'token', $token);

echo $proc->transformToXML($xml);
