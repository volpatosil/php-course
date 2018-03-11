<!-- How to give apache permission to write to home directory?
 https://stackoverflow.com/questions/22062266/how-to-give-apache-permission-to-write-to-home-directory ->

<?php

$file = "example.txt";

if($handle = fopen($file, 'w')) {

  fwrite($handle, 'I love PHP');

fclose($handle);
} else {

echo "The application was not able to write on the file";

}

?>