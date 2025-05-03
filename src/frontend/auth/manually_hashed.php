<?php
// Hash the password before storing it in the XML file (you can use this approach to update the users.xml file)
$hashedPassword = password_hash('guardian@123', PASSWORD_DEFAULT);
echo $hashedPassword; // Output the hashed password to put it into the XML manually
