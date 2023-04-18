<?php
    // connexion à la BDD utilisateur simple
    $bdd = new PDO('mysql:host=localhost;dbname=newlife', 'hafarou','oh251020', 
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>