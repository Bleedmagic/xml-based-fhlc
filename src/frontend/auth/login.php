<?php
session_start();

if (isset($_SESSION['error_notif'])) {
  $error_message = $_SESSION['error_notif'];
  unset($_SESSION['error_notif']);
} else {
  $error_message = '';
}

if (isset($_SESSION['register_success'])) {
  $msg = $_SESSION['register_success'];
  unset($_SESSION['register_success']);
  echo "<script>alert(" . json_encode($msg) . ");</script>";
}

if (isset($_SESSION['reset_success'])) {
  $msg = $_SESSION['reset_success'];
  unset($_SESSION['reset_success']);
  echo "<script>alert(" . json_encode($msg) . ");</script>";
}

$xml = new DOMDocument();
$xml->load('../../data/public/login.xml');

$xsl = new DOMDocument();
$xsl->load('../../xslt/login.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

$proc->setParameter('', 'error_message', $error_message);

echo $proc->transformToXML($xml);
