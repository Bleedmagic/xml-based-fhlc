<?php

$hashedPassword = password_hash('guardian@123', PASSWORD_DEFAULT);
echo $hashedPassword;
