<?php
$password = 'thepassword';  // Replace this with the password you want to hash
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);  // Hash the password
echo "Hashed Password: " . $hashedPassword;
?>