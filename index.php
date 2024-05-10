<?php

$host = 'localhost';
$db = 'ifoa_session_cookie';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);

$coockie_expiration = time() + 60 * 60 * 24 * 365; // 1 anno

if(!isset($_COOKIE['language'])) {
    setcookie('language', 'it', $coockie_expiration);
    $language = 'it';
} else {
    $language = $_COOKIE['language'];
}

if($language === 'it') {
    $stmt = $pdo->query("SELECT * FROM news_it");
    $dati = $stmt->fetchAll();
} else if($language === 'en') {
    $stmt = $pdo->query("SELECT * FROM news_en");
    $dati = $stmt->fetchAll();
}  else if($language === 'fr') {
    $stmt = $pdo->query("SELECT * FROM news_fr");
    $dati = $stmt->fetchAll();
}  else if($language === 'sp') {
    $stmt = $pdo->query("SELECT * FROM news_sp");
    $dati = $stmt->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessioni</title>
</head>
<body>
    <h1><?= $dati[0]['titolo'] ?></h1>
    <h2><?= $dati[0]['sottotitolo'] ?></h2>
    <p><?= $dati[0]['contenuto'] ?></p>
    
    <form action="http://localhost/pratica-s5-l2-sessioni-php/change-language.php" method="get">
        <select name="language">
            <option value="it"<?= $language === 'it' ? ' selected' : '' ?>>IT</option>
            <option value="en"<?= $language === 'en' ? ' selected' : '' ?>>EN</option>
            <option value="fr"<?= $language === 'fr' ? ' selected' : '' ?>>FR</option>
            <option value="sp"<?= $language === 'sp' ? ' selected' : '' ?>>SP</option>
        </select>
        <button>
                <?php
                    if ($language === 'it') {
                        echo 'Cambia Lingua';
                    } elseif ($language === 'en') {
                        echo 'Change Language';
                    } elseif ($language === 'fr') {
                        echo 'Changer de Langue';
                    } else {
                        echo 'Cambiar Idioma';
                    }
?>
        </button>
    </form>
</body>
</html>