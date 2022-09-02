<?php

# Hey Bob,
# I thought it would be safer to use two hasing methods 
# to secure our passwords. MD5 + SHA1 FTW!!

$input = $argv[1];
$output = md5(sha1($input));

echo $output

?>

