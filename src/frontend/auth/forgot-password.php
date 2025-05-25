<?php
session_start();

if (isset($_SESSION['error_notif'])) {
  $error_message = $_SESSION['error_notif'];
  unset($_SESSION['error_notif']);
} else {
  $error_message = '';
}

if (isset($_SESSION['success_notif'])) {
  $success_message = $_SESSION['success_notif'];
  unset($_SESSION['success_notif']);
} else {
  $success_message = '';
}

$xml = new DOMDocument();
$xml->load('../../data/public/forgot-password.xml');

$xsl = new DOMDocument();
$xsl->load('../../xslt/forgot-password.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

$proc->setParameter('', 'error_message', $error_message);
$proc->setParameter('', 'success_message', $success_message);

echo $proc->transformToXML($xml);
