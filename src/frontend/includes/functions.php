<?php

function is_logged_in()
{
  return isset($_SESSION['user_id']);
}

function redirect($url)
{
  header("Location: $url");
  exit();
}
