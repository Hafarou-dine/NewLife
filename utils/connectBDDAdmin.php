<?php
    // connexion à la BDD administrateur
    $bdd = new PDO('mysql:host=localhost;dbname=newlife', 'admin','oh251020', 
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>