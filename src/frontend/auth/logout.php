<?php
session_start();
require_once '../includes/auth.php';
require_once '../includes/functions.php';

logout();
redirect('../auth/login.php');
