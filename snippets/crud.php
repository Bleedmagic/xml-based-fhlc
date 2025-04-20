<?php
if ($_POST['action'] == 'create') {
  $xml = simplexml_load_file("users.xml");
  $lastID = 0;
  foreach ($xml->User as $user) {
    if ((int)$user->ID > $lastID) {
      $lastID = (int)$user->ID;
    }
  }

  $new = $xml->addChild('User');
  $new->addChild('ID', $lastID + 1);
  $new->addChild('Username', $_POST['username']);
  $new->addChild('Email', $_POST['email']);

  $xml->asXML('users.xml');
  header("Location: dashboard.php");
  exit;
}

if ($_POST['action'] == 'delete') {
  $xml = simplexml_load_file("users.xml");
  $idToDelete = $_POST['id'];

  $index = 0;
  foreach ($xml->User as $user) {
    if ((string)$user->ID === $idToDelete) {
      unset($xml->User[$index]);
      break;
    }
    $index++;
  }

  $xml->asXML('users.xml');
  header("Location: dashboard.php");
  exit;
}
