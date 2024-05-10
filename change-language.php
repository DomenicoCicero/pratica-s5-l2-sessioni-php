<?php

$coockie_expiration = time() + 60 * 60 * 24 * 365; // 1 anno
if(isset($_GET['language'])) {
    setcookie('language', $_GET['language'], $coockie_expiration);
}

header("Location: $_SERVER[HTTP_REFERER]");
exit;

?>