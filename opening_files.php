<!-- How to give apache permission to write to home directory?
 https://stackoverflow.com/questions/22062266/how-to-give-apache-permission-to-write-to-home-directory ->

<?php

$file = "example.txt";

$handle = fopen($file, 'w');

fclose($handle);

?>