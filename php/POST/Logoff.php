<?php session_start();
echo 'You have been logged off';
session_destroy();
header( "Location: http://localhost/php-project/Menu.php" );
?>