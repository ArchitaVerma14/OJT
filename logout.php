<?php
setcookie('id', '', time() - (60 * 60 * 24 * 30));
setcookie('token', '', time() - (60 * 60 * 24 * 30));
echo ' <meta http-equiv="refresh" content="0;url=dog_login.php">';
?>