<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u174340608_root');
define('DB_PASSWORD', 'Ranjeet8810@123');
define('DB_NAME', 'u174340608_carpet');
 // correct & fixed port

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: cannot connect');
}

?>

