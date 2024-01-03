<?php
    try {
        $bd = new PDO('mysql:host=localhost;dbname=lprommi', 'root', '');
        } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
        }
?>